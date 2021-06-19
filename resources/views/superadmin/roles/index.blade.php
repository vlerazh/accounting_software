@extends('layouts.app' , ['activePage' => 'roles', 'titlePage' => __('Roles')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Roles Table</h3>
                <div class="card-tools">
                    <a href="{{ route('roles.create') }} " class="btn btn-primary"><i class="fas fa-shield-alt"></i> Add new Role</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Date Posted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role )
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions as $permission )
                                        <button class="btn btn-warning" role="button"><i class="fas fa-shield-alt"></i> {{ $permission->name }}</button>
                                    @endforeach
                                </td>
                                <td><span class="tag tag-success">{{ $role->created_at }}</span></td>
                                {{--  <td>
                                    <a href="{{ route('role.show', $role->id ) }}" class="btn btn-info">Change Permission</a>
                                    <a href="{{ route('role.destroy',$role->id ) }}" class="btn btn-danger">Delete</a>
                                </td>  --}}
                            </tr>
                        @empty
                            <tr>
                                <td><i class="fa fa-folder-open"></i> No Record found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection