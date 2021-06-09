<?php

namespace App\Http\Controllers;
use App\Models\Invoice;

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
     * @return \Illuminate\View\View
     */
    public function index(){

        $totalIncome = $this->caculateIncome();
        return view('dashboard')->with('totalIncome', $totalIncome);
    }

    public function caculateIncome(){

        $invoices = Invoice::all();
        $total = 0;
        foreach($invoices as $invoice){
            $total += $invoice->total;
        };

        return  number_format((float)$total, 2, '.', '');
    }
}
