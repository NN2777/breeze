<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'topic_name' => 'Dasar Pemrograman',
                'description' => 'Pemrograman adalah proses membangun aplikasi atau perangkat lunak dengan tujuan tertentu. Dengan sebagian besar bisnis maju secara signifikan dalam penerapan teknologi, memperoleh keterampilan komputer menjadi sangat penting. Mempelajari kode menggunakan bahasa pemrograman terbaik dapat membantu Anda mengelola proyek secara efisien dan menjadikan karier Anda sebagai pengembang perangkat lunak lebih memuaskan. Pada artikel ini, kami menemukan arti dari bahasa pemrograman dasar, membahas pentingnya mempelajari cara membuat kode, menjelajahi lima bahasa berbeda yang dapat Anda gunakan untuk mengembangkan aplikasi, dan menawarkan tip untuk mempelajari bahasa pemrograman baru.'
            ],
            [
                'topic_name' => 'Algoritma',
                'description' => 'Algoritma adalah prosedur yang digunakan untuk memecahkan masalah atau melakukan komputasi. Algoritma bertindak sebagai daftar instruksi yang tepat yang melakukan tindakan tertentu langkah demi langkah baik berbasis perangkat keras atau perangkat lunak.'
            ],
            [
                'topic_name' => 'Flowchart',
                'description' => 'Flowchart adalah representasi grafis dari proses atau algoritma yang menggunakan simbol dan panah untuk mengilustrasikan urutan langkah atau keputusan yang terlibat. Ini adalah alat visual yang digunakan untuk menggambarkan aliran kontrol atau data dalam suatu sistem.'
            ],
            [
                'topic_name' => 'Tipe Data',
                'description' => 'Tipe data pemrograman merupakan atribut yang berkaitan dengan data yang akan memberi tahu sistem komputer. Sehingga nantinya bisa menafsirkan nilai dari data tersebut. Secara khusus, tipe data adalah format penyimpanan data. Data bisa dalam bentuk variabel untuk tipe data tertentu.'
            ],
            [
                'topic_name' => 'Variabel',
                'description' => 'Variabel adalah lokasi penyimpanan bernama dalam memori komputer yang menyimpan nilai. Ini digunakan untuk mewakili dan menyimpan data yang dapat dimodifikasi selama eksekusi suatu program. Variabel diberi tipe data, yang menentukan jenis nilai yang dapat disimpannya dan operasi yang dapat dilakukan padanya.'
            ],
            [
                'topic_name' => 'Operator',
                'description' => 'Operator adalah simbol atau kata kunci yang digunakan untuk melakukan operasi tertentu pada satu atau lebih operan (nilai atau variabel) untuk menghasilkan suatu hasil. Operator dapat digunakan untuk perhitungan aritmetika (misalnya penjumlahan, pengurangan), perbandingan logis (misalnya persamaan, lebih besar dari), penugasan nilai, atau operasi lainnya. Contoh operator termasuk + (penjumlahan), - (pengurangan), = (penugasan), == (kesetaraan), && (logis DAN), dan || (logis ATAU).
                Konsep-konsep ini sangat mendasar untuk pemrograman dan memahami bagaimana data disimpan, dimanipulasi, dan diproses dalam suatu program.'
            ],
            [
                'topic_name' => 'Seleksi',
                'description' => 'Seleksi, juga dikenal sebagai pernyataan bersyarat atau percabangan, mengacu pada konstruksi pemrograman yang memungkinkan suatu program untuk membuat keputusan dan menjalankan rangkaian instruksi yang berbeda berdasarkan kondisi tertentu. Ini memungkinkan program untuk memilih antara jalur eksekusi yang berbeda berdasarkan evaluasi suatu kondisi. Jenis pernyataan seleksi yang umum termasuk pernyataan if, pernyataan switch, dan operator ternary.'
            ],
            [
                'topic_name' => 'Seleksi 2',
                'description' => 'Seleksi, juga dikenal sebagai pernyataan bersyarat atau percabangan, mengacu pada konstruksi pemrograman yang memungkinkan suatu program untuk membuat keputusan dan menjalankan rangkaian instruksi yang berbeda berdasarkan kondisi tertentu. Ini memungkinkan program untuk memilih antara jalur eksekusi yang berbeda berdasarkan evaluasi suatu kondisi. Jenis pernyataan seleksi yang umum termasuk pernyataan if, pernyataan switch, dan operator ternary.'
            ],
            [
                'topic_name' => 'Pengulangan',
                'description' => 'Perulangan, juga dikenal sebagai iterasi atau pengulangan, adalah konstruksi pemrograman yang memungkinkan serangkaian instruksi dieksekusi berulang kali hingga kondisi tertentu terpenuhi. Ini membantu mengotomatiskan tugas berulang atau memproses pengumpulan data. Ada berbagai jenis perulangan dalam pemrograman, seperti perulangan for, perulangan while, dan perulangan do-while. Perulangan ini memungkinkan eksekusi blok kode berkali-kali, baik berdasarkan hitungan tertentu atau hingga kondisi tertentu menjadi salah.'
            ],
            [
                'topic_name' => 'Nested If',
                'description' => 'Perulangan, juga dikenal sebagai iterasi atau pengulangan, adalah konstruksi pemrograman yang memungkinkan serangkaian instruksi dieksekusi berulang kali hingga kondisi tertentu terpenuhi. Ini membantu mengotomatiskan tugas berulang atau memproses pengumpulan data. Ada berbagai jenis perulangan dalam pemrograman, seperti perulangan for, perulangan while, dan perulangan do-while. Perulangan ini memungkinkan eksekusi blok kode berkali-kali, baik berdasarkan hitungan tertentu atau hingga kondisi tertentu menjadi salah.'
            ],
            [
                'topic_name' => 'Array 1',
                'description' => 'Perulangan, juga dikenal sebagai iterasi atau pengulangan, adalah konstruksi pemrograman yang memungkinkan serangkaian instruksi dieksekusi berulang kali hingga kondisi tertentu terpenuhi. Ini membantu mengotomatiskan tugas berulang atau memproses pengumpulan data. Ada berbagai jenis perulangan dalam pemrograman, seperti perulangan for, perulangan while, dan perulangan do-while. Perulangan ini memungkinkan eksekusi blok kode berkali-kali, baik berdasarkan hitungan tertentu atau hingga kondisi tertentu menjadi salah.'
            ],
            [
                'topic_name' => 'Array 2',
                'description' => 'Perulangan, juga dikenal sebagai iterasi atau pengulangan, adalah konstruksi pemrograman yang memungkinkan serangkaian instruksi dieksekusi berulang kali hingga kondisi tertentu terpenuhi. Ini membantu mengotomatiskan tugas berulang atau memproses pengumpulan data. Ada berbagai jenis perulangan dalam pemrograman, seperti perulangan for, perulangan while, dan perulangan do-while. Perulangan ini memungkinkan eksekusi blok kode berkali-kali, baik berdasarkan hitungan tertentu atau hingga kondisi tertentu menjadi salah.'
            ],
            [
                'topic_name' => 'Fungsi 1',
                'description' => 'Perulangan, juga dikenal sebagai iterasi atau pengulangan, adalah konstruksi pemrograman yang memungkinkan serangkaian instruksi dieksekusi berulang kali hingga kondisi tertentu terpenuhi. Ini membantu mengotomatiskan tugas berulang atau memproses pengumpulan data. Ada berbagai jenis perulangan dalam pemrograman, seperti perulangan for, perulangan while, dan perulangan do-while. Perulangan ini memungkinkan eksekusi blok kode berkali-kali, baik berdasarkan hitungan tertentu atau hingga kondisi tertentu menjadi salah.'
            ],
            [
                'topic_name' => 'Fungsi 2',
                'description' => 'Perulangan, juga dikenal sebagai iterasi atau pengulangan, adalah konstruksi pemrograman yang memungkinkan serangkaian instruksi dieksekusi berulang kali hingga kondisi tertentu terpenuhi. Ini membantu mengotomatiskan tugas berulang atau memproses pengumpulan data. Ada berbagai jenis perulangan dalam pemrograman, seperti perulangan for, perulangan while, dan perulangan do-while. Perulangan ini memungkinkan eksekusi blok kode berkali-kali, baik berdasarkan hitungan tertentu atau hingga kondisi tertentu menjadi salah.'
            ],
        ];

        Topic::insert($data); // Replace with your model name
    }
}
