<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\ProductsImage;
use App\Coupon;
use App\Banner;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\Review;
use App\popular_products;
use App\Wishlist;
use DB;

class ProductsController extends Controller
{
	public function addProduct(Request $request){

		if($request->isMethod('post')){
			$data = $request->all();
			//echo "<pre>"; print_r($data); die;

			$product = new Product;
            $product->category_id = $data['category_id'];
            $product->product_brand = $data['product_brand'];
			$product->product_name = $data['product_name'];
			$product->product_code = $data['product_code'];
			$product->product_color = $data['product_color'];
			if(!empty($data['description'])){
				$product->description = $data['description'];
			}else{
				$product->description = '';	
			}
            if(!empty($data['care'])){
                $product->care = $data['care'];
            }else{
                $product->care = ''; 
            }
            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }
            if(empty($data['new_arrival'])){
                $new_arrival='0';
            }else{
                $new_arrival='1';
            }
            if(empty($data['feature_item'])){
                $feature_item='0';
            }else{
                $feature_item='1';
            }
			$product->price = $data['price'];

			// Upload Image
            if($request->hasFile('image')){
            	$image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/product/large'.'/'.$fileName;
                    $medium_image_path = 'images/backend_images/product/medium'.'/'.$fileName;  
                    $small_image_path = 'images/backend_images/product/small'.'/'.$fileName;  

	                Image::make($image_tmp)->save($large_image_path);
 					Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
     				Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

     				$product->image = $fileName; 

                }
            }

            //Upload Video
            if($request->hasFile('video')){
                $video_tmp = Input::file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'videos/';
                $video_tmp->move($video_path,$video_name);
                $product->video = $video_name;
            }

