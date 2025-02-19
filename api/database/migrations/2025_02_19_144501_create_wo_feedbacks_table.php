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
        Schema::create('wo_feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wo_request_id')->comment('Dari request yg mana')->nullable(); 
            $table->unsignedBigInteger('rating_parameter_id')->comment('Parameter Rating')->nullable(); 
            
            $table->unsignedInteger('rating')->comment('Nilai Bintang')->nullable(); 
            $table->text('feedback')->nullable(); 

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
        Schema::dropIfExists('wo_feedbacks');
    }
};
