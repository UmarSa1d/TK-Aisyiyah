<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('judul');
            $table->string('subtitle')->nullable();
            $table->text('foto')->nullable(); // base64 atau path file
            $table->timestamps();
        });

        // Seed data default
        DB::table('galeri')->insert([
            ['urutan'=>1,'judul'=>'Silat Tradisional','subtitle'=>'Ekstrakurikuler','foto'=>'/assets/images/Silat.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>2,'judul'=>'Kreativitas Anak','subtitle'=>'Aktivitas Belajar','foto'=>'/assets/images/IMG-20260205-WA0021-1.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>3,'judul'=>'Kegiatan Seni','subtitle'=>'Aktivitas Belajar','foto'=>'/assets/images/IMG-20260205-WA0024-1.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>4,'judul'=>'Kebersamaan','subtitle'=>'Momen Spesial','foto'=>'/assets/images/IMG-20260205-WA0027-1.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>5,'judul'=>'Berkumpul Bersama','subtitle'=>'Kegiatan Sekolah','foto'=>'/assets/images/berkumpul.jpg','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>6,'judul'=>'Pawai Sekolah','subtitle'=>'Kegiatan Tahunan','foto'=>'/assets/images/Pawai.jpg','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>7,'judul'=>'Sharing Session','subtitle'=>'Kegiatan Bersama','foto'=>'/assets/images/Shering.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>8,'judul'=>'Hari Cita-Cita','subtitle'=>'Kegiatan Inspiratif','foto'=>'/assets/images/Cita-Cita.jpg','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>9,'judul'=>'Seni Tari','subtitle'=>'Ekstrakurikuler','foto'=>'/assets/images/Menari.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>10,'judul'=>'Mengenal Hewan','subtitle'=>'Field Trip','foto'=>'/assets/images/Pertenakan-kambing.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>11,'judul'=>'Kebersamaan','subtitle'=>'Momen Spesial','foto'=>'/assets/images/Berkumpul2.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>12,'judul'=>'Menonton Bersama','subtitle'=>'Kegiatan Edukatif','foto'=>'/assets/images/Nonton.png','created_at'=>now(),'updated_at'=>now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri');
    }
};