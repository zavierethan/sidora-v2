<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Auth;

class GaleriController extends Controller
{
    public function index() {
        $data = DB::table('t_galeri_kegiatan')->paginate(10);
        return view('transaksi.kegiatan.galeri.index', compact('data'));
    }

    public function getLists(Request $request) {
        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('t_galeri_kegiatan');

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('t_galeri_kegiatan.title', 'like', "%$search%");
            });
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        $totalRecords = $query->count();
        $filteredRecords = $query->count();
        $data = $query->orderBy('t_galeri_kegiatan.created_at', 'desc')->skip($start)->take($length)->get();

        $response = [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return response()->json($response);
    }

    public function create() {
        return view('transaksi.kegiatan.galeri.create');
    }

    public function save(Request $request) {

        try {
            $file = $request->file('content');

            if (!$file) {
                throw new \Exception('No file provided.');
            }

            $fileContent = file_get_contents($file->getRealPath());
            $base64Image = base64_encode($fileContent);

            if (!$fileContent) {
                throw new \Exception('Failed to read file content.');
            }

            DB::table('t_galeri_kegiatan')->insert([
                "title" => $request->title,
                "meta_title" => $request->meta_title,
                "slug" => Str::slug($request->title, '-'),
                "content" => $base64Image,
                "summary" => $request->summary,
                "summary" => $request->date,
                "created_at" => now(),
                "created_by" => Auth::user()->name,
            ]);

            return redirect()->route('kegiatan.galeri.index');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id) {
        $data = DB::table('t_galeri_kegiatan')->where('id', $id)->first();
        return view('transaksi.kegiatan.galeri.edit', compact('data'));
    }

    public function update(Request $request) {
        DB::table('t_galeri_kegiatan')
            ->where('id', $request->id)
            ->update([
                "title" => "",
                "meta_title" => "",
                "slug" => "",
                "content" => "",
                "summary" => "",
                "updated_at" => date('Y-m-d H:i:s'),
                "updated_by" => Auth::user()->name,
        ]);

        return redirect()->back();
    }

    public function delete($id) {
        $data = DB::table('t_galeri_kegiatan')->where('id', $id)->delete();
        return redirect()->back();
    }
}
