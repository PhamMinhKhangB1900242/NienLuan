<?php
session_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . '../../../functions.php';


?>


<!DOCTYPE html>
<html lang="vi">

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
    <script src="../../js/script.js"></script>
    <title>LMPshop.vn</title>
</head>


</div>
</nav>
<!-- end header -->

<body>
    <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-danger">
        <div class="container">
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-5">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">PokeShop <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pokedex.html">Pokedex</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="danhmuc.php">Danh Mục Sản Phẩm</a>
                    </li>
                </ul>

                <form class="form-inline mt-2 mt-md-0" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control mr-lg-5" id="s" name="s" placeholder="Pokemon ... ta chọn ngươi!!" style="width:200px;">
                    </div>
            </div>

            <ul class="navbar-nav px-3">
                <li class="nav-3">
                    <div>
                        <ul>
                            <form method="get">
                                <li class="submenu">
                                    <button type="button" class="img-cart"><a href="cart.php">
                                            <i class="fa fa-shopping-cart"></i></a>
                                    </button>
                                    <div id="shopping-cart">
                                        <table id="cart-content" class="u-full-width">
                                            <thead>
                                                <tr>
                                                    <th>Tên</th>
                                                    <th>Giá</th>
                                                    <th>Xóa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($_SESSION['cart'])) {
                                                    foreach ($_SESSION['cart'] as $key => $value) {
                                                        echo '
                                                    <tr>
                                                        <td>' . $value['titel'] . '</td>
                                                        <td>' . $value['price'] . '$</td>
                                                        <td>
                                                        <a href="cart.php?action=remove&id=' . $value['id'] . '" >
                                                        <button class="btn-custom btn-danger" ><i class="fa-solid fa-trash" ></i></button>
                                                    </a></td>
                                                    </tr>
                                            ';
                                                    }
                                                }
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
                                            </tbody>
                                        </table>
                                        <div>
                                            <a href="thanhtoan_cart.php" name="thanhtoancart"> <button class="btn-success u-full-width"><i class="fa-solid fa-cart-shopping"> </i> Đặt Hàng</a></a>
                                        </div>
                                        <div>
                                            <a href="cart.php?action=clearall">
                                                <button width="100px" class="btn-custom btn-danger u-full-width">Xóa hết</button>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </form>
                        </ul>
                    </div>
                </li>
                <li class="nav-item text-nowrap">
                    <button type="button" class="nav-2"><i class="fas fa-sign-in-alt"></i><a href="../../admin/login.php"> Đăng nhập</a></button>
                </li>
        </div>