<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-secondary font-sans flex items-center justify-center min-h-screen p-8">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl p-8">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <a href="#" class="text-4xl font-extrabold text-secondary"><img
                    src="{{ asset('assets/images/logo.png') }}" class="w-70" alt=""></a>
        </div>


        <!-- Form đăng ký -->
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <!-- Email -->
            <div class="mb-5 relative">
                <label for="email" class="block text-secondary text-md font-medium mb-2">Email</label>
                <div class="flex items-center">
                    <i class="fas fa-envelope text-secondary absolute ml-3"></i>
                    <input type="email" id="email" name="email"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        required>
                </div>
                @if ($errors->has('email'))
                    <p class="text-sm text-red-500 mt-1">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <!-- Mật khẩu -->
            <div class="mb-5 relative">
                <label for="password" class="block text-secondary text-md font-medium mb-2">Mật khẩu</label>
                <div class="flex items-center">
                    <i class="fas fa-lock text-secondary absolute ml-3"></i>
                    <input type="password" id="password" name="password"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        required>
                </div>
                @if ($errors->has('password'))
                    <p class="text-sm text-red-500 mt-1">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <!-- Nút đăng nhập -->
            <button type="submit"
                class="w-full bg-primary text-secondary px-4 py-3 rounded-lg hover:bg-secondary hover:text-white transition-colors duration-200 cursor-pointer">Đăng
                nhập</button>
        </form>

        <!-- Link quay lại đăng nhập -->
        <div class="text-center mt-6">
            <p class="text-secondary text-sm">
                Chưa có tài khoản?
                <a href="{{ route('register') }}" class="text-green-600 font-medium hover:underline">Đăng ký</a>
            </p>
        </div>
    </div>

    <script src="{{ asset('vendors/sweetalert/sweetalert2.all.min.js') }}"></script>

    @if (session()->has('message'))
        <script>
            const message = "{{ session()->get('message') }}";
            if (message) {
                Swal.fire({
                    title: 'Thông báo',
                    text: message,
                    icon: 'info'
                });
            }
        </script>
    @endif
</body>

</html>
