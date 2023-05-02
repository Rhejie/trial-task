<?php

namespace Domain\Course\Http\Actions;

use App\Models\Course;
use App\Models\CourseStudent;
use Domain\Student\Http\Actions\StoreStudentAction;

class StoreCourseStudentAction
{
    public function execute($request)
    {
        if($request->student_id) {
            return $this->storeCourseStudent($request->course_id, $request->student_id);
        }
        else {
            $studentProfile = [
                'name' => $request->student_name,
                'gpa' => $request->student_gpa,
            ];

            $student = (new StoreStudentAction)->execute(json_decode(json_encode($studentProfile)));
            return $this->storeCourseStudent($request->course_id, $student->id);
        }
    }

    private function storeCourseStudent($courseId, $studentId)
    {
        $course = Course::find($courseId);
        $course->students()->attach($studentId);

        return (new GetCourseAction)->getCourse($courseId);
    }
}
