<?php

namespace App\Http\Controllers\Kategori;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request) {
            $user = Kategori::where('nama_kategori','LIKE',"%{$request->keyword}%")

                    ->paginate(15);
        }else{
            $user = Kategori::paginate(15);
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

        $request->request->add(['slug' => Str::of($request->nama_kategori)->slug('-')]);
        $validator = \Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'slug'=>'required|unique:kategori,slug',
        ],[
            '*.unique' => 'Kategori Sudah Tersedia'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }

        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->slug = $request->slug;
        $kategori->save();
        return response()->json([
            'message' => 'Berhasil Tambah Kategori'
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
        $user = Kategori::findOrFail($id);
        return response()->json([
            'kategori' =>$user,
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
        $request->request->add(['slug' => Str::of($request->nama_kategori)->slug('-')]);
        $validator = \Validator::make($request->all(), [
            'nama_kategori' => 'required',
            'slug'=>'required|unique:kategori,slug,'.$id ,
        ],[
            '*.unique' => 'Kategori Sudah Tersedia'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ],400);
        }

        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->slug = $request->slug;
        $kategori->save();
        return response()->json([
            'message' => 'Berhasil Tambah Kategori'
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
        //
    }
}
