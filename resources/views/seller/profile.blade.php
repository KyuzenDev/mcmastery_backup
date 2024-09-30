@extends('seller.dashboard')
@section('seller')
    <!-- partial -->
    <div class="page-content">
        <x-form-alerts></x-form-alerts>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Edit Profile</h6>

                        <form class="forms-sample" action="{{ route('seller.update') }}" method="post">
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off"
                                    placeholder="Name" name="name" value="{{ $getRecord->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputUsername1" class="form-label">Username</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" name="username" value="{{ $getRecord->username }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ $getRecord->email }}" required>
                                <span style="color:red;">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
                                <i>(Leave blank if you are not changing the password)</i>
                            </div>
                            <button type="submit" class="btn btn-outline-primary me-2">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
