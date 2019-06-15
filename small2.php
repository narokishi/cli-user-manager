<?php
declare(strict_types = 1);

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
 * @param array $data
 * @return string
 */
function generateOutput(array $data) {
    $filename = generateMD5() . '.txt';
    $handle = fopen($filename, 'w');

    foreach ($data as $line => $fields) {
        $line += 1;
        fputs($handle, "$line => $fields");
    }

    fclose($handle);

    return $filename;
}

/**
 * @return string
 */
function generateMD5()
{
    return md5(uniqid((string)rand(), true));
}

printLn('Skrypt wyszukuje tekst w pliku i zwraca wystąpienia wraz z liniami');
printLn('Podaj nazwę pliku.');

$filename = trim(fgets(fopen('php://stdin','r')));

if (!file_exists($filename)) {
    printExit("Plik (nazwa: $filename) nie istnieje.");
}

$fileData = file($filename);

if (empty($fileData)) {
    printExit("Plik ($filename) jest pusty.");
}

printLn('Podaj tekst, który chcesz wyszukać');

$pattern = trim(fgets(fopen('php://stdin','r')));

if (is_int(strpos($pattern, '#'))) {
    printExit('Znak "#" jest zarezerwowany. Nie można po nim wyszukiwać.');
}

$data = preg_grep("#$pattern#", $fileData);

if (empty($data)) {
    printExit('Brak wyników.');
}

printLn('Znaleziono ' . count($data) . ' wyników.');

printLn('Wybierz tryb wypisania wyniku:');
printLn('E - ekran');
printLn('P - plik');

$outputType = trim(fgets(fopen('php://stdin','r')));

switch ($outputType) {
    case 'E':
    case 'e':
        foreach ($data as $line => $fields) {
            $line += 1;
            printLn("$line => $fields");
        }

        break;

    case 'P':
    case 'p':
        $newFilename = generateOutput($data);
        printLn("Wygenerowany plik wynikowy: $newFilename");

        break;

    default:
        printExit('Nieobsługiwany tryb wypisania wyniku.');
}


