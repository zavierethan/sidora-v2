<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InfrastrukturKeolahragaanController extends Controller
{
    public function getTotalKecamatan() {

        $data = DB::table('m_kecamatan')->count();

        return response()->json([
            "data" => [
                "total_kecamatan" => $data
            ]
        ], 200);
    }

    public function getTotalSarana() {

        $data = DB::table('t_sarana')->count();

        return response()->json([
            "data" => [
                "total_sarana" => $data
            ]
        ], 200);
    }

    public function getTotalKelompokOlahraga() {

        $data = DB::table('t_kegiatan_olahraga')->count();

        return response()->json([
            "data" => [
                "total_kelompok_olahraga" => $data
            ]
        ], 200);
    }

    public function getSummaryDataKeolahragaanPerKecamatan(){
        $data = DB::select("
            SELECT
                kecamatan.nama as kecamatan,
                kecamatan.latitude,
                kecamatan.longitude,
                SUM( subquery.sarana ) AS sarana,
                SUM( subquery.kegiatan_olahraga ) AS kelompok_olahraga
            FROM
                (
                SELECT
                    dk.id,
                    dk.nama AS nama_desa_kelurahan,
                    kecamatan.id AS kecamatan_id,
                    ( SELECT COUNT( id ) FROM t_sarana WHERE desa_kel_id = dk.id ) AS sarana,
                    ( SELECT COUNT( id ) FROM t_kegiatan_olahraga WHERE desa_kel_id = dk.id ) AS kegiatan_olahraga
                FROM
                    m_desa_kelurahan AS dk
                    JOIN m_kecamatan AS kecamatan ON kecamatan.id = dk.kecamatan_id
                ) AS subquery
                JOIN m_kecamatan AS kecamatan ON kecamatan.id = subquery.kecamatan_id
            GROUP BY
                kecamatan.nama, kecamatan.latitude, kecamatan.longitude");

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function getFasilitasPerDesaKelurahanFilterByKecamatan(Request $request) {
        $query = DB::table('m_sarana as mSarana')
            ->select('mSarana.nama as nama_sarana', DB::raw('COUNT(tSarana.id) as jumlah'))
            ->leftJoin('t_sarana as tSarana', 'tSarana.sarana_id', '=', 'mSarana.id')
            ->leftJoin('m_desa_kelurahan as dk', 'tSarana.desa_kel_id', '=', 'dk.id')
            ->whereIn('tSarana.sarana_id', [18, 1, 5, 14, 4, 2, 17, 3, 6]);

        if (!empty($request->kecamatan_id)) {
            $query->where('dk.kecamatan_id', $request->kecamatan_id);
        }

        if (!empty($request->tahun)) {
            $query->where('tSarana.tahun', $request->tahun);
        }

        $data = $query->groupBy('mSarana.nama')->get();

        return response()->json([
            "data" => $data
        ], 200);
    }
}
