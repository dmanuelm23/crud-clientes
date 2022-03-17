<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreClientePost extends FormRequest
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
        $max="max:255";
        return [
            'nombre' => ['required', 'string', $max],
            'apellido_paterno' => ['required', 'string', $max],
            'apellido_materno' => ['required', 'string', $max],
            'domicilio' => ['required', 'string', $max],
            'correo_electronico' => ['required', 'string', 'email', $max],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'=>'El nombre es requerido.',
            'apellido_paterno.required'=>'El apellido paterno es requerido.',
            'apellido_materno.required'=>'El apellido materno es requerido.',
            'domicilio.min'=>'La dirección es requerida.',
            'correo_electronico.required'=>'Su correo electrónico es requerido.',
            'correo_electronico.email'=>'El formato de correo electrónico  es incorrecto, intenta nuevamente.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'statusCode' => 422,
            'message'    => 'Unprocessable Entity',
            'errors'     => $validator->errors()
        ], 422);
        throw new HttpResponseException($response);
    }
}
