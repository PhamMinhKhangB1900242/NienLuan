<?php
require_once('../data/dbhelper.php');
session_start();

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/home.css">



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Danh Mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../home/cart.php">Giỏ Hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../login.php">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </nav>


</body>

<?php
$dbc = @mysqli_connect('localhost', 'root', '', 'dienthoi');
if (isset($_GET['id']) && isset($_POST['addcart'])) {
    $sql_s = "SELECT * FROM product WHERE id={$_GET['id']}";
    $query_s = mysqli_query($dbc, $sql_s);
    $row_s = mysqli_fetch_array($query_s);
    $i = 1;
    if (isset($_SESSION['cart'])) {
        $session_array_id = array_column($_SESSION['cart'], 'id');

        if (!in_array($_GET['id'], $session_array_id)) {

            if (mysqli_num_rows($query_s) != 0) {
                $id = count($_SESSION['cart']);
                $session_array = array(
                    'id' => $_GET['id'],
                    "title" => $row_s['title'],
                    "thumbnail" => $row_s['thumbnail'],
                    "price" => $row_s['price'],
                    "quantity" => 1,
                );
            }
            $_SESSION['cart'][$id] = $session_array;
            echo '<script>alert("Sản phẩm đã được thêm vào giỏ hàng")</script>';
        } else {

            echo '<script>alert("Sản phẩm đã tồn tại")</script>';
            echo '<script>window.location="cart.php"</script>';
        }
    } else {
        $session_array = array(
            'id' => $_GET['id'],
            "title" => $row_s['title'],
            "thumbnail" => $row_s['thumbnail'],
            "price" => $row_s['price'],
            "quantity" => 1,
        );

        $_SESSION['cart'][] = $session_array;
    }
}

echo '<div class="container ">
<h1 style="text-align: center;">GIỎ HÀNG</h1>
<table class="table">
  <thead scope="col">
      <tr>
          <th scope="col" colspan="2" style="text-align: center;">
              Sản Phẩm
          </th>
          <th scope="col">
              Số lượng
          </th>
          <th scope="col">
              Giá
          </th>
          <th scope="col">
              Thành Tiền
          </th>
          <th scope="col"> Xóa
          </th>
        </tr>
  </thead>
  <tbody scope="col">';

// var_dump($_SESSION['cart']);
// $values = null;
if (!empty($_SESSION['cart'])) {

    // if (is_array($values) || is_object($values)) {
    $total = 0;
    $i = 1;
    foreach ($_SESSION['cart'] as $key => $value) {
        echo '
                <div class="container-fluid row">
                    <div ="container"> 
                       
                        <tr>
                        <form method="post" action="thanhtoancart.php?action=addcart&id=' . $value['id'] . '">
                            <td scope="col" class="text-primary text-uppercase">
                            ' . $value['title'] . '
                            </td>
                            <td scope="col">
                            <img width="150px" src="' . $value['thumbnail'] . '">
                            </td>
                            <td scope="col"> 
                            ' . ($value['quantity']) . '
                            </td>
                            <td scope="col">
                                ' . $value['price'] . 'Đ
                            </td>
                            <td scope="col">
                            ' . $value['price'] * $value['quantity'] . 'Đ</td>
                            </form>
                            <td scope="col">
                                <a href="cart.php?action=remove&id=' . $value['id'] . '" >
                                    <button class="btn-custom btn-danger" ><i class="fa-solid fa-trash">Xoá</i></button>
                                </a>
                            </td>
                        </tr>
                        
                    </div>
                </div>';

        $total = $total + ($value['quantity'] * $value['price']);
    }
    $ids = array_keys($_SESSION['cart']);
    echo '</tbody>
        <tfoot scope="col"> 
        <tr>
            <td scope="col" colspan="3"></td>
            <td scope="col" >Tổng tiền:</td>
            <td scope="col" >' . number_format($total, 0, ",", ".") . 'Đ</td>
            <td scope="col" >
            <a href="cart.php?action=clearall">
            <button width="100px" class="btn-custom btn-danger">Xóa hết</button>
            </a>
            </td>
        </a>
            </th>
        </tr>
        
        
        <tr>
            <th scope="col" colspan="5"></th>
            <th scope="col" >
            <a href="thanhtoan_cart.php" name="thanhtoancart"> <button class="btn-custom btn-success"><i class="fa-solid fa-cart-shopping"> </i> Đặt Hàng</a></a> 
            </th>
           
        </tr>
        
        
        </tfoot>
        ';
    // }
}
echo '</table>
    </div>';

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'clearall') {
        unset($_SESSION['cart']);
        echo '<script>window.location="cart.php"</script>';
    }
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
            }
        }
        echo '<script>window.location="cart.php"</script>';
    }
}
?>
<footer id="footer" class="footer">
	<p> Hân Hạnh Phục Vụ Bạn</p>
	<a class="top" href="index.html"></a>
	<p>Liên hệ chúng tui qua
		<a href="https://www.facebook.com/pham.minhkhang.121"><i class="fa fa-facebook-f"></i></a>
		<a href="twitter.com"><i class="fa fa-twitter"></i></a> hoặc địa chỉ email <a href=""><i class="fas fa-mail-bulk"></i> khangro99@gmail.com</a>
	</p>
</footer>

</html>