<?php

namespace App\Repositories;

use App\Models\KostDetail;
use App\Repositories\BaseRepository;

/**
 * Class KostDetailRepository
 * @package App\Repositories
 * @version September 11, 2022, 8:59 am UTC
*/

class KostDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return KostDetail::class;
    }
}
