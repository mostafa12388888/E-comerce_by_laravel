<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeLangages extends FormRequest
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
          'abbr'=>'required|string|max:10',
          'name'=>'required|string|max:10',
          'direction'=>'required|in:rtl,ltr',
          
        ];
    }
    public function messages()
    {
        return [
            'required'=>'هذا الحقل مطلوب',
           'in'=>'القيم المدخله غير صحيحه',
            'name.string'=>'هذا الحلقل لابد ان يكون احرف',
           
        ];
    }
}
