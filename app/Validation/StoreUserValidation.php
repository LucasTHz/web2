<?php

namespace App\Validation;

class StoreUserValidation
{
    public static function rules(): array
    {
        return [
            'name'              => 'required|min_length[3]|max_length[50]',
            'email'             => 'required|valid_email|is_unique[users.email]',
            'password'          => 'required|min_length[8]|max_length[255]|strongPassword',
            'confirme-password' => 'required|matches[password]',
            'date'              => 'required|valid_date|isAdult|dateFuture'
        ];
    }

    public static function messages(): array
    {
        return [
            'name' => [
                'required'   => 'Nome é obrigatório',
                'min_length' => 'Nome deve ter pelo menos 3 caracteres',
                'max_length' => 'Nome deve ter no máximo 50 caracteres'
            ],
            'email' => [
                'required'    => 'Email é obrigatório',
                'valid_email' => 'Email inválido',
                'is_unique'   => 'Email já cadastrado'
            ],
            'password' => [
                'required'       => 'Senha é obrigatório',
                'min_length'     => 'Senha deve ter pelo menos 8 caracteres',
                'max_length'     => 'Senha deve ter no máximo 255 caracteres',
                'strongPassword' => 'Senha deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial'
            ],
            'confirme-password' => [
                'required' => 'Senha de confirmação é obrigatória',
                'matches'  => 'As senhas não conferem'
            ],
            'date' => [
                'required'   => 'Data de nascimento é obrigatória',
                'valid_date' => 'Data de nascimento inválida',
                'isAdult'    => 'Você deve ter pelo menos 18 anos',
                'dateFuture' => 'Data de nascimento não pode ser no futuro'
            ]
        ];
    }
}
