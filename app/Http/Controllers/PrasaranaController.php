<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class PrasaranaController extends Controller
{
    public function index() {
        $data = DB::table('m_prasarana')->paginate(10);
        return view('master.prasarana.index', compact('data'));
    }

    public function getLists(Request $request) {
        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('m_prasarana');

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('m_prasarana.nama', 'like', "%$search%");
            });
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->orderBy('m_prasarana.nama', 'asc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function save(Request $request) {
        DB::table('m_prasarana')->insert([
            "nama" => $request->nama,
            "created_at" => date('Y-m-d H:i:s'),
            "created_by" => Auth::user()->name,
        ]);

        return redirect()->back();
    }

    public function edit($id) {
        $data = DB::table('m_prasarana')->where('id', $id)->first();
        return view('master.prasarana.edit', compact('data'));
    }

    public function update(Request $request) {
        DB::table('m_prasarana')->where('id', $request->id)->update([
            "nama" => $request->nama,
            "satuan" => $request->satuan
        ]);

        return redirect()->route('master.prasarana.index');
    }

    public function delete($id) {
        DB::table('m_prasarana')->where('id', $id)->delete();

        return redirect()->back();
    }
}

