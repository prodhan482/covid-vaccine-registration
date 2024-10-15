@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4">Vaccination Status</h1>
        <p class="lead">Check your vaccination details based on your NID.</p>
    </div>

    <!-- Vaccination Status Details -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg">
                <div class="card-body">
                    @if ($user)
                        <h3 class="card-title mb-4">Personal Information</h3>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
                            <li class="list-group-item"><strong>NID:</strong> {{ $user->nid }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                        </ul>

                        <h3 class="card-title mb-4">Vaccination Information</h3>
                        <ul class="list-group list-group-flush">
                            @if ($registration && $registration->vaccineCenter)
                                <li class="list-group-item"><strong>Vaccination Center:</strong> {{ $registration->vaccineCenter->name }}</li>
                            @else
                                <li class="list-group-item text-danger">No vaccination center assigned.</li>
                            @endif

                            @if ($registration)
                                <li class="list-group-item"><strong>Scheduled Date:</strong> {{ \Carbon\Carbon::parse($registration->schedule_date)->format('l, F j, Y') }}</li>
                                <li class="list-group-item"><strong>Status:</strong> <span class="badge bg-success">{{ $registration->status }}</span></li>
                                <li class="list-group-item"><strong>Serial No:</strong> {{ $rank }}</li>
                            @else
                                <li class="list-group-item text-warning">Your vaccination has not yet been scheduled.</li>
                            @endif
                        </ul>
                        @else
                        <div class="alert alert-danger text-center mt-4">
                            <strong>No user found with the provided NID.</strong>
                            <p class="mt-3">
                                Please <a href="{{ url('/') }}" class="btn btn-primary">Go for Registration</a>
                            </p>
                        </div>
                    @endif
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
