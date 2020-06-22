<?php

namespace App\Http\Controllers\Wbs;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use App\Models\Wbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPengaduan;
use App\Mail\SendRegistrasi;
use DB;

class WbsController extends Controller
{
    public function index(Request $request){
        if ($request) {
            $user = Wbs::with(['warga'])->where('subjek','LIKE',"%{$request->keyword}%")
                    ->orWhereHas('warga',function($q) use($request) {
                        $q->where('nama','LIKE',"%{$request->keyword}%");
                    })
                    ->orWhere('nomor_registrasi','LIKE',"%{$request->keyword}%")
                    ->paginate(15);
        }else{
            $user = Wbs::paginate(15);
        }

        return $user;
    }
    public function create(Request $request){
        if ($request->kode) {
            $pengaduan = Wbs::with(['warga','user'])->where('nomor_registrasi',$request->kode)->first();

            return view('wbs.detail',compact('pengaduan'));
        }else {
            return view('wbs.index');
        }
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
            $nomor = \Carbon\Carbon::now();
            $get_nomor = Wbs::whereDate('created_at',$nomor->format('Y-m-d'))->first();
            $nomor = $get_nomor ? $get_nomor->nomor_registrasi + 1 : $nomor->format('Ymd') . 1;

            $pengaduan = new Wbs;
            $pengaduan->subjek = $request->subjek;
            $pengaduan->isi_pengaduan = $request->isi_pengaduan;
            $pengaduan->id_warga = $warga->id;

            $pengaduan->nomor_registrasi = $nomor;
            if ($request->file('file_pengaduan')) {
                $file = $request->file('file_pengaduan')->store('file_pengaduan','public');
                $pengaduan->file_pengaduan = $file;
            }
            if (!$pengaduan->save()) {
                $error++;
                throw new \Exception('Gagal Melakukan Pengaduan');
            }else {
                $data = [
                    'subject' => 'Wistle Blowing System (WBS)',
                    'registrasi' => $nomor
                ];
                Mail::to($warga->email)->send(new SendRegistrasi($data));
            }
            if ($error === 0) {
                DB::commit();
                return redirect()->route('wbs.index');
            }

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function edit(Request $request ,$id){
        $lapdu = Wbs::with('warga')->findOrFail($id);
        return response()->json([
            'lapdu' => $lapdu,
        ]);
    }

    public function update( Request $request, $id){
        $pengaduan = Wbs::with(['warga','user'])->findOrFail($id);
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
