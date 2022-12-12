@extends('layout.header')

@section('content')
<div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card mt-5 mb-4 bg-light">
            <div class="card-header">{{ __('Register') }}</div>
            @include('layout.alert')
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3" id="username">
                        <label for="Username">Username</label>
                        <input name="name" type="text" class="form-control @error('message') is-invalid @enderror"
                            placeholder="Username" required>
                    </div>

                    <div class="mb-3" id="email">
                        <label for="Email">Email</label>
                        <input name="email" type="email" class="form-control @error('message') is-invalid @enderror"
                            placeholder="Email" required>
                        <small>
                            <i class="fas fa-info-circle"></i>
                            <span>Remember! You will use this email when you login</span>
                        </small>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3" id="password">
                                <label for="Password">Password</label>
                                <input name="password" type="password"
                                    class="form-control @error('message') is-invalid @enderror" placeholder="Password"
                                    required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3" id="password2">
                                <label for="Password">Re-Type Password</label>
                                <input name="password_confirmation" type="password"
                                    class="form-control @error('message') is-invalid @enderror"
                                    placeholder="Re-Type Password" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-lg btn-dark w-100 text-uppercase" id="btn">Sign Up</button>
                    <p class="sign-up mt-3">Already have an Account? <a href="{{ route('login') }}"> Log In</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
