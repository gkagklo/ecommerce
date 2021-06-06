<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Banner;
use App\Brand;
use App\popular_products;
use DB;


class IndexController extends Controller
{
    public function index(){

	$productsAll = Product::where('status',1)->orderBy('created_at','DESC')->paginate(6);
	$feature_item = Product::where('feature_item','1')->where('status',1)->orderBy('created_at','DESC')->get();
	$onsale_item = Product::where('sale_price','!=','0')->where('status',1)->orderBy('created_at','DESC')->get();
	$new_arrival = Product::where('new_arrival',1)->where('status',1)->orderBy('created_at','DESC')->get();
	$popular_products = DB::table('popular_products')
	->leftJoin('products','popular_products.pro_id','products.id')
	->select('pro_id','product_name','product_brand','price','sale_price','image','products.id',DB::raw('count(*) as count'))	
	->groupBy('pro_id','product_name','product_brand','price','sale_price','image','products.id')
	->orderBy('count','DESC')
	->take(6)
	->get();	
	//$users = json_decode(json_encode($users));
	//echo "<pre>"; print_r($users); die;
	$categories = Category::with('categories')->where(['parent_id'=>0])->get();

	$banners = Banner::where('status','1')->get();

	$meta_title = "E-shop Sample Website";
	$meta_description = "Online shopping site for Men, Women and Kids clothing";
	$meta_keywords = "eshop website, online shopping, men clothing, women clothing, kids clothing";

	return view('index')->with(compact('productsAll','categories','banners','feature_item','meta_title','meta_description','meta_keywords','onsale_item','new_arrival','popular_products'));
	
}
}