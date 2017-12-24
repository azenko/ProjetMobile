<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDessertRequest;
use App\Http\Requests\UpdateDessertRequest;
use App\Repositories\DessertRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DessertController extends AppBaseController
{
    /** @var  DessertRepository */
    private $dessertRepository;

    public function __construct(DessertRepository $dessertRepo)
    {
        $this->dessertRepository = $dessertRepo;
    }

    /**
     * Display a listing of the Dessert.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->dessertRepository->pushCriteria(new RequestCriteria($request));
        $desserts = $this->dessertRepository->all();

        return view('desserts.index')
            ->with('desserts', $desserts);
    }

    /**
     * Show the form for creating a new Dessert.
     *
     * @return Response
     */
    public function create()
    {
        return view('desserts.create');
    }

    /**
     * Store a newly created Dessert in storage.
     *
     * @param CreateDessertRequest $request
     *
     * @return Response
     */
    public function store(CreateDessertRequest $request)
    {
        $input = $request->all();

        $dessert = $this->dessertRepository->create($input);

        Flash::success('Dessert saved successfully.');

        return redirect(route('desserts.index'));
    }

    /**
     * Display the specified Dessert.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dessert = $this->dessertRepository->findWithoutFail($id);

        if (empty($dessert)) {
            Flash::error('Dessert not found');

            return redirect(route('desserts.index'));
        }

        return view('desserts.show')->with('dessert', $dessert);
    }

    /**
     * Show the form for editing the specified Dessert.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dessert = $this->dessertRepository->findWithoutFail($id);

        if (empty($dessert)) {
            Flash::error('Dessert not found');

            return redirect(route('desserts.index'));
        }

        return view('desserts.edit')->with('dessert', $dessert);
    }

    /**
     * Update the specified Dessert in storage.
     *
     * @param  int              $id
     * @param UpdateDessertRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDessertRequest $request)
    {
        $dessert = $this->dessertRepository->findWithoutFail($id);

        if (empty($dessert)) {
            Flash::error('Dessert not found');

            return redirect(route('desserts.index'));
        }

        $dessert = $this->dessertRepository->update($request->all(), $id);

        Flash::success('Dessert updated successfully.');

        return redirect(route('desserts.index'));
    }

    /**
     * Remove the specified Dessert from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dessert = $this->dessertRepository->findWithoutFail($id);

        if (empty($dessert)) {
            Flash::error('Dessert not found');

            return redirect(route('desserts.index'));
        }

        $this->dessertRepository->delete($id);

        Flash::success('Dessert deleted successfully.');

        return redirect(route('desserts.index'));
    }
}
