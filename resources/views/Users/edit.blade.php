@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">My Profile</div>

        <div class="card-body">

            @include('inc.feedback')



            <form action="{{route('route.update-profile')}}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                <label for="name">Name</label>
                    <input class="form-control" name="name" id="name" value="{{$user->name}}">

                </div>
                <div class="form-group">
                <label for="about">About Me</label>
                    <textarea class="form-control" name="about" id="about" cols="5" rows="5">{{$user->about}}</textarea>
        </div>

                <div class="form-group">
                <label for="button">Email</label>
                <input class="form-control" name="email"  value="{{$user->email}}" disabled >
                </div>
                <button type="submit" class="btn btn-success">Update Profile</button>
            </form>


        </div>
    </div>
    </div>

@endsection
