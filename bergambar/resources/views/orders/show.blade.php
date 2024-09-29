<!-- resources/views/orders/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e1e2a;
            color: #ffffff;
        }
        .order-card {
            background-color: #3c3c4d;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }
        .order-image {
            border-radius: 10px;
            width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        .order-buttons .btn {
            margin-right: 10px;
            background-color: #4a90e2;
            border: none;
        }
        .order-buttons .btn:hover {
            background-color: #357abd;
        }
        .text-muted {
            color: #b2b2b2;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="w-100 top-0 navbar navbar-expand-lg navbar-dark shadow-sm mb-4" style="background-color: #252539;">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/Logo.png') }}" class="img-fluid rounded" alt="Logo" style="width: 40px;">
            </a>
    </nav>
    <div class="container my-5">
        <div class="d-flex justify-content-center">
            <div class="order-card col-md-6 text-center">
                <h2>{{ $commission->title }}</h2>
                <img src="{{ asset('storage/' . $commission->image) }}" alt="Commission Image" class="order-image">
                <p><strong>Artist:</strong> {{ $artist->name ?? 'placeholder' }}</p>
                <p><strong>Title:</strong> {{ $commission->description ?? 'placeholder' }}</p>
                <p><strong>Price:</strong> Rp. {{ number_format($commission->total_price, 0, ',', '.') }}</p>
                
                <div class="order-buttons mt-3">
                    <a href="{{ route('orders.show', $commission->id) }}" class="btn btn-primary">Order Now</a>
                    <a href="#" class="btn btn-primary">Chat User</a>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="position-fixed bottom-0 text-white py-3 mt-5 w-100" style="background-color: #252539;">
        <div class="container text-center">
            <small>&copy; 2024 Bergambar. All Rights Reserved.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
