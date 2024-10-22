@extends('seller.dashboard')
@section('seller')
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Manage Products</h4>
            </div>
            <div class="d-flex align-items-center flex-wrap text-nowrap">
                <form action="{{ route('seller.products.manage') }}" method="GET" class="me-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                <a href="{{ route('seller.products.create') }}" class="btn btn-primary">Add New Product</a>
            </div>
        </div>

        <x-form-alerts></x-form-alerts>
        <div class="row">
            @forelse ($getRecord as $product)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        @if ($product->video)
                            <video class="card-img-top" controls>
                                <source src="{{ asset('storage/' . $product->video) }}" type="video/mp4">
                                <source src="{{ asset('storage/' . $product->video) }}" type="video/mov">
                                <source src="{{ asset('storage/' . $product->video) }}" type="video/webm">
                                Your browser does not support the video tag.
                            </video>
                        @elseif ($product->image)
                            <img class="card-img-top" src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}">
                        @else
                            <img class="card-img-top" src="https://via.placeholder.com/150" alt="No Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text short-description" id="short-description-{{ $product->id }}">
                                {{ Str::limit($product->description, 100) }}
                                @if (strlen($product->description) > 100)
                                    <a href="javascript:void(0)" onclick="showFullDescription({{ $product->id }})">See
                                        more</a>
                                @endif
                            </p>
                            <p class="card-text full-description" id="full-description-{{ $product->id }}"
                                style="display:none;">
                                {{ $product->description }}
                                <a href="javascript:void(0)" onclick="showShortDescription({{ $product->id }})">Show
                                    less</a>
                            </p>
                            <p class="card-text mb-3">Price: Rp. {{ number_format($product->price, 2) }}</p>
                            <a href="{{ route('seller.products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $product->id }}">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the product "{{ $product->name }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('seller.products.delete', $product->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>No products available.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
