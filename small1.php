<?php
declare(strict_types = 1);

/**
 * @param $haystack
 * @param $needles
 * @return bool
 */
function endsWith(string $haystack, $needles) {
    $haystackLength = strlen($haystack);

    foreach ((array) $needles as $needle) {
        $needleLength = strlen($needle);

        if ($needle !== ''&& substr($haystack,  $haystackLength - $needleLength, $needleLength) === (string) $needle) {
            return true;
        }
    }

    return false;
}

/**
 * @param string $text
 */
function printLn(string $text) {
    echo $text . PHP_EOL;
}

/**
 * @param string $text
 */
function printExit(string $text) {
    printLn($text);
    exit;
}

/**
 * @param $value
 * @param bool $withThrow
 * @return int|null
 * @throws \InvalidArgumentException
 */
function parseInt($value, $withThrow = true) {
    $intValue = (int)$value;

    if (is_numeric($value)
        && $intValue == $value
    ) {
        return $intValue;
    }

    if ($withThrow) {
        throw new \InvalidArgumentException;
    }

    return null;
}

/**
 * @return string
 */
function generateMD5()
{
    return md5(uniqid((string)rand(), true));
}

/**
 * @param array $data
 * @return string
 */
function generateCsv(array $data) {
    $filename = generateMD5() . '.csv';
    $handle = fopen($filename, 'w');

    foreach ($data as $fields) {
        fputcsv($handle, $fields);
    }

    fclose($handle);

    return $filename;
}

printLn('Skrypt sortuje pliki .csv po wskazanej kolumnie.');
printLn('Podaj nazwę pliku.');

$filename = trim(fgets(fopen('php://stdin','r')));

if (!file_exists($filename)) {
    printExit("Plik (nazwa: $filename) nie istnieje.");
}

if (!endsWith($filename, '.csv')) {
    printExit("Plik (nazwa: $filename) powinien mieć rozszerzenie \".csv\".");
}

$csvArray = array_map('str_getcsv', file($filename));

if (empty($csvArray)) {
    printExit("Plik (nazwa: $filename) jest pusty.");
}

$columnsCount = count(reset($csvArray)) + 1;

printLn('Podaj kolumnę, po której posortować plik .csv');

try {
    $columnNumber = parseInt(trim(fgets(fopen('php://stdin','r'))));
} catch (\InvalidArgumentException $e) {
    printExit('Niepoprawny numer kolumny.');
}

if ($columnNumber < 1 || $columnNumber > $columnsCount) {
    printExit("Kolumna ($columnNumber) nie istnieje.");
}

usort($csvArray, function (array $a, array $b) use ($columnNumber) {
    $columnIndex = $columnNumber - 1;

    if (is_string($a[$columnIndex])) {
        return strcmp($a[$columnIndex], $b[$columnIndex]);
    }

    return $a[$columnIndex] > $b[$columnIndex];
});

$newFilename = generateCsv($csvArray);

printLn("Wygenerowany plik wynikowy: $newFilename");
