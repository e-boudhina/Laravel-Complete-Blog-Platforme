@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($post) ? 'Edit Post':'Create post ' }} <a class="btn btn-secondary float-right mr-1  btn-sm " href="{{ route('posts.index') }}"> Go Back</a>
            </div>

            <div class="card-body">

                @include('inc.feedback')
                <form method="POST" action="  {{ isset($post) ? route('posts.update',$post->id) :  route('posts.store') }}" enctype="multipart/form-data" >
                    @csrf
                    @if(isset($post))

                        @method('put')
                    @endif
                    <div class="form-group">

                        <input type="text" class="form-control col-2 text-center" name="title" placeholder="Title" value="{{isset($post) ? $post->title:old('title')}}">
                    </div>

                        <div class="form-group">
                        <textarea class="form-control" cols="5" rows="5" name="description" placeholder="Description">{{isset($post) ? $post->description: old('description')}}</textarea>
                        </div>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <input id="content" type="hidden" name="content" value="{{isset($post) ? $post->content:old('content')}} ">
                        <trix-editor input="content"></trix-editor>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control col-4 text-center  " id="published_at" name="published_at" placeholder="Published At" value="{{isset($post) ? $post->published_at:old('published_at')}}">
                    </div>
                    @if(isset($post))
                    <div class="form-group">
                        <img src="{{asset('/storage/'.$post->image)}}" style="width:  100%;">
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="image">Image name : {{isset($post) ? $post->image :old('image')}}</label>
                        <input type="file" class="form-control text-center  " name="image" placeholder="Image" value="">
                    </div>

                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select name="category_id" id="category" class="form-control">
                            @if(isset($post) )
                                <option value="{{$post->category_id}}">
                                    {{$post->category->name}}

                                </option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>
                                @endforeach
                                @else
                                <!-- Note there is another way to do  this wich is more simple i just chose this method deliberately because its challenging -->
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>
                                @endforeach
                                @endif
                        </select>
                    </div>
                    @if($tags->count() >0)
                    <div class="form-group">
                        <!-- Tags should be inside an array if you you do not use [] it will handle it as a single object -->
                    <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                        @foreach($tags as $tag)
                            <!-- parsing the tags into array if they are in an array  |
                            This test is only performed if we are redirected from edit page with the post id |
                             if you do not use pluck method you will return an array of arrays of objects ( id , name,created at..) but we only need the id -->
                            <option value="{{$tag->id}}"
                            @if(isset($post))
                                    @if($post->hasTag($tag->id))
                                    selected
                                        @endif
                            @endif
                            >
                                {{$tag ->name}}
                            </option>
                        @endforeach
                    </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-left my-2 ">{{isset($post) ? 'Update post' :'Create post'}}</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        flatpickr('#published_at',  { enableTime: true})
        $(document).ready(function() {
            $('.tags-selector').select2();
        });
    </script>

@endsection

@section('css')
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection


