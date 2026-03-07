<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpdbField;
use Illuminate\Support\Facades\DB;

class PpdbController extends Controller
{
    // ── PUBLIC: ambil fields & status (untuk ppdb.html) ──
    public function publicData()
    {
        $fields = PpdbField::orderBy('urutan')->get();
        $status = DB::table('ppdb_settings')->where('key', 'ppdb_status')->value('value') ?? 'closed';

        return response()->json([
            'status' => $status,
            'fields' => $fields
        ]);
    }

    // ── ADMIN: ambil semua fields ──
    public function index()
    {
        return response()->json(PpdbField::orderBy('urutan')->get());
    }

    // ── ADMIN: tambah field ──
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'required|string',
        ]);

        $field = PpdbField::create([
            'name'     => $request->name,
            'type'     => $request->type,
            'required' => $request->required ?? false,
            'urutan'   => PpdbField::max('urutan') + 1,
        ]);

        return response()->json($field, 201);
    }

    // ── ADMIN: edit field ──
    public function update(Request $request, $id)
    {
        $field = PpdbField::findOrFail($id);
        $field->update([
            'name'     => $request->name     ?? $field->name,
            'type'     => $request->type     ?? $field->type,
            'required' => $request->required ?? $field->required,
        ]);

        return response()->json($field);
    }

    // ── ADMIN: hapus field ──
    public function destroy($id)
    {
        PpdbField::findOrFail($id)->delete();
        return response()->json(['message' => 'Field berhasil dihapus']);
    }

    // ── ADMIN: buka/tutup PPDB ──
    public function setStatus(Request $request)
    {
        $request->validate(['status' => 'required|in:open,closed']);

        DB::table('ppdb_settings')->updateOrInsert(
            ['key' => 'ppdb_status'],
            ['value' => $request->status, 'updated_at' => now(), 'created_at' => now()]
        );

        return response()->json(['message' => 'Status PPDB diperbarui', 'status' => $request->status]);
    }

    // ── ADMIN: ambil status PPDB ──
    public function getStatus()
    {
        $status = DB::table('ppdb_settings')->where('key', 'ppdb_status')->value('value') ?? 'closed';
        return response()->json(['status' => $status]);
    }
}