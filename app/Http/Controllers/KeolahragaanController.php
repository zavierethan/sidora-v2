<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Exports\KeolahragaanExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;

class KeolahragaanController extends Controller
{
    public function index() {
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

        return view('transaksi.keolahragaan.index', compact('desaKelurahan', 'kecamatan'));
    }

    public function getLists(Request $request) {
        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('m_desa_kelurahan AS dk')
            ->select('dk.id', 'dk.nama AS nama_desa_kelurahan','kecamatan.nama as nama_kecamatan',)
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(id)')
                    ->from('t_sarana')
                    ->whereColumn('desa_kel_id', 'dk.id');
            }, 'jumlah_sarana')
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(id)')
                    ->from('t_kegiatan_olahraga')
                    ->whereColumn('desa_kel_id', 'dk.id');
            }, 'jumlah_kegiatan_olahraga')
            ->join('m_kecamatan as kecamatan', 'kecamatan.id', '=', 'dk.kecamatan_id');

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('kecamatan.nama', 'like', "%$search%")
                        ->orWhere('dk.nama', 'like', "%$search%");
            });
        }

        if (!empty($params['kecamatan'])) {
            $query->where('dk.kecamatan_id', $params['kecamatan']);
        }

        if (!empty($params['desa_kelurahan'])) {
            $query->where('dk.id', $params['desa_kelurahan']);
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->orderBy('kecamatan.nama', 'asc')->orderBy('dk.nama', 'asc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function create(Request $request) {

        $kecamatan = $request->kecamatan;
        $desaKelurahan = $request->desa_kelurahan;
        $tahun = $request->tahun;
        $sarana = DB::table('m_sarana')->get();

        return view('transaksi.keolahragaan.forms.sarana', compact('sarana', 'kecamatan', 'desaKelurahan', 'tahun'));
    }

    public function save(Request $request) {

        $sarana = $request->sarana;
        $prasarana = $request->prasarana;
        $kegiatanOlahraga = $request->kegiatan_olahraga;

        try {
            DB::beginTransaction();
            foreach($sarana as $s) {
                DB::table('t_sarana')->insert([
                    "desa_kel_id" => $request->desa_kelurahan_code,
                    "sarana_id" => $s['sarana_code'],
                    "tipe_sarana" => $s['tipe_sarana_code'],
                    "status_kepemilikan" => $s['status_kepemilikan_code'],
                    "nama_pemilik" => $s['nama_pemilik'],
                    "ukuran" => $s['ukuran'],
                    "status_kondisi" => $s['status_kondisi_code'],
                    "foto_lokasi_1" => "",
                    "foto_lokasi_2" => "",
                    "foto_lokasi_3" => "",
                    "foto_lokasi_4" => "",
                    "alamat" => $s['alamat'],
                    "lat" => $s['latitude'],
                    "long" => $s['longitude'],
                    "tahun" => $request->tahun,
                    "created_at" => date('Y-m-d H:i:s'),
                    "created_by" => Auth::user()->name,
                ]);
            }

            foreach($prasarana as $p) {
                DB::table('t_prasarana')->insert([
                    "desa_kel_id" => $request->desa_kelurahan_code,
                    "prasarana_id" => $p['prasarana_code'],
                    "jumlah" => $p['jumlah'],
                    "status_layak" => $p['status_layak_code'],
                    "tahun" => $p['tahun'],
                    "lampiran" => "",
                    "created_at" => date('Y-m-d H:i:s'),
                    "created_by" => Auth::user()->name,
                ]);
            }

            foreach($kegiatanOlahraga as $ko) {
                DB::table('t_kegiatan_olahraga')->insert([
                    "desa_kel_id" => $request->desa_kelurahan_code,
                    "cabang_olahraga_id" => $ko['cabang_olahraga_code'],
                    "nama_kelompok" => $ko['nama_kelompok'],
                    "nama_ketua_kelompok" => $ko['nama_ketua_kelompok'],
                    "jumlah_anggota" => $ko['jumlah_anggota'],
                    "terverifikasi" => $ko['terverifikasi_code'],
                    "nomor_sk" => $ko['nomor_sk'],
                    "alamat_sekretariat" => $ko['alamat_sekretariat'],
                    "tahun" => $request->tahun,
                    "created_at" => date('Y-m-d H:i:s'),
                    "created_by" => Auth::user()->name,
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Data saved successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function saveSarana(Request $request) {

        $file_att_base64 = "";

        if ($request->hasFile('foto_lokasi_1')) {
            $file_att = $request->file('foto_lokasi_1');
            $file_mime_type = $file_att->getMimeType();
            $file_att_base64 = base64_encode(file_get_contents($file_att));
        }

        DB::table('t_sarana')->insert([
            "desa_kel_id" => $request->des_kel_id,
            "sarana_id" => $request->sarana_id,
            "tipe_sarana" => $request->tipe_sarana,
            "status_kepemilikan" => $request->status_kepemilikan,
            "nama_pemilik" => $request->nama_pemilik,
            "ukuran" => $request->ukuran,
            "status_kondisi" => $request->status_kondisi,
            "foto_lokasi_1" => $file_att_base64,
            "foto_lokasi_2" => "",
            "foto_lokasi_3" => "",
            "foto_lokasi_4" => "",
            "alamat" => $request->alamat,
            "lat" => $request->latitude,
            "long" => $request->longitude,
            "tahun" => $request->tahun,
            "created_at" => date('Y-m-d H:i:s'),
            "created_by" => Auth::user()->name,
        ]);

        return redirect()->back();
    }

    public function savePrasarana(Request $request) {

        DB::table('t_prasarana')->insert([
            "desa_kel_id" => $request->des_kel_id,
            "prasarana_id" => $request->prasarana_id,
            "jumlah" => $request->jumlah,
            "hibah_pemerintah" => $request->hibah_pemerintah,
            "status_layak" => $request->status_layak,
            "tahun" => $request->tahun,
            "lampiran" => "",
            "created_at" => date('Y-m-d H:i:s'),
            "created_by" => Auth::user()->name,
        ]);

        return redirect()->back();
    }

    public function saveKegiatanOlahraga(Request $request) {
        // dd($request->all());
        DB::table('t_kegiatan_olahraga')->insert([
            "desa_kel_id" => $request->des_kel_id,
            "cabang_olahraga_id" => $request->cabang_olahraga_id,
            "nama_kelompok" => $request->nama_kelompok,
            "nama_ketua_kelompok" => $request->nama_ketua_kelompok,
            "jumlah_anggota" => $request->jumlah_anggota,
            "terverifikasi" => $request->terverifikasi,
            "nomor_sk" => $request->nomor_sk,
            "alamat_sekretariat" => $request->alamat_sekretariat,
            "tahun" => $request->tahun,
            "created_at" => date('Y-m-d H:i:s'),
            "created_by" => Auth::user()->name,
        ]);

        return redirect()->back();
    }

    public function savePrestasiOlahraga(Request $request) {

        return redirect()->back();
    }

    public function detail($id) {
        $wilayah = DB::table('m_kecamatan as kecamatan')
                    ->select('desa_kelurahan.id', 'kecamatan.nama as nama_kecamatan', 'desa_kelurahan.nama as nama_desa_kelurahan')
                    ->join('m_desa_kelurahan as desa_kelurahan', 'desa_kelurahan.kecamatan_id', '=', 'kecamatan.id')
                    ->where('desa_kelurahan.id', $id)
                    ->first();
        $infrastruktur = DB::table('m_sarana')->get();
        $mPrasarana = DB::table('m_prasarana')->get();
        $cabangOlahraga = DB::table('m_cabang_olahraga')->get();

        $tSarana = DB::table('t_sarana as tSarana')
                ->select(
                    'tSarana.id',
                    'mSarana.nama',
                    DB::raw("
                        CASE
                            WHEN tSarana.tipe_sarana = '1' THEN 'Indoor' ELSE 'Outdoor'
                        END AS str_tipe_sarana"
                    ),
                    DB::raw("
                        CASE
                            WHEN tSarana.status_kepemilikan = '1' THEN 'Pribadi' ELSE 'Pemerintah'
                        END AS str_status_kepemilikan"
                    ),
                    'tSarana.nama_pemilik',
                    'tSarana.ukuran',
                    'tSarana.lat',
                    'tSarana.long',
                    'tSarana.alamat',
                    'tSarana.tahun',
                    'tSarana.foto_lokasi_1',
                    DB::raw("
                        CASE
                            WHEN tSarana.status_kondisi = '1' THEN 'Layak Pakai' ELSE 'Tidak Layak Pakai'
                        END AS str_status_kondisi"
                    )
                )
                ->leftJoin('m_sarana as mSarana', 'mSarana.id', '=', 'tSarana.sarana_id')
                ->where('tSarana.desa_kel_id', $id)
                ->get();

        $tPrasarana = DB::table('t_prasarana as tPrasarana')
                ->select(
                    'tPrasarana.id',
                    'mPrasrana.nama',
                    'tPrasarana.jumlah',
                    'mPrasrana.satuan',
                    DB::raw("
                        CASE
                            WHEN tPrasarana.status_layak = '1' THEN 'Ya' ELSE 'Tidak'
                        END AS str_status_layak"
                    ),
                    DB::raw("
                        CASE
                            WHEN tPrasarana.hibah_pemerintah = '1' THEN 'Ya' ELSE 'Tidak'
                        END AS hibah_pemerintah"
                    ),
                    'tPrasarana.tahun'
                )
                ->leftJoin('m_prasarana as mPrasrana', 'mPrasrana.id', '=', 'tPrasarana.prasarana_id')
                ->where('tPrasarana.desa_kel_id', $id)
                ->get();

        $tKegiatanOlahraga = DB::table('t_kegiatan_olahraga as tKegiatanOlahraga')
                ->select(
                    'tKegiatanOlahraga.id',
                    'mCabor.nama',
                    'tKegiatanOlahraga.nama_kelompok',
                    'tKegiatanOlahraga.nama_ketua_kelompok',
                    'tKegiatanOlahraga.jumlah_anggota',
                    DB::raw("
                        CASE
                            WHEN tKegiatanOlahraga.terverifikasi = '1' THEN 'Ya' ELSE 'Tidak'
                        END AS str_terverifikasi"
                    ),
                    'tKegiatanOlahraga.nomor_sk',
                    'tKegiatanOlahraga.alamat_sekretariat',
                )
                ->leftJoin('m_cabang_olahraga as mCabor', 'mCabor.id', '=', 'tKegiatanOlahraga.cabang_olahraga_id')
                ->where('tKegiatanOlahraga.desa_kel_id', $id)
                ->get();

        return view('transaksi.keolahragaan.detail', compact('wilayah', 'tSarana', 'tPrasarana', 'tKegiatanOlahraga', 'infrastruktur', 'mPrasarana', 'cabangOlahraga'));
    }

    public function export($id) {
        $informasiWilayah = DB::table('m_desa_kelurahan AS dk')
                    ->select('dk.nama AS nama_desa_kelurahan','kecamatan.nama as nama_kecamatan',)
                    ->selectSub(function ($query) {
                        $query->selectRaw('COUNT(id)')
                            ->from('t_sarana')
                            ->whereColumn('desa_kel_id', 'dk.id');
                    }, 'jumlah_sarana')
                    ->selectSub(function ($query) {
                        $query->selectRaw('COUNT(id)')
                            ->from('t_kegiatan_olahraga')
                            ->whereColumn('desa_kel_id', 'dk.id');
                    }, 'jumlah_kegiatan_olahraga')
                    ->join('m_kecamatan as kecamatan', 'kecamatan.id', '=', 'dk.kecamatan_id')
                    ->where('dk.id', $id)
                    ->get();

        $sarana = DB::table('t_sarana as tSarana')
                    ->select(
                        'mSarana.nama',
                        DB::raw("
                            CASE
                                WHEN tSarana.tipe_sarana = '1' THEN 'Indoor' ELSE 'Outdoor'
                            END AS str_tipe_sarana"
                        ),
                        DB::raw("
                            CASE
                                WHEN tSarana.status_kepemilikan = '1' THEN 'Pribadi' ELSE 'Pemerintah'
                            END AS str_status_kepemilikan"
                        ),
                        'tSarana.nama_pemilik',
                        'tSarana.ukuran',
                        DB::raw("
                            CASE
                                WHEN tSarana.status_kondisi = '1' THEN 'Layak Pakai' ELSE 'Tidak Layak Pakai'
                            END AS str_status_kondisi"
                        ),
                        'tSarana.lat',
                        'tSarana.long',
                        'tSarana.alamat',
                        'tSarana.tahun',
                    )
                    ->join('m_sarana as mSarana', 'mSarana.id', '=', 'tSarana.sarana_id')
                    ->where('tSarana.desa_kel_id', $id)
                    ->get();

        $prasarana = DB::table('t_prasarana as tPrasarana')
                    ->select(
                        'mPrasrana.nama',
                        'tPrasarana.jumlah',
                        'mPrasrana.satuan',
                        DB::raw("
                            CASE
                                WHEN tPrasarana.status_layak = '1' THEN 'Ya' ELSE 'Tidak'
                            END AS str_status_layak"
                        ),
                        DB::raw("
                            CASE
                                WHEN tPrasarana.hibah_pemerintah = '1' THEN 'Ya' ELSE 'Tidak'
                            END AS hibah_pemerintah"
                        ),
                        'tPrasarana.tahun'
                    )
                    ->join('m_prasarana as mPrasrana', 'mPrasrana.id', '=', 'tPrasarana.prasarana_id')
                    ->where('tPrasarana.desa_kel_id', $id)
                    ->get();

        $kegiatanOlahraga = DB::table('t_kegiatan_olahraga as tKegiatanOlahraga')
                    ->select(
                        'mCabor.nama',
                        'tKegiatanOlahraga.nama_kelompok',
                        'tKegiatanOlahraga.nama_ketua_kelompok',
                        'tKegiatanOlahraga.jumlah_anggota',
                        DB::raw("
                            CASE
                                WHEN tKegiatanOlahraga.terverifikasi = '1' THEN 'Ya' ELSE 'Tidak'
                            END AS str_terverifikasi"
                        ),
                        'tKegiatanOlahraga.nomor_sk',
                        'tKegiatanOlahraga.alamat_sekretariat',
                        'tKegiatanOlahraga.tahun'
                    )
                    ->join('m_cabang_olahraga as mCabor', 'mCabor.id', '=', 'tKegiatanOlahraga.cabang_olahraga_id')
                    ->where('tKegiatanOlahraga.desa_kel_id', $id)
                    ->get();

        $olahragaPrestasi = DB::table('t_prestasi_keolahragaan as prestasiKeolahragaan')
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
                ->join('m_cabang_olahraga as cabangOlahraga', 'cabangOlahraga.id', '=', 'prestasiKeolahragaan.cabang_olahraga_id')
                ->whereIn('prestasiKeolahragaan.organisasi_pembina', ['KONI', 'NPCI'])
                ->where('prestasiKeolahragaan.desa_kelurahan_id', $id)
                ->orderBy('prestasiKeolahragaan.nama', 'asc')
                ->get();

        return Excel::download(new KeolahragaanExport($informasiWilayah, $sarana, $prasarana, $kegiatanOlahraga, $olahragaPrestasi), 'Laporan.xlsx');
    }

    public function exportByKecamatan($idKecamatan) {
        // Informasi wilayah berdasarkan kecamatan
        $informasiWilayah = DB::table('m_kecamatan AS kecamatan')
            ->select(
                'kecamatan.nama AS nama_kecamatan',
                DB::raw('COUNT(DISTINCT dk.id) AS jumlah_desa_kelurahan')
            )
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(*)')
                    ->from('t_sarana')
                    ->join('m_desa_kelurahan as dk2', 'dk2.id', '=', 't_sarana.desa_kel_id')
                    ->whereColumn('dk2.kecamatan_id', 'kecamatan.id');
            }, 'jumlah_sarana')
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(*)')
                    ->from('t_kegiatan_olahraga')
                    ->join('m_desa_kelurahan as dk3', 'dk3.id', '=', 't_kegiatan_olahraga.desa_kel_id')
                    ->whereColumn('dk3.kecamatan_id', 'kecamatan.id');
            }, 'jumlah_kegiatan_olahraga')
            ->join('m_desa_kelurahan as dk', 'dk.kecamatan_id', '=', 'kecamatan.id')
            ->where('kecamatan.id', $idKecamatan)
            ->groupBy('kecamatan.id', 'kecamatan.nama')
            ->get();

        // Sarana berdasarkan kecamatan
        $sarana = DB::table('t_sarana as tSarana')
            ->select(
                'mSarana.nama',
                DB::raw("CASE WHEN tSarana.tipe_sarana = '1' THEN 'Indoor' ELSE 'Outdoor' END AS str_tipe_sarana"),
                DB::raw("CASE WHEN tSarana.status_kepemilikan = '1' THEN 'Pribadi' ELSE 'Pemerintah' END AS str_status_kepemilikan"),
                'tSarana.nama_pemilik',
                'tSarana.ukuran',
                DB::raw("CASE WHEN tSarana.status_kondisi = '1' THEN 'Layak Pakai' ELSE 'Tidak Layak Pakai' END AS str_status_kondisi"),
                'tSarana.lat',
                'tSarana.long',
                'tSarana.alamat',
                'tSarana.tahun'
            )
            ->join('m_sarana as mSarana', 'mSarana.id', '=', 'tSarana.sarana_id')
            ->join('m_desa_kelurahan as dk', 'dk.id', '=', 'tSarana.desa_kel_id')
            ->where('dk.kecamatan_id', $idKecamatan)
            ->get();

        // Prasarana berdasarkan kecamatan
        $prasarana = DB::table('t_prasarana as tPrasarana')
            ->select(
                'mPrasrana.nama',
                'tPrasarana.jumlah',
                'mPrasrana.satuan',
                DB::raw("CASE WHEN tPrasarana.status_layak = '1' THEN 'Ya' ELSE 'Tidak' END AS str_status_layak"),
                DB::raw("CASE WHEN tPrasarana.hibah_pemerintah = '1' THEN 'Ya' ELSE 'Tidak' END AS hibah_pemerintah"),
                'tPrasarana.tahun'
            )
            ->join('m_prasarana as mPrasrana', 'mPrasrana.id', '=', 'tPrasarana.prasarana_id')
            ->join('m_desa_kelurahan as dk', 'dk.id', '=', 'tPrasarana.desa_kel_id')
            ->where('dk.kecamatan_id', $idKecamatan)
            ->get();

        // Kegiatan Olahraga berdasarkan kecamatan
        $kegiatanOlahraga = DB::table('t_kegiatan_olahraga as tKegiatanOlahraga')
            ->select(
                'mCabor.nama',
                'tKegiatanOlahraga.nama_kelompok',
                'tKegiatanOlahraga.nama_ketua_kelompok',
                'tKegiatanOlahraga.jumlah_anggota',
                DB::raw("CASE WHEN tKegiatanOlahraga.terverifikasi = '1' THEN 'Ya' ELSE 'Tidak' END AS str_terverifikasi"),
                'tKegiatanOlahraga.nomor_sk',
                'tKegiatanOlahraga.alamat_sekretariat',
                'tKegiatanOlahraga.tahun'
            )
            ->join('m_cabang_olahraga as mCabor', 'mCabor.id', '=', 'tKegiatanOlahraga.cabang_olahraga_id')
            ->join('m_desa_kelurahan as dk', 'dk.id', '=', 'tKegiatanOlahraga.desa_kel_id')
            ->where('dk.kecamatan_id', $idKecamatan)
            ->get();

        // Olahraga Prestasi berdasarkan kecamatan
        $olahragaPrestasi = DB::table('t_prestasi_keolahragaan as prestasiKeolahragaan')
            ->select(
                'prestasiKeolahragaan.nama',
                'prestasiKeolahragaan.tempat_lahir',
                DB::raw("DATE_FORMAT(prestasiKeolahragaan.tanggal_lahir, '%d/%m/%Y') as tanggal_lahir"),
                'prestasiKeolahragaan.alamat_lengkap',
                DB::raw("CASE WHEN prestasiKeolahragaan.kategori = '1' THEN 'ATLET'
                            WHEN prestasiKeolahragaan.kategori = '2' THEN 'PELATIH'
                            ELSE 'WASIT - JURI' END AS str_kategori"),
                'prestasiKeolahragaan.organisasi_pembina',
                'cabangOlahraga.nama as nama_cabang_olahraga'
            )
            ->join('m_desa_kelurahan as dk', 'dk.id', '=', 'prestasiKeolahragaan.desa_kelurahan_id')
            ->join('m_cabang_olahraga as cabangOlahraga', 'cabangOlahraga.id', '=', 'prestasiKeolahragaan.cabang_olahraga_id')
            ->whereIn('prestasiKeolahragaan.organisasi_pembina', ['KONI', 'NPCI'])
            ->where('dk.kecamatan_id', $idKecamatan)
            ->orderBy('prestasiKeolahragaan.nama', 'asc')
            ->get();

        return Excel::download(
            new KeolahragaanExport(
                $informasiWilayah,
                $sarana,
                $prasarana,
                $kegiatanOlahraga,
                $olahragaPrestasi
            ),
            'Laporan.xlsx'
        );
    }


    public function getSaranaById(Request $request) {
        $data = DB::table('t_sarana')->where('id', $request->id)->first();

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function getPrasaranaById(Request $request) {
        $data = DB::table('t_prasarana')->where('id', $request->id)->first();

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function getKegiatanOlahragaById(Request $request) {
        $data = DB::table('t_kegiatan_olahraga')->where('id', $request->id)->first();

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function getPrestasiOlahragaById(Request $request) {

    }

    public function getImageBySaranaId(Request $request) {

        $data = DB::table('t_sarana')->select('foto_lokasi_1')->where('id', $request->id)->first();

        return response()->json([
            "data" => $data
        ], 200);
    }

    public function updateSarana(Request $request) {

        $file_att_base64 = "";

        if ($request->hasFile('foto_lokasi_1')) {
            $file_att = $request->file('foto_lokasi_1');
            $file_mime_type = $file_att->getMimeType();
            $file_att_base64 = base64_encode(file_get_contents($file_att));
        } else {
            $file_att_base64 = $request->ex_foto_lokasi_1;
        }

        DB::table('t_sarana')->where('id',$request->id)->update([
            "sarana_id" => $request->sarana_id,
            "tipe_sarana" => $request->tipe_sarana,
            "status_kepemilikan" => $request->status_kepemilikan,
            "nama_pemilik" => $request->nama_pemilik,
            "ukuran" => $request->ukuran,
            "status_kondisi" => $request->status_kondisi,
            "foto_lokasi_1" => $file_att_base64,
            "alamat" => $request->alamat,
            "lat" => $request->latitude,
            "long" => $request->longitude,
            "tahun" => $request->tahun
        ]);

        return redirect()->back();
    }

    public function updatePrasarana(Request $request) {

        DB::table('t_prasarana')->where('id',$request->id)->update([
            "prasarana_id" => $request->prasarana_id,
            "jumlah" => $request->jumlah,
            "hibah_pemerintah" => $request->hibah_pemerintah,
            "status_layak" => $request->status_layak,
            "tahun" => $request->tahun,
        ]);

        return redirect()->back();
    }

    public function updateKegiatanOlahraga(Request $request) {

        DB::table('t_kegiatan_olahraga')->where('id',$request->id)->update([
            "cabang_olahraga_id" => $request->cabang_olahraga_id,
            "nama_kelompok" => $request->nama_kelompok,
            "nama_ketua_kelompok" => $request->nama_ketua_kelompok,
            "jumlah_anggota" => $request->jumlah_anggota,
            "terverifikasi" => $request->terverifikasi,
            "nomor_sk" => $request->nomor_sk,
            "alamat_sekretariat" => $request->alamat_sekretariat,
            "tahun" => $request->tahun,
        ]);

        return redirect()->back();
    }

    public function deleteSarana($id) {
        DB::table('t_sarana')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function deletePrasarana($id) {
        DB::table('t_prasarana')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function deleteKegiatanOlahraga($id) {
        DB::table('t_kegiatan_olahraga')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function deletePrestasiOlahraga($id) {
        DB::table('t_prestasi_olahraga')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function saranaGetLists(Request $request) {
        $params = $request->all();

        $query = DB::table('t_sarana as tSarana')
                ->select(
                    'tSarana.id',
                    'mSarana.nama',
                    DB::raw("
                        CASE
                            WHEN tSarana.tipe_sarana = '1' THEN 'Indoor' ELSE 'Outdoor'
                        END AS str_tipe_sarana"
                    ),
                    DB::raw("
                        CASE
                            WHEN tSarana.status_kepemilikan = '1' THEN 'Pribadi' ELSE 'Pemerintah'
                        END AS str_status_kepemilikan"
                    ),
                    'tSarana.nama_pemilik',
                    'tSarana.ukuran',
                    'tSarana.lat',
                    'tSarana.long',
                    'tSarana.alamat',
                    'tSarana.tahun',
                    DB::raw("
                        CASE
                            WHEN tSarana.status_kondisi = '1' THEN 'Layak Pakai' ELSE 'Tidak Layak Pakai'
                        END AS str_status_kondisi"
                    )
                )
                ->leftJoin('m_sarana as mSarana', 'mSarana.id', '=', 'tSarana.sarana_id')
                ->where('tSarana.desa_kel_id', $params['desa_kelurahan']);

        if (!empty($params['tahun'])) {
            $query->where('tSarana.tahun', $params['tahun']);
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function prasaranaGetLists(Request $request) {
        $params = $request->all();

        $query = DB::table('t_prasarana as tPrasarana')
                    ->select(
                        'tPrasarana.id',
                        'mPrasrana.nama',
                        'tPrasarana.jumlah',
                        'mPrasrana.satuan',
                        DB::raw("
                            CASE
                                WHEN tPrasarana.status_layak = '1' THEN 'Ya' ELSE 'Tidak'
                            END AS str_status_layak"
                        ),
                        DB::raw("
                            CASE
                                WHEN tPrasarana.hibah_pemerintah = '1' THEN 'Ya' ELSE 'Tidak'
                            END AS hibah_pemerintah"
                        ),
                        'tPrasarana.tahun'
                    )
                    ->join('m_prasarana as mPrasrana', 'mPrasrana.id', '=', 'tPrasarana.prasarana_id')
                    ->where('tPrasarana.desa_kel_id', $params['desa_kelurahan']);

        if (!empty($params['tahun'])) {
            $query->where('tPrasarana.tahun', $params['tahun']);
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function kegiatanOlahragaGetLists(Request $request) {
        $params = $request->all();

        $query = DB::table('t_kegiatan_olahraga as tKegiatanOlahraga')
                ->select(
                    'tKegiatanOlahraga.id',
                    'mCabor.nama',
                    'tKegiatanOlahraga.nama_kelompok',
                    'tKegiatanOlahraga.nama_ketua_kelompok',
                    'tKegiatanOlahraga.jumlah_anggota',
                    DB::raw("
                        CASE
                            WHEN tKegiatanOlahraga.terverifikasi = '1' THEN 'Ya' ELSE 'Tidak'
                        END AS str_terverifikasi"
                    ),
                    'tKegiatanOlahraga.nomor_sk',
                    'tKegiatanOlahraga.alamat_sekretariat',
                    'tKegiatanOlahraga.tahun'
                )
                ->leftJoin('m_cabang_olahraga as mCabor', 'mCabor.id', '=', 'tKegiatanOlahraga.cabang_olahraga_id')
                ->where('tKegiatanOlahraga.desa_kel_id', $params['desa_kelurahan']);

        if (!empty($params['tahun'])) {
            $query->where('tKegiatanOlahraga.tahun', $params['tahun']);
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }
}
