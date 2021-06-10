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
                    <h4>Movie Listing</h4>
                </div>

                <span class="card-body">

                    <div class="row" style="margin-bottom:24px;">
                        <?php
                            $dataUL = count($dataUploaded);
                        ?>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center" style="background-color:deepskyblue;">
                                    <h5 class="card-title">Movies showing:</h5>
                                    <p class="card-text"><h1>{{$dataUL}}</h1></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Reviewed Movies - rating = 0 out of 5</h5>
                                    <p class="card-text">
                                        @if(count($dataUploaded) > 0)
                                            @foreach($dataUploaded as $ratedUp1)
                                                @if($ratedUp1->rating > 0)
                                                    {{$ratedUp1->title}}-{{$ratedUp1->rating}},
                                                @endif
                                            @endforeach
                                        @endif
                                        <hr>
                                        <h5>Non Rviewed Movies</h5>
                                        @if(count($dataUploaded) > 0)
                                            @foreach($dataUploaded as $ratedUp2)
                                                @if($ratedUp2->rating == 0)
                                                    <span style="color:#ff0000">{{$ratedUp2->title}},</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Use data from the controller  -->
                    @if(count($dataUploaded) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th><h4>Listing</h4></th>
                                 @can('manage-users')
                                    <th><h4>Edit</h4></th>
                                    <th><h4>Delete</h4></th>
                                @endcan
                            </tr>
                            @foreach($dataUploaded as $dataUp)
                                <tr>
                                    <td>
                                        <h5>Title: <a href="/upload/{{$dataUp->id}}">{{$dataUp->title}}</a></h5>
                                        @if($dataUp->poster == '')
                                            <a href="/upload/{{$dataUp->id}}"><img class="movie-s1 img-fluid" src="/img/comingsoon1.jpg" /></a>
                                        @else
                                            <a href="/upload/{{$dataUp->id}}"><img class="movie-s1 img-fluid" src="/storage/poster-files/{{$dataUp->name}}/{{$dataUp->poster}}" /></a>
                                        @endif
                                       <br>

                                    </td>

                                    @can('manage-users')
                                    <td>
                                        <a href="/upload/{{$dataUp->id}}/edit" class="btn btn-primary">Edit</a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('upload.destroy', [$dataUp->id]) }}" enctype="multipart/form-data">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                    @endcan

                                </tr>
                            @endforeach
                        </table>
                        <!-- PAGINATION Based on the Variable - see counted-->
                            {{$dataUploaded->links()}}
                    @else
                        <H4>No Movies showing at this time....</H4>
                    @endif
                </div>
            </div>
        </div>
    </div>




  <style>
      .movie-s1{
          width: 200px;
          height: 200px;
      }
      .down-20{
          margin-bottom: 20px;
      }
  </style>

@endsection


