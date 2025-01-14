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
    public function index(request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if(strlen($katakunci)){
            $data = mahasiswa::where('nim', 'like', "%$katakunci")
            ->orwhere('nama', 'like', "%$katakunci")
            ->orwhere('jurusan', 'like', "%$katakunci")
            ->paginate($jumlahbaris);
        }else{
             $data = mahasiswa::orderBy('nim','desc')->paginate($jumlahbaris);
        }

        return view('mahasiswa.index')->with('data',$data);
    }

    public function create()
    {
        return view('mahasiswa.create');
    }


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


    public function show(string $id)
    {
        
    }


    public function edit( $id)
    {
        $data = mahasiswa::where('nim', $id)->first();
        return view('mahasiswa.edit')->with('data', $data);
    }


    public function update(Request $request, string $id)
    {
         $request->validate([
            
            'nama'=>'required',
            'nim'=>'required',

        ],[
            
            'nama.required'=>'Nama wajib diisi',
            'jurusan.required'=>'jurusan wajib diisi',

        ]);
        $data =[
            
            'nama'=>$request->nama,
            'jurusan'=>$request->jurusan,

        ];
        mahasiswa::where('nim', $id)->update($data);
        return redirect()->to('mahasiswa')->with('succes', 'berhasil menambahkan data');

    }

    public function destroy(string $id)
    {
        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('succes', 'Berhasil melakukan delete data');
    }
}
