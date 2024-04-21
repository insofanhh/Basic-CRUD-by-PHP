<?php
session_start();
require_once "../connection.php";
if (!isset($_SESSION["email"])) {
    header("Location:../Signin_up/signin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa người dùng
    $sql = "DELETE FROM products WHERE id=$id";

    if ($conn->exec($sql) == 1) {
        header("Location: ../index.php");
    } else {
        echo '<h2 class="text-[#c0392b] font-bold">Deleted Failed!</h2>';
}
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="container mx-auto py-10 px-2">
        <a href="../index.php"
            class="w-30 justify-center rounded-md bg-neutral-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-neutral-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back
            Home</a>
    </div>
</body>

</html>