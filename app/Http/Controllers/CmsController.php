<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPage;
use Illuminate\Support\Facades\Mail;


class CmsController extends Controller
{
    public function addCmsPage(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            if(empty($data['meta_title'])){
                $data['meta_title'] = '';
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = '';
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = '';
            }
            $cmspage = new CmsPage;
            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->meta_keywords = $data['meta_keywords'];
           if(empty($data['status'])){
               $status=0;
           }else{
               $status=1;
           }
     

           $cmspage->status = $status;
           $cmspage->save();
           return redirect()->back()->with('flash_message_success','CMS page has been added successfully!');
        }
        return view('admin.pages.add_cms_page');
    }


    public function viewCmsPages(){
        $cmsPages = CmsPage::get();
        return view('admin.pages.view_cms_pages')->with(compact('cmsPages'));
    }

    public function editCmsPage(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['status'])){
                $status=0;
            }else{
                $status=1;
            }
            if(empty($data['meta_title'])){
                $data['meta_title'] = '';
            }
            if(empty($data['meta_description'])){
                $data['meta_description'] = '';
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords'] = '';
            }
            CmsPage::where('id',$id)->update(['title'=>$data['title'],'url'=>$data['url'],'description'=>$data['description'],'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords'],'status'=>$status]);
            return redirect()->back()->with('flash_message_success','CMS page has been updated successfully!');
        }
        $cmsPage = CmsPage::where('id',$id)->first();
        return view('admin.pages.edit_cms_page')->with(compact('cmsPage'));
    }

    public function deleteCmsPage($id){
        CmsPage::where('id',$id)->delete();
        return redirect('/admin/view-cms-pages')->with('flash_message_success','CMS page has been deleted successfully!');
    }


    public function cmsPage($url){
        //Check if CMS page is disable or enable
        $cmsPageCount = CmsPage::where(['url'=>$url,'status'=>1])->count();
        if($cmsPageCount>0){
             //Get CMS Page Details
         $cmsPageDetails = CmsPage::where('url',$url)->first();
        }else{
            abort(404);
        } 
        $meta_title =  $cmsPageDetails->meta_title ;
        $meta_description =  $cmsPageDetails->meta_description;
        $meta_keywords =  $cmsPageDetails->meta_keywords;
        return view('pages.cms_page')->with(compact('cmsPageDetails','meta_title','meta_description','meta_keywords'));
    }

    public function contact(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

        //Send Contact Email
        $email = "info@procomputerades.xyz";
        $messageData = [
            'name'=>$data['name'],
            'email'=>$data['email'],
            'subject'=>$data['subject'],
            'comment'=>$data['message']
        ];
        Mail::send('emails.enquiry',$messageData,function($message)use($email){
            $message->to($email)->subject('Enquiry from E-com Website');
        });
        return redirect()->back()->with('flash_message_success','Thanks for your enquiry. We will get back to you soon.');
    }
    $meta_title = "Contact Us - E-shop Sample Website";
	$meta_description = "Contact us for any queries related to our products";
    $meta_keywords = "contact us, queries, contact informations, social";
    
    return view('pages.contact')->with(compact('meta_title','meta_description','meta_keywords'));
}

public function terms(){
    $meta_title = "Terms and conditions - E-shop Sample Website";
    return view('pages.terms')->with(compact('meta_title'));
}

    
}