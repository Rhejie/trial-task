<?php

namespace Domain\Course\Http\Resources;

use Domain\Student\Http\Resources\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'student_capacity' => $this->student_capacity,
            'min_gpa' => $this->min_gpa,
            'students' => StudentResource::collection($this->whenLoaded('students')),
            'students_count' => $this->whenCounted('students'),
        ];
    }
}
