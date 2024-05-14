<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

function leerColumnasExcel($nombreArchivo, $hoja = 0) {
    // Cargar el archivo Excel
    $documento = IOFactory::load($nombreArchivo);
    
    // Seleccionar la hoja
    $hojaActual = $documento->getSheet($hoja);
    
    // Recorrer cada fila
    foreach ($hojaActual->getRowIterator() as $fila) {
        $filaIndex = $fila->getRowIndex();
        
        // Leer el valor de la columna A (username)
        $celdaUsername = $hojaActual->getCell("A$filaIndex");
        $username = $celdaUsername ? $celdaUsername->getValue() : '';

        // Leer el valor de la columna B (clave)
        $celdaClave = $hojaActual->getCell("B$filaIndex");
        $clave = $celdaClave ? $celdaClave->getValue() : '';

        if (!empty($username) && !empty($clave)) {
            // Hashear la clave
            $claveHasheada = password_hash($clave, PASSWORD_DEFAULT);

            // Imprimir los valores
            echo '<pre>';
                echo "Fila $filaIndex: Username: $username, Clave Hasheada: $claveHasheada" . PHP_EOL;
            echo '</pre>';
        }
    }
}

// Llamar a la función con el nombre del archivo Excel
leerColumnasExcel('usuarios.xlsx');
