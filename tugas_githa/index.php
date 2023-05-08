<?php 
require_once('koneksi.php');
// memanggil data dengan read_data
function read_data() {

 global $mysqli;

 $query = " SELECT * FROM tb_mhs_instiki ";
 $result = mysqli_query($mysqli, $query);

 if ($result && mysqli_num_rows($result) > 0) {
   $data = array();
   while ($row = mysqli_fetch_assoc($result)) {
     $data[] = $row;
   }
   return $data;
 } else {
   // jika query kosong, kembalikan array kosong
   return array();
 }
}

$data_tabel = read_data();

// 2. sistem hapus data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $NIM = $_POST['NIM'];

 // Query untuk menghapus data buku berdasarkan ID
 $query = "DELETE FROM tb_mhs_instiki WHERE NIM = '$NIM'";

 // Eksekusi query
 if(mysqli_query($mysqli, $query)) {
   // Redirect ke halaman sebelumnya
   header("Location: {$_SERVER['HTTP_REFERER']}");
   exit();
 } else {
   echo "Error deleting record: " . mysqli_error($conn);
 }

 // Tutup koneksi
 mysqli_close($conn);
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
<!-- Table -->
<section>
</head>
  <body>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">NIM</th>
      <th scope="col">NAMA</th>
      <th scope="col">Jurusan</th>
      <th scope="col">Prodi</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php 
      for($i = 0; $i < count($data_tabel); $i++) {
    ?>
    <tr>
      <th scope="row"><?php echo $i +1 ?></th>
      <td><?php echo $data_tabel[$i]['NIM'] ?></td>
      <td><?php echo $data_tabel[$i]['Nama'] ?></td>
      <td><?php echo $data_tabel[$i]['Jurusan'] ?></td>
      <td><?php echo $data_tabel[$i]['Prodi'] ?></td>
      <td scope="row">
            <div class="row">
              <div class="col">
                <a href="update.php?id=<?= $data_tabel[$i]['NIM'] ?>" style="width:100%" class="btn btn-outline-secondary">
                Update
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-check" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                  <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                  <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                </svg>
                </a>
              </div>
              <div class="col">
                <form action="index.php" method="POST">
                  <input type="hidden" value="<?= $data_tabel[$i]['NIM'] ?>" name="NIM">
                  <button type="submit" onclick="return confirm('yakin ingin di hapus?')" style="width:100%" class="btn btn-outline-danger">
                    Hapus
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                      <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          </td>
    </tr>
  <?php 
        }
      ?>
  </tbody>
</table>
</section>
  
  </body>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

     <!-- Option 2: Separate Popper and Bootstrap JS -->
     <!--
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
     -->
</html>
