<?php

namespace App\Http\Controllers\Menu;

use App\Http\Controllers\Controller;
use App\Http\Resources\Menu\Menu as MenuMenu;
use App\Models\ChildMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->keyword) {
            $data = Menu::where('description',"LIKE","%$request->keyword%")
                    ->orWhere('url',"LIKE","%$request->keyword%")
                    ->orderBy('priority','desc')->paginate(15);
        }else{
            $data = Menu::orderBy('priority','desc')->paginate(15);
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
            $data = new Menu;
            $data->url = $request->menu_url;
            $data->icon = $request->menu_icon;
            $data->status_child = $request->status_child == 1 ? true : false;
            $data->description = $request->description;
            $data->priority = $request->priority;
            if ($data->save()) {
                if ($data->status_child == 1) {
                    $childs = json_decode($request->child_menu);
                    foreach ($childs as $child) {
                        $child_menu = new ChildMenu;
                        $child_menu->url = $child->url;
                        $child_menu->icon = $child->icon;
                        $child_menu->id_menu = $data->id;
                        $child_menu->description = $child->description;
                        if ($child_menu->save()) {
                            continue;
                        }else{
                            $error++;
                            throw new \Exception('Gagal Menyimpan Child Menu');
                            break;
                        }
                    }
                }
            }else{
                $error++;
                throw new \Exception('Gagal Menyimpan Menu');
            }

            if ($error === 0) {
                DB::commit();
                $message = 'Berhasil Tambah Menu';
                $status = 200;
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $status = 500;
        }

        return response()->json([
            'message'=>$message
        ],$status);
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
        $data = Menu::findOrFail($id);
        return new MenuMenu($data);
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
        $data = Menu::findOrFail($id);
        $error = 0;
        DB::beginTransaction();
        try {
            $data->url = $request->menu_url;
            $data->icon = $request->menu_icon;
            $data->status_child = $request->status_child == 1 ? true : false;
            $data->description = $request->description;
            $data->priority = $request->priority;
            $data->save();
            $id_child = [];
            if ($data->status_child == 1) {
                $childs = json_decode($request->child_menu);
                foreach($childs as $child){
                    if ($child->id > 0) {
                       $child_menu = ChildMenu::find($child->id);

                    }else{
                        $child_menu = new ChildMenu;
                    }
                    $child_menu->url = $child->url;
                    $child_menu->icon = $child->icon;
                    $child_menu->id_menu = $data->id;
                    $child_menu->description = $child->description;
                    if ($child_menu->save()) {
                        array_push($id_child,$child_menu->id);
                    }else{
                        $error ++;
                        throw new \Exception('Gagal Edit atau Hapus Child Menu');
                    }
                }
            }
            $hapus_child = $data->child_menu()->whereNotIn('id',$id_child)->pluck('id');
            if (count($hapus_child) >= 1) {
                if(!ChildMenu::whereIn('id',$hapus_child)->delete()){
                    $error ++;
                    throw new \Exception('Gagal Hapus Child Mene');
                }
            }
            if ($error === 0) {
                DB::commit();
                $message = "Berhasil Edit Master Data";
                $status = 200;
            }
        } catch (\Exception $e) {
            DB::rollback();
            $status = 500;
            $message = $e->getMessage();
        }

        return response()->json([
            'message'=> $message
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
        $data = Menu::findOrFail($id);
        if ($data->status_child) {
            $data->child_menu()->delete();
        }
        if($data->delete()){
            $status = 200;
            $message = "Berhasil hapus menu";
        }else{
            $status = 500;
            $message = "Gagal hapus menu";

        }
        return response()->json([
            'message' => $message
        ],$status);
    }
}
