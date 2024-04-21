<?php
$name = "";
$email = "";
$phone = "";
$born = "";
$password = "";

// Lay gia tri POST tu form khi SUBMIT
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['name'])){
        $name = $_POST['name'];
    }

    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }

    if(isset($_POST['phone'])){
        $phone = $_POST['phone'];
    }

    if(isset($_POST['born'])){
        $born = $_POST['born'];
    }

    if(isset($_POST['password'])){
        $password = $_POST['password'];
    }

    /* Validate form */
    // B1
    $errors = [];

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $born = trim($_POST["born"]);
    $password = $_POST["password"];

    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    if (empty($phone)) {
        $errors["phone"] = "Phone is required";
    }elseif (strlen($phone)!==10){
        $errors["phone"] = "Only 10 chracters";
    }elseif (substr($phone,0,1)!=="0") {
        $errors["phone"] = "Start from 0";
    }
    for($i=0;$i<strlen($phone);$i++){
        if(!is_numeric($phone[$i])){
            $errors["phone"] = "Chracters must be number";
        }
    }

    if (empty($born)) {
        $errors["born"] = "Date of birth is required";
    }

    if (empty($password)) {
        $errors["password"] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Password must be at least 8 characters long";
    }

    // B2
    if (empty($errors)) {
        require_once "../connection.php";
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, phone, born, password) VALUES ('$name', '$email', '$phone','$born', '$hashed_password')";

        if ($conn->exec($sql)==1) {
            echo '<h2 class="text-[#2ecc71] font-bold">Add data successfully!</h2>';
            $name = $email = $phone = $born = $password = "";
            header("Refresh:1; url=./signin.php");
        }else {
            echo '<h2 class="text-[#c0392b] font-bold">Add data failed!</h2>';
        }
    
    }
}
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to
                your account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <!--  -->
            <form class="space-y-6" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
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
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                        address</label>
                    <div class="mt-2">
                        <input id="email" name="email" class=" block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset
                            ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600
                            sm:text-sm sm:leading-6">
                        <?php if(isset($errors["email"])) { ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors["email"]; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Phone</label>
                    <div class="mt-2">
                        <input id="phone" name="phone" type="phone" autocomplete="phone"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <?php if(isset($errors["phone"])) { ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors["phone"]; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!-- Born -->
                <div>
                    <label for="born" class="block text-sm font-medium leading-6 text-gray-900">Born</label>
                    <div class="mt-2">
                        <input id="born" name="born" type="date" autocomplete="born"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <?php if(isset($errors["born"])) { ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors["born"]; ?></p>
                        <?php } ?>
                    </div>
                </div>
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <?php if(isset($errors["password"])) { ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors["password"]; ?></p>
                        <?php } ?>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        up</button>
                </div>
                <div>
                    <a href="../index.php"
                        class="flex w-full justify-center rounded-md bg-neutral-900 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-neutral-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Home
                        Page</a>
                </div>
            </form>
            <p class="mt-10 text-center text-sm text-gray-500">
                Do you already have an account?
                <a href="./signin.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Click here
                    to signin</a>
            </p>
        </div>
    </div>
</body>

</html>