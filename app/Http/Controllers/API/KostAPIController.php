<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKostAPIRequest;
use App\Http\Requests\API\UpdateKostAPIRequest;
use App\Models\Kost;
use App\Repositories\KostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class KostController
 * @package App\Http\Controllers\API
 */

class KostAPIController extends AppBaseController
{
    /** @var  KostRepository */
    private $kostRepository;

    public function __construct(KostRepository $kostRepo)
    {
        $this->middleware('auth');
        $this->kostRepository = $kostRepo;
    }

    /**
     * Display a listing of the Kost.
     * GET|HEAD /kosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $kosts = $this->kostRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        $data = $kosts->toArray();
        $data['page'] = $request->get('skip') ?? 1;
        $data['limit'] = $request->get('limit');


        return $this->sendResponse($data, 'Kosts retrieved successfully');
    }

    /**
     * Store a newly created Kost in storage.
     * POST /kosts
     *
     * @param CreateKostAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateKostAPIRequest $request)
    {
        $input = $request->all();

        $kost = $this->kostRepository->create($input);

        return $this->sendResponse($kost->toArray(), 'Kost saved successfully');
    }

    /**
     * Display the specified Kost.
     * GET|HEAD /kosts/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Kost $kost */
        $kost = $this->kostRepository->find($id);

        if (empty($kost)) {
            return $this->sendError('Kost not found');
        }

        return $this->sendResponse($kost->toArray(), 'Kost retrieved successfully');
    }

    /**
     * Update the specified Kost in storage.
     * PUT/PATCH /kosts/{id}
     *
     * @param int $id
     * @param UpdateKostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKostAPIRequest $request)
    {
        $input = $request->all();

        /** @var Kost $kost */
        $kost = $this->kostRepository->find($id);

        if (empty($kost)) {
            return $this->sendError('Kost not found');
        }

        $kost = $this->kostRepository->update($input, $id);

        return $this->sendResponse($kost->toArray(), 'Kost updated successfully');
    }

    /**
     * Remove the specified Kost from storage.
     * DELETE /kosts/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Kost $kost */
        $kost = $this->kostRepository->find($id);

        if (empty($kost)) {
            return $this->sendError('Kost not found');
        }

        $kost->delete();

        return $this->sendSuccess('Kost deleted successfully');
    }
}
