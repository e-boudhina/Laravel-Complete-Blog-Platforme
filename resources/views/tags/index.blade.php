@extends('layouts.app')
@section('content')

    <div class="card card-default">
        <div class="card-header">
            Tags <a class="btn btn-success float-right mr-1  btn-sm " href="{{ route('tags.create') }}">  Add tag</a>
        </div>
        <div class="card-body">
            @include('inc.feedback')


            @if(count($tags) > 0)
                <table class="table">
                    <thead>
                    <th>Name</th>
                    <th> Posts count </th>
                    <th>Action</th>
                    </thead>

                    <tbody>

                    @foreach($tags as $tag)
                        <tr>
                            <td>
                                {{$tag->name}}
                            </td>
                            <td>
                                {{$tag->posts->count()}}
                            </td>
                            <td>
                                <div>
                                    <a class="btn btn-warning float-right mr-1  btn-sm " href="{{ route('tags.edit',$tag->id) }}"> Edit</a>
                                    <form  method="post" action="{{route('tags.destroy',$tag->id)}}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger float-right mr-1   btn-sm"  onclick="handleDeleting()" data-toggle="tooltip" data-placement="top" title="Normal delete">Delete</button>

                                    </form>
                                    <button class="btn btn-danger float-right mr-1   btn-sm" onclick="handleDelete({{$tag->id}})" data-toggle="tooltip" data-placement="bottom" title="Delete Using onClick Javascript Function and Modals along side a Form embedded with-in">Delete JS</button>
                                </div>
                            </td>
                            @endforeach

                            @else
                                <p>There is no tags in yet</p>
                            @endif

                        </tr>
                    </tbody>
                </table>


                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">

                        <form  method="post"   id="deletetagForm">
                            @csrf
                            @method('delete')




                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete tag</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center text-bold">Are you sure you want to delete this tag !</p>
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
            var form = document.getElementById('deletetagForm')
            form.action = '/tags/'+id

            $('#deleteModal').modal('show')

        }
    </script>
@endsection
