<?php

namespace App\Http\Controllers\Lapdu;

use App\Http\Controllers\Controller;
use App\Lapdu;
use App\Models\Warga;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPengaduan;
use App\Mail\SendRegistrasi;

class LapduController extends Controller
{
    public function index(Request $request){
        if ($request) {
            $user = Lapdu::with(['warga'])->where('subjek','LIKE',"%{$request->keyword}%")
                    ->orWhereHas('warga',function($q) use($request) {
                        $q->where('nama','LIKE',"%{$request->keyword}%");
                    })
                    ->orWhere('nomor_registrasi','LIKE',"%{$request->keyword}%")
                    ->paginate(15);
        }else{
            $user = Lapdu::paginate(15);
        }

        return $user;
    }
    public function create(Request $request){
        if ($request->kode) {
            $pengaduan = Lapdu::with(['warga','user'])->where('nomor_registrasi',$request->kode)->first();
            return view('lapdu.detail',compact('pengaduan'));
        }else {
            return view('lapdu.index');
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
            'nama_pegawai' => 'required',
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
            $get_nomor = Lapdu::whereDate('created_at',$nomor->format('Y-m-d'))->first();
            $nomor = $get_nomor ? $get_nomor->nomor_registrasi + 1 : $nomor->format('Ymd') . 1;

            $pengaduan = new Lapdu;
            $pengaduan->subjek = $request->subjek;
            $pengaduan->isi_pengaduan = $request->isi_pengaduan;
            $pengaduan->nama_pegawai = $request->nama_pegawai;
            $pengaduan->id_warga = $warga->id;

            $pengaduan->nomor_registrasi = $nomor;
            if ($request->file('file_pengaduan')) {
                $file = $request->file('file_pengaduan')->store('file_pengaduan','public');
                $pengaduan->file_pengaduan = $file;
            }
            if (!$pengaduan->save()) {
                $error++;
                throw new \Exception('Gagal Melakukan Pengaduan');
            } else {
                $data = [
                    'subject' => 'E-Lapdu',
                    'registrasi' => $nomor
                ];
                Mail::to($warga->email)->send(new SendRegistrasi($data));
            }
            if ($error === 0) {
                DB::commit();
                return redirect()->route('lapdu.index');
            }

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function edit(Request $request ,$id){
        $lapdu = Lapdu::with('warga')->findOrFail($id);
        $status = \App\Models\MasterDataDetail::where('id_master_data',9)->get();
        $pelanggaran = \App\Models\MasterDataDetail::where('id_master_data',10)->get();
        return response()->json([
            'lapdu' => $lapdu,
            'status' => $status,
            'pelanggaran' => $pelanggaran
        ]);
    }

    public function update( Request $request, $id){
        $pengaduan = Lapdu::with(['warga','user'])->findOrFail($id);
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
