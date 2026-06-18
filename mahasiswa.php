<?php
$koneksi = mysqli_connect("localhost", "root", "root", "mufweekly-ife");

if($koneksi){
  echo "KONEKSI BERHASIL";
}

$query = "SELECT * from Mahasiswa";

$result = mysqli_query($koneksi, $query);

//// require "fungsi.php";
//// $query = "SELECT * from mahasiswa";
//// tampildata($qmahasiswa);

////$mhs = mysqli_fetch_assoc($result);
////{
////var_dump($mhs);
////}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Data Mahasiswa</title>
  <link rel="stylesheet" href="style.css">

  <style>
    .latihan-table {
      border-collapse: collapse;
    }
    .latihan-table td {
      border: 2px solid black;
      width: 80px;
      height: 50px;
      text-align: center;
      vertical-align: middle;
      font-size: 16px;
    }
  </style>
</head>
<body>
 <table border="1" align="center" cellpadding="10">
    <tr align="center">
      <td><a href="index.php">Home</a></td>
      <td><a href="profile.php">Profile</a></td>
      <td><a href="mahasiswa.php">Data Mahasiswa</a></td>
      <td><a href="contact.php">Contact</a></td>
    </tr>
  </table>
  

  <h2>Data Mahasiswa</h2>

<table class="latihan-table" border="1" cellpadding="20" style="margin-top: 20px;">
  <tr>
    <th>Nama</th>
    <th>Nim</th>
    <th>Program Studi</th>
    <th>Email</th>
    <th>No.HP</th>
    <th>Foto</th>
    <th>Aksi</th>

  </tr>
<?php
while($mhs = mysqli_fetch_assoc($result))
  {
?>

  <tr>
    <td><?php echo $mhs["nama"] ?></td>
    <td><?php echo $mhs["nim"] ?></td>
    <td><?= $mhs["jurusan"] ?></td>
    <td>kirky@epstein.com</td>
    <td>08676767676767</td>
    <td>kirk.jpg</td>
 <td>
        <a href="editdata.php?id=<?php echo $data['id']; ?>">
            <button type="button" style="background-color: #007bff; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                Edit
            </button>
        </a>

        <a href="hapusdata.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa bernama <?php echo $data['nama']; ?>?');">
            <button type="button" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                Hapus
            </button>
        </a>
    </td>
  </tr>
<?php
  }
  ?>

  <tr>
    <td>Rusdi</td>
    <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRPxocBpe5W3AEom3-ePPjMMpPS29MK07mrEQ&s " width="50"></td>
    <td>76</td>
    <td>67</td>
    <td>89</td>
    <td>10</td>
  </tr>

  <tr>
    <td>Gatot</td>
    <td><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSytPpMye2yokGMKhAqJsiKSTYLPxRqOo6Jag&s" width="50"></td>
    <td>89</td>
    <td>11</td>
    <td>12</td>
    <td>13</td>
  </tr>

<table class="latihan-table" border="1" cellpadding="20" style="margin-top: 20px;">
<caption>LATIHAN</caption>
  <tr>
    <td>1,1</td>
    <td>1,2</td>
    <td>1,3</td>
    <td>1,4</td>
  </tr>
  <tr>
    <td>2,1</td>
    <td align="center" rowspan="2" colspan="2" style="font-size:30px;">?</td>
    <td>2,4</td>
  </tr>
  <tr>
    <td>3,1</td>
    <td>3,4</td>
  </tr>
   <tr>
    <td>4,1</td>
    <td>4,2</td>
    <td>4,3</td>
    <td>4,4</td>
  </tr>
  </table>
</body>   