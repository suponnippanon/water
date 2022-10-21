<?php

namespace App\Http\Controllers\Admin;

use App\Models\Village;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.villages.index')->with('villages',Village::paginate(5));
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
        $request->validate([
            'name' => 'required|unique:villages',
        ]);
        
        Village::create([
            'name' => $request->name,
        ]);
        return to_route('admin.villages.index')->with('success', 'สร้างประเภทหมวดหมู่เรียบร้อย');
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
    public function edit(Request $request, $id)
    {
        $village = Village::find($id);
        
        return view('admin.villages.edit', compact('village'));
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
        $request->validate([
            'name' => 'required|unique:villages',
        ]);


        $village = Village::find($id)->update([
            'name' => $request->name
        ]);
        return to_route('admin.villages.index')->with('success', 'อัพเดตข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $village = Village::find($id);
        Village::destroy($id);
       
        return to_route('admin.villages.index')->with('danger', 'ลบข้อมูลเรียบร้อย');
    }
}
