<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddPlace extends Request
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
            'place_title' => 'required',
            'place_desc' => 'required',
            'place_address' => 'required',
            'contact' => 'required',
            'category_group_id' => 'required',
            'category_id' => 'required',
            'map_longitude' => 'required',
            'map_latitude' => 'required',
            'location_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
        ];
    }
}
