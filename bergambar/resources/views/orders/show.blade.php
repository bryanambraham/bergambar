@extends('layouts.app')

@section('content')
<div class="container my-5">
        <div class="row justify-content-center">
        <div class="row">
            <!-- Kolom Gambar -->
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <img src="{{ asset('storage/' . $commission->image) }}" alt="Commission Image" class="img-fluid rounded" style="max-width: 100%; height: auto;">
            </div>

            <!-- Kolom Detail dan Deskripsi -->
            <div class="col-md-6">
                <h2>{{ $commission->title }}</h2>
                <p><strong>Artist:</strong> {{ $artist->name ?? 'placeholder' }}</p>
                <p><strong>Description:</strong> {{ $commission->description ?? 'placeholder' }}</p>
                <p><strong>Price:</strong> ${{ number_format($commission->total_price, 0, ',', '.') }}</p>

                <!-- Tombol Order dan Chat -->
                <div class="order-buttons mt-3">
                    <a href="{{ route('orders.show', $commission->id) }}" class="btn btn-primary me-2 mb-2">Order Now</a>
                    <a href="{{ route('chat.show', $artist->id) }}" class="btn btn-success mb-2">Contact Artist</a>
                </div>
            </div>
        </div>


            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h4>Comments</h4>

                        @if($commission->reviews->isEmpty())
                            <p>No Comments yet.</p>
                        @else
                            @foreach($commission->reviews as $review)
                                <div class="review mb-4">
                                    <strong>{{ $review->user->name ?? 'Unknown' }}</strong> <span class="text-warning">★</span>
                                    <p>{{ $review->review }}</p>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>

            <!-- nambah review -->
            @auth
                <form action="{{ route('commissions.addReview', $commission->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="review" class="form-label">Your Comment</label>
                        <textarea name="review" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary d-flex ms-auto me-0">Submit Comment</button>
                </form>
            @endauth

        </div>
    </div>

    
    <!-- <footer class="position-fixed bottom-0 text-white py-3 mt-5 w-100" style="background-color: #252539;">
        <div class="container text-center">
            <small>&copy; 2024 Bergambar. All Rights Reserved.</small>
        </div>
    </footer> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection



