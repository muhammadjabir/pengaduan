<?php

namespace App\Http\Controllers\Pengaduan;

use App\Http\Controllers\Controller;
use App\Mail\SendPengaduan;
use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use DB;
class PengaduanController extends Controller
{
    public function index(Request $request){
        if ($request) {
            $user = Pengaduan::with(['warga','kategori'])->where('subjek','LIKE',"%{$request->keyword}%")
                    ->orWhereHas('warga',function($q) use($request) {
                        $q->where('nama','LIKE',"%{$request->keyword}%");
                    })
                    ->orWhereHas('kategori',function($q) use($request) {
                        $q->where('nama_kategori','LIKE',"%{$request->keyword}%");
                    })
                    ->paginate(15);
        }else{
            $user = Pengaduan::paginate(15);
        }

        return $user;
    }
    public function create(){
        $kategories = Kategori::all();
        return view('pengaduan.create',compact('kategories'));
    }

    public function detail(Request $request){
        $pengaduan = Pengaduan::with(['warga','kategori','user'])->findOrFail($request->id);
        return view('pengaduan',compact('pengaduan'));
    }

    public function store(Request $request){
        \Validator::make($request->all(), [
            'subjek' => 'required',
            'ktp' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'isi_pengaduan' => 'required',
            'id_kategori' => 'required',
            'status_public' => 'required',
        ])->validate();
        // $validasi =  \Validator::make($request->all(), [
        //         '*' => 'required'
        //     ]);
        //     return $validasi->errors();
        DB::beginTransaction();
        $error = 0;
        try {

            $warga = Warga::updateOrCreate(
                ['ktp' => $request->ktp],
                ['nama' => $request->nama_lengkap, 'alamat' => $request->alamat,'email'=>$request->email,'nohp'=>$request->nohp]
            );
            $pengaduan = new Pengaduan;
            $pengaduan->subjek = $request->subjek;
            $pengaduan->isi_pengaduan = $request->isi_pengaduan;
            $pengaduan->id_kategori = $request->id_kategori;
            $pengaduan->status_tampil = $request->status_public;
            $pengaduan->slug =Str::of($request->subjek)->slug('-');
            $pengaduan->id_warga = $warga->id;
            if ($request->file('file_pengaduan')) {
                $file = $request->file('file_pengaduan')->store('file_pengaduan','public');
                $pengaduan->file_pengaduan = $file;
            }
            if (!$pengaduan->save()) {
                $error++;
                throw new \Exception('Gagal Melakukan Pengaduan');
            }
            if ($error === 0) {
                DB::commit();
                return redirect()->route('home');
            }

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }


    }


    public function edit($id){
        $pengaduan = Pengaduan::with('warga')->findOrFail($id);
        return $pengaduan;
    }

    public function update( Request $request, $id){
        $pengaduan = Pengaduan::with(['warga','user'])->findOrFail($id);
        $pengaduan->jawaban = $request->jawaban;
        $pengaduan->id_admin = \Auth::user()->id;
        if($pengaduan->save()){
            Mail::to($pengaduan->warga->email)->send(new SendPengaduan($pengaduan));
        };
        return response()->json([
            'message' => 'Berhasil menyimpan jawaban'
        ],200);
    }
}
