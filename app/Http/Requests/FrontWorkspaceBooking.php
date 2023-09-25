<?php

namespace App\Http\Requests;

use App\Rules\AfterNow;
use App\Rules\AfterNowHour;
use App\Rules\WorkspaceAvailable;
use Illuminate\Foundation\Http\FormRequest;

class FrontWorkspaceBooking extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return[
            'booking_datetime' => ['required', new AfterNow],
            'startAt' => ['required', 'date_format:H:i', new AfterNowHour],
            'endAt' => ['required', 'date_format:H:i', 'after:startAt', new WorkspaceAvailable],
        ];
    }
}
