<?php
require_once('./VendingMachine.php');


$makanan = new VendingMachine();
/* 
Instansiasi beli makanan dengan 3 parameter, 
nama makanan(str), uang yang dimasukan(int), jumlah makanan(int) 
*/
$beliMakanan = $makanan->beliMakanan('biskuit', 50000, 5);
print_r($beliMakanan);
