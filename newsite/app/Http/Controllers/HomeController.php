<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Main;
use Validator;
use Carbon\Carbon;
use App\Subscriptions;
use App\Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     return view('home');
    // }
    // $data = DB::table('subscriptions')->where(('publisher'),'=',$user->name)->get();


    public function getSales($date){
                    $user = auth()->user();

        $totaSales = DB::select("select sum(amount) as amount from subscriptions where created_at like '".$date->toDateString()."%'");
        return $totaSales[0]->amount;
    }
    public function getSalesRange($first_date,$second_date){
        $totaSales = DB::select("select sum(amount) as amount from subscriptions where created_at between '".$first_date."' AND '".$second_date."'");
        return $totaSales[0]->amount;
    }
    public function index()
    {
        $books = Main::all();
        $dailySales = Carbon::today();
        $daily = self::getSales($dailySales);

        //YESTERDAY
        $yesterdaySales = Carbon::yesterday();
        $yesterday = self::getSales($yesterdaySales);

        //THIS WEEK
        $firstDayThisWeek = new Carbon('this sunday'); 
        $dateToday = Carbon::today();
        $thisWeek = self::getSalesRange($firstDayThisWeek,$dateToday);

        //LAST & DAYS
        $lastSevenDays = $dateToday->subDays(7);
        $dateToday = Carbon::today();
        $lastSevenDaysSales = self::getSalesRange($lastSevenDays,$dateToday);

        //SALES THIS MONTH
        $firstDayOfMonth = Carbon::create(null, null, 1, 0, 0, 0);
        $dateToday = Carbon::today();
        $salesThisMonth = self::getSalesRange($firstDayOfMonth,$dateToday);

        //SALES THIS YEAR
        $firstDayOfYear = Carbon::create(null, 1, 1, 0, 0, 0);
        $dateToday = Carbon::today();
        $salesThisYear = self::getSalesRange($firstDayOfYear,$dateToday);

        //LAST Month
        $dateToday = Carbon::today();
        $customeTime = $dateToday->subMonth();
        $lastMonthFirstDay = Carbon::create($customeTime->year,$customeTime->month,1,0,0,0);
        //last day of month
        $dateToday = Carbon::today();
        $customeTime = $dateToday->subMonth();
        $lastMonthFirstDay2 = Carbon::create($customeTime->year,$customeTime->month,1,0,0,0);
        $lastMonthLastDay = $lastMonthFirstDay2->modify('last day of this month');
        $salesLastMonth = self::getSalesRange($lastMonthFirstDay,$lastMonthLastDay);

        //LAST YEAR
        $dateToday = Carbon::today();
        $lastYear = $dateToday->subYear()->year;
        $lastYear = Carbon::create($lastYear,1,1,0,0,0);
        $salesLastYear = self::getSales($lastYear);

        $dateToday = Carbon::today();
        $year = $dateToday->year;
        //Best selling Books
        $bestSellingBooks = DB::select("SELECT SUM(s.amount) as amount,b.id,b.name FROM subscriptions s LEFT JOIN book b on b.id=s.book_id WHERE s.created_at LIKE '".$year."%' GROUP BY s.book_id,b.id,b.name ORDER BY amount DESC  limit 15");

        //Best Clients
        $bestClients = DB::select("SELECT SUM(s.amount) as amount,c.id,c.phone FROM subscriptions s LEFT JOIN clients c on c.id=s.client_id WHERE s.created_at LIKE '".$year."%' GROUP BY s.client_id,c.id,c.phone ORDER BY amount DESC limit 15");

        $blainers = DB::select("SELECT `edits`.`sub_id`,`edits`.`client_id`,`clients`.`phone`,COUNT( `edits`.`sub_id`) as number FROM edits LEFT JOIN clients on clients.id=edits.client_id GROUP BY clients.phone,edits.sub_id,edits.client_id");
        $user = auth()->user();
$data = DB::table('subscriptions')->where(('publisher'),'=',$user->name)->get();
        return view('home',compact('books','daily','yesterday','thisWeek','lastSevenDaysSales','salesThisMonth','salesThisYear','salesLastYear','salesLastMonth','bestSellingBooks','bestClients','blainers','data'));
    }
 //    

}
