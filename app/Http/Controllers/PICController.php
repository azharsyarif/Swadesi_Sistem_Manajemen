<?php

namespace App\Http\Controllers;

use App\Models\PICCustomer;
use App\Models\Rekanan;
use Illuminate\Http\Request;

class PICController extends Controller
{
    public function index(){
        $rekanans = PICCustomer::all();


        return view('Rekanan.pic', compact('rekanans'));
    }

    public function viewCreate()
    {
        $rekanans = Rekanan::all();
        return view('Rekanan.picCrud.create', compact('rekanans'));
    }

    public function create(Request $request){
        $request->validate([
            'nama_pt' => 'required|exists:rekanans,id',
            'nama' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'posisi' => 'required|string|max:255',
            'cabang' => 'required|string|max:255',
        ]);
    
        PICCustomer::create([
            'nama_pt' => $request->nama_pt,
            'nama' => $request->nama,
            'no_tlp' => $request->no_tlp,
            'posisi' => $request->posisi,
            'cabang' => $request->cabang,
        ]);

        return redirect()->route('pic-index')->with('success', 'PIC Customer berhasil ditambahkan');

    }

    public function viewEdit($id)
{
    $picCustomer = PICCustomer::findOrFail($id);
    $rekanans = Rekanan::all();
    return view('Rekanan.picCrud.edit', compact('picCustomer', 'rekanans'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pt' => 'required|exists:rekanans,id',
            'nama' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:255',
            'posisi' => 'required|string|max:255',
            'cabang' => 'required|string|max:255',
        ]);

        $picCustomer = PICCustomer::findOrFail($id);
        $picCustomer->update([
            'nama_pt' => $request->nama_pt,
            'nama' => $request->nama,
            'no_tlp' => $request->no_tlp,
            'posisi' => $request->posisi,
            'cabang' => $request->cabang,
        ]);

        return redirect()->route('pic-index')->with('success', 'PIC Customer updated successfully.');
    }

    public function delete($id){
        $pic = PICCustomer::findOrFail($id);
        $pic->delete();
        return redirect()->route('pic-index')->with('success', 'PIC Customer berhasil di hapus');
    }
}
