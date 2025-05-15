<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class KecamatanController extends Controller
{
    public function getKecamatan() {
        $kecamatan = DB::table('m_kecamatan')->get();
        return response()->json([
            "data"=> $kecamatan
        ], 200);
    }

    public function getDesaKelurahanByKecamatanId($id) {
        $desa = DB::table('m_desa_kelurahan')->where('kecamatan_id', $id)->get();
        return response()->json([
            "data"=> $desa
        ], 200);
    }
}
