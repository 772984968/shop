<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ActivityFrom extends CommonFrom
{
     public function rules()
    {
        return [
            'title'=>'required',
            'title_url'=>'required',
            'explanation'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
        ];
    }
}
