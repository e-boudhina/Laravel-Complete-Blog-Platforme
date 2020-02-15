@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            Users
        </div>
        <div class="card-body">
            @include('inc.feedback')

            <table class="table">
                @if(count($users)> 0)
                    <thead>
                    <th>Image</th>
                    <th> User Name</th>
                    <th> User Email</th>
                    <th>Actions</th>
                    </thead>
                    @foreach($users as $user)


                        <tbody>
                        <tr>
                            <td>

                                <img width="40px" height="40px" style="border-radius: 50%;" src="{{ Gravatar::src($user->email) }}">

                            </td>

                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if(!$user->isAdmin())
                                    <form action="{{route('users.make-admin' ,$user->id)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm" >Make admin</button>
                                    </form>

                                    @else
                                    <button class="btn btn-success btn-sm" disabled>Administrator</button>
                                @endif
                            </td>








                        </tr>
                        @endforeach
                        </tbody>

            </table>
            @else
                <h3 class="text-center">No Users found</h3>

            @endif


            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <form  method="post"   id="deleteCategoryForm">
                        @csrf
                        @method('delete')




                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center text-bold">Are you sure you want to delete this Category !</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>





        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        function handleDelete(id) {
            console.log('delete',id)
            var form = document.getElementById('deleteCategoryForm')
            form.action = '/categories/'+id

            $('#deleteModal').modal('show')

        }
    </script>
@endsection


