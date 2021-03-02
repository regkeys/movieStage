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
                <div class="card-header"><h4>Dashboard - Edit User Role & Info </h4></div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">

                            <form action="{{route('admin.users.update', $user)}}" method="POST">
                                    @csrf
                                    {{method_field('PUT')}}

                                <br>
                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-left">Name:</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" required autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-left">Email:</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="email" class="col-md-2 col-form-label text-md-left">Roles:</label>
                                    <div class="col-md-6">
                                    @foreach($roles as $role1)
                                        <div class="form-check">
                                            <input type="checkbox" name="roles[]" value="{{$role1->id}}"
                                            @if($user->roles->pluck('id')->contains($role1->id)) checked @endif>
                                            <label>{{$role1->name}}</label>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
