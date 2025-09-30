<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;

class UserController extends Controller
{
    public function index() {
        $roles = DB::table('m_roles')->get();
        return view('pengaturan.users.index', compact('roles'));
    }

    public function getLists(Request $request) {

        $params = $request->all();

        $search = $request->input('custom_search');

        $query = DB::table('m_users')
            ->select(
                'm_users.*',
                'role.name as role_name',
                DB::raw('
                    CASE
                        WHEN m_users.status = 1 THEN "Aktif"
                        ELSE "Tidak Aktif"
                    END AS str_status
                ')
            )
            ->join('m_roles as role', 'role.id', '=', 'm_users.role_id');

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

    public function create() {

    }

    public function save(Request $request) {

        $username =  substr($request->telepon, -6);
        DB::table('m_users')->insert([
            "name" => $username,
            "nama_lengkap" => $request->nama_lengkap,
            "no_telepon" => $request->telepon,
            "email" => $request->email,
            "password" => Hash::make($username),
            "role_id" => $request->role_id,
            "created_at" => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back();
    }

    public function edit($id) {
        $roles = DB::table('m_roles')->get();
        $data = $query = DB::table('m_users')
            ->select(
                'm_users.*',
            )
            ->where('id', $id)
            ->first();
        return view('pengaturan.users.edit', compact('data', 'roles'));
    }

    public function update(Request $request) {
        $user = DB::table('m_users')->where('id', $request->id)->first();

        // prepare base update data
        $dataUpdate = [
            "nama_lengkap" => $request->nama_lengkap,
            "no_telepon"   => $request->no_telepon,
            "email"        => $request->email,
            "role_id"      => $request->role_id,
            "status"       => $request->status,
        ];

        // if reset password is requested, set password = bcrypt(username)
        if ($request->reset_password == 1) {
            $dataUpdate['password'] = Hash::make($user->name);
        }

        DB::table('m_users')->where('id', $request->id)->update($dataUpdate);

        return redirect()->route('transaksi.pengaturan.user.index');
    }

    public function delete() {

    }

    public function resetPassword() {
        return view('pengaturan.users.reset-password');
    }

    public function updatePassword(Request $request) {
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['error' => 'Current password is incorrect']);
        }

        // Update the password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Log the user out (destroy session)
        Auth::logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect()->route('login')->with('status', 'Password updated successfully. Please log in again.');
    }
}
