<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use DB;

class CommentController extends Controller
{


    public function addComment(Request $request){
        if($request->isMethod('post')){
        $data = $request->all();
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();
        return redirect()->back()->with('flash_message_success', 'Comment has been added successfully');
        }
    }

    public function deleteComment($id){  
        $comment =  Comment::where(['id'=>$id ,'user_id'=>Auth::user()->id])->get();
       Comment::where(['id'=>$id ,'user_id'=>Auth::user()->id])->delete();
      if($comment->count()>0){
        return redirect()->back()->with('flash_message_success', 'Comment has been deleted successfully'); 
     }
    else{
        return redirect()->back()->with('flash_message_error', 'Something went wrong');
    }
    }


       public function editComment(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
         if(empty($data['comment'])){
            $data['comment'] = '';
         }
            Comment::where('id',$id)->update(['comment'=>$data['comment']]);
            return redirect()->back()->with('flash_message_success', 'Comment has been edited successfully');
        }     
}


}
