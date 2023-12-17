<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mengajar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Guru'
        ];
        return view('table.guru.index',$data,[
            'guru'  => Guru::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Guru'
        ];
        return view('table.guru.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nip' => 'required|unique:gurus,NIP', // Menambahkan aturan unik untuk kolom 'NIP' pada tabel 'gurus'
            'nama_guru' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'password' => 'required',
        ], [
            'nip.unique' => 'NIP sudah digunakan, harap masukkan NIP yang berbeda.',
        ]);

        Guru::create($data);
        // dd($data);
        return redirect('/table/guru/index')->with('success', 'Data Berhasil Ditambah !');
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
    public function edit(Guru $guru)
    {
        $data = [
            'pageTitle' => 'Guru'
        ];
        return view('table.guru.edit',$data, [
            'guru'  => $guru
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
        'nip' => [
            'required',
            'numeric',
            Rule::unique('gurus', 'NIP')->ignore($guru->id),
        ],
            'nama_guru'     => 'required',
            'jk'            => 'required',
            'alamat'        => 'required',
            'password'      => 'required',
        ],[
            'nip.unique' => 'NIP sudah digunakan, harap masukkan NIP yang berbeda.',
        ]);

        $guru->update($data);
        return redirect('/table/guru/index')->with('success', 'Data Berhasil Diedit !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        $mengajar = Mengajar::where('guru_id', $guru->id)->first();
        if($mengajar){
            return back()->with('error',"$guru->nama_guru masih digunakan di menu mengajar");
        }

        $guru->delete();
        return redirect('/table/guru/index')->with('success','Data Berhasil Dihapus');
    }
}
