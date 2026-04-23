<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    // 1. READ (Menampilkan Data)
    public function index(Request $request)
    {
        // Ambil parameter dari URL
        $limit = $request->input('limit', 10);
        $kelas = $request->input('id_kelas');
        $search = $request->input('search');

        // Query awal
        $query = DB::table('attendance_dubes_siswa')
                    ->orderBy('id_siswa', 'desc');

        // Filter kelas
        if ($kelas) {
            $query->where('id_kelas', $kelas);
        }

        // Search nama / nis
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
            });
        }

        // Pagination
        $dataSiswa = $query->paginate($limit)->withQueryString();

        return view('siswa.index', [
            'dataSiswa' => $dataSiswa,
            'kelasSelected' => $kelas,
            'search' => $search,
            'limit' => $limit
        ]);
    }

    // 2. CREATE (Halaman Tambah)
    public function create()
    {
        return view('siswa.create');
    }

    // 3. STORE (Simpan Data)
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:attendance_dubes_siswa,nis',
            'nama' => 'required',
            'id_kelas' => 'required',
            'gender' => 'required',
        ], [
            'nis.unique' => 'Gagal! NIS tersebut sudah terdaftar.',
        ]);

        DB::table('attendance_dubes_siswa')->insert([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'gender' => $request->gender,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan!');
    }

    // 4. EDIT (Halaman Edit)
    public function edit($id)
    {
        $siswa = DB::table('attendance_dubes_siswa')
                    ->where('id_siswa', $id)
                    ->first();

        return view('siswa.edit', [
            'siswa' => $siswa
        ]);
    }

    // 5. UPDATE (Perbarui Data)
    public function update(Request $request, $id)
    {


        DB::table('attendance_dubes_siswa')  ->where('id_siswa', $id) ->update([
                'nama' => $request->nama,
                'id_kelas' => $request->kelas,
                'gender' => $request->gender,
                'updated_at' => now()
            ]);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui!');
    }

    // 6. DELETE (Hapus Data)
    public function destroy($id)
    {
        DB::table('attendance_dubes_siswa')
            ->where('id_siswa', $id)
            ->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa berhasil dihapus!');
    }
}