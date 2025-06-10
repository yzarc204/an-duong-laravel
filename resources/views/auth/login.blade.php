<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href={{ asset('vendors/bootstrap/css/bootstrap.min.css') }} />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
    <section class="bg-theme-darken vh-100">
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-12 col-lg-5 col-md-7">
                    <div class="card border border-light-subtle rounded-3 shadow-sm">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="text-center mb-3">
                                <a href="#!">
                                    <img src="" alt="Logo" width="175" height="57">
                                </a>
                            </div>
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Đăng nhập</h2>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="name@example.com" required>
                                            <label for="email" class="form-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                value="" placeholder="Mật khẩu" required>
                                            <label for="password" class="form-label">Mật khẩu</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <a href="#!" class="text-theme-darken text-decoration-none">Quên mật
                                            khẩu?</a>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-theme-primary btn-lg" type="submit">Đăng
                                                nhập</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0 text-secondary text-center">Chưa có tài khoản?
                                            <a href="{{ route('register') }}"
                                                class="text-theme-darken text-decoration-none">
                                                Đăng ký ngay
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('vendors/sweetalert/sweetalert2.all.min.js') }}"></script>
    @if (session()->has('message'))
        <script>
            const message = "{{ session()->get('message') }}";
            Swal.fire({
                title: message,
                icon: 'error'
            });
        </script>
    @endif
</body>

</html>
