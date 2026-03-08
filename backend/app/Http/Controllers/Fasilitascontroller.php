<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    // GET /api/fasilitas — publik, untuk Galeri.html
    public function index()
    {
        $data = Fasilitas::orderBy('urutan')->get();
        return response()->json($data);
    }

    // POST /api/fasilitas — tambah (auth)
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|string', // base64 atau path
        ]);

        $urutan = Fasilitas::max('urutan') + 1;

        $item = Fasilitas::create([
            'urutan'    => $urutan,
            'nama'      => $request->nama,
            'deskripsi' => $request->deskripsi ?? '',
            'foto'      => $request->foto ?? '',
        ]);

        return response()->json($item, 201);
    }

    // PUT /api/fasilitas/{id} — edit (auth)
    public function update(Request $request, $id)
    {
        $item = Fasilitas::findOrFail($id);

        $request->validate([
            'nama'      => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|string',
            'urutan'    => 'nullable|integer',
        ]);

        $item->update($request->only(['nama', 'deskripsi', 'foto', 'urutan']));

        return response()->json($item);
    }

    // DELETE /api/fasilitas/{id} — hapus (auth)
    public function destroy($id)
    {
        $item = Fasilitas::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Fasilitas berhasil dihapus']);
    }
}