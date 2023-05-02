<?php

namespace Domain\Course\Http\Rules;

use Closure;
use Domain\Course\Http\Actions\GetCourseAction;
use Illuminate\Contracts\Validation\ValidationRule;

class CourseEnrolledRule implements ValidationRule
{
    private $courseId;
    private GetCourseAction $getCourseAction;
    public function __construct($courseId)
    {
        $this->courseId = $courseId;
        $this->getCourseAction = new GetCourseAction();
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $course = $this->getCourseAction->getCourse($this->courseId);

        $courseCapacity = $course->student_capacity;
        $numberOfEnrolledStudent = $course->students_count;

        if($courseCapacity < $numberOfEnrolledStudent + 1) {
            $fail('The :attribute capacity has reached the limit.');
        }
    }
}
