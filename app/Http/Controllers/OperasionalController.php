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
    public function kendaraanIndex(){
        $kendaraans = Kendaraan::all();

        return view('Operasional.kendaraan.kendaraan', compact('kendaraans'));
    }

    public function viewCreateKendaraan(){
        $intruksiJalans = IntruksiJalan::all();
        $kendaraans = Kendaraan::all();
        $orders = Order::all();
        return view('Operasional.kendaraan.createKendaraan');
    }
    public function kendaraanStore(Request $request){

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

    public function editKendaraan($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('Operasional.kendaraan.editKendaraan', compact('kendaraan'));
    }

    public function updateKendaraan(Request $request, $id)
    {
        $request->validate([
            'nopol' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'berat_maksimal' => 'required|numeric',
            'no_rangka' => 'required|string|max:255',
            'tanggal_pajak_plat' => 'required|date',
            'tanggal_pajak_stnk' => 'required|date',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }
    public function destroyKendaraan($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }

    // INTRUKSI JALAN FUNCTION
    public function instruksiJalanIndex()
    {
        $intruksiJalans = IntruksiJalan::all();
        $kendaraans = Kendaraan::all();
        $orders = Order::all();

        // Fetch users belonging to 'operasional' and 'admin' division
        $users = User::whereHas('divisions', function($query) {
            $query->where('name', 'operasional');
        })->get();

        return view('Operasional.intruksiJalan.instruksiJalan', compact('intruksiJalans', 'kendaraans', 'users', 'orders'));
    }

    public function viewCreateIntruksiJalan(){
        $intruksiJalans = IntruksiJalan::all();
        $kendaraans = Kendaraan::all();
        $orders = Order::all();
    
        // Fetch users belonging to 'operasional' and 'admin' division
        $users = User::whereHas('divisions', function($query) {
            $query->where('name', 'operasional');
        })->get();
    
        return view('Operasional.intruksiJalan.createIntruksi', compact('intruksiJalans', 'kendaraans', 'users', 'orders'));
    }
    

    public function editIntruksiJalan($id)
    {
        $intruksiJalan = IntruksiJalan::findOrFail($id);
        $kendaraans = Kendaraan::all();
        $orders = Order::all();
        $users = User::whereHas('divisions', function($query) {
            $query->where('name', 'operasional');
        })->get();

        return view('Operasional.intruksiJalan.editIntruksi', compact('intruksiJalan', 'kendaraans', 'users', 'orders'));
    }

    public function updateIntruksiJalan(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required',
            'driver_id' => 'required',
            'nopol' => 'required',
            'tanggal_jalan' => 'required|date',
            'estimasi_waktu_ke_tujuan' => 'required',
            'estimasi_jarak' => 'required',
        ]);

        $intruksiJalan = IntruksiJalan::findOrFail($id);
        $intruksiJalan->update($request->all());

        return redirect()->route('intruksiJalan.index')->with('success', 'Intruksi Jalan berhasil diperbarui.');
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
            'estimasi_jarak' => 'required|string',
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
        $instruksiJalan->estimasi_jarak = $request->estimasi_jarak;
        $instruksiJalan->save();

        return redirect()->route('intruksiJalan.index')->with('success', 'Instruksi Jalan created successfully.');
    }

    public function destroyIntuksiJalan($id)
    {
        $intruksiJalan = IntruksiJalan::findOrFail($id);
        $intruksiJalan->delete();

        return redirect()->route('intruksiJalan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }

    // SERVICE KENDARAAN //
    public function indexService(){
        $services = ServiceKendaraan::all();
        $kendaraans = Kendaraan::all();
    
        // Menggunakan whereHas untuk mendapatkan pengguna dari divisi 'operasional'
        $drivers = User::whereHas('divisions', function($query) {
            $query->where('name', 'operasional');
        })->get();
    
        return view('Operasional.service.service', compact('services', 'kendaraans', 'drivers'));
    }

    public function viewCreate(){
        $services = ServiceKendaraan::all();
        $kendaraans = Kendaraan::all();

        $drivers = User::whereHas('divisions', function($query) {
            $query->where('name', 'operasional');
        })->get();

        return view('Operasional.service.createService', compact('services', 'kendaraans', 'drivers'));

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

    public function viewEditService($id)
    {
        $serviceKendaraan = ServiceKendaraan::with('kendaraanItemConditions')->findOrFail($id);
        $kendaraans = Kendaraan::all();
        $drivers = User::whereHas('divisions', function($query) {
            $query->where('name', 'operasional');
        })->get();

        return view('Operasional.service.editService', compact('serviceKendaraan', 'kendaraans', 'drivers'));
    }

    public function updateService(Request $request, $id)
{
    $request->validate([
        'nopol' => 'required',
        'driver_id' => 'required',
        'total_service' => 'required|numeric',
        'upload_dokumen' => 'nullable|file|mimes:jpg,png,pdf,docx',
        'item_name.*' => 'required|string',
        'item_value.*' => 'required|string',
        'desc.*' => 'nullable|string',
    ]);

    $serviceKendaraan = ServiceKendaraan::findOrFail($id);
    $serviceKendaraan->nopol = $request->nopol;
    $serviceKendaraan->driver_id = $request->driver_id;
    $serviceKendaraan->total_service = $request->total_service;

    if ($request->hasFile('upload_dokumen')) {
        $file = $request->file('upload_dokumen');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $serviceKendaraan->upload_dokumen = $filename;
    }

    $serviceKendaraan->save();

    // Handle item conditions
    $serviceKendaraan->kendaraanItemConditions()->delete();
    foreach ($request->item_name as $index => $name) {
        $serviceKendaraan->kendaraanItemConditions()->create([
            'item_name' => $name,
            'item_value' => $request->item_value[$index],
            'desc' => $request->desc[$index] ?? null,
        ]);
    }

    return redirect()->route('service.index')->with('success', 'Service Kendaraan berhasil diperbarui.');
}


    public function destroyService($id)
    {
        $service = ServiceKendaraan::findOrFail($id);
        $service->delete();

        return redirect()->route('service.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}




