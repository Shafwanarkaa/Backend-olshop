<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = kategori::orderBy('nama_kategori', 'asc')->get();
        return view('backend.v_kategori.index', [
            'judul' => 'kategori',
            'index' => $kategori
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_kategori.create', [
            'judul' => 'kategori',
        ]);
    }

    public function store(Request $request)
    {
        // dd($request); 
        $validatedData = $request->validate([
            'nama_kategori' => 'required|max:255|unique:kategori',
        ]);
        Kategori::create($validatedData);
        return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil tersimpan');
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
        $kategori = Kategori::find($id);
        return view('backend.v_kategori.edit', [
            'judul' => 'Kategori',
            'edit' => $kategori
        ]);
    }
    public function update(Request $request, string $id)
    {
        $rules = [
            'nama_kategori' => 'required|max:255|unique:kategori,nama_kategori,' . $id,
        ];
        $validatedData = $request->validate($rules);
        Kategori::where('id', $id)->update($validatedData);
        return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $user = kategori::findOrFail($id);
        $user->delete();
        return redirect()->route('backend.kategori.index')->with('success', 'Data berhasil dihapus');
    }
}
