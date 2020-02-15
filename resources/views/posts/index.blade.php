@extends('layouts.app')

@section('content')
    <div class="card card-default">
    <div class="card-header">
        Posts<a class="btn btn-success float-right mr-1  btn-sm " href="{{ route('posts.create') }}"> Add Posts</a>
    </div>
        <div class="card-body">
            @include('inc.feedback')

<table class="table">
            @if(count($posts)> 0)
        <thead>
        <th>Image</th>
        <th> Title</th>
        <th> Category</th>
        <th>Actions</th>
        </thead>
                    @foreach($posts as $post)


        <tbody>
        <tr>
        <td>

                <img height="60px" width="60px" src="{{asset('/storage/'.$post->image)}}">

        </td>

        <td>{{$post->title}}</td>
            <td><a href="{{ route('categories.edit' ,$post->category->id ) }}">{{$post->category->name}}</a></td>
            <td>
             @if($post->trashed())
                 <form action="{{ route('restore-posts',$post->id) }}" method="post">
                     @csrf
                     @method('put')
                    <button  type="submit" class="btn btn-info  mr-1  btn-sm "> Restore</button>
                 </form>

                    @else

                    <a   class="btn btn-info  mr-1  btn-sm " href="{{ route('posts.edit',$post->id) }}">Edit</a>

                @endif
            </td>
        <td>
                    <form action="{{  route('posts.destroy', $post->id )  }}" method="post">
                        @csrf
                        @method('delete')
                    <button type="submit" class="btn btn-danger  mr-1   btn-sm"   title="Normal delete">
                        {{ $post->trashed()  ? 'Delete' : 'Trash' }}
                    </button>
                    </form>


            </td>








        </tr>
        </tbody>



                    @endforeach


</table>








            @else
                <p>There Is No Posts</p>
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


