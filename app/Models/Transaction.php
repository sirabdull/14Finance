<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'transaction_reference',
        'type',
        'category',
        'amount',
        'balance_before',
        'balance_after',
        'recipient_account',
        'recipient_name',
        'narration',
        'bill_type',
        'bill_reference',
        'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
    ];

    /**
     * Get the account that owns the transaction.
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Generate a unique transaction reference.
     */
    public static function generateReference(): string
    {
        do {
            $reference = 'TXN' . date('Ymd') . strtoupper(substr(uniqid(), -8));
        } while (self::where('transaction_reference', $reference)->exists());

        return $reference;
    }
}
