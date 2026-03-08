<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->integer('urutan')->default(0);
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->text('foto')->nullable(); // base64 atau path file
            $table->timestamps();
        });

        // Seed data default
        DB::table('fasilitas')->insert([
            ['urutan'=>1,'nama'=>'Ruang Kelas Sekolah','deskripsi'=>'Ruang kelas adalah tempat belajar di sekolah yang nyaman dan terang. Di ruang kelas ada meja, kursi, kipas angin, karpet, papan tulis, alat tulis dan alat permainan edukatif.','foto'=>'/assets/images/Fasilitas_Full.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>2,'nama'=>'Halaman Sekolah','deskripsi'=>'Halaman adalah bagian luar dari sekolah yang luas, indah dan segar. Di halaman, kita bisa bermain, berlari, atau menanam bunga dan pohon.','foto'=>'/assets/images/Halaman.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>3,'nama'=>'Aula Sekolah','deskripsi'=>'Aula adalah ruangan yang besar dan luas di dalam sebuah gedung, digunakan untuk acara besar, pentas seni, dan pertemuan orang tua.','foto'=>'/assets/images/berkumpul.jpg','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>4,'nama'=>'TV Sekolah','deskripsi'=>'TV yang besar dan lebar sebagai media pembelajaran visual yang interaktif untuk konten edukatif dan mendukung proses belajar mengajar.','foto'=>'/assets/images/Nonton.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>5,'nama'=>'Perpustakaan Sekolah','deskripsi'=>'Perpustakaan adalah tempat yang penuh dengan buku cerita, buku bergambar, dan buku pelajaran untuk mengembangkan minat baca sejak dini.','foto'=>'/assets/images/IMG-20260205-WA0019-1-1.png','created_at'=>now(),'updated_at'=>now()],
            ['urutan'=>6,'nama'=>'Area Bermain','deskripsi'=>'Area bermain yang aman dan menyenangkan dirancang khusus untuk mendukung perkembangan motorik dan kreativitas anak.','foto'=>'/assets/images/IMG-20260205-WA0021-1.png','created_at'=>now(),'updated_at'=>now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};