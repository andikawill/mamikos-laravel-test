<?php

namespace App\Repositories;

use App\Models\KostPayment;
use App\Repositories\BaseRepository;

/**
 * Class KostPaymentRepository
 * @package App\Repositories
 * @version September 11, 2022, 9:00 am UTC
*/

class KostPaymentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return KostPayment::class;
    }
}
