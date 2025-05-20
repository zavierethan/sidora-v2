<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DesaKelurahanController extends Controller
{
    public function index() {
        return view('master.desa-kelurahan.index');
    }

    public function getLists(Request $request) {
        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('m_desa_kelurahan as kelurahan')
            ->select('kelurahan.id', 'kelurahan.nama','kecamatan.nama as nama_kecamatan', 'kelurahan.longitude', 'kelurahan.latitude')
            ->join('m_kecamatan as kecamatan', 'kecamatan.id', '=', 'kelurahan.kecamatan_id');

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('kelurahan.nama', 'like', "%$search%")
                ->orWhere('kecamatan.nama', 'like', "%$search%");
            });
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->orderBy('kecamatan.nama', 'asc')->orderBy('kelurahan.nama', 'asc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function getDataDesKelByKecamatanId($kecamatanId) {
        $data = DB::table('m_desa_kelurahan')
            ->select(
                'm_desa_kelurahan.id',
                'm_desa_kelurahan.nama',
                'm_desa_kelurahan.kecamatan_id',
                'm_desa_kelurahan.longitude',
                'm_desa_kelurahan.latitude'
            )
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 'm_desa_kelurahan.kecamatan_id')
            ->where('m_desa_kelurahan.kecamatan_id', $kecamatanId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function edit($id) {
        $data = DB::table('m_desa_kelurahan')
            ->select('m_desa_kelurahan.id', 'm_desa_kelurahan.nama', 'm_desa_kelurahan.kecamatan_id', 'm_desa_kelurahan.longitude', 'm_desa_kelurahan.latitude')
            ->join('m_kecamatan', 'm_kecamatan.id', '=', 'm_desa_kelurahan.kecamatan_id')
            ->where('m_desa_kelurahan.id', $id)
            ->first();

        $kecamatans = DB::table('m_kecamatan')->get();
        return view('master.desa-kelurahan.edit', compact('data', 'kecamatans'));
    }

    public function update(Request $request) {
        DB::table('m_desa_kelurahan')->where('id', $request->id)->update([
            "nama" => $request->nama,
            "longitude" => $request->longitude,
            "latitude" => $request->latitude
        ]);

        return redirect()->route('master.desa-kelurahan.index');
    }
}
