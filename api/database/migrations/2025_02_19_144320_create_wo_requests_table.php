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
        Schema::create('wo_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('asset_id');

            $table->string('code', 100)->unique();
            $table->string('name');
            $table->text('description')->nullable();

            $table->dateTime('requested_at')->nullable();
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->dateTime('date_accepted')->nullable();
            $table->unsignedBigInteger('accepted_by')->nullable();            
            $table->text('note_request')->comment('dari user ke teknisi')->nullable();
            $table->text('note_todo')->comment('dari leader ke teknisi')->nullable();

            $table->unsignedSmallInteger('status')->comment("
                0: Belum Dikerjakan / Permintaan Baru;
                1: Sudah Diterima & Diplanning;
                2: Sedang Dikerjakan;
                3: Sebagian Selesai;
                4: Selesai Semua;
                5: Dibatalkan (oleh user);
                6: Ditolak (oleh operator);
                7: Extended (Perpanjangan)
                8: Draft;
                9: Hold;
                10: On Checking;
                11: Failed;

                active task : 0,1,2,3,4,7 -> is_finish = 0
                completed task : 4
                todo : 1")->default('0');
            $table->unsignedSmallInteger('is_finish')->comment('0: false; 1: true;')->default('0');

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
        Schema::dropIfExists('wo_requests');
    }
};
