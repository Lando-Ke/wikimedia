<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\WikimediaService;

class Wikimedia extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \App\Services\WikimediaService $wikimediaService
     * @param $query
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(WikimediaService $wikimediaService, $query)
    {
        $data = $wikimediaService->search($query);
        return response()->json($data, 200);
    }
}
