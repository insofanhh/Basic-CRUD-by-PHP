<?php
session_start();
require_once "../connection.php";
if (!isset($_SESSION["email"])) {
    header("Location:../Signin_up/signin.php");
    exit;
}
    
$name = "";
$description = "";
$price = "";


// Lay gia tri POST tu form khi SUBMIT
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }

    if(isset($_POST['description'])){
        $description = $_POST['description'];
    }

    if(isset($_POST['price'])){
        $price = $_POST['price'];
    }

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

    /* Validate form */
    // B1
    $errors = [];

    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);
    
    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    if (empty($description)) {
        $errors["description"] = "Description is required";
    }

    if (empty($price)) {
        $errors["price"] = " Price is required";
    }

    // B2
    if (empty($errors)) {
        require_once "../connection.php";
        
        $sql = "INSERT INTO products (name, description, price, image) VALUES ('$name', '$description', '$price', '$targetFile')";

        if ($conn->exec($sql)==1) {
            echo '<h2 class="text-[#2ecc71] font-bold">Add data successfully!</h2>';
            $name = $description = $price = "";
            header("Refresh:1; url=../index.php");
        }else {
            echo '<h2 class="text-[#c0392b] font-bold">Add data failed!</h2>';
        }
    
    }
}
 
?>

<?php
include_once '../layouts/header.php'; ?>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Add your product
            infomation here!</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <!--  -->
        <form class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"
            enctype="multipart/form-data">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                <div class="mt-2">
                    <input id="name" name="name" type="name" autocomplete="name"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <?php if(isset($errors["name"])) { ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors["name"]; ?></p>
                    <?php } ?>
                </div>
            </div>
            <!-- Description -->
            <div class="">
                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                <div class="mt-2">
                    <textarea id="description" name="description" rows="3"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    <?php if(isset($errors["description"])) { ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors["description"]; ?></p>
                    <?php } ?>
                </div>
            </div>

            <!-- <div>
                    <label for="description"
                        class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                    <div class="mt-2">
                        <input id="description" name="description" type="textarea" class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset
                            ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600
                            sm:text-sm sm:leading-6">
                        <?php if(isset($errors["description"])) { ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors["description"]; ?></p>
                        <?php } ?>
                    </div>
                </div> -->
            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Price</label>
                <div class="mt-2">
                    <input id="price" name="price" type="price" autocomplete="price"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    <?php if(isset($errors["price"])) { ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo $errors["price"]; ?></p>
                    <?php } ?>
                </div>
            </div>
            <!-- Image -->
            <label for="" class="form-label">Image</label>
            <div class="mb-3">
                <input type="file" class="" id="" name="image">
            </div>
            <div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                    product</button>
            </div>
            <div>
                <a href="../index.php"
                    class="flex w-full justify-center rounded-md bg-neutral-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-neutral-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Home
                    Page</a>
            </div>
        </form>
    </div>
</div>
</body>

</html>