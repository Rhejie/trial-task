<?php

namespace Domain\Student\Http\Controllers;

use App\Http\Controllers\Controller;
use Domain\Student\Http\Actions\DeleteStudentAction;
use Domain\Student\Http\Actions\GetStudentAction;
use Domain\Student\Http\Actions\StoreStudentAction;
use Domain\Student\Http\Actions\UpdateStudentAction;
use Domain\Student\Http\Request\StoreStudentRequest;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private GetStudentAction $getStudentAction;
    private StoreStudentAction $storeStudentAction;
    private UpdateStudentAction $updateStudentAction;
    private DeleteStudentAction $deleteStudentAction;

    public function __construct(
        GetStudentAction $getStudentAction,
        StoreStudentAction $storeStudentAction,
        UpdateStudentAction $updateStudentAction,
        DeleteStudentAction $deleteStudentAction)
    {
        $this->getStudentAction = $getStudentAction;
        $this->storeStudentAction = $storeStudentAction;
        $this->updateStudentAction = $updateStudentAction;
        $this->deleteStudentAction = $deleteStudentAction;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $page = $request->page ? $request->page : 1;
        $search = $request->search ? $request->search : null;
        $courseId = $request->course_id ? $request->course_id : null;

        $params = [
            'limit' => $limit,
            'page' => $page,
            'search' => $search,
            'courseId' => $courseId
        ];

        return $this->getStudentAction->getStudents(json_decode(json_encode($params)));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        return $this->storeStudentAction->execute($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->getStudentAction->getStudent($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request, string $id)
    {
        return $this->updateStudentAction->execute($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->deleteStudentAction->execute($id);
    }
}
