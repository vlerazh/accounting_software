<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('superadmin.users.index')->with('users',$users);
    }


    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('superadmin.users.create' , compact('roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|alpha_num|min:6',
            'role' => 'required',
            'email' => 'required|email|unique:users'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->assignRole($request->role);

        if($request->has("permissions")){
            $permissions = $request->get('permissions');
            foreach($permissions as $permission){
                $user->givePermissionTo($permission);
            }
        }
        $user->save();
        return redirect('users')->with('sucess','User added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'nullable|alpha_num|min:6',
            'role' => 'required',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }


        if($request->has('role')){
            $userRole = $user->getRoleNames();
            foreach($userRole as $role){
                $user->removeRole($role);
            }

            $user->assignRole($request->role);
        }

        if($request->has('permissions')){
            $userPermissions = $user->getPermissionNames();
            foreach($userPermissions as $permssion){
                $user->revokePermissionTo($permssion);
            }

            $user->givePermissionTo($request->permissions);
        }


        $user->save();

        return redirect('users')->with('success', 'User updated succesfully');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', '=', $id)->get()->first();
        $user->delete();
        return redirect('users');
    }

    public function search(Request $request){
        $searchWord = $request->get('table_search');
        $users = User::where(function($query) use ($searchWord){
            $query->where('name', 'LIKE', "%$searchWord%")
            ->orWhere('email', 'LIKE', "%$searchWord%");
        })->latest()->get();

        $users->transform(function($user){
            $user->role = $user->getRoleNames()->first();
            $user->userPermissions = $user->getPermissionNames();
            return $user;
        });

        return view('superadmin.users.index')->with('users', $users);
        
    }

    public function updateStatus(Request $request, $id){
        $message_title = null;
        $message_body = null;
        $user = User::where('id' , '=' , $id)->first();
        if($user->status == 0){
            $user->status = 1;
            $message_title = 'Activation';
            $message_body = 'activated';
        }else{
            $user->status = 0;
            $message_title = 'Deactivation';
            $message_body = 'deactivated';
        }  
        $user->save();
        $this->sendEmail($message_title ,$message_body, $user->email);
        return redirect('users');
    }

    public function sendEmail($message_title ,$message_body ,$email){
        
        $details = [
            'subject' => 'Your account has been ' . $message_body,
            'title' => 'Account ' . $message_title,
            'body' => 'Accounting software has ' . $message_body .' you account. Form more information please contact administration.'
        ];

        \Mail::to($email)->send(new \App\Mail\Email($details));
        return redirect('users');
    }
}

