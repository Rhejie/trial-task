<?php

namespace Domain\Course\Http\Actions;

use App\Models\Course;
use Domain\Course\Http\Resources\CourseResource;

class GetCourseAction
{
    public function getCourse($id)
    {
        $course = Course::withCount(['students'])->findOrFail($id);

        return new CourseResource($course);
    }

    public function getCourses($params)
    {
        $courses = Course::
            withCount('students')
            ->when($params->search,
                function ($query) use ($params)
                    {
                        return $query->where('name', 'LIKE', "%$params->search%");
                   })
            ->orderByDesc('updated_at')
            ->paginate($params->limit, ['*'], 'page', $params->page);


        return CourseResource::collection($courses);
    }
}
