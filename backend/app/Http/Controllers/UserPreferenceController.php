<?php

// File: app/Http/Controllers/UserPreferenceController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\UserPreference;

class UserPreferenceController extends Controller
{
    /**
     * GET /api/user/preferences
     * Ambil preferensi user yang sedang login.
     */
    public function index(Request $request): JsonResponse
    {
        $pref = UserPreference::firstOrCreate(
            ['user_id' => $request->user()->id],
            ['dark_mode' => false, 'color_theme' => 'green', 'system_mode' => false]
        );

        return response()->json([
            'dark_mode'   => (bool) $pref->dark_mode,
            'color_theme' => $pref->color_theme,
            'system_mode' => (bool) $pref->system_mode,
        ]);
    }

    /**
     * POST /api/user/preferences
     * Simpan / update preferensi user.
     *
     * Body JSON: { dark_mode?: bool, color_theme?: string, system_mode?: bool }
     */
    public function store(Request $request): JsonResponse
    {
        $allowed = ['green', 'blue', 'orange', 'pink', 'red'];

        $validated = $request->validate([
            'dark_mode'   => 'sometimes|boolean',
            'color_theme' => 'sometimes|string|in:' . implode(',', $allowed),
            'system_mode' => 'sometimes|boolean',
        ]);

        $pref = UserPreference::updateOrCreate(
            ['user_id' => $request->user()->id],
            $validated
        );

        return response()->json([
            'dark_mode'   => (bool) $pref->dark_mode,
            'color_theme' => $pref->color_theme,
            'system_mode' => (bool) $pref->system_mode,
            'message'     => 'Preferensi berhasil disimpan.',
        ]);
    }
}