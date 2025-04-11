<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('updated_at', 'desc')->get();

        return view('backend.v_user.index', [
            'judul' => 'Data User',
            'index' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:user',
            'role' => 'required|in:0,1,2',
            'hp' => 'required|string|min:10|max:13',
            'password' => 'required|string|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:1024',
        ], [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ]);

        // Set status default
        $validatedData['status'] = 0;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = now()->format('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';

            // Simpan gambar dengan ukuran yang ditentukan
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);

            // Simpan nama file asli di database
            $validatedData['foto'] = $originalFileName;
        }

        // Enkripsi password (gunakan "12345678" jika password tidak diberikan)
        $validatedData['password'] = Hash::make($request->password ?? '12345678');

        // Simpan data user
        User::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('backend.user.index')->with('success', 'User berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('backend.v_user.edit', [
            'judul' => 'Ubah User',
            'edit'  => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ddd($request);
        $user = User::findOrFail($id);

        $rules = [
            'nama'   => 'required|max:255',
            'role'   => 'required',
            'status' => 'required',
            'hp'     => 'required|min:10|max:13',
            'foto'   => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];

        $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max'   => 'Ukuran file gambar maksimal adalah 1024 KB.',
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|email|unique:user';
        }

        $validatedData = $request->validate($rules, $messages);

        // Menggunakan ImageHelper
        if ($request->file('foto')) {
            // Hapus gambar lama
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';

            // Simpan gambar dengan ukuran yang ditentukan
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);

            // Simpan nama file asli di database
            $validatedData['foto'] = $originalFileName;
        }

        $user->update($validatedData);

        return redirect()->route('backend.user.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->foto) {
            $oldImagePath = public_path('storage/img-user/') . $user->foto;

            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $user->delete();

        return redirect()->route('backend.user.index')->with('success', 'Data berhasil dihapus');
    }
    public function formUser()
    {
        return view('backend.v_user.form', [
            'judul' => 'Laporan Data User',
        ]);
    }

    public function cetakUser(Request $request)
    {
        // Menambahkan aturan validasi 
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ], [
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
        ]);

        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $query =  User::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->orderBy('id', 'desc');

        $user = $query->get();
        return view('backend.v_user.cetak', [
            'judul' => 'Laporan User',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $user
        ]);
    }
}
