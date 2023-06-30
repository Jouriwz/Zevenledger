<?php

namespace App\Http\Controllers;

use App\Http\Resources\BankingTransactionResource;
use Illuminate\Http\Request;
use App\Models\BankingTransaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class UploadController extends Controller
{
    public function index()
    {
        $transactions = BankingTransaction::where('user_id', Auth::id())->get();
        return BankingTransactionResource::collection($transactions);
    }



    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);

        if ($request->file()) {
            $file = $request->file('file')->get();

            $data = explode("\n", $file);

            foreach ($data as $index => $row) {
                // Skip the header row
                if($index === 0) continue;

                try {
                    $row = str_getcsv($row, ";");

                    $transaction = new BankingTransaction([
                        'date' => Carbon::createFromFormat('Ymd', $row[0])->toDateString(),
                        'description' => $row[1],
                        'account_number' => $row[2],
                        'counter_account_number' => $row[3],
                        'code' => $row[4],
                        'debit_credit' => $row[5],
                        'amount' => str_replace(',', '.', $row[6]),
                        'transaction_type' => $row[7],
                        'notes' => $row[8],
                        'balance_after_transaction' => str_replace(',', '.', $row[9]),
                        'tag' => $row[10] ?? null,
                        'user_id' => Auth::id(),
                    ]);

                    $transaction->save();
                } catch (\Exception $e) {
                    \Log::error("Failed to process row: " . json_encode($row));
                    \Log::error($e->getMessage());
                    continue;
                }
            }

            return back()->with('success','File has been uploaded and processed successfully.');
        }
    }



}
