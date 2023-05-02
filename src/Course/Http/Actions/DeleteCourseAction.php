<?php

namespace Domain\Course\Http\Actions;

use App\Models\Course;
use App\Response\DeleteResponse;

class DeleteCourseAction
{
    public function execute($id, $request = null)
    {
        Course::findOrFail($id)->delete();

        return new DeleteResponse($request);
    }
}
