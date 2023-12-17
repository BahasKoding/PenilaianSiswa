<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Jurusan'
        ];
        return view('table.jurusan.index',$data, [
            'jurusan'  => Jurusan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Jurusan'
        ];
        return view('table.jurusan.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_jurusan'     => 'required|unique:jurusans,nama_jurusan'
        ],[
            'nama_jurusan.unique' => 'Jurusan sudah digunakan, harap masukkan Jurusan yang berbeda.',
        ]);
        jurusan::create($data);
        return redirect('/table/jurusan/index')->with('success', 'Data Berhasil Ditambah !');
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
    public function edit(Jurusan $jurusan)
    {
        $data = [
            'pageTitle' => 'Jurusan'
        ];
        return view('table.jurusan.edit', $data,[
            'jurusan'  => $jurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurusan $jurusan)
    {
        $data = $request->validate([
            'nama_jurusan' => [
                    'required',
                    Rule::unique('jurusans', 'nama_jurusan')->ignore($jurusan->id),
                ]
            ],[
                'nama_jurusan.unique' => 'Jurusan sudah digunakan, harap masukkan Jurusan yang berbeda.',
            ]);
        $jurusan->update($data);
        return redirect('/table/jurusan/index')->with('success', 'Data Berhasil Diedit !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        $kelas = Kelas::where('jurusan_id', $jurusan->id)->first();
        if($kelas){
            return back()->with('error',"$jurusan->nama_jurusan masih digunakan di menu kelas");
        }

        $jurusan->delete();
        return redirect('/table/jurusan/index')->with('success','Data Berhasil Dihapus');
    }
}
