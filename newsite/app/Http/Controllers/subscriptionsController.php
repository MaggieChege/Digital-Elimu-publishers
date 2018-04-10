<?php

namespace App\Http\Controllers;
use Auth;
use file;
use DB;
use App\subscriptions;
use App\User;
use App\clas;
use App\Book;
use App\Publisher;

use Illuminate\Http\Request;

class subscriptionsController extends Controller
{
    //
    public function getData(){
         $user = auth()->user();
        // dd($user->id);

        $book =Book::all();
        
        // $books = $book->where("publisher", "=",($user->name));
       
        $ndata = DB::table('subscriptions')->where(('publisher'),'=',$user->name)->get();
        return view('subscriptions', compact('ndata'));


    }
    public function filterByClass(Request $request){
            $user = auth()->user();
     
         
        if ($request->get('class_name') =="" )
        {
            $ndata = DB::table('subscriptions')->where(('publisher'),'=',$user->name)->get();
            
        }else{
            $ndata = subscriptions::whereclass_name($request->get('class_name'))->get();

        }

        return view('subscriptions',compact('ndata'));
        }
}
