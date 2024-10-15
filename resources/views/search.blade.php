@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Vaccine Registration Search</h1>
        <p class="lead">Enter your NID to check your registration status and vaccination schedule.</p>
    </div>

    <!-- Search Form -->
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('search') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nid" class="form-label">NID Number:</label>
                            <input type="text" name="nid" id="nid" class="form-control" placeholder="Enter your NID number" required>
                            @error('nid')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg mt-3">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Result Section -->
    @if(isset($status))
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title">Status: <span class="badge bg-info">{{ $status }}</span></h2>

                        @if(isset($registration))
                            <ul class="list-group list-group-flush mt-3">
                                <li class="list-group-item"><strong>Vaccine Center:</strong> {{ $centerName }}</li>
                                <li class="list-group-item"><strong>Rank:</strong> {{ $rank ?? 'N/A' }}</li>
                                <li class="list-group-item"><strong>Scheduled Date:</strong> {{ $registration->vaccination_date->format('d M Y') }}</li>
                            </ul>
                        @else
                            <p class="mt-3 text-danger">No registration found.</p>
                        @endif

                        @if($status === 'Not registered')
                            <div class="text-center mt-4">
                                <a href="{{ $registrationLink }}" class="btn btn-success btn-lg">Register Now</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
