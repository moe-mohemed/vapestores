<?php

namespace App\Http\Requests;

use App\Store;
use App\Http\Requests\Request;

class ManageStoreRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        dd($this->all());
        return Store::where([
            'id' => $this->id,
            'managed_by' => $this->user()->id
        ])->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp,gif'
        ];
    }
}
