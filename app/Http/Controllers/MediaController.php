<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends Controller
{
    public function profilePhoto(string $path): Response|BinaryFileResponse
    {
        $normalized = ltrim($path, '/');

        if ($normalized === '' || str_contains($normalized, '..')) {
            return response($this->svgPlaceholder(), 200, ['Content-Type' => 'image/svg+xml']);
        }

        if (str_starts_with($normalized, 'storage/')) {
            $normalized = substr($normalized, 8);
        }

        $absolute = storage_path('app/public/' . $normalized);

        if (! is_file($absolute)) {
            return response($this->svgPlaceholder(), 200, ['Content-Type' => 'image/svg+xml']);
        }

        return response()->file($absolute);
    }

    private function svgPlaceholder(): string
    {
        return <<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 120" width="120" height="120" role="img" aria-label="Profile image unavailable">
  <rect width="120" height="120" fill="#17353a"/>
  <circle cx="60" cy="45" r="20" fill="#c7775d"/>
  <path d="M24 104c2-22 18-34 36-34s34 12 36 34" fill="#c7775d"/>
</svg>
SVG;
    }
}
