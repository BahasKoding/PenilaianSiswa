<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Mengajar;
use Illuminate\Http\Request;

class MengajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Mengajar'
        ];
        return view('table.mengajar.index',$data,[
            'mengajar'  => Mengajar::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Mengajar'
        ];
        return view('table.mengajar.create', $data,[
            'kelas'   => Kelas::all(),
            'guru'    => Guru::all(),
            'mapel'   => Mapel::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'guru_id'       => 'required',
            'mapel_id'      => 'required',
            'kelas_id'      => 'required',
        ]);

        Mengajar::create($data);
        return redirect('/table/mengajar/index')->with('success', 'Data Berhasil Ditambah !');
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
    public function edit(Mengajar $mengajar)
    {
        $data = [
            'pageTitle' => 'Mengajar'
        ];
        return view('table.mengajar.edit',$data,[
            'mengajar'  => $mengajar,
            'guru'      => Guru::all(),
            'mapel'     => Mapel::all(),
            'kelas'     => Kelas::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mengajar $mengajar)
    {
        $data = $request->validate([
            'guru_id'       => 'required',
            'mapel_id'      => 'required',
            'kelas_id'      => 'required',
        ]);
        
        $mengajar->update($data);
        return redirect('/table/mengajar/index')->with('success', 'Data Berhasil Diedit !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mengajar $mengajar)
    {
        // $mengajar = Mengajar::where('id', $mengajar->id)->first();
        // if($mengajar){
        //     return back()->with('error',"masih digunakan di menu nilai");
        // }

        $mengajar->delete();
        return redirect('/table/mengajar/index')->with('success','Data Berhasil Dihapus');
    }
}
