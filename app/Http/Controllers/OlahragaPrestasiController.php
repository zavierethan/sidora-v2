<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\OlahragaPrestasiExport;
use Maatwebsite\Excel\Facades\Excel;

use DB;
use Auth;

class OlahragaPrestasiController extends Controller
{
    public function index() {
        $desaKelurahan = DB::table('m_desa_kelurahan as desa_kelurahan')
                        ->select('desa_kelurahan.id', 'desa_kelurahan.nama as desa_kelurahan', 'kecamatan.nama as kecamatan')
                        ->join('m_kecamatan as kecamatan', 'kecamatan.id', '=', 'desa_kelurahan.kecamatan_id')
                        ->get();

        $kecamatan = DB::table('m_kecamatan as kecamatan')
                        ->select(
                            'kecamatan.id',
                            'kecamatan.nama'
                        )
                        ->orderBy('kecamatan.nama', 'asc')
                        ->get();

        $desaKelurahan = DB::table('m_desa_kelurahan as desa_kelurahan')
                        ->select(
                            'desa_kelurahan.id',
                            'desa_kelurahan.nama as desa_kelurahan',
                            'kecamatan.nama as kecamatan'
                        )
                        ->join('m_kecamatan as kecamatan', 'kecamatan.id', '=', 'desa_kelurahan.kecamatan_id')
                        ->orderBy('desa_kelurahan.nama', 'asc')
                        ->get();

        $cabangOlahraga = DB::table('m_cabang_olahraga')->get();

        return view('transaksi.olahraga-prestasi.index', compact('kecamatan', 'desaKelurahan', 'cabangOlahraga'));
    }

    public function getLists(Request $request) {
        $params = $request->all();
        $search = $request->input('custom_search');

        $baseQuery = DB::table('t_prestasi_keolahragaan as prestasiKeolahragaan')
            ->select(
                'prestasiKeolahragaan.id',
                'prestasiKeolahragaan.nama',
                'prestasiKeolahragaan.tempat_lahir',
                'prestasiKeolahragaan.jenis_kelamin',
                DB::raw("DATE_FORMAT(prestasiKeolahragaan.tanggal_lahir, '%d/%m/%Y') as tanggal_lahir"),
                'prestasiKeolahragaan.alamat_lengkap',
                'desakelurahan.nama as nama_desa_kelurahan',
                'kecamatan.nama as nama_kecamatan',
                'prestasiKeolahragaan.organisasi_pembina',
                'cabangOlahraga.nama as nama_cabang_olahraga',
                DB::raw("
                    CASE
                        WHEN prestasiKeolahragaan.kategori = '1' THEN 'ATLET'
                        WHEN prestasiKeolahragaan.kategori = '2' THEN 'PELATIH'
                        ELSE 'WASIT - JURI'
                    END AS str_kategori
                "),
            )
            ->join('m_desa_kelurahan as desakelurahan', 'desakelurahan.id', '=', 'prestasiKeolahragaan.desa_kelurahan_id')
            ->join('m_kecamatan as kecamatan', 'kecamatan.id', '=', 'desakelurahan.kecamatan_id')
            ->join('m_cabang_olahraga as cabangOlahraga', 'cabangOlahraga.id', '=', 'prestasiKeolahragaan.cabang_olahraga_id')
            ->whereIn('prestasiKeolahragaan.organisasi_pembina', ['KONI', 'NPCI']);

        // Clone for total count without filters
        $totalRecords = (clone $baseQuery)->count();

        // Apply filters if any
        if (!empty($search)) {
            $baseQuery->where(function($query) use ($search) {
                $query->where('prestasiKeolahragaan.nama', 'like', "%$search%")
                    ->orWhere('cabangOlahraga.nama', 'like', "%$search%");
            });
        }

        if (!empty($params['kecamatan'])) {
            $baseQuery->where('desakelurahan.kecamatan_id', $params['kecamatan']);
        }

        if (!empty($params['desa_kelurahan'])) {
            $baseQuery->where('prestasiKeolahragaan.desa_kelurahan_id', $params['desa_kelurahan']);
        }

        // Filtered count
        $filteredRecords = (clone $baseQuery)->count();

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        // Get data with pagination and ordering
        $data = $baseQuery
            ->orderBy('prestasiKeolahragaan.created_at', 'DESC')
            ->skip($start)
            ->take($length)
            ->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ]);
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
                "jenis_kelamin" => $request->jenis_kelamin,
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

    public function update(Request $request) {
        DB::table('t_prestasi_keolahragaan')
            ->where('id', $request['id'])
            ->update([
                'nama' => $request['nama'],
                'tempat_lahir' => $request['tempat_lahir'],
                'tanggal_lahir' => $request['tanggal_lahir'],
                'jenis_kelamin' => $request['jenis_kelamin'],
                'desa_kelurahan_id' => $request['desa_kelurahan'],
                'alamat_lengkap' => $request['alamat_lengkap'],
                'organisasi_pembina' => $request['organisasi_pembina'],
                'kategori' => $request['kategori'],
                'cabang_olahraga_id' => $request['cabang_olahraga'],
            ]);

        return response()->json([
            'message' => 'Data berhasil diperbarui.'
        ]);
    }

