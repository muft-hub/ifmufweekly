<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name
    </head>
    <body>
        <h2> Tambah Data Mahasiswa</h2>
        <form action="mahasiswa.php" method="post">
            <table>
                <tr>
                    <td> <label for="nama">Nama:</label></td>
                    <td>:</td>
                    <td><input type="text" name="nama" id="nama"/></td>
                </tr>
                <tr>
                    <td> <label for="foto">Foto:</label></td>
                    <td>:</td>
                    <td><input type="file" name="foto" id="foto"/></td>
                </tr>
                <tr>
                    <td> <label for="uts">UTS:</label></td>
                    <td>:</td>
                    <td><input type="number" name="uts" id="uts"/></td>
                </tr>
                <tr>
                    <td> <label for="uas">UAS:</label></td>
                    <td>:</td>
                    <td><input type="number" name="uas" id="uas"/></td>
                </tr>
                <tr>
                    <td> <label for="tugas">Tugas:</label></td>
                    <td>:</td>
                    <td><input type="number" name="tugas" id="tugas"/></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button type="submit" name"submit">
                            Tambah
                        </button>
                    </td>
                </tr>
            
        </form>
        <a href="mahasiswa.php">Back</a>
    <?php 
    require 'fungsi.php';
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    
    if(isset($_POST['kirim']))
    {
        $query = "INSERT INTO mahasiswa (nama, nim, jurusan, email, nohp, foto)"
        VALUES ('$nama', '$nim')

        mysqli_query($koneksi, $query);
    }
    ?>
    }

    </body>
</html>