<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class KostDetail
 * @package App\Models
 * @version September 11, 2022, 8:59 am UTC
 *
 * @property integer $kost_id
 * @property string $name
 * @property string $room_type
 * @property string $description
 * @property string $room_spec
 * @property string $room_facility
 * @property string $bathroom_facility
 * @property string $others_facility
 * @property string $rules
 * @property integer $price
 * @property integer $promo_price
 */
class KostDetail extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'kost_detail';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'kost_id',
        'name',
        'room_type',
        'description',
        'room_spec',
        'room_facility',
        'bathroom_facility',
        'others_facility',
        'rules',
        'price',
        'promo_price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'kost_id' => 'integer',
        'name' => 'string',
        'room_type' => 'string',
        'description' => 'string',
        'room_spec' => 'string',
        'room_facility' => 'string',
        'bathroom_facility' => 'string',
        'others_facility' => 'string',
        'rules' => 'string',
        'price' => 'integer',
        'promo_price' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'kost_id' => 'required|integer',
        'name' => 'nullable|string|max:255',
        'room_type' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'room_spec' => 'nullable|string',
        'room_facility' => 'nullable|string',
        'bathroom_facility' => 'nullable|string',
        'others_facility' => 'nullable|string',
        'rules' => 'nullable|string',
        'price' => 'nullable|integer',
        'promo_price' => 'nullable|integer',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function Kost() {
        return $this->hasOne("App\Models\Kost", 'kost_id','id');
    }

    public function KostAvailability() {
        return $this->hasOne("App\Models\KostAvailability",'id', 'kost_id');
    }

    
}
