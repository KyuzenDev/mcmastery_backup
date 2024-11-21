@extends('user.dashboard')

@section('user')
    <div class="page-content">
        <h4 class="mb-3">Checkout</h4>

        <div class="card mb-4">
            <div class="card-body">
                <!-- Display product information -->
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">Price: Rp. {{ number_format($product->price, 2) }}</p>

                <!-- Purchase form -->
                <form action="{{ route('user.products.purchase', $pendingTransaction->id) }}" method="POST">
                    @csrf

                    <!-- Payment method selection -->
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Select Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="" disabled selected>Select payment method</option>
                            <option value="gopay">GoPay</option>
                            <option value="dana">Dana</option>
                            <option value="ovo">OVO</option>
                        </select>
                    </div>

                    <!-- Submit buttons -->
                    <button type="submit" class="btn btn-primary">Confirm Purchase</button>
                    <a href="{{ route('user.transactions.index') }}" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
        </div>
    </div>
@endsection
