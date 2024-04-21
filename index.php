<?php
session_start();
require "./connection.php";
if (!isset($_SESSION["email"])) {
    header("Location:./Signin_up/signin.php");
    exit;
}
    
// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
//Khoi tao tim kiem
$search = "";
if (isset($_POST["search"])) {
    $search = trim($_POST["search"]);
    //Cau truy van tim kiem voi LIKE
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
    $result = $conn->query($sql);
}

if (isset($_POST["absolutesearch"])) {
    $absolutesearch = trim($_POST["absolutesearch"]);
    //Cau truy van tim kiem voi LIKE va toan tu '='
    $sql = "SELECT * FROM products WHERE name = '$absolutesearch'";
    $result = $conn->query($sql);
  }
?>

<?php
include './layouts/header.php'; ?>
<table border="1" class="table-auto">

    <tbody>
        <?php
        if ($result->rowCount() > 0) {
            echo '<div class="flex flex-col">';
            echo '  <div class="-m-1.5 overflow-x-auto">';
            echo '    <div class="p-1.5 min-w-full inline-block align-middle">';
            echo '      <div class="overflow-hidden">';
            echo '        <table class="min-w-full divide-y divide-gray-200">';
            echo '          <thead>';
            echo '            <tr>';
            echo '              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Name</th>';
            echo '              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Description</th>';
            echo '              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Price</th>';
            echo '              <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Image</th>';
            echo '              <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>';
            echo '            </tr>';
            echo '          </thead>';
            echo '          <tbody>';
          
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
              echo '            <tr class="odd:bg-white even:bg-gray-100">';
              echo '              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">' . $row["name"] . '</td>';
              echo '              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">' . $row["description"] . '</td>';
              echo '              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">' . $row["price"] . '</td>';
              echo '              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">' . $row["image"] . '</td>';
              echo '              <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">';
              
              echo '                <a href="./CRUD_form/update_pro.php?id=' . $row["id"] . '" class="text-blue-600 hover:text-blue-800">Edit</a> |';
              echo '                <button type="button" onclick="confirmDelete(' . $row['id'] . ')" class="text-red-600 hover:text-red-800">Delete</button>';
              echo ' </td>';
                echo ' </tr>';
                }

                echo ' </tbody>';
            echo '
        </table>';
        echo '
    </div>';
    echo ' </div>';
    echo ' </div>';
    echo '</div>';
    } else {
    echo "<tr>
        <td colspan='5'>No product found</td>
    </tr>";
    }
    ?>
    </tbody>
</table>
<?php
include './layouts/footer.php'; ?>
</div>
</body>


</html>