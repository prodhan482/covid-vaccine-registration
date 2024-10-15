<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Registration System</title>
    <link rel="icon" type="image/png" href="{{ asset('images/vaccine.png') }}"> <!-- Update with your favicon path -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    <img src="{{ asset('images/vaccine.png') }}" alt="Logo" width="50" height="50"> <!-- Update with your logo path -->
                </a>
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    Vaccine Registration
                </a>
                
                <!-- Toggler for Mobile View -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- Vaccine Registration Button -->
                        <li class="nav-item">
                            <a class="btn btn-primary me-2" href="{{ url('/') }}">
                                Vaccine Registration
                            </a>
                        </li>
                        <!-- Check Status Button -->
                        <li class="nav-item">
                            <a class="btn btn-primary me-2" href="{{ url('/search') }}">
                                Check Status
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
