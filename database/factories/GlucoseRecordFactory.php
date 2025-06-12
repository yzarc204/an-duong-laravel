<?php

namespace Database\Factories;

use App\Enums\MeasurementPoint;
use App\Models\GlucoseRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GlucoseRecord>
 */
class GlucoseRecordFactory extends Factory
{
    protected $model = GlucoseRecord::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $measurementPoint = $this->faker->randomElement(array_keys(MeasurementPoint::keysLabels()));

        return [
            'user_id' => 1,
            'glucose' => $this->faker->numberBetween(50, 200),
            'measurement_point' => $measurementPoint,
            'weight' => $this->faker->numberBetween(50, 90),
            'measure_at' => $this->faker->dateTimeBetween('-2 months')
        ];
    }
}
