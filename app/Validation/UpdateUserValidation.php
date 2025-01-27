<?php
namespace App\Validation;


class UpdateUserValidation
{
    public static function rules($id): array
    {
        return [
            'name'       => 'required',
            'email'      => 'required|valid_email',
            'date'       => 'required|valid_date',
            'balance'    => 'required|numeric',
        ];
    }

    public static function messages(): array
    {
        return [
          'name' => [
              'required' => 'Nome é obrigatório',
                              'min_length' => 'Nome deve ter pelo menos 3 caracteres',
                'max_length' => 'Nome deve ter no máximo 50 caracteres'
          ],
          'email' => [
              'required' => 'Email é obrigatório',
              'valid_email' => 'Email inválido',
              'is_unique' => 'Email já cadastrado'
          ],
        ];
    }
}