<?php

namespace Domain\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Domain\Course\Http\Actions\DeleteCourseAction;
use Domain\Course\Http\Actions\GetCourseAction;
use Domain\Course\Http\Actions\StoreCourseAction;
use Domain\Course\Http\Actions\StoreCourseStudentAction;
use Domain\Course\Http\Actions\UpdateCourseAction;
use Domain\Course\Http\Request\EnrollStudentRequest;
use Domain\Course\Http\Request\StoreCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private GetCourseAction $getCourseAction;
    private StoreCourseAction $storeCourseAction;
    private UpdateCourseAction $updateCourseAction;
    private DeleteCourseAction $deleteCourseAction;
    private StoreCourseStudentAction $storeCourseStudentAction;

    public function __construct(
        GetCourseAction $getCourseAction,
        StoreCourseAction $storeCourseAction,
        UpdateCourseAction $updateCourseAction,
        DeleteCourseAction $deleteCourseAction,
        StoreCourseStudentAction $storeCourseStudentAction
    ) {
        $this->getCourseAction = $getCourseAction;
        $this->storeCourseAction = $storeCourseAction;
        $this->updateCourseAction = $updateCourseAction;
        $this->deleteCourseAction = $deleteCourseAction;
        $this->storeCourseStudentAction = $storeCourseStudentAction;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->getCourseAction->getCourses($request);
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
    public function store(StoreCourseRequest $request)
    {
        return $this->storeCourseAction->execute($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->getCourseAction->getCourse($id);
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
    public function update(StoreCourseRequest $request, string $id)
    {
        return $this->updateCourseAction->execute($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        return $this->deleteCourseAction->execute($id);
    }

    public function enrollStudent(EnrollStudentRequest $request)
    {
        return $this->storeCourseStudentAction->execute($request);
    }

}
