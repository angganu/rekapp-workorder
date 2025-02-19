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
        Schema::create('mst_assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asset_category_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('room_id')->nullable();
            $table->string('code', 100)->unique();
            $table->string('name');
            $table->text('description')->nullable();
            
            $table->dateTime('last_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();

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
        Schema::dropIfExists('mst_assets');
    }
};
