<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =  [
            [
                'topic_id' => 1,
                'task_no' => 1,
                'question' => 'Buatlah flowchart cara menghitung segitiga menggunakan data tipe integer dan double',
                
            ],
            [
                'topic_id' => 6,
                'task_no' => 1,
                'question' => 'Pak Andi memiliki lahan berbentuk lingkaran dengan diameter 150m. Di dalam lahan
                        pak Andi terdapat kolam renang berbetuk persegi dengan sisi 75m. Buatlah flowchart
                        untuk menghitung berapakah luas kolam renang dan lahan pak Andi yang tidak
                        dibagun kolam renang?',
            ],
            [
                'topic_id' => 6,
                'task_no' => 2,
                'question' => 'Gaji bersih karyawan PT. Indonesia Sejahtera didapatkan dari jumlah gaji pokok dan
                        tunjangan dikurangi pajak ditambah bonus mingguan. Gaji pokok karyawan PT.
                        Indonesia Sejahtera adalah Rp. 5.250.000,-. Tunjangan karyawan dihitung 20% dari gaji
                        pokok, sedangkan pajak adalah 5% dari gaji pokok. Setiap minggu terdapat bonus
                        sejumlah 100ribu untuk setiap karyawan. Buatlah flowchart untuk menghitung gaji
                        bersih karyawan di PT. Indonesia Sejahtera setiap bulan!',
    
            ],
            [
                'topic_id' => 7,
                'task_no' => 1,
                'question' => 'David Martinez adalah seorang remaja yang sedang mempelajari tutorial game FPS
                    (First Person Shooter). Dalam tutorial tersebut, diberi petunjuk tentang
                    penggunaan melee weapon dan range weapon. Melee weapon, digunakan untuk
                    close combat atau pertarungan jarak dekat. Yakni jika pertarungan berlangsung
                    dalam jarak 5 meter atau kurang dari itu. Sedangkan untuk ranged weapon,
                    digunakan untuk 5 meter sampai 1000 meter lebih. Buatlah sebuah flowchart yang
                    menjelaskan penggunaan kedua jenis weapon tersebut!',
            ],
            [
                'topic_id' => 7,
                'task_no' => 2,
                'question' => 'Dalam sebuah game RPG, terdapat sebuah equipment yang memiliki efek
                    Berserker, yakni jika HP (Health Points) player 100%, maka damage yang
                    ditimbulkan player 2 kali lipat, sedangkan jika HP player kurang dari 100% dan
                    masih diatas 15%, maka damage yang ditimbulkan adalah 1,5 kali lipat. Sedangkan
                    jika HP player 15% ke bawah maka damage yang ditimbulkan adalah 5 kali lipat.
                    Buatlah flowchart yang menjelaskan efek Berserker tersebut!',
            ],
            [
                'topic_id' => 7,
                'task_no' => 3,
                'question' => 'Di dalam sebuah program perhitungan, diketahui nilai P = x + y.
                    Pengguna memasukkan dua buah bilangan x dan y. Setelah dihitung,
                    jika P bernilai positif, maka nilai Q = x * y. Jika tidak, maka nilai Q = x /
                    y. Buat flowchart-nya dari studi kasus tersebut!',  
            ],
            [
                'topic_id' => 7,
                'task_no' => 4,
                'question' => 'Salah satu kewajiban sebagai warna negara Indonesia adalah
                    membayar pajak. Salah satu pajak yang wajib dibayar adalah pajak
                    kendaraan bermotor. Buatlah flowchart yang digunakan untuk
                    membantu proses pembayaran pajak kendaraan bermotor dengan
                    asumsi besaran pajak yang dibayarkan dibedakan menjadi 2 jenis
                    kendaraan yaitu mobil (roda empat) dan sepeda motor (roda dua). Jika
                    terlambat melakukan pembayaran maka akan dikenakan denda. Denda
                    pajak yang dibayarkan diasumsikan adalah perhari keterlambatan
                    pembayaran sesuai dengan jenis kendaraan.',  
            ],
            [
                'topic_id' => 8,
                'task_no' => 1,
                'question' => 'Ekspedisi Cargo melayani pengiriman dalam negeri dan ke luar negeri dengan rincian sebagai
                berikut:
                ⮚Untuk pengiriman dalam negeri:
                a. Berat kurang dari 10 kg tidak dikenakan biaya
                b. Jika berat 10-50kg dikenakan biaya Rp 250.000,-
                c. Jika berat barang lebih dari 50-100kg maka dikenakan biaya Rp 500.000,-
                d. Jika berat barang lebih dari 100kg maka dikenakan biaya Rp 1.000.000,-
                
                ⮚Untuk pengiriman ke luar negeri, dengan kondisi sbb :
                a. Jika berat barang kurang dari 5kg maka tidak dikenakan biaya,
                b. Jika berat 5-10kg maka dikenakan biaya Rp. 550.000,-
                c. Jika berat barang lebih dari 10kg maka dikenakan biaya Rp 800.000,-
                
                Buat flowchart untuk menentukan biaya pengiriman yang harus dibayarkan!',  
            ],
            [
                'topic_id' => 8,
                'task_no' => 2,
                'question' => 'Sistem ATM mempunyai 3 menu yaitu Penarikan, Transfer, dan Ubah Pin
                ⮚Pada menu Penarikan, pengguna diminta memilih jenis tabungan “Giro” atau
                “Deposito”, kemudian memasukkan jumlah uang yang akan diambil
                ⮚Pada menu Transfer, pengguna diminta untuk memilih kode bank tujuan yang terdiri
                dari BRI, BNI, Mandiri, Bukopin, dan BCA, kemudian memasukkan rekening tujuan,
                dan memasukkan jumlah uang yang akan ditransfer
                ⮚Pada menu Ubah Pin, pengguna diminta untuk memasukkan password lama dan
                password baru
                Buatlah flowchart untuk sistem ATM tersebut!',  
            ],
            [
                'topic_id' => 8,
                'task_no' => 3,
                'question' => 'Setiap hari Rabu, sebuah toko buku memberikan diskon kepada pelanggannya sesuai jenis buku
                yang dibeli
                ⮚Diskon sebesar 10% diberikan jika buku yang dibeli adalah kamus, kemudian akan diberikan
                tambahan diskon sebesar 2% jika buku yang dibeli lebih dari 2
                ⮚Diskon sebesar 7% diberikan jika buku yang dibeli adalah novel, kemudian akan diberikan
                tambahan diskon sebesar 2% jika novel yang dibeli lebih dari 3, sedangkan jika novel yang
                dibeli kurang dari atau sama dengan 3 akan diberikan tambahan diskon sebesar 1%
                ⮚Pelanggan akan mendapatkan diskon untuk buku selain kamus dan novel sebesar 5% jika
                buku yang dibeli lebih dari 3 produk
                Buatlah flowchart untuk menentukan berapa total yang harus dibayar jika input yang
                dimasukkan adalah jenis dan jumlah pakaian (harga setiap pakaian sudah ditentukan sistem)!',  
            ],
            [
                'topic_id' => 9,
                'task_no' => 1,
                'question' => 'Pengguna memasukkan nama dan jenis kelamin dari 30 mahasiswa di
                    suatu kelas. Nama-nama mahasiswa yang ditampilkan hanya yang
                    berjenis kelamin perempuan',  
            ],
            [
                'topic_id' => 9,
                'task_no' => 2,
                'question' => 'Tampilkan hasil penjumlahan deret bilangan 25 sampai dengan 1',  
            ],
            [
                'topic_id' => 9,
                'task_no' => 3,
                'question' => 'Menampilkan deret bilangan 1 sampai 50, kecuali bilangan kelipatan 3
                    (1 2 4 5 7 8 10 ... 47 49 50)',  
            ],
            [
                'topic_id' => 11,
                'task_no' => 1,
                'question' => 'Buat flowchart pengisian variable array dengan menggunakan
                    looping dan jumlah elemen 75!',  
            ],
            [
                'topic_id' => 11,
                'task_no' => 2,
                'question' => 'Buat flowchart untuk mengisi elemen array dengan jumlah elemen
                    7, kemudian tampilkan isi array tersebut secara terbalik.',  
            ],
            [
                'topic_id' => 11,
                'task_no' => 3,
                'question' => 'Buat flowchart yang meminta inputan pengguna berupa angka 1-7.
                    Tampilkan nama hari sesuai dengan inputan pengguna. Nama-nama
                    hari disimpan dalam array secara berurutan.',  
            ],
            [
                'topic_id' => 12,
                'task_no' => 1,
                'question' => 'Terdapat 30 mahasiswa kelas 1 dengan komposisi jumlah laki-laki dan perempuan
                    yang seimbang yaitu masing-masing 15 orang. Saat praktikum, laboratorium yang
                    digunakan mempunyai 15 meja dengan dua kursi di setiap meja. Semua mahasiswa
                    diharapkan duduk secara berpasangan laki-laki (sebelah kiri) dan perempuan
                    (sebelah kanan) dalam satu meja. Pengecekan posisi duduk dilakukan berdasarkan
                    jenis kelamin mahasiswa, kemudian nama mahasiswa dicatat pada setiap kursi.
                    Buatlah flowchart untuk menentukan posisi duduk dari setiap mahasiswa sesuai
                    kondisi tersebut! (Asumsi mahasiswa datang berselang-selang dengan urutan L - P)',  
            ],
            [
                'topic_id' => 13,
                'task_no' => 1,
                'question' => 'Buatlah flowchart untuk menampilkan FBP dari suatu bilangan bulat menggunakan fungsi!',  
            ],
                    
        ];


        foreach ($data as $element) {
            Task::create([
                'topic_id' => $element['topic_id'],
                'task_no' => $element['task_no'],
                'question' => $element['question'],
            ]);
        }
    }
}