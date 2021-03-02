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
                <div class="card-header"><h4>Dashboard - Manage Club Members</h4></div>

                <div class="card-body">

                    <div class="row" style="margin-bottom:24px;">
                        <?php
                            $userCount = count($users);

                        ?>
                            <div class="col-md-6">
                                <!--div class="card" style="width: 18rem;"-->
                                <div class="card" style="background-color: greenyellow;">
                                   <div class="card-body text-center">
                                        <h5 class="card-title">Number of users:</h5>
                                        <p class="card-text"><h1>{{$userCount}}</h1></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <!--div class="card" style="width: 18rem;"-->
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><br></h5>
                                        <p class="card-text"><h1><br></h1></p>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <table class="table table-striped">
                        <tr>
                            <th><h5>ID</h5></th>
                            <th><h5>Name</h5></th>
                            <th><h5>Email</h5></th>
                            <th><h5>Role</h5></th>
                            <th><h5>Edit</h5></th>
                            <th><h5>Delete</h5></th>
                        </tr>

                        @if(count($users) > 0)
                            @foreach($users as $user1)
                                <tr>
                                    <td>{{$user1->id}}</td>
                                    <td>{{$user1->name}}</td>
                                    <td><a href="mailto:{{$user1->email}}">{{$user1->email}}</a></td>
                                    <td>{{ implode(',', $user1->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <!-- be sure if you get error missing parameter to give it the $user1->id -->
                                    <td><a href="{{ route('admin.users.edit', $user1->id) }}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                                    <td>
                                        <form action="{{ route('admin.users.destroy', $user1) }}" method="POST">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
