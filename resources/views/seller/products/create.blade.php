@extends('seller.dashboard')
@section('seller')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('seller/products/create') }}">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Products</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h6 class="card-title">Add Products</h6>

                        <form id="productForm" method="POST" enctype="multipart/form-data"
                            action="{{ route('seller.products.store') }}">
                            <x-form-alerts></x-form-alerts>
                            @csrf <!-- Token CSRF wajib untuk semua form POST -->
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" id="productName" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Price</label>
                                <input type="number" name="price" class="form-control" id="productPrice" required>
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <textarea name="description" class="form-control" id="productDescription" maxlength="500"></textarea>
                                <small id="descriptionCount" class="form-text text-muted">0/500 characters</small>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Upload Gambar Produk -->
                            <div class="mb-3">
                                <label for="productImage" class="form-label">Thumbnail Image</label>
                                <input type="file" name="image" class="form-control" id="productImage" accept="image/*"
                                    required>
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="productVideo" class="form-label">Product Video</label>
                                <input type="file" class="form-control" id="productVideo"
                                    accept="video/mp4, video/webm, video/quicktime" />
                                @error('video')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Add Product</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('productForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            // Get the video file input
            let videoFile = document.getElementById('productVideo').files[0];

            if (videoFile) {
                let videoBlob = new Blob([videoFile], {
                    type: videoFile.type
                });
                formData.append('video', videoBlob, videoFile.name);
            }

            fetch('{{ route('seller.products.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Product added successfully');
                        // Redirect to the manage products page
                        window.location.href = data.redirect_url; // Redirect here
                    } else {
                        alert('Failed to upload product: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(error => console.error('Error:', error));
        });


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
