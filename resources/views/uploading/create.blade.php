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
                    <h4>Dashboard - Create Movie Package</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('upload.store') }}" enctype="multipart/form-data">
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
                                <input id="poster" type="file" @error('poster') is-invalid @enderror" name="poster">
                            </div>
                        </div>
                        <hr>


                        <div class="col-md-12">
                            <h4>Movie Information:</h4>
                        </div>
                        <div class="form-group row">
                            <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Movie title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title"  placeholder="Please enter movie title" autofocus>
                                @error('title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="length" class="col-md-3 col-form-label text-md-right">{{ __('Movie length') }}</label>
                            <div class="col-md-6">
                                <select id="length" name="length">
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


                        <div class="col-md-8">
                            <!--
                                * Code to verify not a robot - will require a check box before proceeding - disables the register button
                                * add ID above to the button - id="btncheck" and javascript below
                                -->
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
                            <input id="check" name="checkbox" type="checkbox" style="margin-right:10px;">
                            I approve this movie package
                        </div>

                        <div class="form-group col-md-8 col-form-label text-md-right">
                            <button type="submit" class="btn btn-primary" id="btncheck">
                                {{ __('Create movie package') }}
                            </button>

                            <a href="/DASHBOARD" class="btn btn-warning float-right" style="margin-left: 50px;">Cancel</a>
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


    <script>
        // disable Upload button and enable when box checked - **must be in section of page
        $(function() {
            var chk = $('#check');
            var btn = $('#btncheck');

            chk.on('change', function() {
                btn.prop("disabled", !this.checked);//true: disabled, false: enabled
            }).trigger('change'); //page load trigger event
        });
    </script>


@endsection
