@extends('layouts.appDashboard')

@section('content')

    <!-- manage who can see this infor with the gate -->


    @include('inc.messages')

    <div class="row justify-content-center">
        <!-- Navigation -->
        <div class="col-md-3">
            @include('/inc.nav-db')
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header"><h4>Dashboard - Profile Information</h4></div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th><h5>User-ID</h5></th>
                                <th><h5>Name</h5></th>
                                <th><h5>Email</h5></th>
                                <th><h5>Registered</h5></th>
                            </tr>

                            <tr>
                                <td>{{ Auth::user()->name }}-{{ Auth::user()->id }}</td>
                                <td>{{ Auth::user()->name }}</td>
                                <td>{{ Auth::user()->email }}</td>
                                <td>{{ Auth::user()->created_at}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
