<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MyOrganisasi;
use App\Models\Organisasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function myOrganisasi()
    {
        $userId = Auth::user()->id;
        $myOrganisasi = DB::table('my_organisasis')->where('user_id', $userId)
            ->join('organisasis', 'my_organisasis.organisasi_id', '=', 'organisasis.id')
            ->select('nama')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'list my organisasi',
            'data' => $myOrganisasi
        ], 200);
    }

    public function daftar(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'organisasi_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $cekKuota = MyOrganisasi::where('organisasi_id', $request->organisasi_id)->count();
        if ($cekKuota >= 5) {
            return response()->json([
                'status' => 'error',
                'message' => 'kuota organisasi sudah penuh'
            ], 400);
        }

        $userId = Auth::user()->id;
        $cekMyOrgan = MyOrganisasi::where('user_id', $userId)->get();
        $isExist = MyOrganisasi::where('user_id', $userId)->where('organisasi_id', $request->organisasi_id)->exists();

        if ($isExist) {
            return response()->json([
                'status' => 'error',
                'message' => 'user sudah mendaftar dalam organisasi ini'
            ], 400);
        }

        // jika belum mendaftar
        if (!$cekMyOrgan) {
            $organisasi = MyOrganisasi::create([
                'user_id' => $userId,
                'organisasi_id' => $request->organisasi_id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'berhasil daftar organisasi',
                'data' => $organisasi
            ], 201);
        }

        // jika sudah mendaftar tapi baru satu organisasi
        elseif ($cekMyOrgan->count() < 2) {
            $organisasi = MyOrganisasi::create([
                'user_id' => $userId,
                'organisasi_id' => $request->organisasi_id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'berhasil daftar organisasi',
                'data' => $organisasi
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'user hanya boleh mendaftar dua organisasi'
            ], 400);
        }
    }

    public function undur(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'organisasi_id' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $cekMyOrgan = MyOrganisasi::where('user_id', Auth::user()->id)->where('organisasi_id', $request->organisasi_id)->first();
        if (!$cekMyOrgan) {
            return response()->json([
                'status' => 'error',
                'message' => 'anda belum terdaftar pada organisasi tersebut'
            ], 400);
        }

        $cekMyOrgan->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'berhasil keluar sebagai anggota organisasi'
        ], 200);
    }
}
