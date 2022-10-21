<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.categories.index')->with('categories',Category::paginate(5));
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
            'name' => 'required|unique:categories',
        ]);

        // Insert Data to Table
        // $category = new Category;
        // $category->name = $request->name;
        // $category->save();
        // return to_route('admin.categories.index');
        
        Category::create([
            'name' => $request->name,
        ]);
        return to_route('admin.categories.index')->with('success', 'สร้างประเภทหมวดหมู่เรียบร้อย');
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
        $category = Category::find($id);
        
        // return view('admin.categories.edit', ['category'=>$category]);
        return view('admin.categories.edit', compact('category'));
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
            'name' => 'required|unique:categories',
        ]);
        // $category = Category::find($id);
        // // $category->name = $request->name;
        // // $category->save();
        // return to_route('admin.categories.index');

        $category = Category::find($id)->update([
            'name' => $request->name
        ]);
        return to_route('admin.categories.index')->with('success', 'อัพเดตข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $category = Category::find($id);
        if($category->products->count()>0){
            return redirect()->back()->with('warning', 'ไม่สามารถลบได้');
        }

        Category::destroy($id);
       
        return to_route('admin.categories.index')->with('danger', 'ลบข้อมูลเรียบร้อย');
    }
}
