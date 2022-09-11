<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKostAvailabilityAPIRequest;
use App\Http\Requests\API\UpdateKostAvailabilityAPIRequest;
use App\Models\KostAvailability;
use App\Repositories\KostAvailabilityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class KostAvailabilityController
 * @package App\Http\Controllers\API
 */

class KostAvailabilityAPIController extends AppBaseController
{
    /** @var  KostAvailabilityRepository */
    private $kostAvailabilityRepository;

    public function __construct(KostAvailabilityRepository $kostAvailabilityRepo)
    {
        $this->middleware('auth');
        $this->kostAvailabilityRepository = $kostAvailabilityRepo;
    }

    /**
     * Display a listing of the KostAvailability.
     * GET|HEAD /kostAvailabilities
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $kostAvailabilities = $this->kostAvailabilityRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        ); 

        $data = $kostAvailabilities->toArray();
        $data['page'] = $request->get('skip') ?? 1;
        $data['limit'] = $request->get('limit');

        return $this->sendResponse($data, 'Kost Availabilities retrieved successfully');
    }

    /**
     * Store a newly created KostAvailability in storage.
     * POST /kostAvailabilities
     *
     * @param CreateKostAvailabilityAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKostAvailabilityAPIRequest $request)
    {
        $input = $request->all();

        $kostAvailability = $this->kostAvailabilityRepository->create($input);

        return $this->sendResponse($kostAvailability->toArray(), 'Kost Availability saved successfully');
    }

    /**
     * Display the specified KostAvailability.
     * GET|HEAD /kostAvailabilities/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var KostAvailability $kostAvailability */
        $kostAvailability = $this->kostAvailabilityRepository->find($id);

        if (empty($kostAvailability)) {
            return $this->sendError('Kost Availability not found');
        }

        return $this->sendResponse($kostAvailability->toArray(), 'Kost Availability retrieved successfully');
    }

    /**
     * Update the specified KostAvailability in storage.
     * PUT/PATCH /kostAvailabilities/{id}
     *
     * @param int $id
     * @param UpdateKostAvailabilityAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKostAvailabilityAPIRequest $request)
    {
        $input = $request->all();

        /** @var KostAvailability $kostAvailability */
        $kostAvailability = $this->kostAvailabilityRepository->find($id);

        if (empty($kostAvailability)) {
            return $this->sendError('Kost Availability not found');
        }

        $kostAvailability = $this->kostAvailabilityRepository->update($input, $id);

        return $this->sendResponse($kostAvailability->toArray(), 'KostAvailability updated successfully');
    }

    /**
     * Remove the specified KostAvailability from storage.
     * DELETE /kostAvailabilities/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var KostAvailability $kostAvailability */
        $kostAvailability = $this->kostAvailabilityRepository->find($id);

        if (empty($kostAvailability)) {
            return $this->sendError('Kost Availability not found');
        }

        $kostAvailability->delete();

        return $this->sendSuccess('Kost Availability deleted successfully');
    }
}
