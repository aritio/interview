<?php
require_once('./VendingMachine.php');

$makanan = new VendingMachine();
/* 
Instansiasi beli makanan dengan 3 parameter, 
nama makanan(str), uang yang dimasukan(int), jumlah makanan(int) 
*/
$beliMakanan = $makanan->beliMakanan('chips', 20000, 2);
print_r($beliMakanan);
