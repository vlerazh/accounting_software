<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport; 
use App\Imports\CustomersImport; 

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('sales.customers.index')->with('customers',$customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $customer = Customer::create([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'phone'=> $request->input('phone'),
            'address'=> $request->input('address'),
        ]);
        if($request->input('can_login')){
            User::create([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'password'=> Hash::make('password')
            ]);
        }
        return redirect('/customers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return response()->json(['customer' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('sales.customers.edit')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $customer->update([
            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'phone'=> $request->input('phone'),
            'address'=> $request->input('address'),
        ]);
     
        return redirect('/customers'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect('/customers');
    }

    public function export() 
    {
        return Excel::download(new CustomersExport, 'customers.xlsx');
    }
    public function import() 
    {
        Excel::import(new CustomersImport,request()->file('file'));
           
        return redirect()->back();
    }

    public function all(){
        return Customer::all();
    }
}
