<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidarCpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remover caracteres não numéricos
        $cpf = preg_replace('/\D/', '', $value);

        // Verificar se o CPF tem 11 dígitos
        if (strlen($cpf) !== 11) {
            $fail("O :attribute não é um CPF válido.");
            return;
        }

        // Verificar se todos os dígitos são iguais (CPFs inválidos)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail("O :attribute não é um CPF válido.");
            return;
        }

        // Calcular e verificar o primeiro dígito verificador
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                $fail("O :attribute não é um CPF válido.");
                return;
            }
        }
    }

}

