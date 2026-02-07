<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laearng ceter</title>
    <link href="{{ asset("assets/css/bootstrap.min.css") }}" rel="stylesheet">
</head>
<body>
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}">
                            @error('login')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
                            @error('login')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>
                        Hisobingiz yo'qmi?
                        <a href="{{ route('register') }}">Register</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset("assets/js/bootstrap.bundle.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
</body>
</html>

