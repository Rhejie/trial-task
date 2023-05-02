<?php

namespace Domain\Course\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class CourseResponse implements Responsable
{
    public function toResponse($course) {

        return response()->json([
            'course' => $course,
            'status_code' => 200
        ], 200);
    }
}
