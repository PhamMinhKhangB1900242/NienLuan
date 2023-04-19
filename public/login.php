<?php

$loggedin = false;
$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        if ((strtolower($_POST['email']) == 'admin@admin') && ($_POST['password'] == 'admin')) {
            $_SESSION['user'] = 'admin';
            $loggedin = true;
        } else {
            $error = 'Địa chỉ email và mật khẩu không khớp!';
        }
    } else {
        $error = 'Hãy đảm bảo rằng bạn cung cấp đầy đủ địa chỉ email và mật khẩu!';
    }
}

if ($error) {
    echo '<p class="error">' . $error . '</p>';
}




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
    <title>Đăng nhập </title>
</head>
</div>
</nav>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark ">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="nav-item">
	  <a class="nav-link active" href="../home/home.php">Home</a>
      </li>
     <li class="nav-item">
	 <a class="nav-link active" href="../home/index.php">Danh Mục</a>
      </li>
      <li class="nav-item">
	  <a class="nav-link active" href="../home/cart.php">Giỏ Hàng</a>
      </li>
      <li class="nav-item">
	  <a class="nav-link active" href="../home/thanhtoan_cart.php">Thanh Toán</a>
      </li>
      <li class="nav-item">
	  <a class="nav-link active" href="../login.php">Đăng nhập</a>
      </li>
    </ul>
  </div>
</nav>
<?php
if ($loggedin) {
    echo '<p>You are now logged in!</p>';
    header('Location: index.php');
} else {
    echo '
	<form name="frmdangnhap" id="frmdangnhap" method="post" action="login.php">
            <div class="container mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="c-group">
                            <div class="card-1 p-4">
                                <div class="c-body">
                                    <h1>Đăng nhập</h1>
                                    <p class="text-muted">Nhập thông tin Tài khoản</p>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-user"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="email" name="email" placeholder="Nhập Email">
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="icon-lock"></i>
                                            </span>
                                        </div>
                                        <input class="form-control" type="password" name="password" placeholder="Mật khẩu">
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <button name="submit"  type="submit" class="btn btn-primary px-4" name="btnDangNhap">Đăng nhập</button>
                                        </div>



                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>';
}
?>