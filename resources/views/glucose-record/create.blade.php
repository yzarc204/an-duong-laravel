@extends('layouts.default')

@section('content')
    <section class="text-center">
        <h1 class="text-3xl font-bold text-gray-900">Nhập thông tin đường huyết</h1>
        <p class="mt-4 text-gray-600">Vui lòng nhập các thông tin dưới đây để theo dõi sức khỏe của bạn.</p>
    </section>

    <!-- Form -->
    <section class="mt-8 max-w-md mx-auto bg-white p-6 rounded-lg shadow">
        @if (session()->get('success'))
            <div id="success-alert"
                class="mb-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-md">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif

        <form action="{{ route('record.store') }}" method="POST">
            @csrf
            <div class="mb-5 relative">
                <label for="glucose" class="block text-secondary text-sm font-medium mb-2">Chỉ số đường huyết
                    (mg/dl)</label>
                <div class="flex items-center">
                    <i class="fas fa-droplet text-gray-500 absolute ml-3"></i>
                    <input type="number" id="glucose" name="glucose"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 shadow-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        required>
                </div>
                @if ($errors->has('glucose'))
                    <p class="text-sm text-red-500 mt-1">{{ $errors->first('glucose') }}</p>
                @endif
            </div>

            <div class="mb-5 relative">
                <label for="weight" class="block text-secondary text-sm font-medium mb-2">Cân nặng</label>
                <div class="flex items-center">
                    <i class="fas fa-scale-unbalanced text-gray-500 absolute ml-3"></i>
                    <input type="number" id="weight" name="weight"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 shadow-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                </div>
                @if ($errors->has('weight'))
                    <p class="text-sm text-red-500 mt-1">{{ $errors->first('weight') }}</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="measurement_point" class="block text-sm font-medium text-gray-700 mb-2">Thời điểm đo</label>
                <div class="flex items-center">
                    <i class="fas fa-clock text-gray-500 absolute ml-3"></i>
                    <select id="measurement_point" name="measurement_point"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 shadow-sm rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                        required>
                        @foreach ($measurementPoints as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit"
                class="w-full bg-primary text-secondary hover:bg-secondary hover:text-white py-2 px-4 rounded-md transition duration-200 cursor-pointer">Lưu
                thông
                tin</button>
        </form>
    </section>
@endsection
