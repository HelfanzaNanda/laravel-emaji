<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email', 'unique:users,email' . $this->id],
            'role' => ['in:pengawas,penguji'],
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute harus bertipe teks',
            'min' => ':attribute minimal :min',
            'unique' => ':attribute sudah pernah ditambahkan',
            'email' => ':attribute harus bertipe email',
            'in' => ':attribute harus diantara :in',
        ];
    }


    public function attributes()
    {
        return [
            'name' => 'Nama',  
            'email' => 'Email Address',
            'role' => 'Role',   
        ];
    }
}
