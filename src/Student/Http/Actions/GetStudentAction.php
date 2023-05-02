<?php

namespace Domain\Student\Http\Actions;

use App\Models\Student;
use Domain\Student\Http\Resources\StudentResource;

class GetStudentAction
{
    public function getStudents($params)
    {
        $students = Student::with(['courses'])
            ->withCount(['courses'])
            ->when($params->search, function ($query) use ($params) {
                return $query->where('name', 'LIKE', "%$params->search%");
            })
            // if course id exist it will display all students belongs the course id
            ->when($params->courseId, function ($query) use ($params) {
                return $query->whereHas('courses', function ($query) use ($params) {
                    $query->where('course_id', $params->courseId);
                });
            })
            ->orderByDesc('updated_at')
            ->paginate($params->limit, ['*'], 'page', $params->page);

        return StudentResource::collection($students);
    }

    public function getStudent($id)
    {
        $student = Student::findOrFail($id);

        return new StudentResource($student);
    }
}
