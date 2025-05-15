<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KecamatanController extends Controller
{
    public function index() {
        return view('master.kecamatan.index');
    }

    public function getLists(Request $request) {
        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('m_kecamatan');

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('m_kecamatan.kode', 'like', "%$search%")
                        ->orWhere('m_kecamatan.nama', 'like', "%$search%");
            });
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->orderBy('m_kecamatan.nama', 'asc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function edit($id) {
        $data = DB::table('m_kecamatan')->where('id', $id)->first();
        return view('master.kecamatan.edit', compact('data'));
    }

    public function update(Request $request) {
        DB::table('m_kecamatan')->where('id', $request->id)->update([
            "nama" => $request->nama
        ]);

        return redirect()->route('master.kecamatan.index');
    }
}
