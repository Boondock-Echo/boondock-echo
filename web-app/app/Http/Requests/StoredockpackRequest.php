<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoredockpackRequest extends FormRequest
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
            // 'pack_id' => 'required|integer',
            'name' => 'required|string|max:44',
            'description' => 'nullable|string|max:281',
            'owner' => 'nullable|integer',
            'enabled' => 'nullable|boolean'
        ];
    }
}
