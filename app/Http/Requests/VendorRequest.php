<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'logo'=>'required_without:id|mimes:jpg,jpeg,png',
           'name'=>'required|string|max:100',
           'mobile'=>'required|max:100|unique:vendors,mobile,'.$this->id,
           //required|numeric|phone_number|size:11
           'email'=>'required|email|unique:vendors,email,'.$this->id, 
        'category_id'=>'required|exists:main_catagories,id',
        'address'=>'required|string|max:500',
        'password'=>'required_without:id',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'هذا الحقل موجود',
            'max'=>'هذا الحقل طويل',
            'email.email'=>'صيغه البريد الاكتروني غير صحيحه ',
            'category_id.exists'=>'هذا القصم غير موجود ',
            'adress.string'=>'العنوان لابد ان يكون حروف و ارقام',
            'name.strig'=>'الاسم لابد ان يكون حروف',
            'logo.required_without'=>'الصوره مطلوبه',
        ];
    }
}
