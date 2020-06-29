<?php

namespace App\Http\Controllers;

use App\Models\MasterDataDetail;
use App\Pertanyaan;
use Illuminate\Http\Request;
use DB;
class PertanyaanController extends Controller
{
    public function index(Request $request){
        $pertanyaan = MasterDataDetail::where('id_master_data',11)->get();
        return view('pertanyaan',['pertanyaan'=>$pertanyaan]);
    }

    public function store(Request $request){

        $data = $request->input();
        $pertanyaan = MasterDataDetail::where('id_master_data',11)->get();
        DB::beginTransaction();
        $error = 0;
            try {
            foreach ($pertanyaan as $key => $value) {
                $survey = new Pertanyaan;
                $survey->nama = $request->nama;
                $survey->jabatan = $request->jabatan;
                $survey->id_prtanyaan = $value->id;
                switch ($data['pertanyaan_'.$key]) {
                    case 'sangat memuaskan':
                        $nilai = 5;
                        break;
                    case 'memuaskan':
                        $nilai = 4;
                        break;
                    case 'biasa':
                        $nilai = 3;
                        break;
                    case 'kurang memuaskan':
                        $nilai = 2;
                        break;
                    default:
                        $nilai = 1;
                        break;
                }
                $survey->nilai = $nilai;
                if (!$survey->save()) {
                    $error++;
                    throw new \Exception('Tidak bisa menyimpan data');
                }
            }
            if ($error === 0) {
                DB::commit();
                return redirect()->route('pertanyaan.index');
            }
            } catch (\Exception $e) {
                DB::rollback();
                return $e;
            }
    }

    public function detail(){
        $datas = MasterDataDetail::with('pertanyaan')->where('id_master_data',11)->get();
        $pertanyaan = [];
        foreach ($datas as $data) {
           $data_nilai = ['pertanyaan' => $data->description,
                            'total_respon' => count($data->pertanyaan),
                            'total_nilai' => $data->pertanyaan->sum('nilai'),
                            'total_persen' =>($data->pertanyaan->sum('nilai') / (count($data->pertanyaan) * 5)) * 100
            ];
          array_push($pertanyaan,$data_nilai);
        }
        return view('pertanyaan-detail',compact('pertanyaan'));

    }
}
