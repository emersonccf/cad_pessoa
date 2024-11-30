<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidarCnpj implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remover caracteres não numéricos
        $cnpj = preg_replace('/\D/', '', $value);

        // Verificar se o CNPJ tem 14 dígitos
        if (strlen($cnpj) !== 14) {
            $fail("O :attribute não é um CNPJ válido.");
            return;
        }

        // Verificar se todos os dígitos são iguais (CNPJs inválidos)
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            $fail("O :attribute não é um CNPJ válido.");
            return;
        }

        // Calcular e verificar o primeiro dígito verificador
        $tamanho = 12;
        $pesos = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        for ($i = 0; $i < 2; $i++) {
            $soma = 0;
            for ($j = 0; $j < $tamanho; $j++) {
                $soma += $cnpj[$j] * $pesos[$j];
            }
            $d = ($soma % 11) < 2 ? 0 : 11 - ($soma % 11);
            if ($cnpj[$tamanho] != $d) {
                $fail("O :attribute não é um CNPJ válido.");
                return;
            }
            $tamanho++;
            array_unshift($pesos, 6); // Ajustar pesos para o segundo dígito verificador
        }
    }
}
