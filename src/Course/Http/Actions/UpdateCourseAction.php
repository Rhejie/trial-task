<?php

namespace Domain\Course\Http\Actions;

use App\Models\Course;
use Domain\Course\Http\Resources\CourseResource;

class UpdateCourseAction
{
    public function execute($request, $id)
    {
        $course = Course::withCount(['students'])->findOrFail($id);
        $course->name = $request->name;
        $course->student_capacity = $request->student_capacity;
        $course->min_gpa = $request->min_gpa;
        $course->save();

        return new CourseResource($course);
    }
}
