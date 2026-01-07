<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_number',
        'account_type',
        'balance',
        'status'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
    ];

    /**
     * Get the user that owns the account.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions for the account.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Generate a unique account number.
     */
    public static function generateAccountNumber(): string
    {
        do {
            $accountNumber = '14' . str_pad(random_int(0, 99999999), 8, '0', STR_PAD_LEFT);
        } while (self::where('account_number', $accountNumber)->exists());

        return $accountNumber;
    }
}
