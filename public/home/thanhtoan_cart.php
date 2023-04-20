<?php



require_once('../data/dbhelper.php');
session_start();
$id = $name = $phone = $address = $price = '';

if (!empty($_POST)) {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $name = str_replace('"', '\\"', $name);
    }
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
        $phone = str_replace('"', '\\"', $phone);
    }
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
        $address = str_replace('"', '\\"', $address);
    }
    if (isset($_POST['total'])) {
        $total = $_POST['total'];
    }


    if (!empty($name)) {
        $created_at = $updated_at = date('Y-m-d H:s:i');
        //Luu vao database
        if ($id == '') {
            $sql = 'insert into orders(name,phone,address,total, created_at, updated_at) values ("' . $name . '","' . $phone . '", "' . $address . '", "' . $total . '","' . $created_at . '", "' . $updated_at . '")';
        }
        // execute($sql);
        $id_orders = execute($sql, "insert");
        // id	quantity	id_product	id_orders	created_at	updated_at
        // $sql = 'insert into orders_detail( quantity,id_product,id_orders, created_at, updated_at) values ("' . $quantity . '","' . $id_product . '", "' . $id_orders . '","' . $created_at . '", "' . $updated_at . '")';
        foreach ($_SESSION['cart'] as $cartItem) {
            $quantity = $cartItem['quantity'];
            $id_product = $cartItem['id'];
            $sqlInsertOrderDetail = 'insert into orders_detail( quantity,id_product,id_orders, created_at, updated_at) values ("' . $quantity . '","' . $id_product . '", "' . $id_orders . '","' . $created_at . '", "' . $updated_at . '")';
            execute($sqlInsertOrderDetail);
        }

        unset($_SESSION['cart']);


        header('Location: home.php');
        die();
    }
}
if (isset($_GET['id'])) {
    $id       = $_GET['id'];
    $sql      = 'select * from orders where id = ' . $id;
    $product = executeSingleResult($sql);
    if ($product != null) {
        $name = $name['name'];
        $phone = $phone['phone'];
        $address = $address['address'];
        $total = $total['total'];
    }
}


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



?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="../css/home.css">

    <script src="../../js/script.js"></script>
    <title>Thanh Toán</title>
</head>


</div>

</nav>

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
                    <a class="nav-link active" href="thanhtoan_cart.php">Thanh Toán</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../login.php">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </nav>
    <main role="main">
        <!-- Block content - Đục lỗ trên giao diện bố cục chung, đặt tên là `content` -->
        <div class="container mt-4">
            <form class="needs-validation" name="frmthanhtoan" method="post" action="#">
                <input type="hidden" name="kh_tendangnhap" value="dnpcuong">

                <div class="py-5 text-center">
                    <i class="fa fa-credit-card fa-4x" aria-hidden="true"></i>
                    <h2>Thanh toán</h2>
                    <p class="lead">Vui lòng kiểm tra thông tin Khách hàng, thông tin Giỏ hàng trước khi Đặt hàng.</p>
                </div>

                <div class="row">
                    <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Sản phẩm</span>
                        </h4>
                        <ul>
                            <?php

                            if (!empty($_SESSION['cart'])) {

                                // if (is_array($values) || is_object($values)) {
                                $total = 0;
                                $i = 1;
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    echo '
                                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                                            <div>
                                                <h6 class="my-0">' . $value['title'] . ' </h6>
                                                <small class="text-muted">' . $value['price'] . '$ x 1</small>
                                            </div>
                                            <span class="text-muted">' . $value['price'] . '$</span>
                                            
                                        </li>
                                
                                ';

                                    $total = $total + ($value['quantity'] * $value['price']);
                                }
                                $ids = array_keys($_SESSION['cart']);

                 
                            }

                            echo '
                              
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Tổng thành tiền</span>
                                     <strong   name="total" id="total">' . $total . '$</strong>
                                </li>
                              
                                ';

                            ?>
                        </ul>



                    </div>
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Thông tin khách hàng</h4>
                        <div class="row">
                            <form method="post">
                                <div class="col-md-12">
                                    <label for="name">Họ tên</label>
                                    <input type="text" size="77" name="name" id="name" value="">
                                </div>
                                <div class="col-md-12">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" size="77" name="address" id="address" value="">
                                </div>
                                <div class="col-md-12">
                                    <label for="phone">Điện thoại</label>
                                    <input type="text" size="74" name="phone" id="phone" value="">
                                </div>
                                <input hidden type="text" size="74" name="total" id="total" value=<?php echo $total ?>>
                            </form>
                        </div>
                        <hr class="mb-4">
                        <div>
                            
                                <a href="thanhtoan_cart.php?action=clearall">
                                    <button class="btn btn-primary btn-lg btn-block" type="clearall" name="clearall" onclick="dathang()">Đặt hàng</button>
                                </a>
                            
                        </div>

                    </div>
                </div>
            </form>

        </div>

    </main>

</body>
<script type="text/javascript">
    function dathang() {
        alert("đặt hàng thành công");
        window.location="home.php"
    }
</script>
<?php 
// if (isset($_GET['action'])) {
//     if ($_GET['action'] == 'clearall') {
//         unset($_SESSION['cart']);
//         echo '<script>window.location="home.php"</script>';
//     }
// }

?>
<footer id="footer" class="footer">
    <p> Hân Hạnh Phục Vụ Bạn</p>
    <a class="top" href="index.html"></a>
    <p>Liên hệ chúng tui qua
        <a href="https://www.facebook.com/pham.minhkhang.121"><i class="fa fa-facebook-f"></i></a>
        <a href="twitter.com"><i class="fa fa-twitter"></i></a> hoặc địa chỉ email <a href=""><i class="fas fa-mail-bulk"></i> khangro99@gmail.com</a>
    </p>
</footer>