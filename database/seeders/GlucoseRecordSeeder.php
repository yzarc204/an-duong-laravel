<?php

namespace Database\Seeders;

use App\Models\GlucoseRecord;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GlucoseRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GlucoseRecord::factory()->count(50)->create();
    }
}
