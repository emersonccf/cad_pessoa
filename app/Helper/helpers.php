<?php

use Illuminate\Support\Str;

/**
 * Remove acentos de uma string
 * @param string  $string : informe uma string que deseja retirar acentos
 * @return string
 */
function removerAcentos($string):string {
    $acentos = [
        'á' => 'a',
        'à' => 'a',
        'ã' => 'a',
        'â' => 'a',
        'ä' => 'a',
        'é' => 'e',
        'è' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'í' => 'i',
        'ì' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ó' => 'o',
        'ò' => 'o',
        'õ' => 'o',
        'ô' => 'o',
        'ö' => 'o',
        'ú' => 'u',
        'ù' => 'u',
        'û' => 'u',
        'ü' => 'u',
        'ç' => 'c',
        'Á' => 'A',
        'À' => 'A',
        'Ã' => 'A',
        'Â' => 'A',
        'Ä' => 'A',
        'É' => 'E',
        'È' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Í' => 'I',
        'Ì' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ó' => 'O',
        'Ò' => 'O',
        'Õ' => 'O',
        'Ô' => 'O',
        'Ö' => 'O',
        'Ú' => 'U',
        'Ù' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ç' => 'C'
    ];

    return strtr($string, $acentos);
}

/**
 * Converte uma string para slug
 * @param string  $string : informe uma string que deseja converter para slug
 * @param string $separador = "-" : tipo de separador, é opcional, ex: '_' ',' '.' ...
 * @return string : slug
 */
function converteParaSlug($string, string $separador='-'): string {
    return Str::slug($string, $separador);
}

/**
 * Converte nome em e-mail fake
 * @param string  $nome : informe uma string que deseja converter para slug
 * @param string $dominio = "teste.com" : domínio do e-mail, é opcional
 * @return string : e-mail fake
 */
function tornarEmail(string $nome, string $dominio): string {
    return $nome . '@' . $dominio;
}
