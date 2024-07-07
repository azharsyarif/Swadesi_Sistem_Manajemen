<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Order;
use App\Models\Rekanan;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default value 10
        $query = Order::query();
        $rekanans = Rekanan::all();
        $kendaraans = Kendaraan::all();
    
        if ($request->has('search_po')) {
            $query->where('No_PO_Customer', 'like', '%'.$request->input('search_po').'%');
        }
    
        // Calculate average revenue
        $averageRevenue = Order::selectRaw('avg(total_harga_deal::numeric) as avg_revenue')->first()->avg_revenue;
    
        // Paginate orders after filtering
        $orders = $query->paginate($perPage);
    
        return view('Marketing.order.orderIndex', compact('orders', 'rekanans', 'kendaraans', 'averageRevenue', 'perPage'));
    }
    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'No_PO_Customer' => 'required|string',
            'asal' => 'required|string',
            'tujuan' => 'required|string',
            'layanan' => 'required|string',
            'total_km' => 'required|string',
            'total_koli' => 'required|string',
            'total_berat' => 'required|numeric',
            'deskripsi_barang' => 'required|string',
            'rekanan_id' => 'required|exists:rekanans,id',
            'harga_deal' => 'required|numeric',
            'upload_harga_deal' => 'required|file',
        ]);
    
        // Additional validation for kendaraan_id if layanan is 'mobil'
        if ($request->layanan == 'mobil') {
            $request->validate([
                'kendaraan_id' => 'required|exists:kendaraans,id',
            ]);
        }
    
        // Generate No_Order
        $lastOrder = Order::orderBy('id', 'desc')->first();
        $newOrderNumber = $lastOrder ? $lastOrder->id + 1 : 1;
        $No_Order = 'ORD-' . str_pad($newOrderNumber, 6, '0', STR_PAD_LEFT);
    
        $order = new Order();
        $order->No_Order = $No_Order;
        $order->No_PO_Customer = $request->No_PO_Customer;
        $order->asal = $request->asal;
        $order->tujuan = $request->tujuan;
        $order->layanan = $request->layanan;
        $order->total_km = $request->total_km;
        $order->total_koli = $request->total_koli;
        $order->total_berat = $request->total_berat;
        $order->deskripsi_barang = $request->deskripsi_barang;
        $order->rekanan_id = $request->rekanan_id;
        
        // Set kendaraan_id if layanan is 'mobil'
        if ($request->layanan == 'mobil') {
            $order->kendaraan_id = $request->kendaraan_id;
        } else {
            $order->kendaraan_id = null;  // Ensure kendaraan_id is null if layanan is not 'mobil'
        }
    
        $order->harga_deal = $request->harga_deal;
        $order->total_harga_deal = $request->total_berat * $request->harga_deal;
    
        if ($request->hasFile('upload_harga_deal')) {
            $order->upload_harga_deal = $request->file('upload_harga_deal')->store('harga_deal');
        }
    
        $order->save();
    
        return redirect()->route('marketing.order.index')->with('success', 'Order created successfully.');
    }
    

}
