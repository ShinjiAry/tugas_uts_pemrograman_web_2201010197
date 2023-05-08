<?php 
// hubungkan dengan file koneksi.php
require_once('koneksi.php');

// sistem read data
if (isset($_GET['id'])) {

  // sanitize data
  $NIM = mysqli_real_escape_string($mysqli, $_GET['id']);
 
  // query untuk ambil data
  $sql = "SELECT * FROM tb_mhs_instiki WHERE NIM = '$NIM'";

  // eksekusi query
  $result = mysqli_query($mysqli, $sql);

  // cek apakah data ditemukan
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
  } else {
    // jika data tidak ditemukan
    echo "Data tidak ditemukan.";
    $data = [];
  }

  // berhenti mysqli
  mysqli_close($mysqli);
}

// sistem update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //mendapatkan data dari form update
  $NIM = $_POST['NIM'];
  $Nama = $_POST['Nama'];
  $Jurusan = $_POST['Jurusan'];
  $Prodi = $_POST['Prodi'];
  //update data buku ke database
  $query = "UPDATE tb_mhs_instiki SET 
     Nama='$Nama', 
     Jurusan='$Jurusan', 
     Prodi='$Prodi'
   WHERE NIM='$NIM' ";

  $result = mysqli_query($mysqli, $query);

  //cek apakah update berhasil
  if($result) {
    echo "Update data buku berhasil";
    header('Location: update.php?id='.$NIM);
  } else {
    echo "Update data buku gagal";
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <form action="update.php" method="POST">
    <div class="mb-3">
       <label for="exampleFormControlInput1" class="form-label">NIM </label>
       <input type="number" readonly class="form-control" name="NIM" id="exampleFormControlInput1" value="<?= $data['NIM'] ?>">
     </div>
     <div class="mb-3">
       <label for="exampleFormControlInput1" class="form-label">Nama </label>
       <input type="text" class="form-control" name="Nama" id="exampleFormControlInput1" value="<?= $data['Nama'] ?>" >
     </div>
     <div class="mb-3">
       <label for="exampleFormControlInput1" class="form-label">Jurusan </label>
       <input type="text" class="form-control" name="Jurusan" id="exampleFormControlInput1" value="<?= $data['Jurusan'] ?>">
     </div>
     <div class="mb-3">
       <label for="exampleFormControlInput1" class="form-label">Prodi </label>
       <input type="text" class="form-control" name="Prodi" id="exampleFormControlInput1" value="<?= $data['Prodi'] ?>">
     </div>
     <div>
       <button type="submit" class="btn btn-primary">Kirim</button>
     </div>
    </form>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>