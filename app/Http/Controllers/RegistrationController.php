<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function index() {
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
                ->paginate(10);
        return view('pengaturan.registration.index', compact('data'));
    }

    public function getLists(Request $request) {
        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('t_pendaftaran')
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
            ->where('t_pendaftaran.status', 0);

        if (!empty($search)) {
            $query->where(function($query) use ($search) {
                $query->where('m_users.name', 'like', "%$search%")
                        ->orWhere('m_users.nama_lengkap', 'like', "%$search%")
                        ->orWhere('m_users.email', 'like', "%$search%");
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

        DB::table('t_pendaftaran')->insert([
            "nama_lengkap" => $request->nama_lengkap,
            "no_telepon" => $request->no_telepon,
            "email" => $request->email,
            "tanggal_pendaftaran" => date('Y-m-d H:i:s'),
            "jenis_akun" => $request->jenis_akun,
            "kecamatan_id" => $request->kecamatan_id,
            "desa_kelurahan_id" => $request->desa_kelurahan_id,
            "created_at" => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('msg', 'Pendafataran berhasil, akun anda sedang kami verifikasi. Klik untuk kembali ke halaman utama.');
    }

    public function approve($id) {

        $registration = DB::table('t_pendaftaran')->where('id', $id)->first();
        DB::beginTransaction();

        try {
            // Update t_pendafataran table
            DB::table('t_pendaftaran')->where('id', $id)->update([
                "status" => 1,
                "tanggal_approve" => now(), // Use Laravel's now() function to get the current datetime
                "updated_at" => now(),
                "updated_by" => Auth::user()->name,
            ]);

            // Generate username
            $username = substr($registration->no_telepon, -6);

            // Insert into m_users table
            DB::table('m_users')->insert([
                "name" => $username,
                "nama_lengkap" => $registration->nama_lengkap,
                "no_telepon" => $registration->no_telepon,
                "email" => $registration->email,
                "password" => Hash::make($username),
                "role_id" => $registration->jenis_akun,
                "jenis_akun" => $registration->jenis_akun,
                "kecamatan_id" => $registration->kecamatan_id,
                "desa_kelurahan_id" => $registration->desa_kelurahan_id,
                "created_at" => now(),
            ]);

            // Commit the transaction if all queries succeed
            DB::commit();

            return redirect()->back()->with('msg', 'Akun atas nama '.$registration->nama_lengkap.' sudah berhasil di daftarkan dengan username '.$username.' dan password '.$username);
        } catch (\Exception $e) {
            // Rollback the transaction if any query fails
            DB::rollBack();

            // return response()->json(['message' => 'Transaction failed: ' . $e->getMessage()], 500);
            return redirect()->back()->with('msg', $e->getMessage());
        }
    }

}
