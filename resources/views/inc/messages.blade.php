<!--  MESSAGES ERROR FILE  -->


@if(count($errors) > 0)
    <div class="alert alert-danger">
        <h3>Missing Information</h3>
        <hr>
        @foreach($errors->all() as $error)
            <ul>
                <li>
                     {{$error}}
                </li>
            </ul>
        @endforeach
    </div>
@endif



@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif



@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif
