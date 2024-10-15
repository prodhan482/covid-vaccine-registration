@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>Vaccine Registration</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet"
            href="{{ asset('fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
{{-- 
        <style>
            .text-danger {
                color: red;
                font-size: 12px;
                margin-bottom: 5px;
            }

            .form-wrapper {
                margin-bottom: 15px;
                position: relative;
            }

            label {
                font-weight: bold;
                display: flex;
                align-items: center;
            }

            label i {
                margin-right: 10px;
                color: #007bff;
            }

            .form-control {
                width: 100%;
                padding: 8px;
                border: 1px solid #ced4da;
                border-radius: 4px;
            }

            .form-control.is-invalid {
                border-color: red;
            }

            select.form-control {
                appearance: none;
            }

            .form-wrapper select {
                padding: 8px;
                background: #fff;
            }

            .form-wrapper button {
                display: inline-flex;
                align-items: center;
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            .form-wrapper button i {
                margin-left: 10px;
            }

            .form-wrapper button:hover {
                background-color: #0056b3;
            }
        </style> --}}
    </head>

    <body>

        <div class="wrapper" style="background-image: url('{{ asset('images/background.png') }}');">
            <div class="inner">
                <div class="image-holder">
                    <img src="{{ asset('images/registration-form-1.jpg') }}" alt="">
                </div>
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <h3>Registration Form</h3>

                    <div class="form-wrapper">
                        <label for="nid" ><i class="zmdi zmdi-account"></i>NID:</label>
                        @if ($errors->has('nid'))
                            <span class="text-danger">{{ $errors->first('nid') }}</span>
                        @endif
                        <input type="text" id="nid" name="nid" placeholder="Enter your NID"
                            class="form-control {{ $errors->has('nid') ? 'is-invalid' : '' }}" value="{{ old('nid') }}"
                            required>
                    </div>

                    <!-- Full Name Field -->
                    <div class="form-wrapper">
                        <label for="name"><i class="zmdi zmdi-account-box"></i>Name:</label>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <input type="text" id="name" name="name" placeholder="Enter your full name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}"
                            required>
                    </div>

                    <!-- Email Field -->
                    <div class="form-wrapper">
                        <label for="email"><i class="zmdi zmdi-email"></i>Email:</label>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        <input type="email" id="email" name="email" placeholder="Enter your email"
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email') }}" required>
                    </div>

                    <!-- Vaccine Center Selection -->
                    <div class="form-wrapper">
                        <label for="vaccine_center_id"><i class="zmdi zmdi-hospital"></i>Vaccine Center:</label>
                        @if ($errors->has('vaccine_center_id'))
                            <span class="text-danger">{{ $errors->first('vaccine_center_id') }}</span>
                        @endif
                        <select id="vaccine_center_id" name="vaccine_center_id"
                            class="form-control {{ $errors->has('vaccine_center_id') ? 'is-invalid' : '' }}" required>
                            <option value="" disabled selected class="text-muted text-center py-2">Select a Center</option>
                            @foreach ($vaccineCenters as $center)
                                <option value="{{ $center->id }}"
                                    {{ old('vaccine_center_id') == $center->id ? 'selected' : '' }}>
                                    {{ $center->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-wrapper">
                        <button type="submit" >Register
                            <i class="zmdi zmdi-arrow-left"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </body>

    </html>
@endsection
