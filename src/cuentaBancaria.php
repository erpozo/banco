<?php

namespace banco;

class cuentaBancaria{
    private string $titular;
    private string $numCuenta;
    private int $saldo;
    private array $registro;

    private function __construct(string $titular,string $numCuenta, int $ingresoInicial){
        $this->titular = $titular;
        $this->numCuenta = $numCuenta;
        $this->saldo = $ingresoInicial;
        $this->registrar("Crear Cuenta",$ingresoInicial);
    }

    public static function crearCuentaBancaria(string $titular, string $numCuenta, int $ingresoInicial = 0){
        return new cuentaBancaria($titular, $numCuenta, $ingresoInicial);
    }

    public function verSaldo():int{
        return $this->saldo;
    }

    public function verRegistro():array{
        return $this->registro;
    }
    
    public function getNumCuenta():int{
        return $this->numCuenta;
    }

    public function ingresarDinero(int $cantidad){
        $this->saldo+=$cantidad;
        $this->registrar("Ingreso",$cantidad);
    }

    public function retirarDinero(int $cantidad){
        $this->saldo-=$cantidad;
        $this->registrar("Retirada",-$cantidad);
    }

    private function registrar(string $concepto, int $movimiento){
        $this->registro[] = ["Saldo"=>$this->verSaldo(),"Movimiento"=>$movimiento,"Concepto"=>$concepto,"Fecha"=>getdate()];
    }

    public function transferencia(cuentaBancaria $cuenta, $cantidad){
        $this->saldo-=$cantidad;
        $this->registrar("Transferencia a ".$cuenta->titular,-$cantidad);
        $cuenta->saldo+=$cantidad;
        $cuenta->registrar("Transferencia de ".$this->titular,$cantidad);
    }
}
/*
$cuenta1 = cuentaBancaria::crearCuentaBancaria("Pozo",789456789456);
$cuenta2 = cuentaBancaria::crearCuentaBancaria("David",789825148462);

$cuenta1->ingresarDinero(200);

$cuenta1->transferencia($cuenta2,100);

print_r($cuenta1->verRegistro());
print_r($cuenta2->verRegistro());
*/