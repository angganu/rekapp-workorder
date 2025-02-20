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
        Schema::create('wo_plannings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wo_request_id')->comment('Jika terisi berarti ada request dari user')->nullable(); 
            $table->unsignedBigInteger('wo_project_id')->comment('Jika Merupakan Project')->nullable(); 
            $table->unsignedBigInteger('wo_planning_id')->comment('Referensi jika pekerjaan sebelumnya extended / handover; jika dikejakan beberapa kali, ambil hanya id planning pertama;')->nullable(); 
            $table->enum('category', ['planned','unplanned'])->comment('jika request = unplanned')->default('unplanned');
            $table->enum('type', ['service','repair','project','operational'])->comment('jika request = repair; jika project = project;')->default('repair');
            $table->unsignedBigInteger('activity_id')->comment('aktivitas yang dilakukan');
            $table->text('note')->comment('dari leader ke teknisi')->nullable();

            $table->unsignedBigInteger('employee_id')->nullable(); 
            $table->date('date')->nullable();
            $table->time('start_at')->nullable();
            $table->time('finish_at')->nullable();
            $table->unsignedInteger('duration')->comment('in minutes')->nullable();
            $table->unsignedInteger('point')->comment('point dari aktivitas')->nullable();           

            $table->unsignedSmallInteger('status')->comment("
                0: Belum Dikerjakan / Permintaan Baru;
                1: Accepted / Sudah diterima teknisi;
                2: Sedang Dikerjakan;
                3: Success / Done;
                4: Extended / Perpanjang;
                5: Failed / Gagal;
                6: Canceled / Pindah Pekerjaan / Tidak Masuk;
            ")->default('0');
            $table->unsignedSmallInteger('is_urgent')->comment('0: false; 1: true;')->default('0');
            $table->unsignedSmallInteger('is_finish')->comment('0: false; 1: true; sudah submit realisasi.')->default('0');
            $table->unsignedSmallInteger('is_extended')->comment('0: false; 1: true; perpanjang dari referensi planning sebelumnya.')->default('0');
            $table->unsignedSmallInteger('is_handover')->comment('0: false; 1: true; serahterima pekerjaan dari orang lain.')->default('0');
            $table->unsignedSmallInteger('is_active')->comment('0: false; 1: true; masih harus dikerjakan.')->default('0');

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
        Schema::dropIfExists('wo_plannings');
    }
};
