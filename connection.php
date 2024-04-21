<?php
// Cung cấp các thông tin: 
// - Tên máy chủ
    $servername = "localhost";
// - Tên người dùng
    $username = "root";
// - Mật khẩu
    $password = "";
// - Tên CSDL database
    $dbname = "asignment";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
       
        // Thiết lập chế độ báo lỗi cho PDO
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
        // var_dump($conn);
       
        echo "";
    } catch (PDOException $e) {
        echo "Kết nối CSDL không thành công<br>".$e->getMessage();
    }

// TRY và CATCH là cấu trúc của PHP được sử dụng để xử lí ngoại lệ (exception) trong quá trình thực hiện code
// TRY: code trong try có thể gây ra ngoại lệ => khi đó quá trình thực thi code dừng lại và chuyển sang khối code trong CATCH
?>