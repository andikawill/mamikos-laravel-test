<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKostDetailAPIRequest;
use App\Http\Requests\API\UpdateKostDetailAPIRequest;
use App\Models\KostDetail;
use App\Repositories\KostDetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class KostDetailController
 * @package App\Http\Controllers\API
 */

class KostDetailAPIController extends AppBaseController
{
    /** @var  KostDetailRepository */
    private $kostDetailRepository;

    public function __construct(KostDetailRepository $kostDetailRepo)
    {
        $this->middleware('auth');
        $this->kostDetailRepository = $kostDetailRepo;
    }

    /**
     * Display a listing of the KostDetail.
     * GET|HEAD /kostDetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $kostDetails = $this->kostDetailRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        $data = $kostDetails->toArray();
        $data['page'] = $request->get('skip') ?? 1;
        $data['limit'] = $request->get('limit');

        return $this->sendResponse($data, 'Kost Details retrieved successfully');
    }

    /**
     * Store a newly created KostDetail in storage.
     * POST /kostDetails
     *
     * @param CreateKostDetailAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKostDetailAPIRequest $request)
    {
        $input = $request->all();

        $kostDetail = $this->kostDetailRepository->create($input);

        return $this->sendResponse($kostDetail->toArray(), 'Kost Detail saved successfully');
    }

    /**
     * Display the specified KostDetail.
     * GET|HEAD /kostDetails/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var KostDetail $kostDetail */
        $kostDetail = $this->kostDetailRepository->find($id);

        if (empty($kostDetail)) {
            return $this->sendError('Kost Detail not found');
        }

        return $this->sendResponse($kostDetail->toArray(), 'Kost Detail retrieved successfully');
    }

    /**
     * Update the specified KostDetail in storage.
     * PUT/PATCH /kostDetails/{id}
     *
     * @param int $id
     * @param UpdateKostDetailAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKostDetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var KostDetail $kostDetail */
        $kostDetail = $this->kostDetailRepository->find($id);

        if (empty($kostDetail)) {
            return $this->sendError('Kost Detail not found');
        }

        $kostDetail = $this->kostDetailRepository->update($input, $id);

        return $this->sendResponse($kostDetail->toArray(), 'KostDetail updated successfully');
    }

    /**
     * Remove the specified KostDetail from storage.
     * DELETE /kostDetails/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var KostDetail $kostDetail */
        $kostDetail = $this->kostDetailRepository->find($id);

        if (empty($kostDetail)) {
            return $this->sendError('Kost Detail not found');
        }

        $kostDetail->delete();

        return $this->sendSuccess('Kost Detail deleted successfully');
    }
}
