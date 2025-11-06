<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class BookingStoreRequest extends FormRequest
{
    
    public function authorize()
    {
        return true; 
    }


    public function rules()
    {
        return [
            'tour_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\s\-\.,]+$/u' 
            ],
            'hunter_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s\.\-]+$/u' 
            ],
            'guide_id' => [
                'required',
                'integer',
                'exists:guides,id'
            ],
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d H:i',
                'after:' . Carbon::tomorrow()->toDateString(), 
                'before:' . Carbon::now()->addMonths(6)->toDateString() 
            ],
            'participants_count' => [
                'required',
                'integer',
                'between:1,10', 
                'gt:0' 
            ],
        ];
    }

    public function messages()
    {
        return [
            'tour_name.required' => 'The tour name is required.',
            'tour_name.string' => 'The tour name must be a string.',
            'tour_name.max' => 'The tour name may not be greater than 255 characters.',
            'tour_name.regex' => 'The tour name may only contain letters, numbers, spaces, hyphens, dots, and commas.',
            
            'hunter_name.required' => 'The hunter name is required.',
            'hunter_name.string' => 'The hunter name must be a string.',
            'hunter_name.max' => 'The hunter name may not be greater than 255 characters.',
            'hunter_name.regex' => 'The hunter name may only contain letters, spaces, dots, and hyphens.',
            
            'guide_id.required' => 'The guide ID is required.',
            'guide_id.integer' => 'The guide ID must be an integer.',
            'guide_id.exists' => 'The selected guide is invalid.',
            'guide_id.not_in' => 'The selected guide is invalid.',
            
            'date.required' => 'The booking date is required.',
            'date.date' => 'The booking date is not a valid date.',
            'date.date_format' => 'The date must be in YYYY-MM-DD format.',
            'date.after' => 'The booking date must be at least tomorrow.',
            'date.before' => 'The booking date must be within 6 months from now.',
            
            'participants_count.required' => 'The number of participants is required.',
            'participants_count.integer' => 'The number of participants must be an integer.',
            'participants_count.between' => 'The number of participants must be between 1 and 10.',
            'participants_count.gt' => 'The number of participants must be at least 1.',
            
        ];
    }


    public function attributes()
    {
        return [
            'tour_name' => 'tour name',
            'hunter_name' => 'hunter name',
            'guide_id' => 'guide',
            'date' => 'booking date',
            'participants_count' => 'number of participants',
            'special_requests' => 'special requests'
        ];
    }


    protected function prepareForValidation()
    {

        $this->merge([
            'tour_name' => trim($this->tour_name),
            'hunter_name' => trim($this->hunter_name),
            'special_requests' => trim($this->special_requests),
        ]);
    }
}
