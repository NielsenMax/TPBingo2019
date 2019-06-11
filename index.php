<?php
require 'vendor/autoload.php';

use Bingo\FabricaCartones;
use Bingo\Carton;
$fabrica = new FabricaCartones;
foreach (range(1, 5) as $intento) {
    
  $carton = $fabrica->generarCarton();
  print "Intento $intento:\n";
  if($carton){
  imprimirCarton($carton);
  }
}
function imprimirCarton( $carton) {
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
function columnas(array $filas) {
  foreach ($filas as $indice_fila => $columna) {
    foreach ($columna as $indice_columna => $celda) {
      $columnas[$indice_columna][$indice_fila] = $celda;
    }
  }
  return $columnas;
}