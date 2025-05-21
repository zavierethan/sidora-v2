<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WebController extends Controller
{
    public function index() {
        $galeri = DB::table('t_galeri_kegiatan')->orderBy('created_at', 'ASC')->limit(3)->get();
        return view ('web.index', compact('galeri'));
    }

    public function infografis() {
        $wilayah = DB::table('m_kecamatan as kecamatan')->get();
        $desaKelurahan = DB::table('m_desa_kelurahan')->get();
        return view ('web.infografis', compact('wilayah', 'desaKelurahan'));
    }

    public function olahragaPrestasi() {
        $wilayah = DB::table('m_kecamatan as kecamatan')->get();
        $cabangOlahraga = DB::table('m_cabang_olahraga')->get();
        return view ('web.olahraga-prestasi', compact('wilayah', 'cabangOlahraga'));
    }

    public function olahragaMasyarakat() {
        $wilayah = DB::table('m_kecamatan as kecamatan')->get();
        return view ('web.olahraga-masyarakat', compact('wilayah'));
    }

    public function kegiatan() {
        return view ('web.kegiatan');
    }

    public function galeri() {
        $data = DB::table('t_galeri_kegiatan')->paginate(6);
        return view ('web.galeri', compact('data'));
    }
}
