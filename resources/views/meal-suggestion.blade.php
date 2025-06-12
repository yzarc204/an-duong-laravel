@extends('layouts.default')

@section('content')
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @foreach ($suggestions['meals'] as $meal)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="{{ $meal['image'] }}" alt="Ramen" class="w-full h-80 object-cover mx-auto mb-4">
                <div class="px-6 pb-6">
                    <h2 class="text-xl font-bold text-gray-800 text-center">{{ $meal['name'] }}</h2>
                    <div class="mt-4">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="bg-primary text-secondary py-3 px-2 rounded-lg text-center">
                                <p class="text-gray-600 font-medium text-xs">Protein (đạm)</p>
                                <p class="text-gray-800 font-medium">{{ $meal['nutrition']['protein'] }}g</p>
                            </div>
                            <div class="bg-primary text-secondary py-3 px-2 rounded-lg text-center">
                                <p class="text-gray-600 font-medium text-xs">Carb (tinh bột)</p>
                                <p class="text-gray-800 font-medium">{{ $meal['nutrition']['carb'] }}g</p>
                            </div>
                            <div class="bg-primary text-secondary py-3 px-2 rounded-lg text-center">
                                <p class="text-gray-600 font-medium text-xs">Fat (chất béo)</p>
                                <p class="text-gray-800 font-medium">{{ $meal['nutrition']['fat'] }}g</p>
                            </div>
                            <div class="bg-primary text-secondary py-3 px-2 rounded-lg text-center">
                                <p class="text-gray-600 font-medium text-xs">Calories</p>
                                <p class="text-gray-800 font-medium">{{ $meal['nutrition']['calories'] }} kcal</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-gray-700 font-medium mb-2">Nguyên liệu</h3>
                        <ul class="text-gray-600 text-sm list-inside space-y-1">
                            @foreach ($meal['ingredients'] as $ingredient)
                                <li><i class="fas fa-circle-check mr-2 text-primary"></i> {{ $ingredient['name'] }}:
                                    {{ $ingredient['quantity'] }} {{ $ingredient['unit'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-4">
                        <h3 class="text-gray-700 font-medium mb-2">Các bước nấu</h3>
                        <ol class="text-gray-600 text-sm list-inside space-y-1">
                            @foreach ($meal['cooking_guides'] as $step)
                                <li><i class="fas fa-check mr-1 text-primary"></i> {{ $step }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
