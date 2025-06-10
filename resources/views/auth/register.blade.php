<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng ký</title>
    <link rel="stylesheet" href={{ asset('vendors/bootstrap/css/bootstrap.min.css') }} />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>
    <section class="bg-theme-darken">
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
                            @if (session()->has('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <h2 class="fs-6 fw-normal text-center text-secondary mb-4">Đăng ký tài khoản</h2>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="row gy-2 overflow-hidden">
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="name@example.com" value="{{ old('email') }}" required>
                                            <label for="email" class="form-label">Email</label>
                                        </div>
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback d-block">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password" id="password"
                                                value="" placeholder="Mật khẩu" required>
                                            <label for="password" class="form-label">Mật khẩu</label>
                                        </div>
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback d-block">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" name="password_confirm"
                                                id="password_confirm" value="" placeholder="Xác nhận mật khẩu"
                                                required>
                                            <label for="password" class="form-label">Xác nhận mật khẩu</label>
                                        </div>
                                        @if ($errors->has('password_confirm'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('password_confirm') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Họ tên" value="{{ old('name') }}" required>
                                            <label for="password" class="form-label">Họ tên</label>
                                        </div>
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback d-block">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Giới tinh:</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_male"
                                                    id="is_male" value="1">
                                                <label class="form-check-label" for="is_male">Nam</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_male"
                                                    id="is_female" value="0">
                                                <label class="form-check-label" for="is_female">Nữ</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('is_male'))
                                            <div class="invalid-feedback d-block">{{ $errors->first('is_male') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="date" class="form-control" name="date_of_birth"
                                                id="date_of_birth" value="{{ old('date_of_birth') }}"
                                                placeholder="Họ tên" required>
                                            <label for="password" class="form-label">Ngày sinh</label>
                                        </div>
                                        @if ($errors->has('date_of_birth'))
                                            <div class="invalid-feedback d-block">
                                                {{ $errors->first('date_of_birth') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" name="height" id="height"
                                                placeholder="Chiều cao" value="{{ old('height') }}" required>
                                            <label for="password" class="form-label">Chiều cao</label>
                                        </div>
                                        @if ($errors->has('height'))
                                            <div class="invalid-feedback d-block">{{ $errors->first('height') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" name="weight" id="weight"
                                                value="{{ old('weight') }}" placeholder="Cân nặng" required>
                                            <label for="password" class="form-label">Cân nặng</label>
                                        </div>
                                        @if ($errors->has('weight'))
                                            <div class="invalid-feedback d-block">{{ $errors->first('weight') }}</div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid my-3">
                                            <button class="btn btn-theme-primary btn-lg" type="submit">Đăng
                                                ký</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="m-0 text-secondary text-center">Đã có tài khoản? <a href="#!"
                                                class="text-theme-darken text-decoration-none">Đăng nhập ngay</a>
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
</body>

</html>
