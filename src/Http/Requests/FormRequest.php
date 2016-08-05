<?php

namespace TypiCMS\Modules\Categories\Http\Requests;

use TypiCMS\Modules\Core\Custom\Http\Requests\AbstractFormRequest;

class FormRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [
            '*.title' => 'max:255',
            '*.slug'  => 'alpha_dash|max:255',
        ];
    }
}
