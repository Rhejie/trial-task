<?php

namespace Domain\Course\Http\Rules;

use Closure;
use Domain\Course\Http\Actions\GetCourseAction;
use Illuminate\Contracts\Validation\ValidationRule;

class EnrollStudentGPARule implements ValidationRule
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

        if ($course->min_gpa > $value) {
            $fail('The :attribute must be higher or equal to course GPA requirement.');
        }
    }
}
