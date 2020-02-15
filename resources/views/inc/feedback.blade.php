@if($errors->any())
    <div class="alert alert-danger">
        <div class="list-group">

            @foreach($errors->all() as $error)
                <div class="list-group-item">
                    {{$error}}
                </div>
            @endforeach

        </div>
    </div>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success">
        {{  session()->get('success')  }}
    </div>

@elseif(session()->has('error'))
    <div class="alert alert-danger">
        {{session()->get('error')}}
    </div>
@endif

