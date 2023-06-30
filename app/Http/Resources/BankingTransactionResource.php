<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankingTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'description' => $this->description,
            'account_number' => $this->account_number,
            'counter_account_number' => $this->counter_account_number,
            'code' => $this->code,
            'debit_credit' => $this->debit_credit,
            'amount' => $this->amount,
            'transaction_type' => $this->transaction_type,
            'notes' => $this->notes,
            'balance_after_transaction' => $this->balance_after_transaction,
            'tag' => $this->tag,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
