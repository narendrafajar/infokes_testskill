<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Mengembalikan null untuk API, artinya tidak ada pengalihan
        return null;
    }

    protected function unauthenticated($request, array $guards): Response
    {
        // Mengembalikan respons JSON jika tidak terautentikasi
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }
}
