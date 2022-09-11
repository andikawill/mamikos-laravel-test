<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class KostPayment
 * @package App\Models
 * @version September 11, 2022, 9:00 am UTC
 *
 * @property integer $kost_availability_id
 * @property integer $customer_id
 * @property string $type
 * @property string $invoice_date
 * @property string $invoice_number
 * @property string $paid_date
 * @property string $payment_method
 * @property integer $total
 * @property string $status
 */
class KostPayment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'kost_payment';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'kost_availability_id',
        'customer_id',
        'type',
        'invoice_date',
        'invoice_number',
        'paid_date',
        'payment_method',
        'total',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kost_availability_id' => 'integer',
        'customer_id' => 'integer',
        'type' => 'string',
        'invoice_date' => 'date',
        'invoice_number' => 'string',
        'paid_date' => 'date',
        'payment_method' => 'string',
        'total' => 'integer',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kost_availability_id' => 'required|integer',
        'customer_id' => 'required|integer',
        'type' => 'nullable|string|max:255',
        'invoice_date' => 'nullable',
        'invoice_number' => 'nullable|string|max:255',
        'paid_date' => 'nullable',
        'payment_method' => 'nullable|string|max:255',
        'total' => 'nullable|integer',
        'status' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    
}
