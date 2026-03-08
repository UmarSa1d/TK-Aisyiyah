<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{

    // ambil testimoni untuk website
    public function getTestimoni()
    {
        $data = Testimonial::latest()->take(20)->get();
        return response()->json($data);
    }

    // simpan testimoni dari chatbot / form
    public function storeTestimoni(Request $request)
    {

        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'kelas' => 'nullable|string|max:100',
            'teks' => 'required|string',
            'bintang' => 'nullable|integer|min:1|max:5'
        ]);

        $data['baru'] = true;

        $testi = Testimonial::create($data);

        return response()->json([
            "success" => true,
            "data" => $testi
        ]);
    }

}