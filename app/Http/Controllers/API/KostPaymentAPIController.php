<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKostPaymentAPIRequest;
use App\Http\Requests\API\UpdateKostPaymentAPIRequest;
use App\Models\KostPayment;
use App\Repositories\KostPaymentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class KostPaymentController
 * @package App\Http\Controllers\API
 */

class KostPaymentAPIController extends AppBaseController
{
    /** @var  KostPaymentRepository */
    private $kostPaymentRepository;

    public function __construct(KostPaymentRepository $kostPaymentRepo)
    {
        $this->middleware('auth');
        $this->kostPaymentRepository = $kostPaymentRepo;
    }

    /**
     * Display a listing of the KostPayment.
     * GET|HEAD /kostPayments
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $kostPayments = $this->kostPaymentRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        $data = $kostPayments->toArray();
        $data['page'] = $request->get('skip') ?? 1;
        $data['limit'] = $request->get('limit');

        return $this->sendResponse($data, 'Kost Payments retrieved successfully');
    }

    /**
     * Store a newly created KostPayment in storage.
     * POST /kostPayments
     *
     * @param CreateKostPaymentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKostPaymentAPIRequest $request)
    {
        $input = $request->all();

        $kostPayment = $this->kostPaymentRepository->create($input);

        return $this->sendResponse($kostPayment->toArray(), 'Kost Payment saved successfully');
    }

    /**
     * Display the specified KostPayment.
     * GET|HEAD /kostPayments/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var KostPayment $kostPayment */
        $kostPayment = $this->kostPaymentRepository->find($id);

        if (empty($kostPayment)) {
            return $this->sendError('Kost Payment not found');
        }

        return $this->sendResponse($kostPayment->toArray(), 'Kost Payment retrieved successfully');
    }

    /**
     * Update the specified KostPayment in storage.
     * PUT/PATCH /kostPayments/{id}
     *
     * @param int $id
     * @param UpdateKostPaymentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKostPaymentAPIRequest $request)
    {
        $input = $request->all();

        /** @var KostPayment $kostPayment */
        $kostPayment = $this->kostPaymentRepository->find($id);

        if (empty($kostPayment)) {
            return $this->sendError('Kost Payment not found');
        }

        $kostPayment = $this->kostPaymentRepository->update($input, $id);

        return $this->sendResponse($kostPayment->toArray(), 'KostPayment updated successfully');
    }

    /**
     * Remove the specified KostPayment from storage.
     * DELETE /kostPayments/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var KostPayment $kostPayment */
        $kostPayment = $this->kostPaymentRepository->find($id);

        if (empty($kostPayment)) {
            return $this->sendError('Kost Payment not found');
        }

        $kostPayment->delete();

        return $this->sendSuccess('Kost Payment deleted successfully');
    }
}
