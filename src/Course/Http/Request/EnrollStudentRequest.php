<?php

namespace Domain\Course\Http\Request;

use Domain\Course\Http\Rules\CheckIfStudentExistInCourseRule;
use Domain\Course\Http\Rules\CourseEnrolledRule;
use Domain\Course\Http\Rules\EnrollStudentGPARule;
use Illuminate\Foundation\Http\FormRequest;

class EnrollStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'student_gpa' => ['required', new EnrollStudentGPARule($this->course_id)],
            'course' => [new CourseEnrolledRule($this->course_id)],
            'student_name' => ['required', new CheckIfStudentExistInCourseRule($this->course_id, $this->student_id)],
        ];
    }
}
