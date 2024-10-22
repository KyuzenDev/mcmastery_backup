@extends('user.dashboard')

@section('user')
    <div class="page-content">
        <h4 class="mb-4">Payment for {{ $product->name }}</h4>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Price: Rp. {{ number_format($product->price, 2) }}</h5>

                <form action="{{ route('user.products.checkout', $product->id) }}" method="GET">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-success">Proceed to Checkout</button>
                    <a href="{{ route('user.products.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
