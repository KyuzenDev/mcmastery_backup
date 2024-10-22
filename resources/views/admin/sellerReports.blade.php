@extends('admin.dashboard')

@section('admin')
    <div class="page-content">
        <h4 class="mb-3">Seller Reports</h4>

        <!-- Total Admin Commission di bagian atas -->
        <div class="alert alert-info">
            <h5>Total Admin Commission (Rp): {{ number_format($totalAdminCommission, 2) }}</h5>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                @if ($sellerReports->isNotEmpty())
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Seller Name</th>
                                <th>Total Seller Commission (Rp)</th> <!-- Ubah menjadi komisi seller -->
                                <th>Number of Reports</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sellerReports as $report)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $report['seller']->name }}</td>
                                    <td>{{ number_format($report['totalSellerCommission'], 2) }}</td> <!-- Menampilkan komisi seller -->
                                    <td>{{ $report['reportsCount'] }}</td> <!-- Menampilkan jumlah laporan -->
                                    <td>
                                        <a href="{{ route('admin.sellerDetails', $report['seller']->id) }}" class="btn btn-primary">Details</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No sellers found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
