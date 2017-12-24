<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBoissonRequest;
use App\Http\Requests\UpdateBoissonRequest;
use App\Repositories\BoissonRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BoissonController extends AppBaseController
{
    /** @var  BoissonRepository */
    private $boissonRepository;

    public function __construct(BoissonRepository $boissonRepo)
    {
        $this->boissonRepository = $boissonRepo;
    }

    /**
     * Display a listing of the Boisson.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->boissonRepository->pushCriteria(new RequestCriteria($request));
        $boissons = $this->boissonRepository->all();

        return view('boissons.index')
            ->with('boissons', $boissons);
    }

    /**
     * Show the form for creating a new Boisson.
     *
     * @return Response
     */
    public function create()
    {
        return view('boissons.create');
    }

    /**
     * Store a newly created Boisson in storage.
     *
     * @param CreateBoissonRequest $request
     *
     * @return Response
     */
    public function store(CreateBoissonRequest $request)
    {
        $input = $request->all();

        $boisson = $this->boissonRepository->create($input);

        Flash::success('Boisson saved successfully.');

        return redirect(route('boissons.index'));
    }

    /**
     * Display the specified Boisson.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $boisson = $this->boissonRepository->findWithoutFail($id);

        if (empty($boisson)) {
            Flash::error('Boisson not found');

            return redirect(route('boissons.index'));
        }

        return view('boissons.show')->with('boisson', $boisson);
    }

    /**
     * Show the form for editing the specified Boisson.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $boisson = $this->boissonRepository->findWithoutFail($id);

        if (empty($boisson)) {
            Flash::error('Boisson not found');

            return redirect(route('boissons.index'));
        }

        return view('boissons.edit')->with('boisson', $boisson);
    }

    /**
     * Update the specified Boisson in storage.
     *
     * @param  int              $id
     * @param UpdateBoissonRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBoissonRequest $request)
    {
        $boisson = $this->boissonRepository->findWithoutFail($id);

        if (empty($boisson)) {
            Flash::error('Boisson not found');

            return redirect(route('boissons.index'));
        }

        $boisson = $this->boissonRepository->update($request->all(), $id);

        Flash::success('Boisson updated successfully.');

        return redirect(route('boissons.index'));
    }

    /**
     * Remove the specified Boisson from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $boisson = $this->boissonRepository->findWithoutFail($id);

        if (empty($boisson)) {
            Flash::error('Boisson not found');

            return redirect(route('boissons.index'));
        }

        $this->boissonRepository->delete($id);

        Flash::success('Boisson deleted successfully.');

        return redirect(route('boissons.index'));
    }
}
