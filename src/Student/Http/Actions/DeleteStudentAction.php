<?php

namespace Domain\Student\Http\Actions;

use App\Models\Student;
use App\Response\DeleteResponse;

class DeleteStudentAction
{
    public function execute($id, $request = null)
    {
        Student::findOrFail($id)->delete();

        return new DeleteResponse($request);
    }
}
