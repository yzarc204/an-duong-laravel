<!-- Bottom Navigation Bar -->
<nav class="bg-secondary fixed bottom-0 w-full">
    <div class="container mx-auto flex justify-around items-center">
        <a href="{{ route('dashboard') }}"
            class="nav-item flex flex-col items-center text-white border-t-4 border-secondary hover:text-primary hover:border-primary px-4 py-2"
            data-nav="home">
            <i class="fas fa-home text-lg"></i>
            <span class="text-sm">Trang chủ</span>
        </a>
        <a href="{{ route('record.index') }}"
            class="nav-item flex flex-col items-center text-white border-t-4 border-secondary hover:text-primary hover:border-primary px-4 py-2"
            data-nav="measure">
            <i class="fas fa-ruler text-lg"></i>
            <span class="text-sm">Đo đường</span>
        </a>
        <a href="{{ route('meal-suggestion') }}"
            class="nav-item flex flex-col items-center text-white border-t-4 border-secondary hover:text-primary hover:border-primary px-4 py-2"
            data-nav="eat">
            <i class="fas fa-utensils text-lg"></i>
            <span class="text-sm">Ăn chuẩn</span>
        </a>
        <a href="#"
            class="nav-item flex flex-col items-center text-white border-t-4 border-secondary hover:text-primary hover:border-primary px-4 py-2"
            data-nav="exercise">
            <i class="fas fa-running text-lg"></i>
            <span class="text-sm">Vận động</span>
        </a>
    </div>
</nav>
