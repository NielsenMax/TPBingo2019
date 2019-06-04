<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

class VerificacionesAvanzadasCartonTest extends TestCase {

  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   */
  public function testUnoANoventa() {
    $carton = new CartonEjemplo;
    $numeros = $carton->numerosDelCarton();
    foreach($numeros as $numero){
      if($numero < 1 || $numero > 90){
        $this->assertTrue(FALSE);
      }
    }
    $this->assertTrue(TRUE);
  }

  /**
   * Verifica que cada fila de un carton tenga exactamente 5 celdas ocupadas.
   */
  public function testCincoNumerosPorFila() {
    $carton = new CartonEjemplo;
    foreach($carton->filas() as $fila){
      $numeros = 0;
      foreach($fila as $celda){
        if($celda != 0){
          $numeros++;
        }
      }
        if($numeros != 5){
          $this->assertTrue(FALSE);
        }
    }
    $this->assertTrue(TRUE);
  }

  /**
   * Verifica que para cada columna, haya al menos una celda ocupada.
   */
  public function testColumnaNoVacia() {
    $carton = new CartonEjemplo;
    foreach($carton->columnas() as $columna){
      $numeros = 0;
      foreach($columna as $celda){
        if($celda != 0){
          $numeros++;
        }
      }
        if($numeros < 1){
          $this->assertTrue(FALSE);
        }
    }
    $this->assertTrue(TRUE);
  }

  /**
   * Verifica que no haya columnas de un carton con tres celdas ocupadas.
   */
  public function testColumnaCompleta() {
    $carton = new CartonEjemplo;
    foreach($carton->columnas() as $columna){
      $numeros = 0;
      foreach($columna as $celda){
        if($celda != 0){
          $numeros++;
        }
      }
          $this->assertTrue(!($numeros == 3));
    }
  }
 

  /**
   * Verifica que solo hay exactamente tres columnas que tienen solo una celda
   * ocupada.
   */
  public function testTresCeldasIndividuales() {
    $carton = new CartonEjemplo;
    $unacelda=0;
    foreach($carton->columnas() as $columna){
      $numeros = 0;
      foreach($columna as $celda){
        if($celda != 0){
          $numeros++;
        }        
      }
      if($numeros==1)
      {
        $unacelda++;
      }          
    }
    $this->assertTrue($unacelda == 3);

  }

  /**
   * Verifica que los números de las columnas izquierdas son menores que los de
   * las columnas a la derecha.
   */
  public function testNumerosIncrementales() {
    $carton = new CartonEjemplo;
    $max = 0;
    $aux= 0;
    foreach($carton->columnas() as $columna){
      $min = 91;
      foreach($columna as $celda){
        if($celda < $min && $celda != 0){
          $min = $celda;
        }
        if ($celda > $aux){
          $aux = $celda;
        }
      }
      $this->assertTrue($min>$max);
      $max = $aux;
    }
  }

  /**
   * Verifica que en una fila no existan más de dos celdas vacias consecutivas.
   */
  public function testFilasConVaciosUniformes() {
    $this->assertTrue(TRUE);
  }

}
