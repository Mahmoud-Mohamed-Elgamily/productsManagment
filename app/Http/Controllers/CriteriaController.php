<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;
use App\Repositories\CriteriaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class CriteriaController extends AppBaseController
{
  /** @var  CriteriaRepository */
  private $criteriaRepository;

  public function __construct(CriteriaRepository $criteriaRepo)
  {
    $this->criteriaRepository = $criteriaRepo;
  }

  /**
   * Display a listing of the Criteria.
   *
   * @param Request $request
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $criterias = $this->criteriaRepository->all();
    // dd($criterias);
    return view('criterias.index')
      ->with('criterias', $criterias);
  }

  /**
   * Show the form for creating a new Criteria.
   *
   * @return Response
   */
  public function create()
  {
    return view('criterias.create');
  }

  /**
   * Store a newly created Criteria in storage.
   *
   * @param CreateCriteriaRequest $request
   *
   * @return Response
   */
  public function store(CreateCriteriaRequest $request)
  {
    $details = $request->request->get('details');
    $input = $request->all();
    // dd($input);

    $criteria = $this->criteriaRepository->create($input);
    if (gettype($details) == 'string')
      $criteria->update(['details' => [$details]]);

    Flash::success('Criteria saved successfully.');

    return redirect(route('criterias.index'));
  }

  /**
   * Display the specified Criteria.
   *
   * @param int $id
   *
   * @return Response
   */
  public function show($id)
  {
    $criteria = $this->criteriaRepository->find($id);

    if (empty($criteria)) {
      Flash::error('Criteria not found');

      return redirect(route('criterias.index'));
    }

    return view('criterias.show')->with('criteria', $criteria);
  }

  /**
   * Show the form for editing the specified Criteria.
   *
   * @param int $id
   *
   * @return Response
   */
  public function edit($id)
  {
    $criteria = $this->criteriaRepository->find($id);

    if (empty($criteria)) {
      Flash::error('Criteria not found');

      return redirect(route('criterias.index'));
    }

    return view('criterias.edit')->with('criteria', $criteria);
  }

  /**
   * Update the specified Criteria in storage.
   *
   * @param int $id
   * @param UpdateCriteriaRequest $request
   *
   * @return Response
   */
  public function update($id, UpdateCriteriaRequest $request)
  {
    $criteria = $this->criteriaRepository->find($id);

    if (empty($criteria)) {
      Flash::error('Criteria not found');

      return redirect(route('criterias.index'));
    }

    $criteria = $this->criteriaRepository->update($request->all(), $id);

    Flash::success('Criteria updated successfully.');

    return redirect(route('criterias.index'));
  }

  /**
   * Remove the specified Criteria from storage.
   *
   * @param int $id
   *
   * @throws \Exception
   *
   * @return Response
   */
  public function destroy($id)
  {
    $criteria = $this->criteriaRepository->find($id);

    if (empty($criteria)) {
      Flash::error('Criteria not found');

      return redirect(route('criterias.index'));
    }

    $this->criteriaRepository->delete($id);

    Flash::success('Criteria deleted successfully.');

    return redirect(route('criterias.index'));
  }

  public function getDetails($id)
  {

    $criteria = $this->criteriaRepository->find(explode(',',$id));
    if (empty($criteria)) {
      return response()->json('failed to find this criteria', 401);
    }
    return response()->json($criteria, 200);
  }
}