    public function saveDetail(Request $request) {

        if($request->keolahragaan_kategori == 1) {
            DB::table('t_prestasi_keolahragaan_kejuaraan')->insert([
                "prestasi_keolahragaan_id" => $request->keolahragaan_id,
                "nama_prestasi" => $request->prestasi,
                "kategori" => $request->kategori,
                "peraihan_medali" => $request->peraihan_medali,
                "tahun" => $request->tahun,
                "created_at" => date('Y-m-d H:i:s'),
                "created_by" => Auth::user()->name,
            ]);
        } else {
            DB::table('t_prestasi_keolahragaan_lisensi')->insert([
                "prestasi_keolahragaan_id" => $request->keolahragaan_id,
                "lisensi" => $request->lisensi,
                "kategori" => $request->kategori,
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

    public function export() {

        $data = DB::table('t_prestasi_keolahragaan as prestasiKeolahragaan')
            ->select(
                'prestasiKeolahragaan.nama',
                'prestasiKeolahragaan.tempat_lahir',
                DB::raw("DATE_FORMAT(prestasiKeolahragaan.tanggal_lahir, '%d/%m/%Y') as tanggal_lahir"),
                'prestasiKeolahragaan.alamat_lengkap',
                DB::raw("
                    CASE
                        WHEN prestasiKeolahragaan.kategori = '1' THEN 'ATLET'
                        WHEN prestasiKeolahragaan.kategori = '2' THEN 'PELATIH'
                        ELSE 'WASIT - JURI'
                    END AS str_kategori"
                ),
                'prestasiKeolahragaan.organisasi_pembina',
                'cabangOlahraga.nama as nama_cabang_olahraga',
            )
            ->join('m_desa_kelurahan as desakelurahan', 'desakelurahan.id', '=', 'prestasiKeolahragaan.desa_kelurahan_id')
            ->join('m_kecamatan as kecamatan', 'kecamatan.id', '=', 'desakelurahan.kecamatan_id')
            ->join('m_cabang_olahraga as cabangOlahraga', 'cabangOlahraga.id', '=', 'prestasiKeolahragaan.cabang_olahraga_id')
            ->whereIn('prestasiKeolahragaan.organisasi_pembina', ['KONI', 'NPCI'])
            ->orderBy('prestasiKeolahragaan.created_at', 'DESC')->get();

        return Excel::download(new OlahragaPrestasiExport($data), 'Laporan Prestasi Keolahragaan.xlsx');
    }

    public function getPrestasiById(Request $request) {
        $data = DB::table('t_prestasi_keolahragaan_kejuaraan as prestasi')
                ->select(
                    'prestasi.id',
                    'prestasi.nama_prestasi',
                    'prestasi.kategori as kategori_id',
                    DB::raw("
                        CASE
                            WHEN prestasi.kategori = '1' THEN 'DAERAH'
                            WHEN prestasi.kategori = '2' THEN 'NASIONAL'
                            ELSE 'INTERNASIONAL'
                        END AS kategori_name"
                    ),
                    'prestasi.peraihan_medali as peraihan_medali_id',
                    DB::raw("
                        CASE
                            WHEN prestasi.peraihan_medali = '1' THEN 'EMAS'
                            WHEN prestasi.peraihan_medali = '2' THEN 'PERAK'
                            ELSE 'PERUNGGU'
                        END AS peraihan_medali_name"
                    ),
                    'prestasi.tahun'
                )
                ->where('prestasi.id', $request->id)->first();

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function getLisensiById(Request $request) {
        $data = DB::table('t_prestasi_keolahragaan_lisensi as lisensi')
                ->select(
                    'lisensi.id',
                    'lisensi.lisensi as nama_lisensi',
                    'lisensi.kategori as kategori_id',
                    DB::raw("
                        CASE
                            WHEN lisensi.kategori = '1' THEN 'DAERAH'
                            WHEN lisensi.kategori = '2' THEN 'NASIONAL'
                            ELSE 'INTERNASIONAL'
                        END AS kategori_name"
                    ),
                    'lisensi.tahun'
                )
                ->where('lisensi.id', $request->id)->first();

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function updatePrestasi(Request $request) {
        DB::table('t_prestasi_keolahragaan_kejuaraan')->where('id', $request->id)->update([
            "nama_prestasi" => $request->nama_prestasi,
            "kategori" => $request->kategori,
            "peraihan_medali" => $request->peraihan_medali,
            "tahun" => $request->tahun,
        ]);
        return redirect()->back();
    }

    public function updateLisensi(Request $request) {
        DB::table('t_prestasi_keolahragaan_lisensi')->where('id', $request->id)->update([
            "lisensi" => $request->nama_lisensi,
            "kategori" => $request->kategori,
            "tahun" => $request->tahun,
        ]);
        return redirect()->back();
    }
}
