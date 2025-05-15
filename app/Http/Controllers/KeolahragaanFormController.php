<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KeolahragaanFormController extends Controller
{
    public function formSarana() {
        $sarana = DB::table('m_sarana')->get();
        return view('transaksi.keolahragaan.forms.sarana', compact('sarana'));
    }

    public function formPrasarana() {
        $prasarana = DB::table('m_prasarana')->get();
        return view('transaksi.keolahragaan.forms.prasarana', compact('prasarana'));
    }

    public function formKegiatanOlahraga() {
        $cabangOlahraga = DB::table('m_cabang_olahraga')->get();
        return view('transaksi.keolahragaan.forms.kegiatan-olahraga', compact('cabangOlahraga'));
    }

    public function formPrestasiOlahraga() {
        $cabangOlahraga = DB::table('m_cabang_olahraga')->get();
        return view('transaksi.keolahragaan.forms.prestasi-olahraga', compact('cabangOlahraga'));
    }

    public function formVerifikasiKonfirmasi() {
        return view('transaksi.keolahragaan.forms.verifikasi-konfirmasi');
    }

    public function saveFormKeolahragaan () {

    }

}
