<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\MasterDataDetail;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $user = User::with('role')->where('name','LIKE',"%{$request->keyword}%")
                    ->orWhere('email','LIKE',"%{$request->keyword}%")
                    ->orWhereHas('role',function($q) use ($request){
                        $q->where('description','LIKE',"%{$request->keyword}%");
                    })
                    ->paginate(15);
        }else{
            $user = User::with('role')
                    ->paginate(15);
        }

        return $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = MasterDataDetail::where('id_master_data',5)->get();
        return response()->json([
            'roles' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
        ],[
            '*.unique' => 'Email Sudah Tersedia'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        $user = new User;
        $user->name = $request->name;
        $user->password = \Hash::make($request->password);
        $user->email = $request->email;
        $user->id_role = $request->id_role;
        $user->save();

        return response()->json([
            'message' => 'Berhasil Tambah User'
        ],200);
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
        $role = MasterDataDetail::where('id_master_data',5)->get();
        $user = User::findOrFail($id);
        return response()->json([
            'user' =>$user,
            'roles' => $role
        ]);
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
        $validator = \Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'.$id,
        ],[
            '*.unique' => 'Email Sudah Tersedia'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }
        $user = User::findOrFail($id);
        $user->name = $request->name;
        if ($request->password) {
            $user->password = \Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->id_role = $request->id_role;
        $user->save();

        return response()->json([
            'message' => 'Berhasil Edit User'
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->id_role !== 23) {
            $user->delete();
            return response()->json([
                'message' => 'Berhasil Hapus User'
            ],200);
        }else{
            return response()->json([
                'message' => 'Tidak bisa menghapus User Developer'
            ],400);
        }
    }
}
