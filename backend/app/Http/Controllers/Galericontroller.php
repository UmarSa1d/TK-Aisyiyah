<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    // GET /api/galeri — publik, untuk Galeri.html
    public function index()
    {
        $data = Galeri::orderBy('urutan')->get();
        return response()->json($data);
    }

    // POST /api/galeri — tambah (auth)
    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'foto'     => 'nullable|string', // base64 atau path
        ]);

        $urutan = Galeri::max('urutan') + 1;

        $item = Galeri::create([
            'urutan'   => $urutan,
            'judul'    => $request->judul,
            'subtitle' => $request->subtitle ?? 'Galeri Sekolah',
            'foto'     => $request->foto ?? '',
        ]);

        return response()->json($item, 201);
    }

    // PUT /api/galeri/{id} — edit (auth)
    public function update(Request $request, $id)
    {
        $item = Galeri::findOrFail($id);

        $request->validate([
            'judul'    => 'sometimes|required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'foto'     => 'nullable|string',
            'urutan'   => 'nullable|integer',
        ]);

        $item->update($request->only(['judul', 'subtitle', 'foto', 'urutan']));

        return response()->json($item);
    }

    // DELETE /api/galeri/{id} — hapus (auth)
    public function destroy($id)
    {
        $item = Galeri::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Foto galeri berhasil dihapus']);
    }
}