<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class IndukOlahragaController extends Controller
{
    public function index() {
        $data = DB::table('m_induk_olahraga')->paginate(10);
        return view('master.induk-olahraga.index', compact('data'));
    }

    public function getLists(Request $request) {
        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('m_induk_olahraga');

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('m_induk_olahraga.nama', 'like', "%$search%");
            });
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->orderBy('m_induk_olahraga.nama', 'asc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function save(Request $request) {
        DB::table('m_induk_olahraga')->insert([
            "nama" => $request->nama,
            "kategori" => $request->kategori,
            "organisasi_pembina" => $request->organisasi_pembina,
            "created_at" => date('Y-m-d H:i:s'),
            "created_by" => Auth::user()->name,
        ]);

        return redirect()->back();
    }

    public function edit($id) {
        $data = DB::table('m_induk_olahraga')->where('id', $id)->first();
        return view('master.induk-olahraga.edit', compact('data'));
    }

    public function update(Request $request) {
        DB::table('m_induk_olahraga')->where('id', $request->id)->update([
            "nama" => $request->nama,
            "nama" => $request->kategori
        ]);

        return redirect()->route('master.induk-olahraga.index');
    }

    public function delete($id) {
        DB::table('m_induk_olahraga')->where('id', $id)->delete();
        return redirect()->back();
    }
}
