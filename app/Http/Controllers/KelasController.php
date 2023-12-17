<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mengajar;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Kelas'
        ];
        return view('table.kelas.index', $data,[
            'kelas'  => Kelas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Kelas'
        ];
        return view('table.kelas.create',$data,[
            'jurusan'   => Jurusan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kelas'     => 'required|unique:kelas,nama_kelas',
            'jurusan_id'     => 'required'
        ],[
            'nama_kelas.unique' => 'Nama Kelas sudah digunakan, harap masukkan Nama Kelas yang berbeda.',
        ]);

        Kelas::create($data);
        return redirect('/table/kelas/index')->with('success', 'Data Berhasil Ditambah !');
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
    public function edit(Kelas $kelas)
    {
        $data = [
            'pageTitle' => 'Kelas'
        ];
        return view('table.kelas.edit',$data,[
            'kelas'     => $kelas,
            'jurusan'   => Jurusan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $data = $request->validate([
            'nama_kelas'     => 'required',
            'nama_kelas' => [
                    'required',
                    Rule::unique('kelas', 'nama_kelas')->ignore($kelas->id),
                ],
            'jurusan_id'     => 'required'
        ],[
            'nama_kelas.unique' => 'Nama Kelas sudah digunakan, harap masukkan Nama Kelas yang berbeda.',
        ]);
        
        $kelas->update($data);
        return redirect('/table/kelas/index')->with('success', 'Data Berhasil Diedit !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $mengajar = Mengajar::where('kelas_id', $kelas->id)->first();
        if($mengajar){
            return back()->with('error',"$kelas->nama_kelas masih digunakan di menu mengajar");
        }

        $siswa = Siswa::where('kelas_id', $kelas->id)->first();
        if($siswa){
            return back()->with('error',"$kelas->nama_kelas masih digunakan di menu siswa");
        }

        $kelas->delete();
        return redirect('/table/kelas/index')->with('success','Data Berhasil Dihapus');
    }
}
