<?php

namespace App\Http\Requests;

use App\Rules\Ilike;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => [
                'required',
                'between:1,20',
                new Ilike('roles', 'name', $this->input('id'))
            ],
            'permission'  => 'required',
            'description' => 'required|between:0,80'
        ];
    }
}
