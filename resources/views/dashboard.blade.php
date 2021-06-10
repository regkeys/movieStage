@extends('layouts.appDashboard')

@section('content')

    @include('inc.messages')

    <div class="row justify-content-center">

        <!-- Navigation -->
        <div class="col-md-3">
            @include('/inc.nav-db')
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>BlockCity Movies</h4>
                </div>

                <div class="card-body">
                    <h4>movieStage</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <br>

                    <div class="card">
                        <div class="card-body">
                            <!-- Use data from the controller  -->
                            @if(count($uploads) > 0)
                                @foreach($uploads as $dataUp)
                                    <div class="">
                                        <div class="col-md-4 spacer2">
                                        @if($dataUp->poster == '')
                                                <a href="/upload/{{$dataUp->id}}"><img src="/img/comingsoon1.jpg" class="img-fluid" /></a>
                                        @else
                                                <a href="/upload/{{$dataUp->id}}"><img src="/storage/poster-files/{{$dataUp->name}}/{{$dataUp->poster}}" class="top-spacer img-fluid" /></a>
                                        @endif

                                        <p><h4>Title: {{$dataUp->title}}</h4></p>
                                        <p>Showing: {{$dataUp->start}}</p>
                                        <p>Tickets: {{$dataUp->tickets}}</p>
                                        <p>My Review:
                                            @if($dataUp->rating == 0) No Review @else {{$dataUp->rating}} out of 5 @endif
                                        </p>
                                    <p>
                                        <a href="/upload/{{$dataUp->id}}/edit" class="btn btn-primary">Edit movie</a>

                                        <form method="POST" action="{{ route('upload.destroy', [$dataUp->id]) }}" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </p>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <p>
                                    Thank you for joining our BlockCity movie club. We would like to give you an opportunity to create your own movie list and <a href="/upload"> browse other movies<a> added by club members.
                                    <br>Please click "Create your move list" below to start.  See our <a href="#">Privacy Policy</a>
                                </p>


                                <H4>*** Please create your own my movies: <a href="/upload/create" class="btn btn-primary">Create your own my movies </a></H4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <style>
        .spacer2{
            padding-left: 10px;
            border: 1px solid grey;
            margin: 5px;
            float: left;
        }
        .top-spacer{
            padding-top: 10px;
        }
    </style>



@endsection
