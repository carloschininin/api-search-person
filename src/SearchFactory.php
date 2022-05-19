<?php

declare(strict_types=1);

namespace CarlosChininin\ApiSearchPerson;

final class SearchFactory
{
    public static function rucFactory(string $dni): string
    {
        return '10'.$dni.self::digitoVerificador($dni);
    }

    public static function digitoVerificador(string $dni): int
    {
        $suma = 5;
        $len = mb_strlen($dni);
        $hash = [3, 2, 7, 6, 5, 4, 3, 2];
        for ($i = 0; $i < $len; ++$i) {
            $suma += $dni[$i] * $hash[$i];
        }
        $entero = (int) ($suma / 11);
        $digito = 11 - ($suma - $entero * 11);

        return $digito > 9 ? $digito - 10 : $digito;
    }
}
