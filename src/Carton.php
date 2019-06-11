<?php

namespace Bingo;

include_once "CartonInterface.php";
/**
 * Este es un Carton de Ejemplo.
 */
class Carton implements CartonInterface {
  //class CartonEjemplo {
  protected $numeros_carton = [];

  /**
   * {@inheritdoc}
   */
  public function __construct(Array $carton) {
    $this->numeros_carton=$carton;
  }

  /**
   * {@inheritdoc}
   */
  public function filas() {
    return $this->numeros_carton;
  }

  /**
   * {@inheritdoc}
   */
  public function columnas() {
    
    $columnas= Array(Array());
    for($i=0;$i<3;$i++)
    {
      for($j=0;$j<9;$j++){
        $columnas[$j][$i]=$this->numeros_carton[$i][$j];
      }
    }
    return $columnas;
  }

  /**
   * {@inheritdoc}
   */
  public function numerosDelCarton() {
    $numeros = [];
    foreach ($this->filas() as $fila) {
      foreach ($fila as $celda) {
        if ($celda != 0) {
          $numeros[] = $celda;
        }
      }
    }
    return $numeros;
  }

  

}
?>
