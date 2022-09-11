<?php

namespace App\Repositories;

use App\Models\KostAvailability;
use App\Repositories\BaseRepository;

/**
 * Class KostAvailabilityRepository
 * @package App\Repositories
 * @version September 11, 2022, 8:59 am UTC
*/

class KostAvailabilityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'kost_detail_id',
        'customer_id',
        'contract_code',
        'booking_date',
        'start_date',
        'end_date',
        'status'
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
        return KostAvailability::class;
    }
}
