<?php

namespace App\Http\Controllers\API;

use App\Models\Kost;
use App\Models\KostDetail;
use App\Models\KostAvailability;
use App\Models\KostPayment;
use App\Repositories\KostRepository;
use App\Repositories\KostDetailRepository;
use App\Repositories\KostAvailabilityRepository;
use App\Repositories\KostPaymentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class HomeController
 * @package App\Http\Controllers\API
 */

class HomeAPIController extends AppBaseController
{
    /** @var  KostRepository */
    private $kostRepository;
    /** @var  KostDetailRepository */
    private $kostDetailRepository;
    /** @var  KostAvailabilityRepository */
    private $kostAvailabilityRepository;
    /** @var  KostPaymentRepository */
    private $kostPaymentRepository;

    public function __construct(
        kostRepository $kostRepo,
        kostDetailRepository $kostDetailRepo,
        kostAvailabilityRepository $kostAvailabilityRepo,
        kostPaymentRepository $kostPaymentRepo
    ) {
        $this->kostRepository = $kostRepo;
        $this->kostDetailRepository = $kostDetailRepo;
        $this->kostAvailabilityRepository = $kostAvailabilityRepo;
        $this->kostPaymentRepository = $kostPaymentRepo;
    }

    /**
     * Display a listing of the Home.
     * GET|HEAD /home
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = $this->kostRepository->all(
            $request->except(["skip", "limit"]),
            $request->get("skip"),
            $request->get("limit")
        );

        return $this->sendResponse($data, "Data retrieved successfully");
    }
}
