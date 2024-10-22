<!-- resources/views/seller/products/edit.blade.php -->
@extends('seller.dashboard')

@section('seller')
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Edit Product</h4>
            </div>
        </div>

        <!-- Tambahkan enctype="multipart/form-data" untuk menangani file upload -->
        <form method="POST" action="{{ route('seller.products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <!-- Nama Produk -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            </div>

            <!-- Harga Produk -->
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}" required>
            </div>

            <!-- Deskripsi Produk -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="productDescription" maxlength="500">{{ $product->description }}</textarea>
                <small id="descriptionCount" class="form-text text-muted">0/500 characters</small>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Thumbnail Image Produk -->
            <div class="mb-3">
                <label for="productThumbnail" class="form-label">Thumbnail Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">

                <!-- Tampilkan thumbnail saat ini jika ada -->
                @if ($product->image)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Thumbnail" width="500">
                    </div>
                @endif

                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
@endsection
@section('script')
    <script>
        document.getElementById('productDescription').addEventListener('input', function() {
            const maxLength = 500;
            const currentLength = this.value.length;

            const charCount = document.getElementById('descriptionCount');
            charCount.textContent = `${currentLength}/${maxLength} characters`;

            if (currentLength > maxLength) {
                charCount.classList.add('text-danger');
            } else {
                charCount.classList.remove('text-danger');
            }
        });
    </script>
@endsection
