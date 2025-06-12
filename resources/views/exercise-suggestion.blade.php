@extends('layouts.default')

@section('content')
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @foreach ($suggestions['workout_exercises'] as $exercise)
            <div class="bg-white rounded-lg shadow-lg w-fit overflow-hidden">
                <img src="{{ $exercise['image'] }}" alt="Warrior II Pose" class="w-full h-80 object-cover mb-4" />
                <div class="px-6 pb-6">
                    <h2 class="text-xl font-bold text-gray-800 mr-3">{{ $exercise['name'] }}</h2>
                    <span class="text-xs bg-primary text-secondary px-2 py-1 rounded-full inline-block mt-1">Mức độ vận
                        động: {{ $exercise['activity_level'] }}</span>
                    <ol class="list-inside text-gray-600 text-sm mt-4 space-y-2">
                        @foreach ($exercise['guides'] as $step)
                            <li>
                                <i class="fas fa-circle-check text-primary mr-2"></i> {{ $step }}
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        @endforeach
    </section>
@endsection
