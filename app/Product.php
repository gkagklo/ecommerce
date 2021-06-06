<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use DB;

class Product extends Model
{
    public function attributes(){
    	return $this->hasMany('App\ProductsAttribute','product_id');
    }

    public static function cartCount(){
        if(Auth::check()){
            // We will use Auth when user is logged in
            $user_email = Auth::user()->email;
            $cartCount = DB::table('cart')->where('user_email',$user_email)->sum('quantity');
        }
        else{
            // We will use Session when user is not logged in
            $session_id = Session::get('session_id');
            $cartCount = DB::table('cart')->where('session_id',$session_id)->sum('quantity');
        }
        return $cartCount;
    }

    public static function productCount($cat_id){
        $catCount = Product::where(['category_id'=>$cat_id,'status'=>1])->count();
        return $catCount;
    }

    public static function getProductStock($product_id,$product_size){
        $getProductStock = ProductsAttribute::select('stock')->where(['product_id' => $product_id,'size' => $product_size])->first();
        return $getProductStock->stock;
    }

}
