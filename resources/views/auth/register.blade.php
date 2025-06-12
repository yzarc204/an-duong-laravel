<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
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
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <!-- Email -->
            <div class="mb-5 relative">
                <label for="email" class="block text-secondary text-md font-medium mb-2">Email</label>
                <div class="flex items-center">
                    <i class="fas fa-envelope text-secondary absolute ml-3"></i>
                    <input type="email" id="email" name="email"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        value="{{ old('email') }}" required>
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

            <!-- Mật khẩu xác nhận -->
            <div class="mb-5 relative">
                <label for="password_confirmation" class="block text-secondary text-md font-medium mb-2">
                    Xác nhận mật khẩu
                </label>
                <div class="flex items-center">
                    <i class="fas fa-lock text-secondary absolute ml-3"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        required>
                </div>
                @if ($errors->has('password_confirmation'))
                    <p class="text-sm text-red-500 mt-1">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>

            <!-- Họ tên -->
            <div class="mb-5 relative">
                <label for="name" class="block text-secondary text-md font-medium mb-2">Họ tên</label>
                <div class="flex items-center">
                    <i class="fas fa-user text-secondary absolute ml-3"></i>
                    <input type="text" id="name" name="name"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        value="{{ old('name') }}" required>
                </div>
                @if ($errors->has('name'))
                    <p class="text-sm text-red-500 mt-1">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <!-- Giới tính -->
            <div class="mb-5">
                <label class="block text-secondary text-sm font-medium mb-2">Giới tính</label>
                <div class="flex space-x-6">
                    <label class="flex items-center">
                        <input type="radio" name="is_male" value="1" class="mr-2 text-primary focus:ring-primary"
                            required>
                        <span class="text-secondary">Nam</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="is_male" value="0" class="mr-2 text-primary focus:ring-primary"
                            required>
                        <span class="text-secondary">Nữ</span>
                    </label>
                </div>
                @if ($errors->has('is_male'))
                    <p class="text-sm text-red-500 mt-1">{{ $errors->first('is_male') }}</p>
                @endif
            </div>

            <!-- Ngày sinh -->
            <div class="mb-5 relative">
                <label for="date_of_birth" class="block text-secondary text-sm font-medium mb-2">Ngày sinh</label>
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-secondary absolute ml-3"></i>
                    <input type="date" id="date_of_birth" name="date_of_birth"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        value="{{ old('date_of_birth') }}" required>
                </div>
                @if ($errors->has('date_of_birth'))
                    <p class="text-sm text-red-500 mt-1">{{ $errors->first('date_of_birth') }}</p>
                @endif
            </div>

            <div class="grid grid-cols-2 gap-x-3">
                <!-- Chiều cao -->
                <div class="mb-5 relative">
                    <label for="height" class="block text-secondary text-sm font-medium mb-2">Chiều cao (cm)</label>
                    <div class="flex items-center">
                        <i class="fas fa-ruler-vertical text-secondary absolute ml-3"></i>
                        <input type="number" id="height" name="height" min="0" step="1"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            value="{{ old('height') }}" required>
                    </div>
                    @if ($errors->has('height'))
                        <p class="text-sm text-red-500 mt-1">{{ $errors->first('height') }}</p>
                    @endif
                </div>

                <!-- Cân nặng -->
                <div class="mb-8 relative">
                    <label for="weight" class="block text-secondary text-sm font-medium mb-2">Cân nặng (kg)</label>
                    <div class="flex items-center">
                        <i class="fas fa-scale-unbalanced text-secondary absolute ml-3"></i>
                        <input type="number" id="weight" name="weight" min="0" step="0.1"
                            class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                            value="{{ old('height') }}" required>
                    </div>
                    @if ($errors->has('weight'))
                        <p class="text-sm text-red-500 mt-1">{{ $errors->first('weight') }}</p>
                    @endif
                </div>
            </div>

            <!-- Nút đăng ký -->
            <button type="submit"
                class="w-full bg-primary text-secondary px-4 py-3 rounded-lg hover:bg-secondary hover:text-white transition-colors duration-200 cursor-pointer">Đăng
                ký</button>
        </form>

        <!-- Link quay lại đăng nhập -->
        <div class="text-center mt-6">
            <p class="text-secondary text-sm">
                Đã có tài khoản?
                <a href="{{ route('login') }}" class="text-green-600 font-medium hover:underline">Đăng nhập</a>
            </p>
        </div>
    </div>
</body>

</html>
