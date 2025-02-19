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
        Schema::create('wo_discussions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wo_request_id')->comment('Dari request yg mana')->nullable(); 
            $table->unsignedBigInteger('wo_planning_id')->comment('Dari planning yg mana')->nullable();

            $table->text('messages');
            $table->unsignedBigInteger('sent_by')->comment('user id')->nullable(); 

            $table->unsignedSmallInteger('read_by_user')->comment('sender = auto read')->default('0');
            $table->unsignedSmallInteger('read_by_leader')->comment('sender = auto read')->default('0');
            $table->unsignedSmallInteger('read_by_technician')->comment('sender = auto read')->default('0');

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
        Schema::dropIfExists('wo_discussions');
    }
};
