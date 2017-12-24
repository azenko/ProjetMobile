<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSandwitchRequest;
use App\Http\Requests\UpdateSandwitchRequest;
use App\Repositories\SandwitchRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SandwitchController extends AppBaseController
{
    /** @var  SandwitchRepository */
    private $sandwitchRepository;

    public function __construct(SandwitchRepository $sandwitchRepo)
    {
        $this->sandwitchRepository = $sandwitchRepo;
    }

    /**
     * Display a listing of the Sandwitch.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sandwitchRepository->pushCriteria(new RequestCriteria($request));
        $sandwitches = $this->sandwitchRepository->all();

        return view('sandwitches.index')
            ->with('sandwitches', $sandwitches);
    }

    /**
     * Show the form for creating a new Sandwitch.
     *
     * @return Response
     */
    public function create()
    {
        return view('sandwitches.create');
    }

    /**
     * Store a newly created Sandwitch in storage.
     *
     * @param CreateSandwitchRequest $request
     *
     * @return Response
     */
    public function store(CreateSandwitchRequest $request)
    {
        $input = $request->all();

        $sandwitch = $this->sandwitchRepository->create($input);

        Flash::success('Sandwitch saved successfully.');

        return redirect(route('sandwitches.index'));
    }

    /**
     * Display the specified Sandwitch.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sandwitch = $this->sandwitchRepository->findWithoutFail($id);

        if (empty($sandwitch)) {
            Flash::error('Sandwitch not found');

            return redirect(route('sandwitches.index'));
        }

        return view('sandwitches.show')->with('sandwitch', $sandwitch);
    }

    /**
     * Show the form for editing the specified Sandwitch.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sandwitch = $this->sandwitchRepository->findWithoutFail($id);

        if (empty($sandwitch)) {
            Flash::error('Sandwitch not found');

            return redirect(route('sandwitches.index'));
        }

        return view('sandwitches.edit')->with('sandwitch', $sandwitch);
    }

    /**
     * Update the specified Sandwitch in storage.
     *
     * @param  int              $id
     * @param UpdateSandwitchRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSandwitchRequest $request)
    {
        $sandwitch = $this->sandwitchRepository->findWithoutFail($id);

        if (empty($sandwitch)) {
            Flash::error('Sandwitch not found');

            return redirect(route('sandwitches.index'));
        }

        $sandwitch = $this->sandwitchRepository->update($request->all(), $id);

        Flash::success('Sandwitch updated successfully.');

        return redirect(route('sandwitches.index'));
    }

    /**
     * Remove the specified Sandwitch from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sandwitch = $this->sandwitchRepository->findWithoutFail($id);

        if (empty($sandwitch)) {
            Flash::error('Sandwitch not found');

            return redirect(route('sandwitches.index'));
        }

        $this->sandwitchRepository->delete($id);

        Flash::success('Sandwitch deleted successfully.');

        return redirect(route('sandwitches.index'));
    }
}
