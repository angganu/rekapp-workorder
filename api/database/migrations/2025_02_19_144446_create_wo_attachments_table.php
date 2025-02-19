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
        Schema::create('wo_attachments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wo_request_id')->comment('Dari request yg mana')->nullable(); 
            $table->unsignedBigInteger('wo_planning_id')->comment('Dari planning yg mana')->nullable(); 
            $table->unsignedBigInteger('wo_realization_id')->comment('Dari realization yg mana')->nullable(); 

            $table->string('name');
            $table->string('original_name');
            $table->string('path');
            $table->string('extension')->nullable(); 
            $table->string('size')->nullable(); 
            $table->text('description')->nullable(); 

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
        Schema::dropIfExists('wo_attachments');
    }
};
