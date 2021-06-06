<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Country;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;
use File;

class UsersController extends Controller
{

    public function userLoginRegister(){
        $meta_title = "Login | Register - E-shop Sample Website";
        $meta_description = "Login and register page";
        $meta_keywords =  "login, register";
        return view('users.login_register')->with(compact('meta_title','meta_description','meta_keywords'));
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();      
            //Check if user already exist
            $usersCount = User::where('email',$data['email'])->count();
            if($usersCount>0){
                return redirect()->back()->with('flash_message_error','Email already exists!');
            }else{
               $user = new User;
               $user->name = $data['name'];
               $user->last_name = $data['last_name'];
               $user->email = $data['email'];
               $user->password = bcrypt($data['password']);
               $user->gender = $data['gender'];
               $user->save();

              /* //Send Register Email
               $email = $data['email'];
               $messageData = ['email' => $data['email'],'name' => $data['name']];
               Mail::send('emails.register',$messageData,function($message) use($email){
                   $message->to($email)->subject('Registration with E-com Website');
               });*/

               //Send Confirmation Email
               $email = $data['email'];
               $messageData = ['email' => $data['email'],'name' => $data['name'],'code'=>base64_encode($data['email'])];
               Mail::send('emails.confirmation',$messageData,function($message) use($email){
               $message->to($email)->subject('Confirm your E-com Account');  });
               return redirect()->back()->with('flash_message_success','Please confirm your email to activate your account!');

                // Redirect to cart page after login
               if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password'] ]))
               {
                Session::put('frontSession',$data['email']);
                   return redirect('/cart');
               }
            }
        }
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])){

                // Show message your "your account is not activated"
                $userStatus = User::where('email',$data['email'])->first();
                if($userStatus->status == 0){
                    Auth::logout();
                    Session::forget('frontSession');
                    return redirect()->back()->with('flash_message_error','Your account is not activated.');  
                }
                if($userStatus->banned == 1){
                    Auth::logout();
                    Session::forget('frontSession');
                    return redirect()->back()->with('flash_message_error','Your account has been banned. Please contact administrator.');  
                }


                Session::put('frontSession',$data['email']);

                if(!empty(Session::get('session_id'))){
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email' => $data['email']]);
                }


                return redirect('/cart');  
            }else{
                return redirect()->back()->with('flash_message_error','Invalid Username or Password!');
            }
         }
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $userCount = User::where('email',$data['email'])->count();
            if($userCount == 0){
                return redirect()->back()->with('flash_message_error','Email does not exists!');
            }
           //Get user details
           $userDetails = User::where('email',$data['email'])->first();
           //Generate random password
           $random_password = str_random(8);
           //Encode-Secure Password
           $new_password = bcrypt($random_password);
           // Update password in database
           User::where('email',$data['email'])->update(['password'=>$new_password]);
           //Send forgot password email code
           $email = $data['email'];
           $name = $userDetails->name;
           $messageData = [
                'email'=>$email,
                'name'=>$name,
                'password'=>$random_password
           ];
           Mail::send('emails.forgotpassword',$messageData,function($message)use($email){
               $message->to($email)->subject('New Password E-com Website');
           });

           return redirect('login-register')->with('flash_message_success','Please check your email for new password!');

        }
        $meta_title = "Forgot Password - E-shop Sample Website";
        $meta_description = "Find your lost password";
        $meta_keywords =  "Forgot password";
        return view('users.forgot_password')->with(compact('meta_title','meta_description','meta_keywords'));
    }

    public function confirmAccount($email){
        $email = base64_decode($email);
        $userCount = User::where('email',$email)->count();
        if($userCount > 0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                return redirect('login-register')->with('flash_message_success','Your  account is already activated. You can login now.');
            }else{
                User::where('email',$email)->update(['status'=>1]);

               //Send Welcome Email
               $messageData = ['email' => $email,'name' => $userDetails->name ];
               Mail::send('emails.welcome',$messageData,function($message) use($email){
                   $message->to($email)->subject('Welcome to E-com Website');
               });
                return redirect('login-register')->with('flash_message_success','Your account is  activated. You can login now.');
            }
        }else{
            abort(404);
        }
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        if($request->isMethod('post')){
            $data = $request->all();
            $user = User::find($user_id);

            if(empty($data['name'])){
                return redirect()->back()->with('flash_message_error','Please enter your Name to update your account details !'); 
            }
            if(empty($data['address'])){
                $data['address'] = '';
            }
            if(empty($data['city'])){
                $data['city'] = '';
            }
            if(empty($data['state'])){
                $data['state'] = '';
            }
            if(empty($data['country'])){
                $data['country'] = '';
            }
            if(empty($data['pincode'])){
                $data['pincode'] = '';
            }
            if(empty($data['mobile'])){
                $data['mobile'] = '';
            }
         
         
            $user->name = $data['name'];
            $user->last_name = $data['last_name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->gender = $data['gender'];
                
      
            if($request->hasFile('image')){        
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $user_path = 'images/frontend_images/profile/'.'/'.$fileName; 
                     Image::make($image_tmp)->resize(900, 300)->save($user_path);
                    $oldFilename = $user->image;
                     //update the database
                     $user->image = $fileName; 
                     //Delete the old photo
                     Storage::delete($oldFilename);
            }
        }
                  
            $user->save();
          

            return redirect()->back()->with('flash_message_success','Your account details has been successfully updated!');
        }

        $meta_title = "Account - E-shop Sample Website";
        $meta_description = "Account settings";
        $meta_keywords =  "Account settings";

        return view('users.account')->with(compact('countries','userDetails','meta_title','meta_description','meta_keywords'));
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                //Update password
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','Password updated successfully!'); 
            }else{
                return redirect()->back()->with('flash_message_error','Current Password is incorrect!'); 
            }
        }
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }


    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }


    public function checkEmail(Request $request){
        $data = $request->all();
        //Check if user already exist
        $usersCount = User::where('email',$data['email'])->count();
        if($usersCount>0){
           echo "false";
        }else{
            echo "true"; die;
        }
    }

    public function viewUsers(){
        $users = User::get();
        return view('admin.users.view_users')->with(compact('users'));
    }


    public function deleteUserImage($id=null){     
        // Get User Image
        $userImage = User::where('id',Auth::user()->id)->first();   

        if($userImage->image != ''){
		// Get User Image Paths
		$user_path = 'images/frontend_images/profile/';     
        // Delete  Image if not exists in Folder
        if(file_exists($user_path.$userImage->image)){
            unlink($user_path.$userImage->image);     
        } 
          // Delete Image from Products table
          User::where(['id'=>Auth::user()->id])->update(['image'=>'']);
          return redirect()->back()->with('flash_message_success', 'User image has been deleted successfully'); 
    }
    else{
        return redirect()->back()->with('flash_message_error', 'You need first to upload an image before delete it!'); 
    }
}







}
