<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use Auth;
use App\Post;
use App\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewPosts()
    {
        $post = Post::get();
        return view('admin.posts.view_posts')->with(compact('post'));
    }


    public function addPost(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $post = new Post;
            $post->title = $data['title'];
            $post->body = $data['body'];		
            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $post_path = 'images/frontend_images/posts/'.'/'.$fileName; 
                     Image::make($image_tmp)->resize(900, 300)->save($post_path);
                     $post->image = $fileName; 
                }
            }
            $post->save();
            return redirect()->back()->with('flash_message_success', 'Post has been added successfully');
        }
        return view('admin.posts.add_post');
    }

  

    public function editPost(Request $request,$id=null)
    {
        if($request->isMethod('post')){
            $data = $request->all();
    
         if(empty($data['title'])){
            $data['title'] = '';
         }
         if(empty($data['body'])){
            $data['body'] = '';
         }
            // Upload Image
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;   
                    $post_path = 'images/frontend_images/posts/'.'/'.$fileName; 
                     Image::make($image_tmp)->resize(900, 300)->save($post_path);
                }
            }
                else if(!empty($data['current_image'])){
                    $fileName = $data['current_image'];
                }else{
                    $fileName = '';
                }
           
    
            Post::where('id',$id)->update(['title'=>$data['title'],'body'=> $data['body'],'image'=>$fileName]);
            return redirect()->back()->with('flash_message_success', 'Post has been edited successfully');
        }
        $postDetails = Post::where('id',$id)->first();
        return view('admin.posts.edit_post')->with(compact('postDetails'));
    }


    public function deletePost($id = null){
        Post::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Post has been deleted successfully');
       }


       public function deletePostImage($id=null){

		// Get Post Image
		$postImage = Post::where('id',$id)->first();

		// Get Post Image Paths
		$post_path = 'images/frontend_images/posts/';

        // Delete  Image if not exists in Folder
        if(file_exists($post_path.$postImage->image)){
            unlink($post_path.$postImage->image);
        }

        // Delete Image from Products table
        Post::where(['id'=>$id])->update(['image'=>'']);

        return redirect()->back()->with('flash_message_success', 'Post image has been deleted successfully');

    }

    
   //Show all blogs
   public function show_blogs(){

    $meta_title = "Our Blog - E-shop Sample Website";
	$meta_description = "Latest new from our blog";
    $meta_keywords = "blog";
    
    $post = Post::orderBy('created_at','DESC')->paginate(4);  
    return view('blog.view_blogs')->with(compact('post','meta_title','meta_description','meta_keywords'));
   }

//Show single blog
public function single_blog($id = null){
    $post = Post::where('id',$id)->first();
    $meta_title =  $post->title;
    $meta_description =  $post->title;
    $meta_keywords =  $post->title;
    return view('blog.single_blog')->with(compact('post','meta_title','meta_description','meta_keywords'));
   }


}
