<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    
    public function product_save(Request $req){

        
        $validated = Validator::make($req->all(), [
            'product_name' => 'required',
            'unit_type' => 'required',
            'product_category' => 'required',
            'product_images' => 'required',
            'product_price' => 'required|numeric',
            'discount_percentage' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'discount_range_dates' => 'required',
            'tax_percentage' => 'required|numeric',
            'tax_amount' => 'required|numeric',

        ]);
        if ($validated->fails()) {
            $error_message = $validated->errors()->all();

            return response()->json($error_message);
        }


    //   $images_list=$req->product_images;
    $input=$req->all();
    $images=array();
    if($image=$req->file('product_images')){
       
        foreach($image as $img){
            $timestamp = now()->timestamp;
            $uniqueId = uniqid();
            
            $name=$img->getClientOriginalName();
            $image_name=$timestamp.$uniqueId.$name;
            $img->move('image',$image_name);
            $images[]=$image_name;
        }
    }
       
$input=[
    'product_name'=>$req->product_name,
    'unit_type'=>$req->unit_type,
    'product_category'=>$req->product_category,
    'product_images'=>json_encode($images),
    'product_price'=>$req->product_price,
    'discount_percentage'=>$req->discount_percentage,
    'discount_amount'=>$req->discount_amount,
    'discount_range_dates'=>$req->discount_range_dates,
    'tax_percentage'=>$req->tax_percentage,
    'tax_amount'=>$req->tax_amount,

];

$product =DB::table('product')->insertGetId($input);
if($product){
return response()->json([
    'success'=>true,
    'message'=>'Product added successfully'
]);
}else{
return response()->json([
    'success'=>false,
    'message'=>'Product added falied',
]);

}

    }



public function show_value(Request $req){
    $value=DB::table('product')->get();
    
    return response()->json($value);

}


public function product_edit(Request $req){
$val=Auth::user()->name;
    $validated = Validator::make($req->all(), [
        'product_name' => 'required',
        'unit_type' => 'required',
        'product_category' => 'required',
        // 'product_images' => 'required',
        'product_price' => 'required|numeric',
        'discount_percentage' => 'required|numeric',
        'discount_amount' => 'required|numeric',
        'discount_range_dates' => 'required',
        'tax_percentage' => 'required|numeric',
        'tax_amount' => 'required|numeric',

    ]);
    if ($validated->fails()) {
        $error_message = $validated->errors()->all();

        return response()->json($error_message);
    }


//   $images_list=$req->product_images;
$input=$req->all();
$images=array();
if($image=$req->file('product_images')){
   
    foreach($image as $img){
        $timestamp = now()->timestamp;
        $uniqueId = uniqid();
        
        $name=$img->getClientOriginalName();
        $image_name=$timestamp.$uniqueId.$name;
        $img->move('image',$image_name);
        $images[]=$image_name;
    }
}
   
$input=[
'product_name'=>$req->product_name,
'unit_type'=>$req->unit_type,
'product_category'=>$req->product_category,
'product_price'=>$req->product_price,
'discount_percentage'=>$req->discount_percentage,
'discount_amount'=>$req->discount_amount,
'discount_range_dates'=>$req->discount_range_dates,
'tax_percentage'=>$req->tax_percentage,
'tax_amount'=>$req->tax_amount,

];
if(count($images)>0){
    $input['product_images']=json_encode($images);

}

$product =DB::table('product')->where('id',$req->edit_id)->update($input);
// dd($product);
if($product){
return response()->json([
'success'=>true,
'message'=>'Product updated successfully'
]);
}else{
return response()->json([
'success'=>false,
'message'=>'Product updated falied',
]);

}

}


public function product_delete(Request $req){
    $product=DB::table('product')->where('id',$req->delete_id)->delete();
    
    if($product){
        return response()->json([
        'success'=>true,
        'message'=>'Product Deleted successfully'
        ]);
        }else{
        return response()->json([
        'success'=>false,
        'message'=>'Product Deleted falied',
        ]);
        
        }

}



}
