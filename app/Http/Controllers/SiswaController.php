<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Mengajar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Siswa'
        ];
        return view('table.siswa.index', $data,[
            'siswa'  => Siswa::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Siswa'
        ];
        return view('table.siswa.create',$data,[
            'kelas' => Kelas::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nis'           => 'required|unique:siswas,nis', // Menambahkan aturan unik untuk kolom 'nis' pada tabel 'Siswas'
            'nama_siswa'    => 'required',
            'jk'            => 'required',
            'alamat'        => 'required',
            'password'      => 'required',
            'kelas_id'      => 'required',
        ], [
            'nis.unique'    => 'NIS sudah digunakan, harap masukkan NIS yang berbeda.',
        ]);

        Siswa::create($data);
        // dd($data);
        return redirect('/table/siswa/index')->with('success', 'Data Berhasil Ditambah !');
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
    public function edit(Siswa $siswa)
    {
        $data = [
            'pageTitle' => 'Siswa'
        ];
        return view('table.siswa.edit',$data,[
            'siswa'  => $siswa
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
        'nis' => [
            'required',
            'numeric',
            Rule::unique('siswas', 'nis')->ignore($siswa->id),
        ],
            'nama_siswa'     => 'required',
            'jk'            => 'required',
            'alamat'        => 'required',
            'password'      => 'required',
        ],[
            'nis.unique' => 'NIS sudah digunakan, harap masukkan NIS yang berbeda.',
        ]);

        $siswa->update($data);
        return redirect('/table/siswa/index')->with('success', 'Data Berhasil Diedit !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $mengajar = Mengajar::where('Siswa_id', $siswa->id)->first();
        if($mengajar){
            return back()->with('error',"$siswa->nama_siswa masih digunakan di menu mengajar");
        }

        $siswa->delete();
        return redirect('/table/siswa/index')->with('success','Data Berhasil Dihapus');
    }
}
