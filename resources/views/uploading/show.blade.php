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
                    <h4>Movie Package Info</h4>
                </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4 spacer2">
                                  <br>
                                @if($findInfo->poster == '')
                                    <img src="/img/comingsoon1.jpg" class="img-fluid" />
                                @else
                                    <img src="/storage/poster-files/{{$findInfo->name}}/{{$findInfo->poster}}" class="img-fluid" />
                                @endif
                            </div>

                            <div class="col-md-4 spacer2">
                                <br>
                                <p><h4>Title: {{$findInfo->title}}</h4><hr></p>
                                <p>Length: {{$findInfo->length}}<hr></p>
                                <p>Showing: {{$findInfo->start}}<hr></p>
                                <p>{{$findInfo->description}}<hr></p>
                                <p>Available Tickets: {{$findInfo->tickets}}<hr></p>
                                <p>Owner Review: @if($findInfo->rating == 0) No Review @else {{$findInfo->rating}} out of 5 @endif</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <p style="margin: 15px;">
                    <button onclick="goBack()" class="btn btn-primary">Back</button>
                    </p>
            </div>
        </div>
    </div>



     <script>
         function goBack() {
             window.history.back();
         }
     </script>

@endsection
