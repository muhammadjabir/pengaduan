<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $kategori = Kategori::all();
        if ($request->kategori) {
            $pengaduan = Pengaduan::with(['warga','kategori'])
            ->where('status_tampil',true)
            ->where('jawaban','!=',null)
            ->whereHas('kategori',function($q) use($request){
                $q->where('slug',$request->kategori);
            })->get();
        } else {
            $pengaduan = Pengaduan::with(['warga','kategori'])
            ->where('status_tampil',true)
            ->where('jawaban','!=',null)
            ->get();
        }
        return view('home',compact('kategori','pengaduan'));
    }
}
