<?php 

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\JsonResponse;

class IconsController extends Controller
{
   public function json(): JsonResponse
{
    try {
        $cssPath = public_path('assets/vendor/bootstrap-icons/bootstrap-icons.css');

        if (!File::exists($cssPath)) {
            return response()->json([]);
        }

        $css = File::get($cssPath);

        preg_match_all('/\.bi-([a-z0-9-]+)::before/', $css, $matches);

        $icons = array_map(function ($match) {
            return 'bi-' . $match;
        }, $matches[1]);

        return response()->json($icons);
    } catch (\Throwable $e) {
        // Log error and return empty array or error message
        \Log::error("Failed to get icons: " . $e->getMessage());
        return response()->json([], 500);
    }
}

}
