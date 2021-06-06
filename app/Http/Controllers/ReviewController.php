<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Auth;

class ReviewController extends Controller
{
    public function addReview(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $review = new Review;
            $review->rating = $data['rate'];
            $review->user_id = Auth::user()->id;
            $review->product_id = $request->product_id;
            $review->comment = $data['comment'];
            $review->save();
            return redirect()->back()->with('flash_message_success', 'Review has been added successfully');
    }
    }

    
    public function editReview(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
    
         if(empty($data['comment'])){
            $data['comment'] = '';
         }
         
         if(empty($data['rate'])){
            $data['rate'] = '';
         }
            Review::where('id',$id)->update(['comment'=>$data['comment'],'rating'=>$data['rate']]);
            return redirect()->back()->with('flash_message_success', 'Review has been edited successfully');
        }     
}

public function deleteReview($id=null){  
    $review =  Review::where(['id'=>$id ,'user_id'=>Auth::user()->id])->get();
    Review::where(['id'=>$id ,'user_id'=>Auth::user()->id])->delete();
  if($review->count()>0){
    return redirect()->back()->with('flash_message_success', 'Review has been deleted successfully'); 
 }
else{
    return redirect()->back()->with('flash_message_error', 'Something went wrong');
}
}





}
