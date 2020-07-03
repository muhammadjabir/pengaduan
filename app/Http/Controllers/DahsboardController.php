<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DahsboardController extends Controller
{
    public function index(){
        $tahun = \Carbon\Carbon::now();
        $pengaduan = $this->get_data(DB::table('pengaduan')->select(DB::raw('count(id) as total'),DB::raw("DATE_FORMAT(created_at, '%c') month"))
        ->whereYear('created_at',$tahun->format('Y-m-d'))
        ->groupBy('month')->get());

        $pengaduan_korupsi = $this->get_data(DB::table('omjaka')->select(DB::raw('count(id) as total'),DB::raw("DATE_FORMAT(created_at, '%c') month"))
        ->whereYear('created_at',$tahun->format('Y-m-d'))
        ->groupBy('month')->get());

        $elapdu = $this->get_data(DB::table('pengaduan_lapdu')->select(DB::raw('count(id) as total'),DB::raw("DATE_FORMAT(created_at, '%c') month"))
        ->whereYear('created_at',$tahun->format('Y-m-d'))
        ->groupBy('month')->get());

        $gratifikasi = $this->get_data(DB::table('gratifikasi')->select(DB::raw('count(id) as total'),DB::raw("DATE_FORMAT(created_at, '%c') month"))
        ->whereYear('created_at',$tahun->format('Y-m-d'))
        ->groupBy('month')->get());

        $wbs = $this->get_data(DB::table('wbs')->select(DB::raw('count(id) as total'),DB::raw("DATE_FORMAT(created_at, '%c') month"))
        ->whereYear('created_at',$tahun->format('Y-m-d'))
        ->groupBy('month')->get());

        $data = [
            'pengaduan_masyarakat' => $pengaduan,
            'pengaduan_korupsi' => $pengaduan_korupsi,
            'elapdu' => $elapdu,
            'gratifikasi' => $gratifikasi,
            'wbs' => $wbs,
            'tahun' => $tahun->format('Y')
        ];
        return $data;
    }

    public function get_data($data){
        $januari = 0;
        $feb = 0;
        $maret = 0;
        $april = 0; $mei =0; $juni = 0; $juli=0; $agus = 0; $sep = 0; $okto = 0; $nov =0 ; $des = 0;

        foreach ($data as $item ) {
            switch ($item->month) {
                case '1':
                    $januari = $item->total;
                    break;
                case '2':
                    $feb = $item->total;
                    break;
                case '3':
                    $maret = $item->total;
                    break;
                case '4':
                    $april = $item->total;
                    break;
                case '5':
                    $mei = $item->total;
                    break;
                case '6':
                    $juni = $item->total;
                    break;
                case '7':
                    $juli = $item->total;
                    break;
                case '8':
                    $agus = $item->total;
                    break;
                case '9':
                    $sep = $item->total;
                    break;
                case '10':
                    $okto  = $item->total;
                    break;
                case '11':
                    $nov = $item->total;
                    break;
                case '12':
                    $des = $item->total;
                    break;
                default:
                    # code...
                    break;
            }
        }
        $data_value = [$januari,$feb,$maret,$april,$mei,$juni,$juli,$agus,$sep,$okto,$nov,$des];
        return $data_value;
    }
}
