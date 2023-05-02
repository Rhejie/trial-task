<?php

namespace Domain\Student\Http\Actions;

use App\Models\Student;
use Domain\Student\Http\Resources\StudentResource;

class UpdateStudentAction
{
    public function execute($request, $id)
    {
        $student = Student::withCount(['courses'])->findOrFail($id);
        $student->name = $request->name;
        $student->gpa = $request->gpa;
        $student->save();

        return new StudentResource($student);
    }
}
