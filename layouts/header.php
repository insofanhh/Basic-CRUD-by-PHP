<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    function confirmDelete(id) {
        var result = confirm("Are you sure, darling?");
        if (result) {
            window.location.href = "./CRUD_form/delete_pro.php?id=" + id;
        }
    }
    </script>
    <link rel="stylesheet" href="./index.css">

</head>

<body>
    <div class="container mx-auto px-14">
        <header>
            <nav class="bg-[#2c3e50] px-4 lg:px-6 py-1 pt-4">
                <div class="flex justify-between py-2">
                    <a class="font-bold text-white" href="./index.php">PRODUCT INFOMATION</a>
                    <div class="text-white">
                        <?php $email = $_SESSION["email"];
                    echo "Chào mừng ".$email."!";?>
                    </div>
                    <div class="flex justify-between">
                        <form action="" method="POST">
                            <input type="text" name="search" placeholder="Search..."
                                class="border rounded-lg py-1 px-2">
                            <button type="submit" class="bg-[#2c3e50] text-white py-1 px-2 rounded-lg"></button>
                        </form>
                        <form action="" method="POST">
                            <input type="text" name="absolutesearch" placeholder="Absolute search"
                                class="border rounded-lg py-1 px-2">
                            <button type="submit" class="bg-[#2c3e50] text-white py-1 px-2 rounded-lg"></button>
                        </form>

                    </div>
                    <div class="flex justify-between">
                        <a class="text-white hover:text-blue-800 bg-[#c0392b] py-1 px-1 rounded-sm"
                            href="./CRUD_form/create_pro.php">Create new</a>
                        <a class="text-white hover:bg-sky-700 bg-[#2c3e50] py-1 px-1 rounded-sm"
                            href="./Signin_up/logout.php">Log
                            out</a>
                    </div>
                </div>
            </nav>
        </header>