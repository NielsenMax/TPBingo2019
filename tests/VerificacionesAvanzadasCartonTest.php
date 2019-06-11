<?php

namespace Bingo;

use PHPUnit\Framework\TestCase;

class VerificacionesAvanzadasCartonTest extends TestCase {

  /**
   * Verifica que los números del carton se encuentren en el rango 1 a 90.
   *  
   * @dataProvider cartones
   *
   */
  public function testUnoANoventa(CartonInterface $carton) {
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
   /**
   * @dataProvider cartones
   */
  public function testCincoNumerosPorFila(CartonInterface $carton) {
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
   /**
   * @dataProvider cartones
   */
  public function testColumnaNoVacia(CartonInterface $carton) {
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
   /**
   * @dataProvider cartones
   */
  public function testColumnaCompleta(CartonInterface $carton) {
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
   /**
   * @dataProvider cartones
   */
  public function testTresCeldasIndividuales(CartonInterface $carton) {
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
   /**
   * @dataProvider cartones
   */
  public function testNumerosIncrementales(CartonInterface $carton) {
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
   /**
   * @dataProvider cartones
   */
  public function testFilasConVaciosUniformes(CartonInterface $carton) {
    foreach($carton->filas() as $fila){
      $numeros = 0;
      foreach($fila as $celda){
        if($celda == 0){
          $numeros++;
        }
        else
        {
          $numeros=0;
        }
          $this->assertTrue($numeros < 3);
       
      }        
    }    
  }
 
  /**
   * Devuelve una lista de objetos para usar con dataProvider
   */
  public function cartones() {
    return [
      [new CartonEjemplo],
      [new CartonJs],
    [new Carton ((new FabricaCartones)->generarCarton())]
    ];
  }

}
