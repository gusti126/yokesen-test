<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function index()
    {
        $data = Organisasi::get();

        return response()->json([
            'status' => 'success',
            'message' => 'list organisasi',
            'data' => $data
        ], 200);
    }

}
