@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                Create Category <a class="btn btn-secondary float-right mr-1  btn-sm " href="{{ route('categories.index') }}"> Go Back</a>
            </div>

        <div class="card-body">

            @include('inc.feedback')
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf

            <div class="form-group">
                <input type="text" class="form-control col-2 text-center  " name="name" placeholder="Name" value="{{old('name')}}">
                <button class="btn btn-success float-left my-2 ">Create Category</button>
            </div>

        </form>
        </div>
    </div>
    </div>
@endsection


