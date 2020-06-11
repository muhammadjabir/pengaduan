<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\MasterDataDetail;
use App\Models\Menu;
use App\Models\RoleMenu;
use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function __construct()
    {

    }
    public function index(){
        $data = MasterDataDetail::where('id_master_data',5)->paginate(15);
        return $data;
    }

    public function store(Request $request){
        $data = RoleMenu::updateOrCreate(
                ['id_role' => $request->id_role],
                ['parent_menu' =>json_encode(json_decode($request->parent_menu)) ,
                'child_menu' => json_encode(json_decode($request->child_menu))]
                );

        if ($data) {
            $status = 200;
            $message = 'Berhasil Simpan Data';
        }else{
            $status = 500;
            $message = 'Gagal Simpan Data';
        }

        return response()->json([
            'message' => $message
        ],$status);
    }

    public function edit($id){
        $role = MasterDataDetail::with('role_menu')->findOrFail($id);
        $menu = Menu::with('child_menu')->get();
        return response()->json([
            'role' => $role->description,
            'menu' => $menu,
            'role_menu' => $role->role_menu,
        ]);
    }
}
