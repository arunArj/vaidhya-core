
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Vaidhya Accounts Dashboard</title>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.css') }}">

    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/app.css') }}">
</head>

<body>
    <div id="auth">
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="assets/images/favicon.svg" height="48" class='mb-4'>
                        <h3>Sign In</h3>
                        <p>Please sign up to continue to Vaidhya Accounts APP.</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left">
                            <label for="username">Name</label>
                            <div class="position-relative">
                                <input  class="form-control" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                               @if($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <label for="username">Email</label>
                            <div class="position-relative">
                                <input  class="form-control" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="email">
                               @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="clearfix">
                                <label for="password">Password</label>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class='float-end'>
                                    <small>Forgot password?</small>
                                </a>
                                @endif
                            </div>
                            <div class="position-relative">
                                <input type="password"  name="password" required autocomplete="current-password" class="form-control" id="password">
                                     @if($errors->has('password'))
                                     <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="clearfix">
                                <label for="password">Confirm Password</label>
                            </div>
                            <div class="position-relative">
                                <input type="password" name="password_confirmation"  required autocomplete="current-password" class="form-control" id="password_confirmation">
                                     @if($errors->has('password_confirmation'))
                                     <div class="error">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                        </div>

                        <div class='form-check clearfix my-4'>
                            <div class="float-end">
                                <a href="/login">Already have an account?</a>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-primary float-end">  {{ __('Submit') }}</button>
                        </div>
                    </form>
                    <div class="divider">
                        <div class="divider-text">OR</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-block mb-2 btn-primary"><i data-feather="facebook"></i> Facebook</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-block mb-2 btn-secondary"><i data-feather="github"></i> Github</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="{{ URL::asset('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>
</body>

</html>
