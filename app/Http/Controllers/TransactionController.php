<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        //
        DB::beginTransaction();
            try {
                $product = [1,2,3,4,5];
                    $transaction = Transaction::create([
                    'customer'=>'gombloh',
                    'total_amount' => 10000
            ]);
            $transactiondetail = [];
            foreach ($product as $key => $value){
                $transactionDetails[] = [
                    'transaction_id' => $transaction->id,
                    'product_id' => $value,
                    'quantity' => "test",
                    'amount' => 1000,
                    'created_at' => Carbon::now()
                ];
            }
            if ($transactionDetails){
                TransactionDetail::insert($transactionDetails);
            }
            DB::commit();
            return "ok";
        } catch (\Throwable $th) {
            DB::rollback();
            return "gagal";
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransactionRequest  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
