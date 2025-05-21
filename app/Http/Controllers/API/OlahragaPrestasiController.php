<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class OlahragaPrestasiController extends Controller
{
    public function getSummaryDataKONI() {

        $data = DB::select("
                    SELECT
                    (SELECT COUNT(*) FROM t_prestasi_keolahragaan WHERE kategori = 1 AND organisasi_pembina = 'KONI') AS jumlah_atlet,
                    (SELECT COUNT(*) FROM t_prestasi_keolahragaan WHERE kategori = 2 AND organisasi_pembina = 'KONI') AS jumlah_pelatih,
                    (SELECT COUNT(*) FROM t_prestasi_keolahragaan WHERE kategori = 3 AND organisasi_pembina = 'KONI') AS jumlah_wasit"
                );

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function getSummaryDataNPCI() {

        $data = DB::select("
                    SELECT
                    (SELECT COUNT(*) FROM t_prestasi_keolahragaan WHERE kategori = 1 AND organisasi_pembina = 'NPCI') AS jumlah_atlet,
                    (SELECT COUNT(*) FROM t_prestasi_keolahragaan WHERE kategori = 2 AND organisasi_pembina = 'NPCI') AS jumlah_pelatih,
                    (SELECT COUNT(*) FROM t_prestasi_keolahragaan WHERE kategori = 3 AND organisasi_pembina = 'NPCI') AS jumlah_wasit"
                );

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function getSummaryTotalOlahragaPrestasi() {

        $data = DB::table('t_prestasi_keolahragaan')
            ->whereIn('organisasi_pembina', ['NPCI', 'KONI'])
            ->count();

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function getDataOlahragaPrestasiGroupByDesaKelurahan(Request $request) {

        $chartData = DB::table('t_prestasi_keolahragaan')
                    ->select(
                        'desa_kelurahan.nama as nama_desa_kelurahan',
                        DB::raw('SUM(CASE WHEN kategori = 1 THEN 1 ELSE 0 END) AS jumlah_atlet'),
                        DB::raw('SUM(CASE WHEN kategori = 2 THEN 1 ELSE 0 END) AS jumlah_pelatih'),
                        DB::raw('SUM(CASE WHEN kategori = 3 THEN 1 ELSE 0 END) AS jumlah_wasit')
                    )
                    ->join('m_desa_kelurahan as desa_kelurahan', 'desa_kelurahan.id', '=', 't_prestasi_keolahragaan.desa_kelurahan_id')
                    ->where('t_prestasi_keolahragaan.organisasi_pembina', '!=', 'KORMI')
                    ->where('desa_kelurahan.kecamatan_id', $request->kecamatan_id)
                    ->where('t_prestasi_keolahragaan.cabang_olahraga_id', $request->cabang_olahraga_id)
                    ->groupBy('desa_kelurahan.nama')
                    ->orderBy('desa_kelurahan.nama')
                    ->get();

        $categories = [];
        $series = [
            [
                'name' => 'Atlet',
                'data' => [],
            ],
            [
                'name' => 'Pelatih',
                'data' => [],
            ],
            [
                'name' => 'Wasit - Juri',
                'data' => [],
            ],
        ];

        // Loop through the retrieved data to structure it into the desired format
        foreach ($chartData as $data) {
            $categories[] = $data->nama_desa_kelurahan;
            $series[0]['data'][] = (int)$data->jumlah_atlet;
            $series[1]['data'][] = (int)$data->jumlah_pelatih;
            $series[2]['data'][] = (int)$data->jumlah_wasit;
        }

        $jsonData = [
            'categories' => $categories,
            'series' => $series,
        ];

        return response()->json($jsonData, 200);
    }

}
