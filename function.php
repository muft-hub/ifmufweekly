<?php
  $connection = mysqli_connect('localhost', 'root', 'muft', 'mhsweekly');
  
  function showData($query){
    global $connection;
    $result = mysqli_query($connection, $query);

    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
      $rows[] = $row;
    }
    return $rows;
  }

  function addData($data, $file){
    global $connection;

    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $program_studi = htmlspecialchars($data['program_studi']);
    $email = htmlspecialchars($data['email']); 
    $nomor_hp = htmlspecialchars($data['nomor_hp']);
    $foto = $file['name'];
    $formatted_foto = date('dmYhis_').$foto;
    $foto_tmp = $file['tmp_name'];
    $foto_dir = './assets/images/';
    if(move_uploaded_file($foto_tmp, $foto_dir . $formatted_foto)){
      $query = "INSERT INTO mahasiswa (nama, nim, program_studi, email, nomor_hp, foto) VALUES ('$nama', '$nim', '$program_studi', '$email', '$nomor_hp', '$formatted_foto')";
      mysqli_query($connection, $query);
    }

    return mysqli_affected_rows($connection);
  }

  function deleteData($id){
    global $connection;
    $query = "DELETE FROM mahasiswa WHERE id = $id";
    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
  }

  function updateData($data, $file){
    global $connection;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $program_studi = htmlspecialchars($data['program_studi']);
    $email = htmlspecialchars($data['email']);
    $nomor_hp = htmlspecialchars($data['nomor_hp']);

    // Get current photo from database
    $result = mysqli_query($connection, "SELECT foto FROM mahasiswa WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
    $current_foto = $row['foto'];

    $foto_to_save = $current_foto; // Default to current photo

    // Check if a new file was uploaded
    if ($file['error'] === 0) {
        $foto = $file['name'];
        $formatted_foto = date('dmYhis_').$foto;
        $foto_tmp = $file['tmp_name'];
        $foto_dir = './assets/images/';

        if(move_uploaded_file($foto_tmp, $foto_dir . $formatted_foto)){
            $foto_to_save = $formatted_foto;
        } else {
            // Log error if file move fails, but proceed with other updates
            error_log("Failed to move uploaded file for ID: $id");
        }
    }

    $query = "UPDATE mahasiswa SET
                nama = '$nama',
                nim = '$nim',
                program_studi = '$program_studi',
                email = '$email',
                nomor_hp = '$nomor_hp',
                foto = '$foto_to_save'
              WHERE id = $id";

    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
  }

  function createUsersTable(){
    global $connection;
    $query = "CREATE TABLE IF NOT EXISTS users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(100) NOT NULL,
      email VARCHAR(100) NOT NULL UNIQUE,
      password VARCHAR(255) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    mysqli_query($connection, $query);
  }

  function registerUser($data){
    global $connection;
    createUsersTable();

    $username = htmlspecialchars(stripslashes($data['username']));
    $email = htmlspecialchars(strtolower($data['email']));
    $password = mysqli_real_escape_string($connection, $data['password']);
    $password_confirm = mysqli_real_escape_string($connection, $data['password_confirm']);

    // Check if email already registered
    $check = mysqli_query($connection, "SELECT email FROM users WHERE email = '$email'");
    if(mysqli_fetch_assoc($check)){
      return -1; // Email already exists
    }

    // Check password match
    if($password !== $password_confirm){
      return -2; // Passwords don't match
    }

    // Hash password
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_hashed')";
    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
  }

  function loginUser($data){
    global $connection;
    createUsersTable();

    $email = htmlspecialchars(strtolower($data['email']));
    $password = $data['password'];

    $result = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);

    // Check if user exists
    if(!$row){
      return -1; // User not found
    }

    // Verify password
    if(!password_verify($password, $row['password'])){
      return -2; // Wrong password
    }

    // Set session
    $_SESSION['login'] = true;
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $row['email'];

    return 1; // Login success
  }
?>