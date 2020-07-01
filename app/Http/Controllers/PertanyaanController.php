<?php

namespace App\Http\Controllers;

use App\Models\MasterDataDetail;
use App\Pertanyaan;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;
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
                    case 'sangat kurang':
                        $nilai = 1;
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
                return redirect()->route('ertanyaan.detail');
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
            $sangat = 0;
            $puas = 0;
            $biasa = 0;
            $kurang = 0;
            $sangat_kurang = 0;
            foreach ($data->pertanyaan as $s) {
                switch ($s->nilai) {
                    case 5:
                        $sangat++;
                        break;
                    case 4:
                        $puas++;
                        break;
                    case 3:
                        $biasa++;
                        break;
                    case 2:
                        $kurang++;
                        break;
                    case 1:
                        $sangat_kurang++;
                        break;
                    default:
                        # code...
                        break;
                }
            }
           $data_nilai = ['pertanyaan' => $data->description,
                            'id' => $data->description,
                            'total_respon' => count($data->pertanyaan),
                            'total_nilai' => $data->pertanyaan->sum('nilai'),
                            'total_persen' =>($data->pertanyaan->sum('nilai') / (count($data->pertanyaan) * 5)) * 100,
                            'label' => ['Sangat Memuaskan','Memuaskan','Biasa','Kurang Memuaskan','Sangat Kurang Memuaskan'],
                            'value' => [$sangat,$puas,$biasa,$kurang,$sangat_kurang]
            ];
          array_push($pertanyaan,$data_nilai);
        }
        return view('pertanyaan-detail',compact('pertanyaan'));
    }

    public function data_survey(){
        $datas = MasterDataDetail::with('pertanyaan')->where('id_master_data',11)->get();
        $pertanyaan = [];
        foreach ($datas as $data) {
            $sangat = 0;
            $puas = 0;
            $biasa = 0;
            $kurang = 0;
            $sangat_kurang = 0;
            foreach ($data->pertanyaan as $s) {
                switch ($s->nilai) {
                    case 5:
                        $sangat++;
                        break;
                    case 4:
                        $puas++;
                        break;
                    case 3:
                        $biasa++;
                        break;
                    case 2:
                        $kurang++;
                        break;
                    case 1:
                        $sangat_kurang++;
                        break;
                    default:
                        # code...
                        break;
                }
            }
            $slug = Str::of($data->description)->slug('-');
           $data_nilai = ['pertanyaan' => $data->description,
                            'id' => $data->description,
                            'total_respon' => count($data->pertanyaan),
                            'total_nilai' => $data->pertanyaan->sum('nilai'),
                            'total_persen' =>($data->pertanyaan->sum('nilai') / (count($data->pertanyaan) * 5)) * 100,
                            'label' => ['Sangat Memuaskan','Memuaskan','Biasa','Kurang Memuaskan','Sangat Kurang Memuaskan'],
                            'value' => [$sangat,$puas,$biasa,$kurang,$sangat_kurang]
            ];
          array_push($pertanyaan,$data_nilai);
        }
        return $pertanyaan;
    }
}
