@extends('admin.dashboard')
@section('admin')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/users') }}">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
        <x-form-alerts></x-form-alerts>
        <div class="row">
            <div class="col-lg-12 stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Search Users</h6>
                        <form method="get">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <input type="text" name="username" class="form-control"
                                        value="{{ Request()->username }}" placeholder="Search">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <select name="role" class="form-control">
                                        <option value="-">Select Role</option>
                                        <option value="admin"{{ Request()->role == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="seller"{{ Request()->role == 'seller' ? 'selected' : '' }}>Seller
                                        </option>
                                        <option value="user"{{ Request()->role == 'user' ? 'selected' : '' }}>User
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary">Submit</button>
                            <a href="{{ url('admin/users') }}" class="btn btn-danger">Reset</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">List Users</h4>
                        <div class="table-responsive pt-3">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    ?>
                                    @forelse ($getRecord as $data)
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>
                                                <form id="updateRoleForm{{ $data->id }}" method="POST"
                                                    action="{{ route('admin.updateRole', $data->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select class="form-select" name="role"
                                                        onchange="showModal({{ $data->id }}, 'role')">
                                                        <option value="admin"
                                                            {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="seller"
                                                            {{ $data->role == 'seller' ? 'selected' : '' }}>Seller</option>
                                                        <option value="user"
                                                            {{ $data->role == 'user' ? 'selected' : '' }}>User</option>
                                                    </select>
                                                </form>
                                            </td>

                                            <td>
                                                <form id="updateStatusForm{{ $data->id }}" method="POST"
                                                    action="{{ route('admin.updateStatus', $data->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select class="form-select" name="status"
                                                        onchange="showModal({{ $data->id }}, 'status')">
                                                        <option value="active"
                                                            {{ $data->status == 'active' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="pending"
                                                            {{ $data->status == 'pending' ? 'selected' : '' }}>Pending
                                                        </option>
                                                        <option value="rejected"
                                                            {{ $data->status == 'rejected' ? 'selected' : '' }}>Rejected
                                                        </option>
                                                    </select>
                                                </form>
                                            </td>



                                            <td>{{ $data->created_at }}</td>
                                            <!-- Tombol untuk Memunculkan Modal -->
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $data->id }}">
                                                    <i data-feather="trash-2" width="16" height="12"></i>
                                                </button>
                                            </td>

                                            <!-- Modal Bootstrap 5 -->
                                            <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel">Konfirmasi
                                                                Penghapusan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda yakin ingin menghapus akun ini? Tindakan ini tidak
                                                            dapat diurungkan.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <!-- Form Penghapusan -->
                                                            <form action="{{ route('admin.delete', $data->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">No Record Found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div style="padding: 10px; float: right;">
                            {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Konfirmasi -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to make this change?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">Confirm</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden Inputs untuk Menyimpan Data -->
        <input type="hidden" id="modalUserId">
        <input type="hidden" id="modalType">

    </div>
@endsection
