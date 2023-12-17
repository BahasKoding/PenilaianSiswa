<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Mengajar;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Mapel'
        ];
        return view('table.mapel.index',$data,[
            'mapel'  => Mapel::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Mapel'
        ];
        return view('table.mapel.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_mapel'     => 'required|unique:mapels,nama_mapel'
        ],[
            'nama_mapel.unique' => 'Mapel sudah digunakan, harap masukkan Mapel yang berbeda.',
        ]);
        Mapel::create($data);
        return redirect('/table/mapel/index')->with('success', 'Data Berhasil Ditambah !');
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
    public function edit(Mapel $mapel)
    {
        $data = [
            'pageTitle' => 'Mapel'
        ];
        return view('table.mapel.edit',$data,[
            'mapel'  => $mapel
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mapel $mapel)
    {
        $data = $request->validate([
            'nama_mapel' => [
                    'required',
                    Rule::unique('mapels', 'nama_mapel')->ignore($mapel->id),
                ]
            ],[
                'nama_mapel.unique' => 'Mapel sudah digunakan, harap masukkan Mapel yang berbeda.',
            ]);
        $mapel->update($data);
        return redirect('/table/mapel/index')->with('success', 'Data Berhasil Diedit !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mapel $mapel)
    {
        $mengajar = Mengajar::where('mapel_id', $mapel->id)->first();
        if($mengajar){
            return back()->with('error',"$mapel->nama_mapel masih digunakan di menu mengajar");
        }

        $mapel->delete();
        return redirect('/table/mapel/index')->with('success','Data Berhasil Dihapus');
    }
}
