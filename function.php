<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "english_course");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function add($data) {
    global $conn;
    $name = htmlspecialchars($data['name']);
    $level = htmlspecialchars($data['level']);
    $birthplace = htmlspecialchars($data['birthplace']);
    $year_of_birth = htmlspecialchars($data['year_of_birth']);
    $email = htmlspecialchars($data['email']);
    
    // cek apakah upload gambar berhasil
    $photo = upload();
    if ( !$photo ) {
        return false;
    }

    $query = "INSERT INTO student VALUES 
    ('', '$level', '$name', '$birthplace', '$year_of_birth', '$email', '$photo')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function change($data) {
    global $conn;
    $id = $data['id'];
    $name = htmlspecialchars($data['name']);
    $level = htmlspecialchars($data['level']);
    $birthplace = htmlspecialchars($data['birthplace']);
    $year_of_birth = htmlspecialchars($data['year_of_birth']);
    $email = htmlspecialchars($data['email']);
    $photoLama = $data['photoLama'];

    // cek apakah user pilih gambar baru atau tidak
    if ( $_FILES['photo']['error'] === 4 ) {
        $photo = $photoLama;
    }else {
        $photo = upload();
    }

    if ( !$photo ) {
        return false;
    } else{
        $query = "UPDATE student SET
                    name = '$name',
                    level = '$level',
                    email = '$email',
                    birthplace = '$birthplace',
                    year_of_birth = '$year_of_birth',
                    email = '$email',
                    photo = '$photo'
                    WHERE id = $id
                    ";
        
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

}

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM student WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM student
                 WHERE 
                 name like '%$keyword%' OR
                 birthplace like '%$keyword%' OR
                 year_of_birth like '%$keyword%' OR
                 email like '%$keyword%'";
    return query($query);
}

function upload(){
    $namaFile = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];
    $error = $_FILES['photo']['error'];
    $tmpName = $_FILES['photo']['tmp_name'];

    // cek apakah ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu !');
            </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ektensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if( !in_array($ekstensiGambar, $ektensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar / ekstensi file salah !');
            </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $size > 1000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar !');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}
// function of registration
function registration($data){
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $confim_password = mysqli_real_escape_string($conn, $data['confirm_password']);

    // cek apakah username telah digunakan
    $cek_user = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if( mysqli_fetch_assoc($cek_user) ) {
        echo "<script>
                alert('username sudah terdaftar!');
            </script>";
            return false;
    }
    
    // cek confirm password
    if( $password !== $confim_password ){
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    // tambahkan userbaru ke database 
    mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}  

?>