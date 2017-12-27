<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBoissonAPIRequest;
use App\Http\Requests\API\UpdateBoissonAPIRequest;
use App\Models\Boisson;
use App\Repositories\BoissonRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BoissonController
 * @package App\Http\Controllers\API
 */

class BoissonAPIController extends AppBaseController
{
    /** @var  BoissonRepository */
    private $boissonRepository;

    public function __construct(BoissonRepository $boissonRepo)
    {
        $this->boissonRepository = $boissonRepo;
    }

    /**
     * Display a listing of the Boisson.
     * GET|HEAD /boissons
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->boissonRepository->pushCriteria(new RequestCriteria($request));
        $this->boissonRepository->pushCriteria(new LimitOffsetCriteria($request));
        $boissons = $this->boissonRepository->all();

        return $this->sendResponse($boissons->toArray(), 'Boissons retrieved successfully');
    }

    /**
     * Store a newly created Boisson in storage.
     * POST /boissons
     *
     * @param CreateBoissonAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateBoissonAPIRequest $request)
    {
        $input = $request->all();

        $boissons = $this->boissonRepository->create($input);

        return $this->sendResponse($boissons->toArray(), 'Boisson saved successfully');
    }

    /**
     * Display the specified Boisson.
     * GET|HEAD /boissons/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Boisson $boisson */
        $boisson = $this->boissonRepository->findWithoutFail($id);

        if (empty($boisson)) {
            return $this->sendError('Boisson not found');
        }

        return $this->sendResponse($boisson->toArray(), 'Boisson retrieved successfully');
    }

    /**
     * Update the specified Boisson in storage.
     * PUT/PATCH /boissons/{id}
     *
     * @param  int $id
     * @param UpdateBoissonAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBoissonAPIRequest $request)
    {
        $input = $request->all();

        /** @var Boisson $boisson */
        $boisson = $this->boissonRepository->findWithoutFail($id);

        if (empty($boisson)) {
            return $this->sendError('Boisson not found');
        }

        $boisson = $this->boissonRepository->update($input, $id);

        return $this->sendResponse($boisson->toArray(), 'Boisson updated successfully');
    }

    /**
     * Remove the specified Boisson from storage.
     * DELETE /boissons/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Boisson $boisson */
        $boisson = $this->boissonRepository->findWithoutFail($id);

        if (empty($boisson)) {
            return $this->sendError('Boisson not found');
        }

        $boisson->delete();

        return $this->sendResponse($id, 'Boisson deleted successfully');
    }
}
