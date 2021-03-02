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
                    <h4>Dashboard - movieStage2 Edit Movie Package</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('upload.update', [$findInfo]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <!-- hidden field for poster folder -->
                            <div class="col-md-6">
                                <input id="name" type="hidden" class="form-control @error('name') is-invalid @enderror" name="name"  value="{{ Auth::user()->name }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h4>Movie Poster:</h4>
                        </div>
                        <div class="form-group row">
                            <label for="poster" class="col-md-3 col-form-label text-md-right">{{ __('Movie Poster: *image') }}</label>
                            <div class="col-md-9">
                                @if($findInfo->poster == '')
                                    <input id="poster" type="file" @error('poster') is-invalid @enderror" name="poster"><br>
                                @else
                                    <div class="row">
                                        <div class="col-md-4">Current file: <img src="/storage/poster-files/{{$findInfo->name}}/{{$findInfo->poster}}" style="width: 75px; height: 75px;"></div>
                                        Replace file:  <div class="col-md-4"><input id="poster" type="file" @error('poster') is-invalid @enderror" name="poster"></div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>


                        <div class="col-md-12">
                            <h4>Movie Information:</h4>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Movie title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"  value="{{$findInfo->title}}">
                                @error('title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="length" class="col-md-3 col-form-label text-md-right">{{ __('Movie length') }}</label>
                            <div class="col-md-6">
                                <select id="length" name="length">
                                    <option value="{{$findInfo->length}}" selected>{{$findInfo->length}}</option>
                                    <option value="1 hr">1 hr</option>
                                    <option value="1.5 hrs">1.5 hrs</option>
                                    <option value="2 hrs">2 hrs</option>
                                    <option value="2.5 hrs">2.5 hrs</option>
                                    <option value="3 hrs">3 hrs</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="start" class="col-md-3 col-form-label text-md-right">{{ __('Movie start time') }}</label>
                            <div class="col-md-6">
                                <select id="start" name="start">
                                    <option value="{{$findInfo->start}}" selected>{{$findInfo->start}}</option>
                                    <option value="1:00 pm">1:00 pm</option>
                                    <option value="1.30 pm">1.30 pm</option>
                                    <option value="2:00 pm">2:00 pm</option>
                                    <option value="2.30 pm">2.30 pm</option>
                                    <option value="3:00 pm">3:00 pm</option>
                                    <option value="3.30 pm">3.30 pm</option>
                                    <option value="4:00 pm">4:00 pm</option>
                                    <option value="4.30 pm">4.30 pm</option>
                                    <option value="5:00 pm">5:00 pm</option>
                                    <option value="5.30 pm">5.30 pm</option>
                                    <option value="6:00 pm">6:00 pm</option>
                                    <option value="6.30 pm">6.30 pm</option>
                                    <option value="7:00 pm">7:00 pm</option>
                                    <option value="7.30 pm">7.30 pm</option>
                                    <option value="8:00 pm">8:00 pm</option>
                                    <option value="8.30 pm">8.30 pm</option>
                                    <option value="9:00 pm">9:00 pm</option>
                                    <option value="9.30 pm">9.30 pm</option>
                                    <option value="10:00 pm">10:00 pm</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Movie description') }}</label>
                            <div class="col-md-6">
                                <textarea rows="6" id="description" class="form-control @error('description') is-invalid @enderror" name="description">
                                     {{$findInfo->description}}
                                </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            <h4>Additional Information:</h4>
                        </div>
                        <div class="form-group row">
                            <label for="tickets" class="col-md-3 col-form-label text-md-right">{{ __('Set available tickets') }}</label>
                            <div class="col-md-6">
                                <select id="tickets" name="tickets">
                                    <option value="{{$findInfo->tickets}}" selected>{{$findInfo->tickets}}</option>
                                    <option value="0">0</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tickets" class="col-md-3 col-form-label text-md-right">{{ __('Review movie') }}</label>
                            <div class="col-md-6">
                                <select id="rating" name="rating">
                                    <option value="{{$findInfo->rating}}" selected>{{$findInfo->rating}}</option>
                                    <option value="0">No rating</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <hr>

                        <!-- spoofing the method because it needs to be a PUT or PATCH - see route:list to check - but we can't put PUT in method above will get an error      -->
                        {{ method_field('PUT') }}

                        <div class="form-group col-md-6 col-form-label text-md-right">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            *image formats accepted: JPEG, JPG, PNG
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
