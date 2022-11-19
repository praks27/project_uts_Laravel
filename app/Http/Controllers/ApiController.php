<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //untuk membuat data yang ditampilkan dinamis
    public function list(Request $request){
        //untuk menangkap data dengan query param
        $limit = $request->input('limit');
        return Transaction::with(['details'])->paginate($limit);
    }
    public function detail(Request $request, $id)
    {
        //cara 1
        return Transaction::with(['details'])->find($id);
        //cara 2
        // return Transaction::where('id',$id)->first();
    }
    public function store(Request $request)
    {
        $data = $request->all();
        //cara ambil idnya aja ,pakai laravel collection
        $proudctIds = collect($data['products'])->pluck('id');

        $product = Product::whereIn('id',$proudctIds)->get();
        $total_amount = 0;
        foreach ($data['products'] as $value){
            $product = $product->firstWhere('id',$value['id']);
            //total_amount = $total_amount + 1;
            //total_amount += 1; hasilnya sama saja seperti dibawah atau diatasnya
            $total_amount += ($product ? $product->price : 0) * $value['qty'];
        }

        //script untuk insert ke banyak table tetapi semua inputan harus berhasil jika error maka inputan tidak akan di input ke database
        DB::beginTransaction();
            try {
                    $transaction = Transaction::create([
                    'id' => Uuid::uuid4()->toString(),
                    'customer'=>$data['customer'],
                    'total_amount' => $total_amount
            ]);
            $transactionDetails = [];
            foreach ($data['products'] as $key => $value){
                $product = $product->firstWhere('id', $value['id']);
                $transactionDetails[] = [
                    'id' => Uuid::uuid4()->toString(),
                    'transaction_id' => $transaction->id,
                    'product_id' => $value['id'],
                    'quantity' => $value['qty'],
                    'amount' => $product ? $product->price : 0,
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
            return $th;
        }

    }
}
