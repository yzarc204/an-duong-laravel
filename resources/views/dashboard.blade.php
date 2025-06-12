@extends('layouts.default')

@section('content')
    <section class="bg-white rounded-lg shadow-md p-6 mb-8">
        <canvas id="chart" class="w-full" height="425"></canvas>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <section class=" bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold text-secondary mb-6">Hôm nay ăn gì?</h1>
            <div class="space-y-6">
                <!-- Món ăn 1 -->
                @if (auth()->user()->meal_suggestions)
                    @foreach (auth()->user()->meal_suggestions['meals'] as $meal)
                        <div
                            class="bg-gray-100 rounded-lg shadow-sm p-4 flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
                            <img src="{{ $meal['image'] }}" alt="{{ $meal['name'] }}"
                                class="w-30 h-30 object-cover rounded-lg">
                            <div class="flex-1 flex flex-col gap-y-2">
                                <h2 class="text-xl font-semibold text-secondary">{{ $meal['name'] }}</h2>
                                <p class="text-sm font-normal text-gray-700">
                                    Nguyên liệu: {{ collect($meal['ingredients'])->pluck('name')->join(', ') }}
                                </p>
                                <a href="{{ asset('meal-suggestion') }}"
                                    class="inline-block w-fit py-1 px-2 text-sm font-semibold rounded-sm bg-primary text-secondary hover:bg-secondary hover:text-white transition duration-200">Xem
                                    cách nấu</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>

        <section class=" bg-white rounded-lg shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold text-secondary mb-6">Tập gì cho khoẻ?</h1>
            <div class="space-y-6">
                <!-- Món ăn 1 -->
                @if (auth()->user()->exercise_suggestions)
                    @foreach (auth()->user()->exercise_suggestions['workout_exercises'] as $exercise)
                        <div
                            class="bg-gray-100 rounded-lg shadow-sm p-4 flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
                            <img src="{{ $exercise['image'] }}" alt="{{ $exercise['name'] }}"
                                class="w-30 h-30 object-cover rounded-lg">
                            <div class="flex-1 flex flex-col gap-y-2">
                                <h2 class="text-xl font-semibold text-secondary">{{ $exercise['name'] }}</h2>
                                <p class="text-sm font-normal text-gray-700">
                                    Cấp độ: {{ $exercise['activity_level'] }}
                                </p>
                                <a href="{{ asset('exercise-suggestion') }}"
                                    class="inline-block w-fit py-1 px-2 text-sm font-semibold rounded-sm bg-primary text-secondary hover:bg-secondary hover:text-white transition duration-200">Xem
                                    cách tập</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script src="{{ asset('vendors/chart.js/chart.umd.min.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script>
        const records = @json($records);
    </script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection
