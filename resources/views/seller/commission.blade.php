@extends('seller.dashboard')

@section('seller')
    <div class="page-content">
        <h4 class="mb-3">Your Earnings</h4>

        <div class="card mb-4">
            <div class="card-body">
                <p>Total Earnings: Rp. {{ number_format($totalCommission, 2) }}</p>

                @if ($commissions->isNotEmpty())
                    <h5>Transaction Details:</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Transaction ID</th>
                                <th>Product Name</th>
                                <th>Buyer Name</th>
                                <th>Price (Rp)</th>
                                <th>Earnings (Rp)</th> <!-- Pendapatan seller setelah potong komisi -->
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($commissions as $commission)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $commission->id }}</td>
                                    <td>{{ $commission->product->name }}</td>
                                    <td>{{ $commission->user->name }}</td>
                                    <td>{{ number_format($commission->amount, 2) }}</td>
                                    <td>{{ number_format($commission->amount * (1 - 0.10), 2) }}</td> <!-- 90% dari harga -->
                                    <td>
                                        @if ($commission->status === 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($commission->status === 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif($commission->status === 'failed')
                                            <span class="badge bg-danger">Failed</span>
                                        @else
                                            <span class="badge bg-secondary">Unknown</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No transactions found.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
