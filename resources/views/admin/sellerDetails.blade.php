@extends('admin.dashboard')

@section('admin')
    <div class="page-content">
        <h4 class="mb-3">Seller Details</h4>

        <div class="card mb-4">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <img src="{{ asset('storage/' . $seller->profile_image) }}" alt="{{ $seller->name }}"
                            class="photo_image img-fluid">
                    </div>
                    <div class="col-md-9">
                        <h5>{{ $seller->name }}</h5>
                        <p>Email: {{ $seller->email }}</p>
                    </div>
                </div>

                @if ($seller->products->isNotEmpty())
                    <h5 class="mb-3">Products:</h5>

                    <!-- Menggunakan Bootstrap's card layout untuk produk -->
                    <div class="row">
                        @php
                            // Mengurutkan produk berdasarkan jumlah pembeli
                            $sortedProducts = $seller->products->sortByDesc(function ($product) {
                                return $product->transactions->count();
                            });
                        @endphp

                        @foreach ($sortedProducts as $product)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <!-- Menampilkan thumbnail jika tersedia -->
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="card-img-top img-fluid">
                                    @endif
                                    @if ($product->video)
                                        <div class="mt-3">
                                            <video width="100%" controls>
                                                <source src="{{ asset('storage/' . $product->video) }}" type="video/mp4">
                                                <source src="{{ asset('storage/' . $product->video) }}" type="video/mov">
                                                <source src="{{ asset('storage/' . $product->video) }}" type="video/webm">
                                                Your browser does not support the video tag.
                                            </video>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text">Price: Rp {{ number_format($product->price, 2) }}</p>
                                        <p class="card-text mb-2">Total Buyers: {{ $product->transactions->count() }}</p>

                                        <!-- Menampilkan deskripsi produk -->
                                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                                        <!-- Memotong deskripsi agar tidak terlalu panjang -->

                                        <!-- Menampilkan video jika tersedia -->

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-3">No products found for this seller.</p>
                @endif

                <!-- Tambahkan list laporan dari user tentang seller ini -->
                @if ($seller->reports->isNotEmpty())
                    <h5 class="mt-3 mb-3">User Reports:</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Reported By</th>
                                <th>Reason</th>
                                <th>Date Reported</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seller->reports as $report)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ $report->reason }}</td>
                                    <td>{{ $report->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mt-3">No reports found for this seller.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
