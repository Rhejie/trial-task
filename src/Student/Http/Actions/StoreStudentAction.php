<?php

namespace Domain\Student\Http\Actions;

use App\Models\Student;
use Domain\Student\Http\Resources\StudentResource;

class StoreStudentAction
{
    public function execute($request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->gpa = $request->gpa;
        $student->save();

        return new StudentResource($student);
    }
}
