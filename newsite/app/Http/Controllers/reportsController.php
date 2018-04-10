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

class reportsController extends Controller
{
    //
     public function index()
    {
        return view('report');
    }

   
    public function getData(){
         $user = auth()->user();
        // dd($user->id);

        $book =Book::all();
        
        // $books = $book->where("publisher", "=",($user->name));
       
        $data = DB::table('subscriptions')->where(('publisher'),'=',$user->name)->get();
        return view('report', compact('data'));


    }
        public function filterdata(Request $req){
                    $user = auth()->user();

        if ($req->get('Book_name') =="" )
        {
            $data = DB::table('subscriptions')->where(('publisher'),'=',$user->name)->get();
            
        }else{
            $data = subscriptions::whereBook_name($req->get('Book_name'))->get();

        }

        return view('report',compact('data'));
        }
     
public function search(){
$name = Input::get('character');
    $datasearch = DB::table('subscriptions')->where(('publisher'),'=',$user->name,'Book_name','LIKE','%$name%')->get();
return view::make('search.search')
->with('Book_name',$Book_name);
}

    
        

}
