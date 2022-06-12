<?php
use PHPUnit\Framework\TestCase;
use banco\cuentaBancaria;

final class cuentaBancariaTests extends TestCase{
    public function testCuentaBancaria(){
        $cuenta1 = cuentaBancaria::crearCuentaBancaria("Pozo",789456789456);
        $cuenta2 = cuentaBancaria::crearCuentaBancaria("David",789825148462);  

        $cuenta1->ingresarDinero(200);
        
        $cuenta1->transferencia($cuenta2,100);
         
        $this->assertEquals($cuenta1->verSaldo(),100);
        $this->assertEquals($cuenta2->verSaldo(),100);

        $cuenta1->retirarDinero(20);
        $this->assertEquals($cuenta1->verSaldo(),80);
    }
}