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
        Schema::create('wo_realizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wo_planning_id')->comment('Dari planning yg mana')->nullable(); 

            $table->unsignedBigInteger('employee_id')->nullable(); 
            $table->date('date')->nullable();
            $table->time('start_at')->nullable();
            $table->time('finish_at')->nullable();
            $table->unsignedInteger('duration')->comment('in minutes')->nullable(); 
            $table->unsignedInteger('point')->comment('point dari aktivitas')->nullable();  
            $table->unsignedInteger('score')->comment('dari rumusan: (durasi planning / durasi realisasi) * point')->nullable();    

            $table->unsignedSmallInteger('status')->comment("
                1: Success / Done
                2: Extended / Perpanjang;
                3: Failed / Gagal;
            ")->default('0');
            $table->text('note')->comment('dari teknisi ke leader')->nullable();     

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
        Schema::dropIfExists('wo_realizations');
    }
};
