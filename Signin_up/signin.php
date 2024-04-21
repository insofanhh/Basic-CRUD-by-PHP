<?php
session_start();

include "../connection.php";

$email = "";
$password = "";
$errors = [];

if (isset($_POST["login"])) {
  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  // Xác thực
  if (empty($email)) {
    $errors["email"] = "Email is required";
  }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors["email"]="Invalid email format";
  }

  if (empty($password)) {
    $errors["password"] = "Password is required";
  }

  if (empty($errors)) {
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {          
        $_SESSION["email"] = $email;
        header("Location: ../index.php");
        exit;
      }
    } else {
      $errors["login"] = "Wrong email or password";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">

            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your
                account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                        address</label>
                    <div class="mt-2">
                        <input id="email" name="email" value="<?php echo $email; ?>"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <?php if (isset($errors["email"])) { ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo $errors["email"]; ?></p>
                        <?php } ?>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>

                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password"
                            value="<?php echo $password; ?>"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <?php if (isset($errors["password"])) { ?>
                        <p class="text-red-500 text-xs py-2 "><?php echo $errors["password"]; ?></p>
                        <?php } ?>
                    </div>
                </div>

                <div class="py-5">
                    <?php if (isset($errors["login"])) { ?>
                    <p class="text-red-500 text-xs mb-5"><?php echo $errors["login"]; ?></p>
                    <?php } ?>
                    <button type="submit" name="login"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        in</button>
                </div>
            </form>
            <p class="mt-10 text-center text-sm text-gray-500">
                Not a member?
                <a href="./signup.php" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Click here
                    to
                    become</a>
            </p>
        </div>
    </div>
</body>

</html>