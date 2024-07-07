<?php

namespace App\Http\Controllers;

use App\Models\Divisions;
use App\Models\IntruksiJalan;
use App\Models\Kendaraan;
use App\Models\KendaraanItemCondition;
use App\Models\Order;
use App\Models\ServiceKendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperasionalController extends Controller
{
    public function index(){
        $kendaraans = Kendaraan::all();

        return view('Operasional.kendaraan', compact('kendaraans'));
    }

    public function instruksiJalanIndex()
    {
        $intruksiJalans = IntruksiJalan::all();
        $kendaraans = Kendaraan::all();
        $orders = Order::all();
    
        // Fetch users belonging to 'operasional' division
        $users = User::whereHas('division', function($query) {
            $query->where('name', 'operasional');
        })->get();
    
        return view('Operasional.instruksiJalan', compact('intruksiJalans', 'kendaraans', 'users', 'orders'));
    }
    

    public function instruksiStore(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'driver_id' => 'required|exists:users,id',
        'kenek_id' => 'nullable|exists:users,id',
        'nopol' => 'required|string',
        'tanggal_jalan' => 'required|date',
        'tanggal_stuffing' => 'nullable|date',
        'tanggal_stripping' => 'nullable|date',
        'estimasi_waktu_ke_tujuan' => 'required|string',
    ]);

    // Generate No Surat Jalan
    $lastInstruksiJalan = IntruksiJalan::orderBy('id', 'desc')->first();
    $newId = $lastInstruksiJalan ? $lastInstruksiJalan->id + 1 : 1;
    $noSuratJalan = 'SRT-' . str_pad($newId, 6, '0', STR_PAD_LEFT);

    // Store data to database
    $instruksiJalan = new IntruksiJalan();
    $instruksiJalan->order_id = $request->order_id;
    $instruksiJalan->no_surat_jalan = $noSuratJalan;
    $instruksiJalan->driver_id = $request->driver_id;
    $instruksiJalan->kenek_id = $request->kenek_id;
    $instruksiJalan->nopol = $request->nopol;
    $instruksiJalan->tanggal_jalan = $request->tanggal_jalan;
    $instruksiJalan->tanggal_stuffing = $request->tanggal_stuffing;
    $instruksiJalan->tanggal_stripping = $request->tanggal_stripping;
    $instruksiJalan->estimasi_waktu_ke_tujuan = $request->estimasi_waktu_ke_tujuan;
    $instruksiJalan->save();

    return redirect()->route('intruksiJalan.index')->with('success', 'Instruksi Jalan created successfully.');
}



    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'nopol' => 'required|string',
            'jenis_kendaraan' => 'required|string',
            'panjang' => 'required|string',
            'lebar' => 'required|string',
            'tinggi' => 'required|string',
            'berat_maksimal' => 'required|string',
            'no_rangka' => 'required|string',
            'tanggal_pajak_plat' => 'required|date',
            'tanggal_pajak_stnk' => 'required|date',
        ]);

        if ($validator->fails()){
            return redirect()->route('karyawan.index')
                ->withErrors($validator)
                ->withInput();
        }

        $kendaraan = new Kendaraan();
        $kendaraan->nopol = $request->nopol;
        $kendaraan->jenis_kendaraan = $request->jenis_kendaraan;
        $kendaraan->panjang = $request->panjang;
        $kendaraan->lebar = $request->lebar;
        $kendaraan->tinggi = $request->tinggi;
        $kendaraan->berat_maksimal = $request->berat_maksimal;
        $kendaraan->no_rangka = $request->no_rangka;
        $kendaraan->tanggal_pajak_plat = $request->tanggal_pajak_plat;
        $kendaraan->tanggal_pajak_stnk = $request->tanggal_pajak_stnk;
        $kendaraan->save();
        return redirect()->route('kendaraan.index')->with('success', 'Data kendaraan berhasil ditambahkan');
    }



    // SERVICE KENDARAAN //
    public function indexService(){
        $services = ServiceKendaraan::all();
        $kendaraans = Kendaraan::all();
    
        $division = Divisions::where('name', 'operasional')->first();
    
        $division_id = $division ? $division->id : null;
    
        $drivers = $division_id ? User::where('division_id', $division_id)->get() : collect();
    
        return view('Operasional.service', compact('services', 'kendaraans', 'drivers'));
    }

    public function createService(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'driver_id' => 'required|exists:users,id',
            'total_service' => 'required|numeric',
            'upload_dokumen' => 'nullable|file',
            'item_name.*' => 'required|string',
            'item_value.*' => 'required|string',
            'desc.*' => 'nullable|string',
        ]);

        // Generate nomor service otomatis
        $lastService = ServiceKendaraan::orderBy('id', 'desc')->first();
        $lastServiceNumber = $lastService ? (int)substr($lastService->no_service, -5) : 0;
        $newServiceNumber = str_pad($lastServiceNumber + 1, 5, '0', STR_PAD_LEFT);
        $no_service = 'SRV' . $newServiceNumber;

        // Upload dokumen
        $uploadDokumen = $request->file('upload_dokumen');
        $uploadPath = $uploadDokumen ? $uploadDokumen->store('uploads', 'public') : null;

        // Simpan data service kendaraan
        $service = ServiceKendaraan::create([
            'no_service' => $no_service,
            'nopol' => $request->kendaraan_id,
            'driver_id' => $request->driver_id,
            'total_service' => $request->total_service,
            'upload_dokumen' => $uploadPath,
        ]);

        // Simpan kondisi item kendaraan
        if ($request->has('item_name')) {
            foreach ($request->item_name as $index => $itemName) {
                $service->kendaraanItemConditions()->create([
                    'item_name' => $itemName,
                    'item_value' => $request->item_value[$index],
                    'desc' => $request->desc[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('service.index')->with('success', 'Data service kendaraan berhasil ditambahkan');
    }
}




