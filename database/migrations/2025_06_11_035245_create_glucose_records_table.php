<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('glucose_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete()->constrain();
            $table->float('glucose', 5, 2)->comment('Chỉ số đường huyết');
            $table->float('weight', 5, 2);
            $table->string('measurement_point')->comment('Thời điểm đo');
            $table->string('status');
            $table->datetime('measure_at')->comment('Thời gian đo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glucose_records');
    }
};
