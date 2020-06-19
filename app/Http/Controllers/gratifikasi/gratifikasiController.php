<?php

namespace App\Http\Controllers\gratifikasi;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Gratifikasi;
use App\Models\Warga;
use Illuminate\Http\Request;
use DB;

class gratifikasiController extends Controller
{
    public function index(Request $request){
        if ($request) {
            $user = Gratifikasi::with(['warga'])->where('tgl_terima','LIKE',"%{$request->keyword}%")
                    ->orWhereHas('warga',function($q) use($request) {
                        $q->where('nama','LIKE',"%{$request->keyword}%");
                    })
                    ->orWhere('nama_pemberi','LIKE',"%{$request->keyword}%")
                    ->paginate(15);
        }else{
            $user = Gratifikasi::paginate(15);
        }

        return $user;
    }

    public function create(Request $request){

        return view('gratifikasi.index');
    }

    public function store(Request $request){
        \Validator::make($request->all(), [
            'ktp' => 'required',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'nohp' => 'required',
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

            $gratifikasi = new Gratifikasi;
            $gratifikasi->nama_pemberi = $request->nama_pemberi;
            $gratifikasi->pekerjaan = $request->pekerjaan;
            $gratifikasi->nohp = $request->nohp;
            $gratifikasi->tgl_terima = $request->tgl_terima;
            $gratifikasi->alasan = $request->alasan;
            $gratifikasi->jrnid = $request->jenis;
            $gratifikasi->alamat = $request->alamat;
            $gratifikasi->hubungan = $request->hubungan;
            $gratifikasi->lokasi_diterima = $request->lokasi;
            $gratifikasi->kronologi = $request->kronologi;
            $gratifikasi->id_warga = $warga->id;
            if ($gratifikasi->save()) {
                $files = $request->file('file_barang');
                for ($i=0; $i < count($request->nama_barang) ; $i++) {
                    $barang = new Barang;
                    $barang->nama_barang = $request->nama_barang[$i];
                    $barang->jenis_barang = $request->jenis_barang[$i];
                    $barang->taksiran_harga = $request->taksiran_harga[$i];
                    $barang->id_gratifikasi = $gratifikasi->id;
                    if (array_key_exists($i,$files)) {
                        $file = $files[$i]->store('file_barang','public');
                        $barang->file_barang = $file;
                    }
                    if (!$barang->save()) {
                        $error++;
                        throw new \Exception('Gagal Melakukan Save barang');
                        break;
                    }

                }
            }else {
                $error++;
                throw new \Exception('Gagal Melakukan Pengaduan');
            }
            if ($error === 0) {
                DB::commit();
                return redirect()->route('gratifikasi.index');
            }

        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function edit(Request $request ,$id){
        $lapdu = Gratifikasi::with(['warga','barang'])->findOrFail($id);
        return response()->json([
            'lapdu' => $lapdu,
        ]);
    }
}
