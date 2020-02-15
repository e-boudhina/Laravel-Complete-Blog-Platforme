@extends('layouts.app')

@section('content')


        <div class="card car-default">
        <div class="card-header">
            Update Category <a class="btn btn-secondary float-right mr-1  btn-sm " href="{{ route('categories.index') }}"> Go Back</a>
        </div>
        <div class="card-body">
            @include('inc.feedback')
        <form method="post" action="{{route('categories.update',$category->id)}}">
            @csrf
            @method('patch')
            <div class="form-group">
                <input type="text" class="form-control col-2 text-center  " name="name" placeholder="Name" value="{{$category->name}}">
                <button class="btn btn-success float-left my-2 ">Update Category</button>
            </div>

        </form>
        </div>
    </div>
@endsection
