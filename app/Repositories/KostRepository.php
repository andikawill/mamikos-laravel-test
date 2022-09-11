<?php

namespace App\Repositories;

use App\Models\Kost;
use App\Repositories\BaseRepository;

/**
 * Class KostRepository
 * @package App\Repositories
 * @version September 11, 2022, 8:02 am UTC
*/

class KostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Kost::class;
    }
}
