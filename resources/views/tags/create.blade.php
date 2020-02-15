@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($tag) ? 'Edit Tag':'Create Tag ' }}<a class="btn btn-secondary float-right mr-1  btn-sm " href="{{ route('tags.index') }}"> Go Back</a>
            </div>

            <div class="card-body">

                @include('inc.feedback')
                <form method="POST" action="{{ isset($tag) ? route('tags.update',$tag->id) :  route('tags.store') }}">
                    @csrf
                    @if(isset($tag))

                        @method('put')
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control col-2 text-center  " name="name" placeholder="Name" value=" {{ isset($tag) ? $tag->name:old('name')}}">
                        <button class="btn btn-success float-left my-2 ">{{ isset($tag) ? 'Update Tag':'Create Tag ' }}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


