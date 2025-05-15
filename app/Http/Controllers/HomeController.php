<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = DB::table('t_pendaftaran')
                ->select(
                    't_pendaftaran.*',
                    'm_kecamatan.nama as nama_kecamatan',
                    'm_desa_kelurahan.nama as nama_desa_kelurahan',
                    'm_roles.name as nama_role',
                    DB::raw('
                        CASE 
                            WHEN t_pendaftaran.status = 1 THEN "Approve"
                            ELSE "Waiting For Approve"
                        END AS str_status
                    ')
                )
                ->leftJoin('m_kecamatan', 'm_kecamatan.id', '=', 't_pendaftaran.kecamatan_id')
                ->leftJoin('m_desa_kelurahan', 'm_desa_kelurahan.id', '=', 't_pendaftaran.desa_kelurahan_id')
                ->join('m_roles', 'm_roles.id', '=', 't_pendaftaran.jenis_akun')
                ->where('t_pendaftaran.status', 0)
                ->paginate(10);

        return view('home', compact('data'));
    }
}
