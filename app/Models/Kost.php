<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Kost
 * @package App\Models
 * @version September 11, 2022, 8:02 am UTC
 *
 * @property integer $user_id
 * @property string $name
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $sub_district
 * @property string $address
 * @property string $description
 */
class Kost extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'kost';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'name',
        'province',
        'city',
        'district',
        'sub_district',
        'address',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'name' => 'string',
        'province' => 'string',
        'city' => 'string',
        'district' => 'string',
        'sub_district' => 'string',
        'address' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|integer',
        'name' => 'nullable|string|max:255',
        'province' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'district' => 'nullable|string|max:255',
        'sub_district' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'deleted_at' => 'nullable'
    ];

    public function KostDetail() {
        return $this->hasMany("App\Models\KostDetail", 'id','kost_id');
    }
    
}
