<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //ketentuan input untuk table product
            "title" => "required",
            "status" => "required",
            "description" => "required",
            "image" => "image|mimes:png,jpg,jpeg|max:4000",
            "price" => "required|numeric",
            "weight" => "required|numeric"


        ];
    }
}
