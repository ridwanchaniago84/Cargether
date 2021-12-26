<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Member;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:owner|treasurer|staff');
    }

    public function print($id)
    {
        $transaction = Transaction::where('transactions.id', $id)
        ->join('vehicles', 'vehicles.id', 'transactions.vehicle_id')
        ->join('members', 'members.id', 'transactions.member_id')
        ->join('prices', 'prices.id', 'vehicles.price_id')
        ->select([
            'transactions.*',
            'vehicles.plate_no',
            'vehicles.brand',
            'vehicles.brand_type',
            'members.name',
            'members.address',
            'prices.price as pricePerDay'
        ])
        ->first();

        $pdf = PDF::loadView('Transactions.invoice', [
            'transaction' => $transaction,
            'no' => 1
        ])
            ->setPaper('a5', 'portrait');

        return $pdf->download('Invoice ' . $transaction->name . '.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::join('vehicles', 'vehicles.id', 'transactions.vehicle_id')
            ->join('members', 'members.id', 'transactions.member_id')
            ->select([
                'transactions.*',
                'vehicles.plate_no',
                'members.name'
            ])
            ->get();

        return view('Transactions.index', [
            'no'            => 1,
            'transactions'   => $transaction,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('treasurer')) return abort(403, 'Unauthorized action.');

        $members = Member::where('is_active', 1)->get();
        $vehicles = Vehicle::where('is_active', 1)->get();

        return view('Transactions.create', [
            'members' => $members,
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'id_member' => 'required|integer',
            'id_vehicle' => 'required|integer',
            'rent_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:rent_date',
            // 'period' => 'required',
            // 'price' => 'required|integer'
        ])->validate();

        $rent_date = new \DateTime($request->get('rent_date'));
        $return_date = new \DateTime($request->get('return_date'));
        $period = $rent_date->diff($return_date)->days;

        // if ($period < 1) $period = 1;
        $period = $period + 1;

        $pricePerDay = Vehicle::join('prices', 'prices.id', 'vehicles.price_id')
            ->where('vehicles.id', $request->get('id_vehicle'))
            ->first()
            ->price;

        $price = (int)$period * $pricePerDay;

        $transaction = Transaction::create([
            'member_id' => $request->get('id_member'),
            'vehicle_id' => $request->get('id_vehicle'),
            'rent_date' => $request->get('rent_date'),
            'return_date' => $request->get('return_date'),
            'period' => $period,
            'price' => $price
        ]);

        return redirect()->route('transaction.index')->with('success', 'Berhasil menambahkan transaksi baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $members = Member::where('is_active', 1)->get();
        $vehicles = Vehicle::where('is_active', 1)->get();

        return view('Transactions.create', [
            'members' => $members,
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasRole('treasurer')) return abort(403, 'Unauthorized action.');

        $transaction = Transaction::findOrFail($id);
        $members = Member::where('is_active', 1)->get();
        $vehicles = Vehicle::where('is_active', 1)->get();

        return view('Transactions.edit', [
            'members' => $members,
            'vehicles' => $vehicles,
            'transaction' => $transaction
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'id_member' => 'required|integer',
            'id_vehicle' => 'required|integer',
            'rent_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:rent_date',
            // 'period' => 'required',
            // 'price' => 'required|integer'
        ])->validate();

        $rent_date = new \DateTime($request->get('rent_date'));
        $return_date = new \DateTime($request->get('return_date'));
        $period = $rent_date->diff($return_date)->days;

        // if ($period < 1) $period = 1;
        $period = $period + 1;

        $pricePerDay = Vehicle::join('prices', 'prices.id', 'vehicles.price_id')
            ->where('vehicles.id', $request->get('id_vehicle'))
            ->first()
            ->price;

        $price = (int)$period * $pricePerDay;

        $transaction = Transaction::whereId($id)->update([
            'member_id' => $request->get('id_member'),
            'vehicle_id' => $request->get('id_vehicle'),
            'rent_date' => $request->get('rent_date'),
            'return_date' => $request->get('return_date'),
            'period' => $period,
            'price' => $price
        ]);

        return redirect()->route('transaction.index')->with('success', 'Berhasil mengubah transaksi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->hasRole('owner')) return abort(403, 'Unauthorized action.');
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->delete();

            return redirect()->route('transaction.index')->with('success', 'Berhasil Menghapus transaksi!');
        } catch (\Illuminate\Database\QueryException $err) {
            return redirect()->route('transaction.index')->with('danger', 'Member gagal dihapus. Code: SQLSTATE[' . $err->getCode() . ']');
        }
    }
}
