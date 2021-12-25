<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Vehicle;
use App\Models\Spending;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function user(){

    }
    public function index()
    {
        $members = Member::count();
        $vehicles = Vehicle::count();
        $transactions = Transaction::count();
        $spendings = Spending::count();

        return view('dashboard', [
            'members'               => $members,
            'vehicles'              => $vehicles,
            'transactions'          => $transactions,
            'spendings'             => $spendings,
        ]);
    }
}
