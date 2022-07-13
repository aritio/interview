<?php

class VendingMachine
{
    /* Data makanan */
    public $makanan = [
            [
                'jenisMakanan' => 'biskuit',
                'harga' => 6000,
                'stok' => 10
            ],
            [
                'jenisMakanan' => 'chips',
                'harga' => 8000,
                'stok' => 15
            ],
            [
                'jenisMakanan' => 'oreo',
                'harga' => 10000,
                'stok' => 20
            ],
            [
                'jenisMakanan' => 'tango',
                'harga' => 12000,
                'stok' => 5
            ],
            [
                'jenisMakanan' => 'cokelat',
                'harga' => 15000,
                'stok' => 4
            ]
        ],
        /* nominal uang yang dapat diterima */
        $nominalUangYangDapatDiterima = [2000, 5000, 10000, 20000, 50000];

    /* 
       Cari data makanan dengan parameter makanan yang dicari 
       dengan tipe data string dan return data yang dicari
    */
    public function cariMakanan(string $makanan)
    {
        $data = $this->makanan;
        $arrayKey = array_search($makanan, array_column($data, 'jenisMakanan'), true);

        if ($arrayKey === false) {
            return 0;
        }
        return $data[$arrayKey];
    }

    /* 
        Validasi uang yang dimasukan customer dengan parameter uang
        dengan tipe data integer dengan return boolean
    */
    public function uangYangDapatDiterimaDimesin(int $uang)
    {
        $data = $this->nominalUangYangDapatDiterima;

        $search = array_search($uang, $data);
        if ($search === false) {
            return 0;
        }
        return true;
    }

    /* 
        Pembelian makanan dengan beberapa parameter, makanan(string), 
        uang yang dimasukan (int), jumlah makanan(int)
    */
    public function beliMakanan(string $makanan, int $uangYangDimasukan, int $jumlahMakanan)
    {
        $uangYangDapatDiterima = $this->uangYangDapatDiterimaDimesin($uangYangDimasukan);
        $uangYangBoleh = implode(', ', $this->nominalUangYangDapatDiterima);

        /* Cek nominal uang yang dimasukan */
        if ($uangYangDapatDiterima == false) {
            return "Maaf, uang yang anda masukan tidak terbaca didalam mesin! <br> 
            uang yang anda masukan $uangYangDimasukan<br>
            uang yang bisa terbaca didalam mesin adalah {$uangYangBoleh}";
        }

        $barang = $this->cariMakanan($makanan);
        /* Cek barang yang dicari */
        if ($barang) {
            $harga = $barang['harga'];
            $stok = $barang['stok'];
            $total = $harga * $jumlahMakanan;

            /* Cek jumlah barang yang dibeli dengan stok barang apakah cukup */
            if ($jumlahMakanan > $stok) {
                return "Maaf, makanan yang kamu pilih melebihi stok yang tersedia! <br>
                stok barang yang tersedia adalah {$stok}";
            }

            /* Cek barang yang dibeli dengan harga barang apakah cukup */
            if ($uangYangDimasukan < $total) {
                return "Maaf, uang yang kamu masukan kurang! <br>
                jumlah total harga barangnya {$this->rupiah($total)} <br>
                uang yang anda masukan {$this->rupiah($uangYangDimasukan)}";
            }

            $kembalian = $uangYangDimasukan - ($harga * $jumlahMakanan);
            return "Berhasil!<br>
            Makanan yang kamu pesan adalah {$makanan} dengan harga satunya {$this->rupiah($harga)} <br>
            dengan jumlah barang {$jumlahMakanan} <br>
            total harga {$this->rupiah($total)} <br>
            uang yang kamu masukkan {$this->rupiah($uangYangDimasukan)} <br>
            dan kembaliannya {$this->rupiah($kembalian)}";
        }
        return "Maaf, makanan yang anda cari tidak ada";
    }

    public function rupiah(int $uang)
    {
        if (!$uang) {
            return 0;
        }
        return "Rp " . number_format($uang, 0, ',', '.');
    }
}
