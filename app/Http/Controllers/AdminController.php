<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use App\Product;
use App\ProductsAttribute;
use App\Admin;
use App\Order;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function login(Request $request){
    	if($request->isMethod('post')){
            $data = $request->input();
            $adminCount = Admin::where(['username' => $data['username'],'password' => md5($data['password']),'status'=>1])->count();
            if($adminCount > 0){
                    //echo "Success"; die;
                    Session::put('adminSession', $data['username']);
                    return redirect('/admin/dashboard');
        	}else{
                    //echo "failed"; die;
                    return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
        	}
    	}
    	return view('admin.admin_login');
    }

    public function dashboard(){
        /*if(Session::has('adminSession')){
            // Perform all actions
        }else{
            //return redirect()->action('AdminController@login')->with('flash_message_error', 'Please Login');
            return redirect('/admin')->with('flash_message_error','Please Login');
        }*/
        $count_users = User::get();
        $count_orders = Order::get();
        $count_products = DB::table('products')->join('products_attributes','products_attributes.product_id','products.id')->get();  
        $count_pending_orders = Order::get()->where('order_status','Pending');
        return view('admin.dashboard')->with(compact('count_users','count_orders','count_pending_orders','count_products'));

    }

    public function settings(){

        $adminDetails = Admin::where(['username'=>Session::get('adminSession')])->first();

        //echo "<pre>"; print_r($adminDetails); die;

        return view('admin.settings')->with(compact('adminDetails'));
    }

    public function chkPassword(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $adminCount = Admin::where(['username' => Session::get('adminSession'),'password' => md5($data['current_pwd']),'status'=>1])->count();
            if ($adminCount == 1) {
                //echo '{"valid":true}';die;
                echo "true"; die;
            } else {
                //echo '{"valid":false}';die;
                echo "false"; die;
            }

    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $adminCount = Admin::where(['username' => Session::get('adminSession'),'password' => md5($data['current_pwd']),'status'=>1])->count();
            if ($adminCount == 1) {
                // here you know data is valid
                $password = md5($data['new_pwd']);
                Admin::where('username',Session::get('adminSession'))->update(['password'=>$password]);
                return redirect('/admin/settings')->with('flash_message_success', 'Password updated successfully.');
            }else{
                return redirect('/admin/settings')->with('flash_message_error', 'Current Password entered is incorrect.');
            }     
        }
    }

    public function logout(){
        Session::forget('adminSession');
        return redirect('/admin')->with('flash_message_success', 'Logged out successfully.');  
    }


    public function addSale(Request $request){
       $salePrice = $request->salePrice;
       $pro_id = $request->pro_id;
       DB::table('products')->where('id',$pro_id)->update(['sale_price' => $salePrice]);
    }

    public function banUser(Request $request){
        //return $request->all();
        $status = $request->status;
        $userID = $request->userID;
        $update_status = DB::table('users')
        ->where('id', $userID)
        ->update([
          'banned' => $status
        ]);
        if($update_status==1){
       echo "Banned status updated successfully.";
        }else{
            echo "Banned status updated successfully.";
        }
      }

      public function viewAdmins(){
      $admins = Admin::get();
      return view('admin.admins.view_admins')->with(compact('admins'));
    }

    public function addAdmin(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $adminCount = Admin::where('username',$data['username'])->count();
            if($adminCount > 0){
                return redirect()->back()->with('flash_message_error', 'Admin / Sub Admin already exists! Please choose another.');
            }else{
                if(empty($data['status'])){
                    $data['status'] = 0;
                }
                if($data['type']=="Admin"){
                    $admin = new Admin;
                    $admin->type = $data['type'];
                    $admin->username = $data['username'];
                    $admin->password = md5($data['password']);
                    $admin->email = $data['email'];
                    $admin->status = $data['status'];
                    $admin->save();
                    return redirect()->back()->with('flash_message_success', 'Admin added successfully!');
                }else if($data['type']=="Sub Admin"){

                    if(empty($data['categories_access'])){
                        $data['categories_access'] = 0;
                    }
                    if(empty($data['products_access'])){
                        $data['products_access'] = 0;
                    }
                    if(empty($data['orders_access'])){
                        $data['orders_access'] = 0;
                    }
                    if(empty($data['users_access'])){
                        $data['users_access'] = 0;
                    }
                    if(empty($data['posts_access'])){
                        $data['posts_access'] = 0;
                    }
                    if(empty($data['banners_access'])){
                        $data['banners_access'] = 0;
                    }
                    if(empty($data['coupons_access'])){
                        $data['coupons_access'] = 0;
                    }
                    if(empty($data['cmspages_access'])){
                        $data['cmspages_access'] = 0;
                    }
                    if(empty($data['admins_access'])){
                        $data['admins_access'] = 0;
                    }

                    $admin = new Admin;
                    $admin->type = $data['type'];
                    $admin->username = $data['username'];
                    $admin->password = md5($data['password']);
                    $admin->email = $data['email'];
                    $admin->status = $data['status'];
                    $admin->categories_access = $data['categories_access'];
                    $admin->products_access = $data['products_access'];
                    $admin->orders_access = $data['orders_access'];
                    $admin->users_access = $data['users_access'];
                    $admin->posts_access = $data['posts_access'];
                    $admin->banners_access = $data['banners_access'];
                    $admin->coupons_access = $data['coupons_access'];
                    $admin->cmspages_access = $data['cmspages_access'];
                    $admin->admins_access = $data['admins_access'];
                    $admin->save();
                    return redirect()->back()->with('flash_message_success', 'Sub Admin added successfully!');
                }
              
            }
        }
        return view('admin.admins.add_admin');
    }


    public function editAdmin(Request $request,$id){
        $adminDetails = Admin::where('id',$id)->first();
        //$adminDetails = json_decode(json_encode($adminDetails));
        //echo "<pre>"; print_r($adminDetails); die;
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $data['status'] = 0;
            }
            if($data['type']=="Admin"){
               Admin::where('username',$data['username'])->update(['password'=> md5($data['password']),'status'=>$data['status']]);
                return redirect()->back()->with('flash_message_success', 'Admin updated successfully!');
            }else if($data['type']=="Sub Admin"){

                if(empty($data['categories_access'])){
                    $data['categories_access'] = 0;
                }
                if(empty($data['products_access'])){
                    $data['products_access'] = 0;
                }
                if(empty($data['orders_access'])){
                    $data['orders_access'] = 0;
                }
                if(empty($data['users_access'])){
                    $data['users_access'] = 0;
                }
                if(empty($data['posts_access'])){
                    $data['posts_access'] = 0;
                }
                if(empty($data['banners_access'])){
                    $data['banners_access'] = 0;
                }
                if(empty($data['coupons_access'])){
                    $data['coupons_access'] = 0;
                }
                if(empty($data['cmspages_access'])){
                    $data['cmspages_access'] = 0;
                }
                if(empty($data['admins_access'])){
                    $data['admins_access'] = 0;
                }

                Admin::where('username',$data['username'])->update(['password'=> md5($data['password']),'email'=>$data['email'],'status'=>$data['status'],'categories_access'=>$data['categories_access'],'products_access'=>$data['products_access'],'orders_access'=>$data['orders_access'],'users_access'=>$data['users_access'],'posts_access'=>$data['posts_access'],'banners_access'=>$data['banners_access'],'coupons_access'=>$data['coupons_access'],'cmspages_access'=>$data['cmspages_access'],'admins_access'=>$data['admins_access']]);
                return redirect()->back()->with('flash_message_success', 'Sub Admin updated successfully!');
            }
        }
        return view('admin.admins.edit_admin')->with(compact('adminDetails'));
    }

    public function deleteAdmin($id = null){
        Admin::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Admin has been deleted successfully');
    }


    public function recoverPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $adminCount = Admin::where('email',$data['email'])->count();
            if($adminCount == 0){
                return redirect()->back()->with('flash_message_error','Email does not exists!');
            }
           //Get user details
           $adminDetails = Admin::where('email',$data['email'])->first();
           //Generate random password
           $random_password = str_random(8);
           //Encode-Secure Password
           $new_password = md5($random_password);
           // Update password in database
           Admin::where('email',$data['email'])->update(['password'=>$new_password]);
           //Send forgot password email code
           $email = $data['email'];
           $messageData = [
                'email'=>$email,
                'username'=>$adminDetails->username,
                'password'=>$random_password
           ];
           Mail::send('emails.recoverpassword',$messageData,function($message)use($email){
               $message->to($email)->subject('New Password E-com Website');
           });

           return redirect('/admin')->with('flash_message_success','Please check your email for new password!');

        }
    }


}
