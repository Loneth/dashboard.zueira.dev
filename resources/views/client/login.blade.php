@extends('layout.header')

@push('css')
<style>
    .su-bg {
        background-color: #f1ced8 !important;
    }
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-md-4 su-bg" style="height: 100vh;">
        <div class="text-center">
            <img src="https://cdn.dribbble.com/assets/auth/sign-in-a63d9cf6c1f626ccbde669c582b10457b07523adb58c2a4b46833b7b4925d9a3.jpg"
                class="rounded mx-auto d-block" alt="..." style="width: 440px; margin-top: 110px;">
        </div>
    </div>

    <div class="col-md-8">
        <div class="container">
            <div class="col-sm-9 col-lg-6 mx-auto" style="margin-top: 170px;">
                <h4 class="card-header fa-bolder" style="margin-bottom: 15px;">Sign in to {{ config('app.name') }}</h4>

                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    Username or Password is invalid.
                </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" autocomplete="on">
                        @csrf
                        <div class="mb-3" id="name">
                            <label for="Name">Email Address</label>
                            <input name="email" type="email"
                                class="form-control form-control-sm @error('message') is-invalid @enderror" value="admin@zueira.dev" required>
                        </div>

                        <div class="mb-3 underline" id="password">
                            <label for="Password">
                                Password
                            </label>
                            <a href="/" class="float-end">
                                Forgot Password?
                            </a>
                            <input name="password" type="password"
                                class="form-control form-control-sm @error('message') is-invalid @enderror" value="123123123" required>
                        </div>

                        <div class="d-grid col-5">
                            <button class="btn btn-dark btn-sm rounded-2" type="submit">Sign In</button>
                        </div>
                        <p class="mt-3 underline">
                            Need an account? <a href="/">Register</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
