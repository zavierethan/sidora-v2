<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class OlahragaPrestasiController extends Controller
{
    public function index() {
        $desaKelurahan = DB::table('m_desa_kelurahan as desa_kelurahan')
                        ->select('desa_kelurahan.id', 'desa_kelurahan.nama as desa_kelurahan', 'kecamatan.nama as kecamatan')
                        ->join('m_kecamatan as kecamatan', 'kecamatan.id', '=', 'desa_kelurahan.kecamatan_id')
                        ->get();

        $cabangOlahraga = DB::table('m_cabang_olahraga')->get();

        return view('transaksi.olahraga-prestasi.index', compact('desaKelurahan', 'cabangOlahraga'));
    }

    public function getLists(Request $request) {
        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('t_prestasi_keolahragaan as prestasiKeolahragaan')
            ->select(
                'prestasiKeolahragaan.id',
                'prestasiKeolahragaan.nama',
                'prestasiKeolahragaan.tempat_lahir',
                DB::raw("DATE_FORMAT(prestasiKeolahragaan.tanggal_lahir, '%d/%m/%Y') as tanggal_lahir"),
                'prestasiKeolahragaan.alamat_lengkap',
                'prestasiKeolahragaan.organisasi_pembina',
                'desakelurahan.nama as nama_desa_kelurahan',
                'cabangOlahraga.nama as nama_cabang_olahraga',
                DB::raw("
                    CASE
                        WHEN prestasiKeolahragaan.kategori = '1' THEN 'ATLET'
                        WHEN prestasiKeolahragaan.kategori = '2' THEN 'PELATIH'
                        ELSE 'WASIT - JURI'
                    END AS str_kategori"
                ),
            )
            ->join('m_desa_kelurahan as desakelurahan', 'desakelurahan.id', '=', 'prestasiKeolahragaan.desa_kelurahan_id')
            ->join('m_cabang_olahraga as cabangOlahraga', 'cabangOlahraga.id', '=', 'prestasiKeolahragaan.cabang_olahraga_id')
            ->whereIn('prestasiKeolahragaan.organisasi_pembina', ['KONI', 'NPCI'])
            ->orderBy('prestasiKeolahragaan.created_at', 'DESC');

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('desakelurahan.nama', 'like', "%$search%")
                        ->orWhere('cabangOlahraga.nama', 'like', "%$search%");
            });
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->orderBy('prestasiKeolahragaan.created_at', 'asc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function create() {
        return view('transaksi.olahraga-prestasi.create');
    }

    public function save(Request $request) {
        $prestasi = $request->prestasi;
        $lisensi = $request->lisensi;

        try {
            DB::beginTransaction();

            $keolahragaan = DB::table('t_prestasi_keolahragaan')->insertGetId([
                "nama" => $request->nama,
                "tempat_lahir" => $request->tempat_lahir,
                "tanggal_lahir" => $request->tanggal_lahir,
                "desa_kelurahan_id" => $request->desa_kelurahan_code,
                "alamat_lengkap" => $request->alamat_lengkap,
                "organisasi_pembina" => $request->organisasi_pembina_code,
                "kategori" => $request->kategori_code,
                "cabang_olahraga_id" => $request->cabang_olahraga_code,
                "foto" => $request->foto,
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => Auth::user()->name,
            ]);

            if (is_array($prestasi) && !empty($prestasi)) {
                foreach($prestasi as $p) {
                    DB::table('t_prestasi_keolahragaan_kejuaraan')->insert([
                        "prestasi_keolahragaan_id" => $keolahragaan,
                        "nama_prestasi" => $p['prestasi'],
                        "kategori" => $p['kategori_code'],
                        "peraihan_medali" => $p['peraihan_medali_code'],
                        "tahun" => $p['tahun'],
                        "created_at" => date('Y-m-d H:i:s'),
                        "created_by" => Auth::user()->name,
                    ]);
                }
            }

            if (is_array($lisensi) && !empty($lisensi)) {
                foreach($lisensi as $l) {
                    DB::table('t_prestasi_keolahragaan_lisensi')->insert([
                        "prestasi_keolahragaan_id" => $keolahragaan,
                        "lisensi" => $l['lisensi'],
                        "kategori" => $l['kategori_code'],
                        "tahun" => $l['tahun'],
                        "created_at" => date('Y-m-d H:i:s'),
                        "created_by" => Auth::user()->name,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['message' => 'Data saved successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function detail($id) {

        $desaKelurahan = DB::table('m_desa_kelurahan as desa_kelurahan')
                        ->select('desa_kelurahan.id', 'desa_kelurahan.nama as desa_kelurahan', 'kecamatan.nama as kecamatan')
                        ->join('m_kecamatan as kecamatan', 'kecamatan.id', '=', 'desa_kelurahan.kecamatan_id')
                        ->get();

        $cabangOlahraga = DB::table('m_cabang_olahraga')->get();

        $prestasiKeolahragaan = DB::table('t_prestasi_keolahragaan as prestasiKeolahragaan')
                            ->where('prestasiKeolahragaan.id', $id)
                            ->first();

        $prestasi = DB::table('t_prestasi_keolahragaan_kejuaraan as prestasi')
                            ->select(
                                'prestasi.id',
                                'prestasi.nama_prestasi',
                                DB::raw("
                                    CASE
                                        WHEN prestasi.kategori = '1' THEN 'DAERAH'
                                        WHEN prestasi.kategori = '2' THEN 'NASIONAL'
                                        ELSE 'INTERNASIONAL'
                                    END AS kategori"
                                ),
                                DB::raw("
                                    CASE
                                        WHEN prestasi.peraihan_medali = '1' THEN 'EMAS'
                                        WHEN prestasi.peraihan_medali = '2' THEN 'PERAK'
                                        ELSE 'PERUNGGU'
                                    END AS peraihan_medali"
                                ),
                                'prestasi.tahun'
                            )
                            ->where('prestasi.prestasi_keolahragaan_id', $id)
                            ->get();

        $lisensi = DB::table('t_prestasi_keolahragaan_lisensi as lisensi')
                            ->select(
                                'lisensi.id',
                                'lisensi.lisensi',
                                DB::raw("
                                    CASE
                                        WHEN lisensi.kategori = '1' THEN 'DAERAH'
                                        WHEN lisensi.kategori = '2' THEN 'NASIONAL'
                                        ELSE 'INTERNASIONAL'
                                    END AS kategori"
                                ),
                                'lisensi.tahun'
                            )
                            ->where('lisensi.prestasi_keolahragaan_id', $id)
                            ->get();

        return view('transaksi.olahraga-prestasi.detail', compact('prestasiKeolahragaan', 'prestasi', 'lisensi', 'desaKelurahan','cabangOlahraga'));
    }

    public function saveDetail(Request $request) {

        if($request->keolahragaan_kategori == 1) {
            DB::table('t_prestasi_keolahragaan_kejuaraan')->insert([
                "prestasi_keolahragaan_id" => $request->keolahragaan_id,
                "nama_prestasi" => $request->prestasi,
                "kategori" => $request->kategori_code,
                "peraihan_medali" => $request->peraihan_medali_code,
                "tahun" => $request->tahun,
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => Auth::user()->name,
            ]);
        } else {
            DB::table('t_prestasi_keolahragaan_lisensi')->insert([
                "prestasi_keolahragaan_id" => $request->keolahragaan_id,
                "lisensi" => $request->lisensi,
                "kategori" => $request->kategori_code,
                "tahun" => $request->tahun,
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => Auth::user()->name,
            ]);
        }

        return redirect()->back();
    }

    public function deleteDetail($id) {

    }

    public function delete($keolahragaanId, $id) {

        $keolahragaan = DB::table('t_prestasi_keolahragaan')->where('id', $keolahragaanId)->first();

        if($keolahragaan->kategori == 1) {
            DB::table('t_prestasi_keolahragaan_kejuaraan')->where('id', $id)->delete();
        } else {
            DB::table('t_prestasi_keolahragaan_lisensi')->where('id', $id)->delete();
        }

        return redirect()->back();
    }

    public function uploadFoto(Request $request) {

        try {
            DB::table('t_prestasi_keolahragaan')->where('id', $request->id)->update([
                "foto" => $request->image
            ]);

            return response()->json(['message' => 'Data saved successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
