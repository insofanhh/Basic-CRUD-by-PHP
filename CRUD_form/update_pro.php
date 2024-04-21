<?php
session_start();
require_once "../connection.php";

if (!isset($_SESSION["email"])) {
    header("Location:../Signin_up/signin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin của sản phẩm
    $sql = "SELECT * FROM products WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            
        $name = $row["name"];
        $description = $row["description"];
        $price = $row["price"];
        if (isset($row["image"])) {
            $targetFile = $row["image"];
        }else {
            $targetFile = "";
        }
        }
    } else {
        echo "Product not found!";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $id = $_POST['id'];

    $targetDirectory = "upload/";
    $targetFile = $targetDirectory.basename($_FILES["image"]["name"]);
    if (file_exists($targetFile)) {
        echo "Tep tin da ton tai!<br>";
    }else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "Tep tin ".basename($_FILES["image"]["name"])." da tai len thanh cong!<br>";
        }else {
            echo "Da xay ra loi khi tai len<br>";
        }
    }
    
    // Cập nhật thông tin sản phẩm
    $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$targetFile' WHERE id=$id";

    if ($conn->exec($sql) == 1) {
        echo '<h2 class="text-[#2ecc71] font-bold">Record updated successfully!</h2>';
        header("Refresh:1; url=../index.php");
}else{
    echo '<h2 class="text-[#c0392b] font-bold">Record updated failed!</h2>';
}
}
?>

<?php
include_once '../layouts/header.php'; ?>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Update product
            infomation!</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="update_pro.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <input id="name" name="name" type="name" autocomplete="name" value="<?php echo $name; ?>" required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                <div class="mt-2">
                    <input id="description" name="description" type="description" autocomplete="description"
                        value="<?php echo $description; ?>" required
                        class="block w-full rounded-md border-0 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                <div class="mt-2">
                    <input id="price" name="price" type="price" autocomplete="price" value="<?php echo $price; ?>"
                        required
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                <div class="mt-2">
                    <input id="image" name="image" type="file" autocomplete="image" value="<?php echo $image; ?>">
                </div>
            </div>


            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update
                    Product</button>
            </div>
            <div>
                <a href="../index.php"
                    class="flex w-full justify-center rounded-md bg-neutral-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-neutral-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Back
                    Home</a>
            </div>
        </form>

    </div>
</div>


<!-- <form action="update_product" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $description; ?></textarea><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" value="<?php echo $price; ?>"><br><br>
        <input type="submit" value="Update Product">
    </form> -->
</body>

</html>