@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card h-100">
                    <div class="card-header bg-black text-white h4">{{ __('SystemName') }}</div>

                    <div class="card-body bg-gradient-light">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row my-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end"><b>{{ __('E-Mail Address') }}</b></label>
                                
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end"><b>{{ __('Password') }}</b></label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .felipe {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {
            background-position: 0% 50%;
            }
            50% {
            background-position: 100% 50%;
            }
            100% {
            background-position: 0% 50%;
            }
        }

    </style>

    <script src="https:////cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if ( session('error') )
        <script>
            Swal.fire({
                icon:   'error',
                title:  'Error',
                text:   "<?=session('error')?>",
            })
        </script>
    @endif

@endsection
