<?php

namespace App\Http\Controllers;
use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = mahasiswa::orderBy('nim','desc')->paginate(3);
        return view('mahasiswa.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        session::flash('nim',$request->nim);
        session::flash('nama',$request->nama);
        session::flash('jurusan',$request->jurusan);
        $request->validate([
            'nim'=>'required|numeric|unique:mahasiswa,nim',
            'nama'=>'required',
            'nim'=>'required',

        ],[
            'nim.required'=>'NIM wajib diisi',
            'nim.numeric'=>'NIM wajib dalam angka',
            'nim.unique'=>'NIM yang diisikan sudah ada dalam database',
            'nama.required'=>'Nama wajib diisi',
            'jurusan.required'=>'jurusan wajib diisi',

        ]);
        $data =[
            'nim'=>$request->nim,
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,

        ];
        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('succes', 'berhasil menambahkan data');

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