            $product->status = $status;
            $product->new_arrival = $new_arrival;
            $product->feature_item = $feature_item;
			$product->save();
			return redirect()->back()->with('flash_message_success', 'Product has been added successfully');
		}

		$categories = Category::where(['parent_id' => 0])->get();

		$categories_drop_down = "<option value='' selected disabled>Select</option>";
		foreach($categories as $cat){
			$categories_drop_down .= "<option value='".$cat->id."'>".$cat->name."</option>";
			$sub_categories = Category::where(['parent_id' => $cat->id])->get();
			foreach($sub_categories as $sub_cat){
				$categories_drop_down .= "<option value='".$sub_cat->id."'>&nbsp;&nbsp;--&nbsp;".$sub_cat->name."</option>";	
			}	
		}

		//echo "<pre>"; print_r($categories_drop_down); die;

		return view('admin.products.add_product')->with(compact('categories_drop_down'));
	}  

	public function editProduct(Request $request,$id=null){

		if($request->isMethod('post')){
			$data = $request->all();
			//echo "<pre>"; print_r($data); die;

            if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }

            if(empty($data['new_arrival'])){
                $new_arrival='0';
            }else{
                $new_arrival='1';
            }

            if(empty($data['feature_item'])){
                $feature_item='0';
            }else{
                $feature_item='1';
            }

			// Upload Image
            if($request->hasFile('image')){
            	$image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/product/large'.'/'.$fileName;
                    $medium_image_path = 'images/backend_images/product/medium'.'/'.$fileName;  
                    $small_image_path = 'images/backend_images/product/small'.'/'.$fileName;  

	                Image::make($image_tmp)->save($large_image_path);
 					Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
     				Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                }
            }else if(!empty($data['current_image'])){
            	$fileName = $data['current_image'];
            }else{
            	$fileName = '';
            }


               //Upload Video
               if($request->hasFile('video')){
                $video_tmp = Input::file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'videos/';
                $video_tmp->move($video_path,$video_name);
                $videoName = $video_name;
            }
        else if(!empty($data['current_video'])){
            $videoName = $data['current_video'];
        }else{
            $videoName = '';
        }

            if(empty($data['description'])){
            	$data['description'] = '';
            }

            if(empty($data['care'])){
                $data['care'] = '';
            }

			Product::where(['id'=>$id])->update(['new_arrival'=>$new_arrival,'feature_item'=>$feature_item,'status'=>$status,'category_id'=>$data['category_id'],'product_brand'=>$data['product_brand'],'product_name'=>$data['product_name'],
				'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'care'=>$data['care'],'price'=>$data['price'],'image'=>$fileName,'video'=>$videoName]);
		
			return redirect()->back()->with('flash_message_success', 'Product has been edited successfully');
		}

		// Get Product Details start //
		$productDetails = Product::where(['id'=>$id])->first();
		// Get Product Details End //

		// Categories drop down start //
		$categories = Category::where(['parent_id' => 0])->get();

		$categories_drop_down = "<option value='' disabled>Select</option>";
		foreach($categories as $cat){
			if($cat->id==$productDetails->category_id){
				$selected = "selected";
			}else{
				$selected = "";
			}
			$categories_drop_down .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
			$sub_categories = Category::where(['parent_id' => $cat->id])->get();
			foreach($sub_categories as $sub_cat){
				if($sub_cat->id==$productDetails->category_id){
					$selected = "selected";
				}else{
					$selected = "";
				}
				$categories_drop_down .= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;&nbsp;--&nbsp;".$sub_cat->name."</option>";	
			}	
		}
		// Categories drop down end //

		return view('admin.products.edit_product')->with(compact('productDetails','categories_drop_down'));
	} 

	public function deleteProductImage($id=null){

		// Get Product Image
		$productImage = Product::where('id',$id)->first();

		// Get Product Image Paths
		$large_image_path = 'images/backend_images/product/large/';
		$medium_image_path = 'images/backend_images/product/medium/';
		$small_image_path = 'images/backend_images/product/small/';

		// Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Delete Medium Image if not exists in Folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        // Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

        // Delete Image from Products table
        Product::where(['id'=>$id])->update(['image'=>'']);

        return redirect()->back()->with('flash_message_success', 'Product image has been deleted successfully');

    }

 
    public function deleteProductVideo($id=null){
        // Get Product Video
        $productVideo = Product::where('id',$id)->first();
        // Get Product Video path
        $video_path = 'videos/';
        // Delete Video if  exists in folder
         if(file_exists($video_path.$productVideo->video)){
            unlink($video_path.$productVideo->video);
        }
        // Delete Video from Products table
        Product::where(['id'=>$id])->update(['video'=>'']);

        return redirect()->back()->with('flash_message_success', 'Product video has been deleted successfully');
    }



    public function deleteProductAltImage($id=null){

        // Get Product Image
        $productImage = ProductsImage::where('id',$id)->first();

        // Get Product Image Paths
        $large_image_path = 'images/backend_images/product/large/';
        $medium_image_path = 'images/backend_images/product/medium/';
        $small_image_path = 'images/backend_images/product/small/';

        // Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$productImage->image)){
            unlink($large_image_path.$productImage->image);
        }

        // Delete Medium Image if not exists in Folder
        if(file_exists($medium_image_path.$productImage->image)){
            unlink($medium_image_path.$productImage->image);
        }

        // Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$productImage->image)){
            unlink($small_image_path.$productImage->image);
        }

        // Delete Image from Products Images table
        ProductsImage::where(['id'=>$id])->delete();

        return redirect()->back()->with('flash_message_success', 'Product alternate mage has been deleted successfully');
    }

	public function viewProducts(Request $request){
		$products = Product::get();
		foreach($products as $key => $val){
			$category_name = Category::where(['id' => $val->category_id])->first();
			$products[$key]->category_name = $category_name->name;
		}
		$products = json_decode(json_encode($products));
		//echo "<pre>"; print_r($products); die;
		return view('admin.products.view_products')->with(compact('products'));
	}

	public function deleteProduct($id = null){
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Product has been deleted successfully');
    }

    public function deleteAttribute($id = null){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Product Attribute has been deleted successfully');
    }

    public function addAttributes(Request $request, $id=null){
        $productDetails = Product::with('attributes')->where(['id' => $id])->first();
        $productDetails = json_decode(json_encode($productDetails));
        /*echo "<pre>"; print_r($productDetails); die;*/
        $categoryDetails = Category::where(['id'=>$productDetails->category_id])->first();
        $category_name = $categoryDetails->name;
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach($data['sku'] as $key => $val){
                if(!empty($val)){
                    $attrCountSKU = ProductsAttribute::where(['sku'=>$val])->count();
                    if($attrCountSKU>0){
                        return redirect('admin/add-attributes/'.$id)->with('flash_message_error', 'SKU already exists. Please add another SKU.');    
                    }
                    $attrCountSizes = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes>0){
                        return redirect('admin/add-attributes/'.$id)->with('flash_message_error', 'Attribute already exists. Please add another Attribute.');    
                    }
                    $attr = new ProductsAttribute;
                    $attr->product_id = $id;
                    $attr->sku = $val;
                    $attr->size = $data['size'][$key];
                    $attr->price = $data['price'][$key];
                    $attr->stock = $data['stock'][$key];
                    $attr->save();
                }
            }
            return redirect('admin/add-attributes/'.$id)->with('flash_message_success', 'Product Attributes has been added successfully');
        }
        $title = "Add Attributes";
        return view('admin.products.add_attributes')->with(compact('title','productDetails','category_name'));
    }

    public function editAttributes(Request $request, $id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            foreach($data['idAttr'] as $key=> $attr){
                if(!empty($attr)){
                    ProductsAttribute::where(['id' => $data['idAttr'][$key]])->update(['price' => $data['price'][$key], 'stock' => $data['stock'][$key]]);
                }
            }
            return redirect('admin/add-attributes/'.$id)->with('flash_message_success', 'Product Attributes has been updated successfully');
        }
    }

    public function addImages(Request $request, $id=null){
        $productDetails = Product::where(['id' => $id])->first();

        $categoryDetails = Category::where(['id'=>$productDetails->category_id])->first();
        $category_name = $categoryDetails->name;

        if($request->isMethod('post')){
            $data = $request->all();
            if ($request->hasFile('image')) {
                $files = $request->file('image');
                foreach($files as $file){
                    // Upload Images after Resize
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/product/large'.'/'.$fileName;
                    $medium_image_path = 'images/backend_images/product/medium'.'/'.$fileName;  
                    $small_image_path = 'images/backend_images/product/small'.'/'.$fileName;  
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600, 600)->save($medium_image_path);
                    Image::make($file)->resize(300, 300)->save($small_image_path);
                    $image->image = $fileName;  
                    $image->product_id = $data['product_id'];
                    $image->save();
                }   
            }

            return redirect('admin/add-images/'.$id)->with('flash_message_success', 'Product Images has been added successfully');

        }

        $productImages = ProductsImage::where(['product_id' => $id])->orderBy('id','DESC')->get();

        $title = "Add Images";
        return view('admin.products.add_images')->with(compact('title','productDetails','category_name','productImages'));
    }

    public function products($url=null){
    	// Show 404 Page if Category does not exists
        $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
    	if($categoryCount==0){
    		abort(404);
    	}
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();
        $banners = Banner::where('status','1')->get();

    	$categoryDetails = Category::where(['url'=>$url])->first();
    	if($categoryDetails->parent_id==0){
    		$subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
    		$subCategories = json_decode(json_encode($subCategories));
    		foreach($subCategories as $subcat){
    			$cat_ids[] = $subcat->id;
            }
            $productsAll = Product::whereIn('products.category_id', $cat_ids)->where('products.status','1')->orderBy('products.created_at','DESC');
            $breadcrumb = "<a href='/'>Home</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";
    	}else{
            $productsAll = Product::where(['products.category_id'=>$categoryDetails->id])->where('products.status','1')->orderBy('products.created_at','DESC');	
            $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
            $breadcrumb = "<a href='/'>Home</a> / <a href='".$mainCategory->url."'>".$mainCategory->name."</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";
    	}
        
        if(!empty($_GET['color'])){
            $colorArray = explode('-',$_GET['color']);
            $productsAll = $productsAll->whereIn('products.product_color',$colorArray);
        }

        if(!empty($_GET['brand'])){
            $brandArray = explode('-',$_GET['brand']);
            $productsAll = $productsAll->whereIn('products.product_brand',$brandArray);
        }

        if(!empty($_GET['size'])){
            $sizeArray = explode('-',$_GET['size']);
            $productsAll = $productsAll->join('products_attributes','products_attributes.product_id','=','products.id')
            ->select('products.*','products_attributes.product_id','products_attributes.size')
            ->whereIn('products_attributes.size',$sizeArray);
        }
  
      
    	
        $productsAll = $productsAll->paginate(6);


        $brandArray = Product::select('product_brand')->where('status',1)->groupBy('product_brand')->get();
        $brandArray = array_flatten(json_decode(json_encode($brandArray),true));
        
        $colorArray = Product::select('product_color')->where('status',1)->groupBy('product_color')->get();
        $colorArray = array_flatten(json_decode(json_encode($colorArray),true));

        $sizeArray = ProductsAttribute::select('size')->groupBy('size')->get();
        $sizeArray = array_flatten(json_decode(json_encode($sizeArray),true));
        /*echo "<pre>"; print_r($colorArray); die;*/

        $meta_title =  $categoryDetails->meta_title ;
        $meta_description =  $categoryDetails->meta_description;
        $meta_keywords =  $categoryDetails->meta_keywords;

    	return view('products.listing')->with(compact('categories','productsAll','categoryDetails','banners','url','brandArray','colorArray','sizeArray','breadcrumb','meta_title','meta_description','meta_keywords'));

    }

    public function filter(Request $request){
        $data = $request->all(); 
        /*echo "<pre>"; print_r($data); die;*/

        $brandUrl="";
        if(!empty($data['brandFilter'])){
            foreach($data['brandFilter'] as $brand){
                if(empty($brandUrl)){
                    $brandUrl = "&brand=".$brand;
                }else{
                    $brandUrl .="-".$brand;
                }
            }
        }
    
        $colorUrl="";
        if(!empty($data['colorFilter'])){
            foreach($data['colorFilter'] as $color){
                if(empty($colorUrl)){
                    $colorUrl = "&color=".$color;
                }else{
                    $colorUrl .="-".$color;
                }
            }
        }

        $sizeUrl="";
        if(!empty($data['sizeFilter'])){
            foreach($data['sizeFilter'] as $size){
                if(empty($sizeUrl)){
                    $sizeUrl = "&size=".$size;
                }else{
                    $sizeUrl .="-".$size;
                }
            }
        }

        
     


        $finalUrl = "products/".$data['url']."?".$brandUrl.$colorUrl.$sizeUrl;
        return redirect::to($finalUrl);
    }


    public function searchProducts(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $categories = Category::with('categories')->where(['parent_id' => 0])->get();
            $banners = Banner::where('status','1')->get();
            $search_product = $data['product'];
            /*$productsAll = Product::where('product_name','like','%'.$search_product.'%')->orwhere('product_code',$search_product)->where('status',1)->paginate(6);*/
            $productsAll = Product::where(function($query) use($search_product){
                $query->where('product_name','like','%'.$search_product.'%')
                ->orwhere('product_code','like','%'.$search_product.'%')
                ->orwhere('product_brand','like','%'.$search_product.'%');     
            })->where('status',1)->get();
            return view('products.listing')->with(compact('categories','productsAll','search_product','banners')); 
        }
     
    }


    public function product($id = null){

        //Popular products
        if(Auth::check()){
        $popular_products = new popular_products;
        $popular_products->uid = Auth::user()->id;
        $popular_products->pro_id = $id;
        $popular_products->save();
        }

        // Show 404 Page if Product is disabled
        $productCount = Product::where(['id'=>$id,'status'=>1])->count();
        if($productCount==0){
            abort(404);
        }
        // Get Product Details
       $productDetails = Product::where('id',$id)->first();
       $relatedProducts = Product::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id,'feature_item'=>0])->get();
       /*$relatedProducts = json_decode(json_encode($relatedProducts));*/
       // Get categories and sub categories
       $categories = Category::with('categories')->where(['parent_id' => 0])->get();
       // Get Product Alternate Images
       $productAltImages = ProductsImage::where('product_id',$id)->get();

       $categoryDetails = Category::where('id',$productDetails->category_id)->first();
       if($categoryDetails->parent_id==0){
           $breadcrumb = "<a href='/'>Home</a> / <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a> / ".$productDetails->product_name;
       }else{
           $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();
           $breadcrumb = "<a href='/'>Home</a> / <a href='/products/".$mainCategory->url."'>".$mainCategory->name."</a> / <a href='/products/".$categoryDetails->url."'>".$categoryDetails->name."</a> / ".$productDetails->product_name;
       }

        //Check if product is in stock
       $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock'); 

       $reviews = Review::where(['product_id'=>$productDetails->id])->get();

       $meta_title = $productDetails->product_name;
       $meta_description = "$productDetails->product_name for $mainCategory->name";
       $meta_keywords =  "$mainCategory->name, $categoryDetails->name, $productDetails->product_name";

       return view('products.detail')->with(compact('productDetails','categories','productAltImages','relatedProducts','total_stock','reviews','breadcrumb','meta_title','meta_description','meta_keywords'));
      
    }


    public function getProductPrice(Request $request){
        $data = $request->all(); 
        $proArr = explode("-",$data['idSize']);
        $proAttr = ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        echo  $proAttr->price; 
        echo "#";
        echo  $proAttr->stock; 
    }


    public function addtocart(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/

        //Check Product Stock is available or not.
        $product_size = explode("-",$data['size']);
        $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$product_size[1]])->first();
        if($getProductStock->stock < $data['quantity']){
            return redirect()->back()->with('flash_message_error','Required quantity is not available!');
        }


        if(empty(Auth::user()->email)){
            $data['user_email'] = '';    
        }else{
            $data['user_email'] = Auth::user()->email;
        }
        $session_id = Session::get('session_id');
        if(!isset($session_id)){
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }

        $sizeIDArr = explode('-',$data['size']);
        $product_size = $sizeIDArr[1];

        if(empty(Auth::check())){
            $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],'product_color' => $data['product_color'],'size' => $product_size,'session_id' => $session_id])->count();
            if($countProducts>0){
                return redirect()->back()->with('flash_message_error','Product already exist in Cart!');
            }
        }
        else{
            $countProducts = DB::table('cart')->where(['product_id' => $data['product_id'],'product_color' => $data['product_color'],'size' => $product_size,'user_email' => $data['user_email']])->count();
            if($countProducts>0){
                return redirect()->back()->with('flash_message_error','Product already exist in Cart!');
            }
        }
       
        $getSKU = ProductsAttribute::select('sku')->where(['product_id' => $data['product_id'], 'size' => $product_size])->first();
                
        DB::table('cart')
        ->insert(['product_id' => $data['product_id'],'product_name' => $data['product_name'],
            'product_code' => $getSKU['sku'],'product_color' => $data['product_color'],
            'price' => $data['price'],'size' => $product_size,'quantity' => $data['quantity'],'user_email' => $data['user_email'],'session_id' => $session_id]);
        return redirect('cart')->with('flash_message_success','Product has been added in Cart!');
    }



    public function cart(){  
   
    if(Auth::check()){
        $user_email = Auth::user()->email;
        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();  
    }else{
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();   
    }
   
    foreach($userCart as $key => $product){
        $productDetails = Product::where('id',$product->product_id)->first();
        $userCart[$key]->image = $productDetails->image;    
    }

    $meta_title = "Cart - E-shop Sample Website";
    $meta_description = "Shopping cart";
    $meta_keywords =  "item, price, quantity, total";

     return view('products.cart')->with(compact('userCart','meta_title','meta_description','meta_keywords'));
    }

    public function deleteCartProduct($id = null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_message_success','Product has been deleted from cart!');
    }
 
    public function updateCartQuantity($id=null, $quantity=null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        $getAttributeStock = ProductsAttribute::where('sku',$getCartDetails->product_code)->first();
        $updated_quantity = $getCartDetails->quantity+$quantity;
        if($getAttributeStock->stock >= $updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart')->with('flash_message_success','Product quantity has been updated successfully!');
        }else{
            return redirect('cart')->with('flash_message_error','Product quantity is not available!');
        }   
    }


    public function applyCoupon(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if( $couponCount == 0 ){
            return redirect()->back()->with('flash_message_error','This c   oupon does not exist!');
        }else{
            // other checks like Active/Inactive and Expiry date
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();
            //If coupon is Inactive
            if( $couponDetails->status == 0 ){
                return redirect()->back()->with('flash_message_error','This coupon is not active!');
            }
         //If coupon is Expired
         $expiry_date = $couponDetails->expiry_date;
         $current_date = date('Y-m-d');
        if($expiry_date < $current_date){
            return redirect()->back()->with('flash_message_error','This coupon is expired!');
        }

        //Coupon is Valid for discount

        //Get Cart Total Amount
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email' => $user_email])->get();     
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();    
        }
        $total_amount=0;
        foreach($userCart as $item){
            $total_amount = $total_amount + ($item->price * $item->quantity);
        }
        //Check if amount_type is Fixed or Percentage
        if($couponDetails->amount_type=="Fixed"){
            $couponAmount = $couponDetails->amount;
        }else{  
            $couponAmount = $total_amount * ($couponDetails->amount/100);
        }
        //Add Coupon Code & Amount in Session
        Session::put('CouponAmount',$couponAmount);
        Session::put('CouponCode',$data['coupon_code']);

        return redirect()->back()->with('flash_message_success','Coupon code successfully applied!');
        }
    }


    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        //Check if Shipping Address exists
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array(); 
        if($shippingCount>0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }
        //Update cart table with user email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')){
            $data = $request->all();
           /* echo "<pre>"; print_r($data); die; */
           //Return to checkout page if any of the field is empty
           if(empty($data['billing_name']) || empty($data['billing_last_name']) || empty($data['billing_address']) ||
           empty($data['billing_city']) || empty($data['billing_state']) ||
           empty($data['billing_country']) || empty($data['billing_pincode']) ||
           empty($data['billing_mobile']) || empty($data['shipping_name']) ||
           empty($data['shipping_address']) || empty($data['shipping_city']) || 
           empty($data['shipping_state']) || empty($data['shipping_country']) ||
           empty($data['shipping_pincode']) || empty($data['shipping_mobile']) ){
            return redirect()->back()->with('flash_message_error','Please fill all fields to continue!');
           }
           //Update User details
           User::where('id',$user_id)->update(['name'=>$data['billing_name'],'last_name'=>$data['billing_last_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],
           'state'=>$data['billing_state'],'country'=>$data['billing_country'],'pincode'=>$data['billing_pincode'],'mobile'=>$data['billing_mobile']]);
           
           if($shippingCount>0){
            //Update Shipping Address
            DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'last_name'=>$data['shipping_last_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],
            'state'=>$data['shipping_state'],'country'=>$data['shipping_country'],'pincode'=>$data['shipping_pincode'],'mobile'=>$data['shipping_mobile']]);
           }else{
            //Add new shipping address
            $shipping = new DeliveryAddress;
            $shipping->user_id = $user_id;
            $shipping->user_email = $user_email;
            $shipping->name = $data['shipping_name'];
            $shipping->last_name = $data['shipping_last_name'];
            $shipping->address = $data['shipping_address'];
            $shipping->city = $data['shipping_city'];
            $shipping->state = $data['shipping_state'];
            $shipping->country = $data['shipping_country'];
            $shipping->pincode = $data['shipping_pincode'];
            $shipping->mobile = $data['shipping_mobile'];
            $shipping->save();
           }
           return redirect('/order-review');
        }
        $meta_title = "Checkout - E-shop Sample Website";
        return view('products.checkout')->with(compact('userDetails','countries','shippingDetails','meta_title'));
    }


    public function orderReview(){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));
        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();   
        foreach($userCart as $key => $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;    
        }
        $meta_title = "Order Review - E-shop Sample Website";
        return view('products.order_review')->with(compact('userDetails','shippingDetails','userCart','meta_title'));
    }

    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            //Prevent out of stock products from ordering
            $userCart = DB::table('cart')->where('user_email',$user_email)->get();
            foreach($userCart as $cart){
                $product_stock = Product::getProductStock($cart->product_id,$cart->size);
                if($product_stock==0){
                    return redirect('/cart')->with('flash_message_error','Product is sold out! Please choose another product.');
                }
                if($cart->quantity > $product_stock){
                    return redirect('/cart')->with('flash_message_error','Reduce product stock and try again.');
                }
            }


            //Get Shipping Address of User
            $shippingDetails = DeliveryAddress::where(['user_email' => $user_email])->first();

            if(empty(Session::get('CouponCode'))){
                $coupon_code = ''; 
             }else{
                $coupon_code = Session::get('CouponCode'); 
             }
             if(empty(Session::get('CouponAmount'))){
                $coupon_amount = '0'; 
             }else{
                $coupon_amount = Session::get('CouponAmount'); 
             }

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->pincode = $shippingDetails->pincode;
            $order->country = $shippingDetails->country;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
             foreach( $cartProducts as $pro){
                 $cartPro = new OrdersProduct;
                 $cartPro->order_id = $order_id;
                 $cartPro->user_id = $user_id;
                 $cartPro->product_id = $pro->product_id;
                 $cartPro->product_code = $pro->product_code;
                 $cartPro->product_name = $pro->product_name;
                 $cartPro->product_size = $pro->size;
                 $cartPro->product_color = $pro->product_color;
                 $cartPro->product_price = $pro->price;
                 $cartPro->product_qty = $pro->quantity;
                 $cartPro->save();

                 // Reduce product stock
                 $getProductStock = ProductsAttribute::where('sku',$pro->product_code)->first();
                 //echo "Original Stock: ".$getProductStock->stock;
                 //echo "Stock to reduce: ".$pro->quantity;
                 $newStock = $getProductStock->stock - $pro->quantity;
                 if($newStock < 0){
                    $newStock = 0;
                 }
                 ProductsAttribute::where('sku',$pro->product_code)->update(['stock'=>$newStock]);
             }

             Session::put('order_id',$order_id);
             Session::put('grand_total',$data['grand_total']);
             
             if($data['payment_method']=="COD"){
                 // COD-redirect user to thanks page after saving order
                 return redirect('/thanks');
             }else{
                return redirect('/paypal');
             }
            
        }
    }

    public function thanks(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.thanks');
    }

    public function paypal(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.paypal');
    }

    public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->get();
        /*$orders = json_decode(json_encode($orders));
        echo "<pre>"; print_r($orders); die;*/
        $meta_title = "Orders - E-shop Sample Website";
        return view('orders.users_orders')->with(compact('orders','meta_title'));
    }

    public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        /*echo "<pre>"; print_r($orderDetails); die;*/
        $meta_title = "Order #$orderDetails->id - E-shop Sample Website";
        return view('orders.user_order_details')->with(compact('orderDetails','meta_title'));
    }

    public function viewOrders(){
        $orders = Order::with('orders')->get();
        $orders = json_decode(json_encode($orders));
        /*echo "<pre>"; print_r($orders); die;*/
        return view('admin.orders.view_orders')->with(compact('orders'));
    }

    public function viewOrderDetails($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        /*echo "<pre>"; print_r($orderDetails); die;*/
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
    }

    public function viewOrderInvoice($order_id){
       
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        /*echo "<pre>"; print_r($orderDetails); die;*/
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_invoice')->with(compact('orderDetails','userDetails'));
    }


    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
           Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
           return redirect()->back()->with('flash_message_success','Order Status has been updated successfully!');
        }
    }


   public function Wishlist($id,Request $request){
       $wishlist = new Wishlist;
       $wishlist->user_id = Auth::user()->id;
       $wishlist->pro_id = $id;
       $wishlist->save();
     
       return back()->with('flash_message_success','Product added to your wishlist successfully!');
   }
 

   public function viewWishlist(Request $request){
        $user_id = Auth::user()->id;
        $wishlist = Wishlist::where('user_id',$user_id)->join('products','products.id','=','wishlist.pro_id')->paginate(6);   
        return view('products.wishlist')->with(compact('wishlist'));
   }


   public function removeWishlist($id){
        Wishlist::where('pro_id', '=', $id)->delete();
    return back()->with('flash_message_success','Product removed from your wishlist!');
   }
}
