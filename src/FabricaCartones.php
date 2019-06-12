<?php
namespace Bingo;
class FabricaCartones {
  public function generarCarton() {
    // Algo de pseudo-código para ayudar con la evaluacion.
    while(TRUE){
    $carton =new Carton($this->intentoCarton());
    if ($this->cartonEsValido($carton)) {
      return $carton;
    }
}
}

  
  protected function cartonEsValido($carton) {
        /*debugging
        echo "\n\nNuevo Carton \n";
        if($this->validarUnoANoventa($carton)             ){echo "Funciono 1 \n";}else{echo "No 1 \n";}
        if($this->validarCincoNumerosPorFila($carton)     ){echo "Funciono 2 \n";}else{echo "No 2\n";}
        if($this->validarColumnaNoVacia($carton)          ){echo "Funciono 3\n";}else{echo "No 3\n";}
        if($this->validarColumnaCompleta($carton)         ){echo "Funciono 4\n";}else{echo "No 4\n";} 
        if($this->validarTresCeldasIndividuales($carton)  ){echo "Funciono 5\n";}else{echo "No 5\n";}
        if($this->validarNumerosIncrementales($carton)    ){echo "Funciono 6\n";}else{echo "No 6\n";}
        if($this->validarFilasConVaciosUniformes($carton) ){echo "Funciono 7\n";}else{echo "No 7\n";}   
        //enddebugging*/
    if (
        $this->validarUnoANoventa($carton) &&
        $this->validarCincoNumerosPorFila($carton) &&
        $this->validarColumnaNoVacia($carton) &&
        $this->validarColumnaCompleta($carton) &&
        $this->validarTresCeldasIndividuales($carton) &&
        $this->validarNumerosIncrementales($carton) &&
        $this->validarFilasConVaciosUniformes($carton)
    ) {
      return TRUE;
    }
    return FALSE;
  }
  protected function validarUnoANoventa($carton) {
    $numeros = $carton->numerosDelCarton();
    foreach($numeros as $numero){
      if($numero < 1 || $numero > 90){
        return FALSE;
      }
    }
    return TRUE;
  }
  protected function validarCincoNumerosPorFila($carton) {
    foreach($carton->filas() as $fila){
        $numeros = 0;
        foreach($fila as $celda){
          if($celda != 0){
            $numeros++;
          }
        }
          if($numeros != 5){
            return FALSE;
          }
      }
     return TRUE;
  }
  protected function validarColumnaNoVacia($carton) {
    foreach($carton->columnas() as $columna){
        $numeros = 0;
        foreach($columna as $celda){
          if($celda != 0){
            $numeros++;
          }
        }
          if($numeros < 1){
            return FALSE;
          }
      }
      return TRUE;
  }
  protected function validarColumnaCompleta($carton) {
    foreach($carton->columnas() as $columna){
        if(count(array_filter($columna)) == 3){
          return FALSE;
        }else{
          return TRUE;
        }
    }
  }
  protected function validarTresCeldasIndividuales($carton) {
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
    if($unacelda == 3)
    {
        return TRUE;
    }
    else{return FALSE;}
  }
  protected function validarNumerosIncrementales($carton) {
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
      if($min<$max)
      {return FALSE;}
      $max = $aux;
    }
    return TRUE;
  }
  protected function validarFilasConVaciosUniformes($carton) {
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
            if($numeros > 2)
            {return FALSE;}
         
        }        
      } 
     return TRUE; 
  }

  public function intentoCarton() {
    $contador = 0;
    $carton = [
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0],
      [0,0,0]
    ];
    $numerosCarton = 0;
    while ($numerosCarton < 15) {
      $contador++;
      if ($contador == 50) {
        return $this->intentoCarton();
      }
      $numero = rand (1, 90);
      $columna = floor ($numero / 10);
      if ($columna == 9) { $columna = 8;}
      $huecos = 0;
      for ($i = 0; $i<3; $i++) {
        if ($carton[$columna][$i] == 0) {
          $huecos++;
        }
        if ($carton[$columna][$i] == $numero) {
          $huecos = 0;
          break;
        }
      }
      if ($huecos < 2) {
        continue;
      }
      $fila = 0;
      for ($j=0; $j<3; $j++) {
        $huecos = 0;
        for ($i = 0; $i<9; $i++) {
          if ($carton[$i][$fila] == 0) { $huecos++; }
        }
        if ($huecos < 5 || $carton[$columna][$fila] != 0) {
          $fila++;
        } else{
          break;
        }
      }
      if ($fila == 3) {
        continue;
      }
      $carton[$columna][$fila] = $numero;
      $numerosCarton++;
      $contador = 0;
    }
    for ( $x = 0; $x < 9; $x++) {
      $huecos = 0;
      for ($y =0; $y < 3; $y ++) {
        if ($carton[$x][$y] == 0) { $huecos++;}
      }
      if ($huecos == 3) {
        return $this->intentoCarton();
      }
    }
    return $carton;
  }
}