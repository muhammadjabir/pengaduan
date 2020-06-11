<?php

namespace App\Http\Controllers\Masterdata;

use App\Http\Controllers\Controller;
use App\Http\Resources\Masterdata as ResourcesMasterdata;
use App\Models\Masterdata;
use App\Models\MasterDataDetail;
use Illuminate\Http\Request;
use DB;

class MasterdataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->keyword) {
            $data = Masterdata::where('description',"LIKE","%$request->keyword%")->orderBy('created_at','desc')->paginate(15);
        }else{
            $data = Masterdata::orderBy('created_at','desc')->paginate(15);
        }
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $error = 0;
        try {
            $data = new \App\Models\Masterdata;
            $data->description = $request->masterdata;
            if($data->save()){
                $childrens = json_decode($request->childrens);
                foreach($childrens as $children) {
                   $data_children = new MasterDataDetail;
                   $data_children->description = $children->description;
                   $data_children->id_master_data = $data->id;
                   if($data_children->save()){
                        continue;
                   }else {
                        $error++;
                        throw new \Exception('Gagal Menyimpan');
                        break;
                   }
                }
            }

            if ($error === 0) {
                DB::commit();
                $message = "Berhasil Tambah Master Data";
                $status = 200;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            DB::rollback();
            $status = 400;
        }

        return response()->json([
            'message' => $message,
        ], $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Masterdata::findOrFail($id);
        return new ResourcesMasterdata($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $id_children = [];
            $message = '';
            $error = 0;
            $data = Masterdata::findOrFail($id);
            $childrens = json_decode($request->childrens);
            $data->description = $request->description;
            if($data->save()){
                foreach ($childrens as $children) {
                    if ($children->id > 0) {
                       $data_children = MasterDataDetail::find($children->id);
                       $data_children->description = $children->description;
                       if ($data_children->save()) {
                            array_push($id_children,$data_children->id);
                       }else {
                           $error++;
                           throw new \Exception('Gagal Edit Children');
                       }
                    }else{
                        $data_children = new MasterDataDetail;
                        $data_children->description = $children->description;
                        $data_children->id_master_data = $data->id;
                        if ($data_children->save()) {
                            array_push($id_children,$data_children->id);
                        }else {
                           $error++;
                           throw new \Exception('Gagal Tambah Children');
                        }
                    }
                }
                $hapus_children = $data->detail()->whereNotIn('id',$id_children)->get()->pluck('id');
                if (count($hapus_children) >= 1) {
                    if (!MasterDataDetail::whereIn('id',$hapus_children)->delete()) {
                        $error++;
                        throw new \Exception('Gagal Hapus Children');
                    }

                }
            }

            if ($error === 0) {
                DB::commit();
                $message = "Berhasil Edit Master Data";
                $status = 200;
            }
        } catch (\Exception $e) {
            DB::rollback();
            $message = $e->getMessage();
            $status = 500;
        }


        return response()->json([
            'message' => $message
        ],$status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Masterdata::find($id);
        $status = 200;
        $message = "Berhasil Hapus Data";
        if ($data) {
            $data->detail()->delete();
            $data->delete();
        }else{
            $message = "Gagal Hapus Data";
            $status = 500;
        }

        return response()->json([
            'message' => $message
        ],$status);
    }
}
