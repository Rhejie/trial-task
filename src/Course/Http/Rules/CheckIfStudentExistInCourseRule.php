<?php

namespace Domain\Course\Http\Rules;

use App\Models\Course;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckIfStudentExistInCourseRule implements ValidationRule
{
    private $courseId;
    private $studentId;

    public function __construct($courseId, $studentId)
    {
        $this->courseId = $courseId;
        $this->studentId = $studentId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $studentId = $this->studentId;
        $course = Course::with('students')
            ->whereHas('students', function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })->find($this->courseId);

        if($course && $course->id) {
            $fail('This student already enrolled to this course.');
        }

    }
}
