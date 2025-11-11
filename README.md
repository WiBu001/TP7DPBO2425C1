# TP7DPBO2425C1

## Janji

Saya Daffa Dhiyaa Candra dengan NIM 2404286 mengerjakan  
TP 7 dalam mata kuliah Desain dan Pemrograman  
Berorientasi Objek untuk keberkahanNya maka saya tidak  
melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.  

## Desain Program

### 🕹️ Tentang GameHub
**GameHub** adalah aplikasi web sederhana berbasis PHP yang memungkinkan pengguna untuk mengelola data **User**, **Game**, **Genre**, dan **Library** (koleksi game yang dimiliki user).  

Aplikasi ini dibangun menggunakan konsep **PBO (Pemrograman Berorientasi Objek)**, **PDO (Prepared Statement)** untuk koneksi database yang aman, dan **struktur modular MVC-like**.

---

#### 🧍 User.php
- Menangani CRUD pengguna.
- Method:  
  `getAllUsers()`, `createUser()`, `updateUser()`, `deleteUser()`, `getUserById()`

#### 🎮 Game.php
- Menangani CRUD game dan join dengan tabel genre.
- Method:  
  `getAllGames()`, `createGame()`, `updateGame()`, `deleteGame()`, `getGameById()`

#### 🧩 Genre.php
- Menangani CRUD genre.
- Method:  
  `getAllGenres()`, `createGenre()`, `updateGenre()`, `deleteGenre()`, `getGenreById()`

#### 📚 Library.php
- Menangani data relasi antara user dan game.
- Method:  
  `getAllLibraries()`, `createLibrary()`, `updateLibrary()`, `deleteLibrary()`, `getLibraryById()`

### Keamanan Query

Semua query SQL menggunakan Prepared Statement untuk mencegah SQL Injection.  

---

### ERD

![Diagram](Diagram%20TP7.png)  

## ⚙️ Penjelasan Alur Program

### 🧩 1. Inisialisasi & Koneksi Database
- File `config/db.php` berisi class **Database** yang mengatur koneksi ke MySQL menggunakan **PDO**.  
- Semua class model (`User.php`, `Game.php`, `Library.php`, `genre.php`) membuat koneksi ke database dengan memanggil class ini.
- Penggunaan **Prepared Statement** menjamin keamanan dari **SQL Injection**.

---

### 🧑‍💻 2. Struktur MVC Sederhana
Aplikasi ini menggunakan pendekatan **MVC sederhana (Model–View–Controller-like)**:
- Folder **class/** berisi **Model** (logika bisnis dan query ke database)
- Folder **view/** berisi **View** (tampilan/form HTML untuk CRUD)
- File utama `index.php` berfungsi sebagai **Controller** sederhana yang mengatur navigasi antar halaman.

---

### 🎮 3. Alur Fungsionalitas (CRUD)
Setiap entitas memiliki fitur **Create, Read, Update, Delete**:

#### 🔸 a. User
- **Create**: Tambah user baru melalui form input (username & password).
- **Read**: Menampilkan semua user dari database dalam bentuk tabel.
- **Update**: Edit username atau password user tertentu.
- **Delete**: Hapus user berdasarkan `id`.

#### 🔸 b. Game
- **Create**: Tambah game baru (judul, harga, developer, genre).
- **Read**: Menampilkan daftar game beserta genre-nya.
- **Update**: Ubah data game tertentu.
- **Delete**: Hapus game dari database.

#### 🔸 c. Library
- **Relasi**: `Library` berelasi dengan `User` dan `Game` melalui foreign key (`user_id`, `game_id`).
- **Create**: Tambahkan game ke library milik user.
- **Read**: Tampilkan daftar game yang dimiliki user tertentu.
- **Update**: Ubah data library (misalnya status pembelian).
- **Delete**: Hapus game dari library user.

#### 🔸 d. Genre
- **Create**: Tambah genre baru (nama genre).
- **Read**: Menampilkan genre.
- **Update**: Ubah data genre tertentu.
- **Delete**: Hapus genre dari database.

---

### 🔗 4. Relasi Antar Tabel
Database memiliki hubungan **one-to-many**:
- Satu **User** dapat memiliki banyak **Library**.
- Satu **Game** dapat muncul di banyak **Library**.
- Tabel **Library** menjadi jembatan (relasi) antara **User** dan **Game**.
- Satu **Genre** dapat dimiliki banyak **Game**

## Dokumentasi

<video width="600" controls>
  <source src="Dokumentasi%20TP7.mp4" type="video/mp4">
  Browser kamu tidak mendukung video tag.
</video>