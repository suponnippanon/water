<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('verifyCategory')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::all();
        return view('admin.products.index')->with('products',Product::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
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
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:5000'
        ]);
        
        // การเข้ารหัสรูปภาพ
        $image = $request->file('image');
         // Generate ชื่อภาพ
        $name_gen = hexdec(uniqid());
          // ดึงนามสกุลไฟล์ภาพ
        $img_ext = strtolower($image->getClientOriginalExtension());

        $img_name = $name_gen.'.'.$img_ext;

        // อัพโหลดและบันทึกข้อมูล
        $upload_location = 'storage/product/';
        $full_path = $upload_location.$img_name;

        Product::insert([
            'name'=>$request->name,
            'description'=>$request->description,
            'category_id'=>$request->category,
            'price'=>$request->price,
            'image'=>$full_path,
            'created_at'=>Carbon::now(),
        ]);
        // อัพโหลดรูปภาพ
        $image->move($upload_location,$img_name);
      
        return to_route('admin.products.index')->with('success', 'สร้างสินค้าเรียบร้อยแล้ว');;
       
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
    public function edit(Product $product)
    {
        // $product = Product::find($id);
        // $categories = Category::all();
        // return view('admin.products.edit', compact('product', 'categories'));
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
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
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            // 'image' => 'required|file|image|mimes:jpeg,png,jpg|max:5000'
            
        ]);

        $image = $request->file('image');

         // อัพเดตภาพและชื่อ
         if($image){
            // Generate ชื่อภาพ
            $name_gen = hexdec(uniqid());
            
            // ดึงนามสกุลไฟล์ภาพ
            $img_ext = strtolower($image->getClientOriginalExtension());
        
            $img_name = $name_gen.'.'.$img_ext;
        
            // อัพโหลดและอัพเดตข้อมูล
            $upload_location = 'storage/product/';
            $full_path = $upload_location.$img_name;
   
            // อัพเดตข้อมูล
            Product::find($id)->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'category_id'=>$request->category,
                'price'=>$request->price,
                'image'=>$full_path,
                'created_at'=>Carbon::now(),

            ]);

            // ลบภาพเก่าและอัพภาพใหม่แทนที่
            $old_image = $request->old_image;
            unlink($old_image);
     
            // แทนที่ภาพใหม่
            $image->move($upload_location,$img_name);
            return to_route('admin.products.index')->with('success',"อัพเดตภาพเรียบร้อย");
            }else{
            // อัพเดตชื่ออย่างเดียว
            Product::find($id)->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'category_id'=>$request->category,
                'price'=>$request->price,
                'created_at'=>Carbon::now(),
            ]);
            return to_route('admin.products.index')->with('success',"อัพเดตเรียบร้อย");;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ลบภาพ
        $img = Product::find($id)->image;
        unlink($img);
       
    //    // ลบข้อมูลจากฐานข้อมูล
    //    $delete = Product::find($id)->delete();
        Product::destroy($id);
        return to_route('admin.products.index')->with('danger',"ลบข้อมูลเรียบร้อย");
    }
}
