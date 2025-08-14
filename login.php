<?php
    session_start();
    // connect database
    require_once 'config/condb.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login by devbanban.com </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css?v=3.2.0">

<!-- sweet alert -->
  <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
 

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Form</b> Login
        </div>

        <div class="card">
            <div class="card-body login-card-body">

                <p class="login-box-msg">Login เข้าใช้งานระบบ</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="username" class="form-control" placeholder="Email/Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="action" value="login" class="btn btn-danger btn-block">Login</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center mb-3">
                    <p>- ติดต่อ -</p>
                </div>

                <p class="mb-1">
                    <a href="http://devbanban.com/">กลับหน้าหลัก</a>
                </p>
                <p class="mb-0">
                    <a href="http://devbanban.com/" class="text-center">แฟนเพจ</a>
                </p>
            </div>

        </div>
    </div>
    
</body>

</html>

<?php 
// echo '<pre>';
// print_r($_POST);

// สร้างเงื่อนไข check input จาก from

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['action']) && isset($_POST['action']) == 'login'){
    // ประกาศตัวแปรรับค่าจาก form
    $username = $_POST['username'];
    $password = hash('sha512', $_POST['password']);
    
    // คิวรี่ username & password
    // รูปแบบการคิวรี่แบบ single row
    // single row query แสดงแค่ 1 รายการ
    $stmtMemberDetail = $condb->prepare("SELECT id, name, m_level
    FROM tbl_member 
    WHERE username=:username
    AND password=:password
    ");
    //bindParam
    $stmtMemberDetail->bindParam(':username', $username , PDO::PARAM_STR);
    $stmtMemberDetail->bindParam(':password', $password , PDO::PARAM_STR);
    $stmtMemberDetail->execute();
    $row = $stmtMemberDetail->fetch(PDO::FETCH_ASSOC);

    //   echo '<pre>';
    //   print_r($rowProduct);    
    //exit;
    // echo $stmtMemberDetail->rowCount();
    // exit;

    //สร้างเงื่อนไขตรวจสอบการคิวรี่

    // ถ้าใส่ username หรือ password ไม่ผ่าน จะเด้งออก
    if($stmtMemberDetail->rowCount() == 0) { 
        //คิวรี่ผิดพลาด
        echo '<script>
                setTimeout(function() {
                    swal({
                        title: "เกิดข้อผิดพลาด",
                        text: "Userneme or Password ไม่ถูกต้อง",
                        type: "error"
                    }, function() {
                    window.location = "login.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                }, 1000);
            </script>';
        exit();
    }else{
        // Login correct
        // Create session variables
        $_SESSION['userID'] = $row['id'];
        $_SESSION['memberName'] = $row['name'];
        $_SESSION['m_level'] = $row['m_level'];
        echo '<pre>';
        print_r($_SESSION);

        // check member level
        if($_SESSION['m_level'] == 'admin'){
            echo 'Are you Admin';
            header('Location: admin/');
        }elseif($_SESSION['m_level'] == 'staff'){
            echo 'Are you Member';
            header('Location: member/');
        }else{
            echo 'Not Access Grant !!!';
        }
    }
}

?>