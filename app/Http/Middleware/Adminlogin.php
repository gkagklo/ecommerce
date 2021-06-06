<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Route;
use App\Admin;

class Adminlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty(Session::has('adminSession'))){
            return redirect('/admin');
        }else{
            //Get Admin/Sub Admin details
            $adminDetails = Admin::where('username',Session::get('adminSession'))->first();
            $adminDetails = json_decode(json_encode($adminDetails),true);
            if($adminDetails['type']=="Admin"){
                $adminDetails['categories_access']=1;
                $adminDetails['products_access']=1;
                $adminDetails['orders_access']=1;
                $adminDetails['users_access']=1;
                $adminDetails['posts_access']=1;
                $adminDetails['banners_access']=1;
                $adminDetails['coupons_access']=1;
                $adminDetails['cmspages_access']=1;
                $adminDetails['admins_access']=1;
            }
            Session::put('adminDetails',$adminDetails);

            //Get current path
             $currentPath = Route::getFacadeRoot()->current()->uri();

            //Access for Categories
            if($currentPath=="admin/view-categories" && Session::get('adminDetails')['categories_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/add-category" && Session::get('adminDetails')['categories_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/edit-category/{id}" && Session::get('adminDetails')['categories_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/delete-category/{id}" && Session::get('adminDetails')['categories_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }

             //Access for Products
             if($currentPath=="admin/view-products" && Session::get('adminDetails')['products_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/add-product" && Session::get('adminDetails')['products_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/edit-product/{id}" && Session::get('adminDetails')['products_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/delete-product/{id}" && Session::get('adminDetails')['products_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/add-attributes/{id}" && Session::get('adminDetails')['products_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/add-images/{id}" && Session::get('adminDetails')['products_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
           

            //Access for Orders
            if($currentPath=="admin/view-orders" && Session::get('adminDetails')['orders_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/view-order/{id}" && Session::get('adminDetails')['orders_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/view-order-invoice/{id}" && Session::get('adminDetails')['orders_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }


            //Access for Users
            if($currentPath=="admin/view-users" && Session::get('adminDetails')['users_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }


            //Access for Posts
            if($currentPath=="admin/view-posts" && Session::get('adminDetails')['posts_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/add-post" && Session::get('adminDetails')['posts_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/edit-post/{id}" && Session::get('adminDetails')['posts_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/delete-post/{id}" && Session::get('adminDetails')['posts_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }

             //Access for Banners
             if($currentPath=="admin/view-banners" && Session::get('adminDetails')['banners_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/add-banner" && Session::get('adminDetails')['banners_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/edit-banner/{id}" && Session::get('adminDetails')['banners_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/delete-banner/{id}" && Session::get('adminDetails')['banners_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }

              //Access for Coupons
              if($currentPath=="admin/view-coupons" && Session::get('adminDetails')['coupons_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/add-coupon" && Session::get('adminDetails')['coupons_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/edit-coupon/{id}" && Session::get('adminDetails')['coupons_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/delete-coupon/{id}" && Session::get('adminDetails')['coupons_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }

            
              //Access for Coupons
              if($currentPath=="admin/view-coupons" && Session::get('adminDetails')['coupons_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/add-coupon" && Session::get('adminDetails')['coupons_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/edit-coupon/{id}" && Session::get('adminDetails')['coupons_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/delete-coupon/{id}" && Session::get('adminDetails')['coupons_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }

             //Access for CmsPages
             if($currentPath=="admin/view-cms-pages" && Session::get('adminDetails')['cmspages_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/add-cms-page" && Session::get('adminDetails')['cmspages_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/edit-cms-page/{id}" && Session::get('adminDetails')['cmspages_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }
            if($currentPath=="admin/delete-cms-page/{id}" && Session::get('adminDetails')['cmspages_access']==0){
                return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
            }

                //Access for Admins/Sub-Admins
                if($currentPath=="admin/view-admins" && Session::get('adminDetails')['admins_access']==0){
                    return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
                }
                if($currentPath=="admin/add-admin" && Session::get('adminDetails')['admins_access']==0){
                    return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
                }
                if($currentPath=="admin/edit-admin/{id}" && Session::get('adminDetails')['admins_access']==0){
                    return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
                }
                if($currentPath=="admin/delete-admin/{id}" && Session::get('adminDetails')['admins_access']==0){
                    return redirect('/admin/dashboard')->with('flash_message_error','You have no access for this module.');
                }



        }
        return $next($request);
    }
}
