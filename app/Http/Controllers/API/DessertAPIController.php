<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDessertAPIRequest;
use App\Http\Requests\API\UpdateDessertAPIRequest;
use App\Models\Dessert;
use App\Repositories\DessertRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DessertController
 * @package App\Http\Controllers\API
 */

class DessertAPIController extends AppBaseController
{
    /** @var  DessertRepository */
    private $dessertRepository;

    public function __construct(DessertRepository $dessertRepo)
    {
        $this->dessertRepository = $dessertRepo;
    }

    /**
     * Display a listing of the Dessert.
     * GET|HEAD /desserts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->dessertRepository->pushCriteria(new RequestCriteria($request));
        $this->dessertRepository->pushCriteria(new LimitOffsetCriteria($request));
        $desserts = $this->dessertRepository->all();

        return $this->sendResponse($desserts->toArray(), 'Desserts retrieved successfully');
    }

    /**
     * Store a newly created Dessert in storage.
     * POST /desserts
     *
     * @param CreateDessertAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDessertAPIRequest $request)
    {
        $input = $request->all();

        $desserts = $this->dessertRepository->create($input);

        return $this->sendResponse($desserts->toArray(), 'Dessert saved successfully');
    }

    /**
     * Display the specified Dessert.
     * GET|HEAD /desserts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Dessert $dessert */
        $dessert = $this->dessertRepository->findWithoutFail($id);

        if (empty($dessert)) {
            return $this->sendError('Dessert not found');
        }

        return $this->sendResponse($dessert->toArray(), 'Dessert retrieved successfully');
    }

    /**
     * Update the specified Dessert in storage.
     * PUT/PATCH /desserts/{id}
     *
     * @param  int $id
     * @param UpdateDessertAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDessertAPIRequest $request)
    {
        $input = $request->all();

        /** @var Dessert $dessert */
        $dessert = $this->dessertRepository->findWithoutFail($id);

        if (empty($dessert)) {
            return $this->sendError('Dessert not found');
        }

        $dessert = $this->dessertRepository->update($input, $id);

        return $this->sendResponse($dessert->toArray(), 'Dessert updated successfully');
    }

    /**
     * Remove the specified Dessert from storage.
     * DELETE /desserts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Dessert $dessert */
        $dessert = $this->dessertRepository->findWithoutFail($id);

        if (empty($dessert)) {
            return $this->sendError('Dessert not found');
        }

        $dessert->delete();

        return $this->sendResponse($id, 'Dessert deleted successfully');
    }
}
