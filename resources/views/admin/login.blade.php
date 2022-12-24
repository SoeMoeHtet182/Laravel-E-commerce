<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/argon-dashboard.css') }}" />
    {{-- Toastify --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-4 offset-4">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        Admin Login
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/admin/login') }}" method="POST">
                            @csrf
                            @if ($errors->has('email'))
                                <div class='alert alert-danger small'>{{ $errors->first('email') }}</div>
                            @endif
                            <div class="form-group">
                                <label for="email">Enter Email</label>
                                <input type="email" name="email" class="form-control" />
                            </div>
                            @if ($errors->has('password'))
                                <div class='alert alert-danger small'>{{ $errors->first('password') }}</div>
                            @endif
                            <div class="form-group">
                                <label for="password">Enter Password</label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <input type="submit" value="Login" class="text-center btn btn-primary" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Toastify --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @if (session()->has('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                position: "center",
                style: {
                    background: "red",
                }
            }).showToast();
        </script>
    @endif

</body>

</html>
