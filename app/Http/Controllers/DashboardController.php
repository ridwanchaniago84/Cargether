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

    public function user()
    {
    }

    public function getDataTrasaction()
    {
        $datesData = [];
        $transactionsData = [];
        $transactionPrice = [];

        $dataTrasactions = Transaction::orderBy('created_at', 'ASC')
            ->get();

        foreach ($dataTrasactions as $data) {
            if (!in_array($data->created_at->format('Y-m-d'), $datesData)) {
                $countTrasactionThisDay = Transaction::whereDate('transactions.created_at', $data->created_at->format('Y-m-d'))
                    ->count();

                $sellingTrasactionThisDay = Transaction::whereDate('created_at', $data->created_at->format('Y-m-d'))
                    ->sum('price');

                array_push($transactionsData, $countTrasactionThisDay);
                array_push($transactionPrice, $sellingTrasactionThisDay);
                array_push($datesData, $data->created_at->format('Y-m-d'));
            }
        }

        $response = [
            'totalHargaPenjualan' => $transactionPrice,
            'totalPenjualan' => $transactionsData,
            'date' => $datesData
        ];

        return response()->json($response);
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
            'spendings'             => $spendings
        ]);
    }
}
