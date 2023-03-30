<?php

if(isset($_POST['salario'])){
  $salario = $_POST['salario'];
  $inss = calcularInss($salario); 
  echo "O Valor do INSS é R$ " . number_format($inss, 2, ",", ".");
  echo"<br>";
  $valorIRRF = calcularIRRF($salario, $inss); 
  echo "O Valor do IRRF é R$ " . number_format($valorIRRF, 2, ",", ".");  
  echo"<br>";
  $salarioLiquido = $salario - $inss - $valorIRRF;
  echo "O Valor do Salario liquido é R$" . number_format($salarioLiquido, 2, ",", "."); 
}
function calcularInss($salario) {
  if ($salario <= 1302) {
    $inss = $salario * 0.075;
  } elseif ($salario <= 2571.29) {
    $inss = ($salario - 1302) * 0.09 + 97.65;
  } elseif ($salario <= 3856.94) {
    $inss = ($salario - 2571.29) * 0.12 + 97.65 + 114.23;
  } elseif ($salario <= 7507.49) {
    $inss = ($salario - 3856.95) * 0.14 + 97.65 + 114.23 + 154.28;
  } else {
    $inss = 877.24; 
  }
  return $inss;
}

function calcularIRRF($salario, $inss){
  $salario2 = ($salario - $inss) - 189.59;
  $aliquota = 0;
  $deducao = 0; 
  switch (true) {
    case ($salario2 <= 1903.98):
      $aliquota = 0;
      $deducao = 0;
      break;
    case ($salario2 <= 2826.65):
      $aliquota = 0.075;
      $deducao = 142.80;
      break;
    case ($salario2 <= 3751.05):
      $aliquota = 0.15;
      $deducao = 354.80;
      break;
    case ($salario2 <= 4664.68):
      $aliquota = 0.225;
      $deducao = 636.13;
      break;
    default:
      $aliquota = 0.275;
      $deducao = 869.36;
      break;
  }

  $valorIRRF = ($salario2 * $aliquota) - $deducao;
  return $valorIRRF;
}
?>



