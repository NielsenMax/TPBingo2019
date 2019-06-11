<?php
require 'vendor/autoload.php';
use Bingo\FabricaCartones;
$fabrica = new FabricaCartones;
foreach (range(1, 5) as $intento) {
    
  $carton = $fabrica->generarCarton();
  print "Intento $intento:\n";
  imprimirCarton($carton);
}
function imprimirCarton(CartonInterface $carton) {
  print("[\n");
  foreach ($carton->columnas() as $columna) {
    print("  [");
    foreach ($columna as $celda) {
      printf("% 2d, ", $celda);
    }
    print("],");
    print("\n");
  }
  print("];\n\n");
}
function columnass(array $filas) {
  foreach ($filas as $indice_fila => $columna) {
    foreach ($columna as $indice_columna => $celda) {
      $columnas[$indice_columna][$indice_fila] = $celda;
    }
  }
  return $columnas;
}