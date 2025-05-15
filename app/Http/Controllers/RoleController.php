<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RoleController extends Controller
{
    public function index() {
        return view('pengaturan.roles.index');
    }

    public function getLists(Request $request) {
        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('m_roles')
            ->select(
                'm_roles.*',
            );

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('m_roles.name', 'like', "%$search%");
            });
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->orderBy('id', 'desc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function save(Request $request) {
        DB::table('m_roles')->insert([
            "name" => $request->name
        ]);

        return redirect()->back();
    }

    public function edit($id) {
        $data = DB::table('m_roles')->where('id', $id)->first();
        return view('pengaturan.roles.edit', compact('data'));
    }

    public function update(Request $request) {
        DB::table('m_roles')->where('id', $request->id)->update([
            "name" => $request->name
        ]);

        return redirect()->route('transaksi.pengaturan.role.index');
    }
}
