@extends('user.dashboard')

@section('user')
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Transactions</h4>
            </div>
        </div>
        <x-form-alerts></x-form-alerts>
        <div class="row">
            @if ($transactions && $transactions->count() > 0)
                @foreach ($transactions as $transaction)
                    <div class="col-md-4 col-sm-6 col-12 mb-3"> <!-- Responsive grid -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Product: {{ $transaction->product->name }}</h5>
                                <p class="card-text">Amount: Rp. {{ number_format($transaction->amount, 2) }}</p>
                                <p class="card-text">Status: {{ ucfirst($transaction->status) }}</p>
                                
                                @if ($transaction->status === 'completed') <!-- Menampilkan tombol hanya jika status completed -->
                                    <!-- Button to open modal -->
                                    <button class="btn btn-outline-primary mt-2" data-bs-toggle="modal"
                                        data-bs-target="#productModal{{ $transaction->id }}">
                                        Open
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Modal for product details -->
                    <div class="modal fade" id="productModal{{ $transaction->id }}" tabindex="-1"
                        aria-labelledby="productModalLabel{{ $transaction->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel{{ $transaction->id }}">
                                        {{ $transaction->product->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                    <!-- Display product image -->
                                    @if ($transaction->product->image)
                                        <img src="{{ asset('storage/' . $transaction->product->image) }}"
                                            alt="{{ $transaction->product->name }}" class="img-fluid mb-3">
                                    @else
                                        <img src="https://via.placeholder.com/300" alt="No Image" class="img-fluid mb-3">
                                    @endif

                                    <!-- Display product details -->
                                    <h5>{{ $transaction->product->name }}</h5>
                                    <p class="mb-3">Rp. {{ number_format($transaction->product->price, 2) }}</p>
                                    <textarea name="description" class="form-control" id="productDescription"
                                        placeholder="{{ $transaction->product->description }}" maxlength="500" readonly
                                        style="width: 100%; height: 150px;"></textarea>
                                    <p class="mt-2"><strong>Seller:</strong> {{ $transaction->product->seller->name }}
                                    </p>
                                    <h6>Video:</h6>
                                    <p class="text-muted mb-3">Note: The video cannot be downloaded.</p>
                                    <video id="productVideo" width="100%" height="315" preload="metadata">
                                        <source src="{{ asset('storage/' . $transaction->product->video) }}"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>

                                    <!-- Kontrol Video -->
                                    <div class="d-flex align-items-center mt-2">
                                        <button id="playButton" class="btn btn-primary">Play</button>
                                        <button id="pauseButton" class="btn btn-secondary"
                                            style="margin-left: 10px;">Pause</button>
                                        <input type="range" id="videoSeekBar" value="0" step="0.1"
                                            style="margin-left: 10px; cursor: pointer; flex-grow: 1;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No transactions found.
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
<script>
    const videos = document.querySelectorAll('video'); // Mengambil semua elemen video

    videos.forEach(video => {
        const playButton = video.parentElement.querySelector('#playButton');
        const pauseButton = video.parentElement.querySelector('#pauseButton');
        const seekBar = video.parentElement.querySelector('#videoSeekBar');

        // Mencegah klik kanan pada elemen video
        video.addEventListener('contextmenu', function(e) {
            e.preventDefault(); // Mencegah menu konteks muncul
        });

        // Mengupdate slider saat video sedang diputar
        video.addEventListener('timeupdate', function() {
            seekBar.value = video.currentTime;
            seekBar.max = video.duration;
        });

        // Mengatur video berdasarkan slider
        seekBar.addEventListener('input', function() {
            video.currentTime = seekBar.value;
        });

        // Ketika video dimulai, set slider ke 0
        video.addEventListener('loadedmetadata', function() {
            seekBar.max = video.duration;
        });

        // Menangani tombol Play
        playButton.addEventListener('click', function() {
            video.play();
            playButton.disabled = true; // Menonaktifkan tombol play setelah ditekan
            pauseButton.disabled = false; // Mengaktifkan tombol pause
        });

        // Menangani tombol Pause
        pauseButton.addEventListener('click', function() {
            video.pause();
            pauseButton.disabled = true; // Menonaktifkan tombol pause setelah ditekan
            playButton.disabled = false; // Mengaktifkan tombol play
        });
    });
</script>
@endsection
