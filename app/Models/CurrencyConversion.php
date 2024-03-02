<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyConversion extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currency_conversion';

    protected $fillable = [
        'base_code',
        'base_value',
        'target_code',
        'target_value',
    ];

    // Add any additional model logic or relationships here if needed

    public static function getConversionRate($baseCode, $targetCode)
    {
        return CurrencyConversion::where('base_code', $baseCode)
            ->where('target_code', $targetCode)
            ->value('target_value');
    }
    
}