<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSandwitchAPIRequest;
use App\Http\Requests\API\UpdateSandwitchAPIRequest;
use App\Models\Sandwitch;
use App\Repositories\SandwitchRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SandwitchController
 * @package App\Http\Controllers\API
 */

class SandwitchAPIController extends AppBaseController
{
    /** @var  SandwitchRepository */
    private $sandwitchRepository;

    public function __construct(SandwitchRepository $sandwitchRepo)
    {
        $this->sandwitchRepository = $sandwitchRepo;
    }

    /**
     * Display a listing of the Sandwitch.
     * GET|HEAD /sandwitches
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sandwitchRepository->pushCriteria(new RequestCriteria($request));
        $this->sandwitchRepository->pushCriteria(new LimitOffsetCriteria($request));
        $sandwitches = $this->sandwitchRepository->all();

        return $this->sendResponse($sandwitches->toArray(), 'Sandwitches retrieved successfully');
    }

    /**
     * Store a newly created Sandwitch in storage.
     * POST /sandwitches
     *
     * @param CreateSandwitchAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSandwitchAPIRequest $request)
    {
        $input = $request->all();

        $sandwitches = $this->sandwitchRepository->create($input);

        return $this->sendResponse($sandwitches->toArray(), 'Sandwitch saved successfully');
    }

    /**
     * Display the specified Sandwitch.
     * GET|HEAD /sandwitches/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Sandwitch $sandwitch */
        $sandwitch = $this->sandwitchRepository->findWithoutFail($id);

        if (empty($sandwitch)) {
            return $this->sendError('Sandwitch not found');
        }

        return $this->sendResponse($sandwitch->toArray(), 'Sandwitch retrieved successfully');
    }

    /**
     * Update the specified Sandwitch in storage.
     * PUT/PATCH /sandwitches/{id}
     *
     * @param  int $id
     * @param UpdateSandwitchAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSandwitchAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sandwitch $sandwitch */
        $sandwitch = $this->sandwitchRepository->findWithoutFail($id);

        if (empty($sandwitch)) {
            return $this->sendError('Sandwitch not found');
        }

        $sandwitch = $this->sandwitchRepository->update($input, $id);

        return $this->sendResponse($sandwitch->toArray(), 'Sandwitch updated successfully');
    }

    /**
     * Remove the specified Sandwitch from storage.
     * DELETE /sandwitches/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Sandwitch $sandwitch */
        $sandwitch = $this->sandwitchRepository->findWithoutFail($id);

        if (empty($sandwitch)) {
            return $this->sendError('Sandwitch not found');
        }

        $sandwitch->delete();

        return $this->sendResponse($id, 'Sandwitch deleted successfully');
    }
}
