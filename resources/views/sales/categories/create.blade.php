@extends('layouts.app', ['activePage' => 'categories', 'titlePage' => __('Categories')])

@section('content')   
 <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">New Category</h4>
                        <p class="card-category">Here you can add a new category</p>
                    </div>
                    <div class="card-body">
                        <form action="/categories" method="POST">
                            @csrf
                           <div class="input-group mb-4">
                                <input type="text" class="form-control" placeholder="Enter name"  required name="name" >
                            </div>
                            <input type="submit" value="Cancel" class="btn btn-light">
                            <input type="submit" value="Save" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error )
            <li>
                {{ $error }}
            </li>
        @endforeach
    </div>
@endif
@endsection