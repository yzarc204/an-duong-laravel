<!-- Header -->
<header class="bg-secondary text-primary p-4">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="#" class="text-2xl font-bold">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10">
        </a>
        <div class="relative">
            <button id="avatarButton" class="flex items-center space-x-2 focus:outline-none">
                <span class="text-primary text-md text-bold">{{ auth()->user()->name }}</span>
                <img src="https://sm.ign.com/t/ign_nordic/cover/a/avatar-gen/avatar-generations_prsz.600.jpg"
                    alt="Avatar" class="w-10 h-10 rounded-full cursor-pointer">
            </button>
            <div id="avatarDropdown"
                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10 divide-y-1 divide-gray-300 overflow-hidden">
                <a href="{{ route('exercise-suggestion') }}"
                    class="block px-4 py-2 text-secondary hover:bg-primary hover:text-secondary">
                    <i class="far fa-user-circle me-1"></i> Hồ sơ người dùng
                </a>
                <a href="{{ route('logout') }}"
                    class="block px-4 py-2 text-secondary hover:bg-primary hover:text-secondary">
                    <i class="fas fa-sign-out me-1"></i> Đăng xuất
                </a>
            </div>
        </div>
    </div>
</header>
