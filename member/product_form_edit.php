<?php
//คิวรี่รายละเอียดสินค้า single row
$stmtProductDetail = $condb->prepare("SELECT * FROM tbl_members WHERE id=:id");
//bindParam
$stmtProductDetail->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$stmtProductDetail->execute();
$rowProduct = $stmtProductDetail->fetch(PDO::FETCH_ASSOC);

//   echo '<pre>';
//   print_r($rowProduct);    
//exit;
// echo $stmtProductDetail->rowCount();
// exit;

//สร้างเงื่อนไขตรวจสอบการคิวรี่

if($stmtProductDetail->rowCount() == 0) { //คิวรีี่ผิดพลาด
    echo '<script>
                            setTimeout(function() {
                              swal({
                                  title: "เกิดข้อผิดพลาด",
                                  type: "error"
                              }, function() {
                                  window.location = "product.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
    exit;
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> ฟอร์มแก้ไขข้อมูลนักศึกษา </h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-body">
                        <div class="card card-primary">
                            <!-- form start -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body">

                                    


                                    <div class="form-group row">
                                        <label class="col-sm-2">ชื่อ-นามสกุล</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="std_name" class="form-control" required placeholder="ชื่อ-นามสกุล นักศึกษา">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">รหัสนักศึกษา</label>
                                        <div class="col-sm-7">
                                            <input type="text" name="std_id" class="form-control" required placeholder="รหัสนักศึกษา">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">เบอร์โทร</label>
                                        <div class="col-sm-7">
                                            <input type="tel" name="phone" class="form-control" required placeholder="เบอร์โทร">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2">อีเมล์</label>
                                        <div class="col-sm-7">
                                            <input type="email" name="email" class="form-control" required placeholder="อีเมล์">
                                        </div>
                                    </div>
                                                    

                                    <div class="form-group row">
                                        <label class="col-sm-2">ภาพนักศึกษา</label>
                                        <div class="col-sm-4">
                                            ภาพเก่า <br> 
                                            <img src="../assets/std_img/<?php echo $rowProduct['profile_image'];?>" width="200px">
                                            <br> <br>
                                            เลือกภาพใหม่
                                            <br>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="profile_image" class="custom-file-input"  id="exampleInputFile" accept="image/*">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group row">
                                        <label class="col-sm-2"></label>
                                        <div class="col-sm-4">
                                            <input type="hidden" name="id" value="<?php echo $rowProduct['id'];?>">
                                            <input type="hidden" name="oldImg" value="<?php echo $rowProduct['profile_image'];?>">
                                            <button type="submit" name="btn" class="btn btn-primary"> บันทึก </button>
                                            <a href="product.php" class="btn btn-danger">ยกเลิก</a>
                                        </div>
                                    </div>

                                </div> <!-- /.card-body -->

                            </form>
                            <?php
                            // echo '<pre>';
                            // print_r($_POST);
                            // echo '<hr>';
                            // print_r($_FILES);
                            // exit;
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
//เช็ค input ที่ส่งมาจากฟอร์ม
// echo '<pre>';
// print_r($_POST);
// exit;

if (isset($_POST['id']) && isset($_POST['std_name']) && isset($_POST['oldImg'])) {
    //echo 'ถูกเงื่อนไข ส่งข้อมูลมาได้';

          //trigger exception in a "try" block
          try {


    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $id = $_POST['id'];
    $std_name = $_POST['std_name'];
    $std_id = $_POST['std_id'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $oldImg = $_POST['oldImg'];
    $upload = $_FILES['profile_image']['name'];

    //สร้างเงื่อนไขตรวจสอบการอัพโหลดไฟล์
    if($upload == ''){
        //echo 'ไม่มีการอัพโหลดไฟล์'; 
        //sql update without upload file
    $stmtUpdateProduct = $condb->prepare("UPDATE tbl_members SET
                std_name=:std_name,
                std_id=:std_id,
                phone=:phone
                email=:email
            WHERE id=:id
    ");

  //bindParam
    $stmtUpdateProduct->bindParam(':std_name', $std_name, PDO::PARAM_STR);
    $stmtUpdateProduct->bindParam(':std_id', $std_id, PDO::PARAM_STR);
    $stmtUpdateProduct->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmtUpdateProduct->bindParam(':email', $email, PDO::PARAM_STR);
    $stmtUpdateProduct->bindParam(':id', $id, PDO::PARAM_INT);

  $result = $stmtUpdateProduct->execute();
  if ($result) {
    echo '<script>
                setTimeout(function() {
                  swal({
                      title: "ปรับปรุงข้อมูลสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "product.php"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
} //if


}else{ 
       // echo 'มีการอัพโหลดไฟล์ใหม่';
        //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    $date1 = date("Ymd_His");
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $profile_image = (isset($_POST['profile_image']) ? $_POST['profile_image'] : '');
   
    //ตัดขื่อเอาเฉพาะนามสกุล
   $typefile = strrchr($_FILES['profile_image']['name'], ".");

//    echo $typefile;
//    exit;

        //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
        if ($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png') {
            //echo 'อัพโหลดไฟล์ไม่ถูกต้อง';
            //exit;
            
            //ลบภาพเก่า 
            unlink('../assets/std_img/'.$_POST['oldImg']);

            //โฟลเดอร์ที่เก็บไฟล์
            $path = "../assets/std_img/";
            //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
            $newname = $numrand . $date1 . $typefile;
            $path_copy = $path . $newname;
            //คัดลอกไฟล์ไปยังโฟลเดอร์
            move_uploaded_file($_FILES['profile_image']['tmp_name'], $path_copy);

            //sql update with upload file 
            $stmtUpdateProduct = $condb->prepare("UPDATE tbl_members SET
            std_name=:std_name,
            std_id=:std_id,
            phone=:phone,
            email=:email,
            profile_image='$newname'
            WHERE id=:id
            ");
            //bindParam
                $stmtUpdateProduct->bindParam(':std_name', $std_name, PDO::PARAM_STR);
                $stmtUpdateProduct->bindParam(':std_id', $std_id, PDO::PARAM_STR);
                $stmtUpdateProduct->bindParam(':phone', $phone, PDO::PARAM_STR);
                $stmtUpdateProduct->bindParam(':email', $email, PDO::PARAM_STR);
                $stmtUpdateProduct->bindParam(':id', $id, PDO::PARAM_INT);

  $result = $stmtUpdateProduct->execute();
  if ($result) {
    echo '<script>
                setTimeout(function() {
                  swal({
                      title: "ปรับปรุงข้อมูลสำเร็จ",
                      type: "success"
                  }, function() {
                      window.location = "product.php"; //หน้าที่ต้องการให้กระโดดไป
                  });
                }, 1000);
            </script>';
} //if
        
    }else{ //อัพโหลดไฟล์ไม่ถุกต้อง
        echo '<script>
                setTimeout(function() {
                swal({
                    title: "คุณอัพโหลดไฟล์ไม่ถูกต้อง",
                    type: "error"
                }, function() {
                    window.location = "product.php?id='.$id.'&act=edit";
                });
                }, 1000);
            </script>';
            //exit;
        } //else upload file
    } //else not upload file

} //try
//catch exception
catch(Exception $e) {
    // echo 'Message: ' .$e->getMessage();
    // exit;
    echo '<script>
         setTimeout(function() {
          swal({
              title: "เกิดข้อผิดพลาด",
              type: "error"
          }, function() {
              window.location = "product.php"; //หน้าที่ต้องการให้กระโดดไป
          });
        }, 1000);
    </script>';
  } //catch
} //isset
?>