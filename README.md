# tiketing_parking
 Aplikasi "My Parking System" untuk keperluan soal test interview kerja PT. Maskapai Reasuransi Indonesia Tbk

 HALAMAN MASTER USER (Master Data > User)
 - Digunakan untuk input user baru
 - Terdapat 4 Inputan (Nama Lengkap, Username, Password, dan Level)
 - Ada 2 Level 
   > Level 0 (Admin) : Admin bisa mengakses menu Master Data, sehingga Admin dapat menambahkan user baru
   > Level 1 (Staff) : Staff hanya bisa melakukan input Create Tiket di menu Form Tiketing
 - Selain fungsi Add (Insert), terdapat fungsi Edit (Update), dan Hapus (Delete) data
 - Validasi
   > Username yang sudah terdaftar tidak dapat di input kembali, berlaku ketika update juga
   > Ketika Update password 1 (Password) & password 2 (Confirm Password) harus sama
   > Nama lengkap yang sudah terdaftar di database sebelumnya tidak dapat di input kembali saat menambah user baik saat insert maupun saat melakukan edit (Update)

 HALAMAN MASTER TARIF PARKIR KENDARAAN (Master Data > Tarif Parkir Kendaraan)
 - Digunakan untuk menambahkan jenis kendaraan dan menambhakan tarif parkir sesuai dengan jenis kendaraan
 - Terdapat 2 inputan (Jenis Kendaraan & Tarif Parkir Per Jam)
 - Selain fungsi Add (Insert), terdapat fungsi Edit (Update), dan Hapus (Delete) data
 - Validasi
   > Jenis Kendaraan yang sudah di input sebelumnya tidak dapat di input lagi, berlaku saat dilakukan edit data

HALAMAN Form Tiketing (Form Tiketing)
- Digunakan untuk input data parkiran
- Dibagi menjadi 2 bagian (Tiket Masuk & Tiket Keluar)
- Form Tiket Masuk terdiri dari 4 inputan (Kode Tiket, Jenis Kendaraan, Plat Nomor, Jam Masuk)
- Kode Tiket akan tergenerate secara otomatis oleh sistem dengan format (cth : PC001)
- Kode Tiket tidak dapat di ketik manual (Untuk mencegah duplikat data dan salah penginputan)
- Jenis Kendaraan dapat di ambil dari data yang sudah di input di Halaman Tarif Parkir Kendaraan
- Jenis Kendaraan dibuat dropdown menu dengan live search.
- Plat Nomor Terdiri dari 3 kolom inputan
  > Inputan pertama berisi Kode Huruf Awal pada plat kendaraan
  > Inputan kedua berisi kode nomor pada plat kendaraan
  > Inputan ketiga berisi Kode Huruf Akhir pada plat kendaraan
- Nantinya dari ketiga kolom ini akan digabungkan menjadi 1 seperti format plat kendaraan pada umumnya
- Jam masuk bersifat real sesuai dengan jam yang ada di sistem, tetapi yang kita lihat jam masuk tidak berubah - ubah secara live, karena bersifat statis, sehingga untuk merubah jam dan tanggal tinggal me refresh halaman saja
- Jam Masuk bersifat readonly atau hanya dapat membaca data sehingga tidak dapat di edit secara manual

- Form Tiket Keluar teridiri dari 7 inputan yaitu Plat Nomor, Kode Tiket, Jenis Kendaraan, Jam Masuk, Jam Keluar, Durasi, Tarif Parkir
- Plat nomor menggunakan dropdown yang berisi plat nomor yang sudah pernah di input di form Tiket Masuk sebelumnya.
- Setelah memilih plat nomor data akan otomatis terload (autofill).
- Data yang otomatis terload (autofill) yaitu : Kode Tiket, Jenis Kendaraan, Jam Masuk
- Setelah memilih plat nomor kolom inputan Jam Keluar akan terbuka dan bisa di input secara manual untuk mendapatkan durasi dan tarif parkir
- User tak perlu mengetik secara manual untuk tanggal nya karena sudah ada fungsi seperti kalender.
- Ketika Jam Keluar di pilih maka kolom Durasi dan Tarif Parkir akan otomatis terload (autofill) dan terkalkulasi
- Tombol Save untuk simpan hasil inputan
- Tombol Cancel untuk reset data, sehingga user tak perlu hapus manual, tinggal pencet tombol canvel saja data yang tadi sudah di input otomatis akant ereset.
- Terdapat gridview yang berisi list tiket yang sudah di input pada Form Tiket Masuk dan di update pada Form Tiket Keluar
- Terdapat tombol Detail (Untuk melihat detail dari data yang di pilih), Update (untuk melakukan update pada data yang sudah pernah di input sebelumnya), delete (untuk delete data yang kita mau)
- Selama kendaraan belum keluar parkir maka data tiket bias di update
- Jika kendaraan sudah keluar pakir maka data sudah tidak dapat di edit kembali
- Tombol delete ada di semus status data
- Pada menu Update (Edit Tiket) hanya kolom Plat Nomor dan Jenis Kendaraan yang dapat di update
- Diatas kanan gridview terdapat kolom searching yang berguna untuk mencari data berdasarkan semua variable kecuali variable action
- Di samping kiri terdapat tombol print dimana kita dapat menyimpannya dalam bentuk PDF atau dapat langsung di print juga.

