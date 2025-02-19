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
        Schema::create('wo_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('room_category_id');

            $table->string('code', 100)->unique();
            $table->string('name');
            $table->text('description')->nullable();

            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();

            $table->double('budget_estimation', 8,2)->comment('by input')->nullable();
            $table->double('budget_realization', 8,2)->comment('by penggunaan items')->nullable();

            $table->unsignedSmallInteger('status')->comment("
                0: Belum Dikerjakan / Permintaan Baru;
                1: Sedang Dikerjakan;
                2: Success / Done;
                3: Canceled / Dibatalkan;
                4: Failed / Gagal;
                5: Draft / Hold;
            ")->default('0');

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wo_projects');
    }
};
