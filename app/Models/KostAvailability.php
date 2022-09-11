<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class KostAvailability
 * @package App\Models
 * @version September 11, 2022, 8:59 am UTC
 *
 * @property integer $kost_detail_id
 * @property integer $customer_id
 * @property string $contract_code
 * @property string $booking_date
 * @property string $start_date
 * @property string $end_date
 * @property string $status
 */
class KostAvailability extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'kost_availability';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'kost_detail_id',
        'customer_id',
        'contract_code',
        'booking_date',
        'start_date',
        'end_date',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kost_detail_id' => 'integer',
        'customer_id' => 'integer',
        'contract_code' => 'string',
        'booking_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kost_detail_id' => 'required|integer',
        'customer_id' => 'required|integer',
        'contract_code' => 'nullable|string|max:255',
        'booking_date' => 'nullable',
        'start_date' => 'nullable',
        'end_date' => 'nullable',
        'status' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function KostPaymet() {
        return $this->hasMany("App\Models\KostPaymet", 'id','kost_detail_id');
    }

    
}
