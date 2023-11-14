<?php


function isStringValid($string)
{
    return isset($string) && !empty($string);
}

function isValidBirthDate($date)
{
    $delimiter = false;
    if (strpos($date, '-') !== false) {
        $delimiter = '-';
    } elseif (strpos($date, '/') !== false) {
        $delimiter = '/';
    }

    if (!$delimiter) {
        return false;
    }

    $dateParts = explode($delimiter, $date);

    if (count($dateParts) != 3) {
        return false;
    }

    list($year, $month, $day) = $delimiter === '-' ? $dateParts : array_reverse($dateParts);

    if (!is_numeric($year) || !is_numeric($month) || !is_numeric($day)) {
        return false;
    }

    if (strlen($year) != 4 || strlen($month) != 2 || strlen($day) != 2) {
        return false;
    }

    if (!checkdate($month, $day, $year)) {
        return false;
    }

    return true;
}

function isValidCURP($curp)
{
    if (!isStringValid($curp) || strlen($curp) != 18) {
        return false;
    }
    return true;
}

function isValidRFC($rfc)
{
    if (!isStringValid($rfc) || strlen($rfc) != 13) {
        return false;
    }
    return true;
}



function isValidYear($year)
{
    try {

        if (!is_numeric($year)) {
            throw new Exception("El año de lanzamiento debe ser un número");
        }

        $year = intval($year);

        if (intval($year) <= 1900 || intval($year) >= 2024) {
            throw new Exception("El año de lanzamiento debe ser mayor a 1900 y menor a 2024");
        }

        return "";
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
    return "";
}


function isOnlyCharacters($string)
{
    return preg_match('/^[a-zA-Z ]+$/', $string);
}
