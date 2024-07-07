<?php

namespace App\Http\Controllers;

use App\Models\Rekanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekananController extends Controller
{
    public function dashboard()
    {
        return view('Rekanan.dashboard', compact('roles'));
    }
    public function index()
    {
        $rekanan = Rekanan::all();
        return view('Rekanan.rekanan', compact('rekanan'));
    }


    public function viewCreate()
    {
        $rekanans = Rekanan::all();
        return view('Rekanan.crud.create', compact('rekanans'));
    }
    
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_pt' => 'required|string',
            'no_tlp' => 'required|string|max:15',
            'jenis_usaha' => 'required|string',
            'alamat' => 'required|string',
            'term_agrement' => 'required|string',
        ]);

        if($validator->fails()){
            return redirect()->route('rekanan.index')->withErrors($validator)->withInput();
        }

        $rekanan = new Rekanan();
        $rekanan->nama_pt = $request->nama_pt;
        $rekanan->no_tlp = $request->no_tlp;
        $rekanan->jenis_usaha = $request->jenis_usaha;
        $rekanan->alamat = $request->alamat;
        $rekanan->term_agrement = $request->term_agrement;
        $rekanan->save();
        return redirect()->route('rekanan.index');
    }

    public function viewEdit ($id){
        $rekanan = Rekanan::findOrFail($id);

        return view('Rekanan.crud.edit', compact('rekanan'));
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama_pt' => 'required|string|max:255',
        'no_tlp' => 'required|string|max:15',
        'jenis_usaha' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'term_agrement' => 'nullable|string|max:255',
    ]);

    $rekanan = Rekanan::findOrFail($id);
    $rekanan->update($validatedData);

    return redirect()->route('rekanan.index')->with('success', 'Rekanan updated successfully.');
}
}
