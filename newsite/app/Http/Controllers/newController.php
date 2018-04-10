<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use file;
use DB;
use App\subscriptions;
use App\User;
use App\clas;
use App\Book;
use App\Publisher;

class newController extends Controller
{
    //
    // filter by Book name
   
     public function filterdata(Request $request){
        //     $user = auth()->user();
     
        //   $user = auth()->user();
        // // dd($user->id);

        // $book =Book::all();
        
        // // $books = $book->where("publisher", "=",($user->name));
       
        // $data = DB::table('subscriptions')->where(('publisher'),'=',$user->name)->get();
        // if ($request->get('Book_name') =="" )
        // {
        //     $data = DB::table('subscriptions')->where(('publisher'),'=',$user->name)->get();
            
        // }else{
        //     $data = subscriptions::whereBook_name($request->get('Book_name'))->get();

        // }

        return view('report',compact('data'));
        }
}
