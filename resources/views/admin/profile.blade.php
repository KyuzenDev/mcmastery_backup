@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <x-form-alerts></x-form-alerts>

        <!-- Profile Image -->
        <div class="mb-3">
            <img class="profile-image"
                src="{{ $getRecord->profile_image ? asset('storage/' . $getRecord->profile_image) : asset('default-profile.png') }}"
                alt="{{ $getRecord->name ?? 'Default Admin' }}">
        </div>

        <!-- Edit Profile Form -->
        <form class="forms-sample" action="{{ route('admin.update') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                    value="{{ $getRecord->name }}" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="{{ $getRecord->username }}" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                    value="{{ $getRecord->email }}" required>
                <span style="color:red;">{{ $errors->first('email') }}</span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                <i>(Leave blank if you are not changing the password)</i>
            </div>
            <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image">
            </div>
            <button type="submit" class="btn btn-outline-primary me-2">Submit</button>
        </form>
    </div>
@endsection
