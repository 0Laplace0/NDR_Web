  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> ฟอร์มเพิ่มข้อมูลสินค้า  </h1>
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
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file"  name="profile_image" class="custom-file-input" required id="exampleInputFile" accept="image/*">
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
                        <button type="submit" name="btn" class="btn btn-primary"> เพิ่มข้อมูล </button>
                        <a href="product.php"  class="btn btn-danger">ยกเลิก</a>
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

    if(isset($_POST['std_name']) && isset($_POST['std_id']) && isset($_POST['phone']) && isset($_POST['email'])){
      //trigger exception in a "try" block
    try {

                    //ประกาศตัวแปรรับค่าจากฟอร์ม
                    $std_name = $_POST['std_name'];
                    $std_id = $_POST['std_id'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    

                     //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
                    $date1 = date("Ymd_His");
                    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
                    $numrand = (mt_rand());
                    $profile_image = (isset($_POST['profile_image']) ? $_POST['profile_image'] : '');
                    $upload=$_FILES['profile_image']['name'];
                
                    //มีการอัพโหลดไฟล์
                    if($upload !='') {
                    //ตัดขื่อเอาเฉพาะนามสกุล
                    $typefile = strrchr($_FILES['profile_image']['name'],".");
                
                    //สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
                    if($typefile =='.jpg' || $typefile  =='.jpeg' || $typefile  =='.png'){
                
                    //โฟลเดอร์ที่เก็บไฟล์
                    $path="../assets/std_img/";
                    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
                    $newname = $numrand.$date1.$typefile;
                    $path_copy=$path.$newname;
                    //คัดลอกไฟล์ไปยังโฟลเดอร์
                    move_uploaded_file($_FILES['profile_image']['tmp_name'],$path_copy); 


                    //sql insert
                    $stmtInsertProduct = $condb->prepare("INSERT INTO tbl_members 
                    (
                      std_name,
                      std_id,
                      phone,
                      email,
                      profile_image
                    )
                    VALUES 
                    (
                      :std_name,
                      :std_id,
                      :phone,
                      :email,
                      '$newname'
                    )
                    ");

                    //bindParam
                    $stmtInsertProduct->bindParam(':std_name', $std_name, PDO::PARAM_STR);
                    $stmtInsertProduct->bindParam(':std_id', $std_id, PDO::PARAM_STR);
                    $stmtInsertProduct->bindParam(':phone', $phone, PDO::PARAM_STR);
                    $stmtInsertProduct->bindParam(':email', $email, PDO::PARAM_STR);
                    
                    $result = $stmtInsertProduct->execute();
                    $condb = null; //close connect db

                    //เงื่อนไขตรวจสอบการเพิ่มข้อมูล
                      if($result){
                        echo '<script>
                            setTimeout(function() {
                              swal({
                                  title: "เพิ่มข้อมูลสำเร็จ",
                                  type: "success"
                              }, function() {
                                  window.location = "product.php"; //หน้าที่ต้องการให้กระโดดไป
                              });
                            }, 1000);
                        </script>';
                    } //if
                
                }else{ //ถ้าไฟล์ที่อัพโหลดไม่ตรงตามที่กำหนด
                    echo '<script>
                                setTimeout(function() {
                                  swal({
                                      title: "คุณอัพโหลดไฟล์ไม่ถูกต้อง",
                                      type: "error"
                                  }, function() {
                                      window.location = "product.php"; //หน้าที่ต้องการให้กระโดดไป
                                  });
                                }, 1000);
                            </script>';
                } //else ของเช็คนามสกุลไฟล์

            } // if($upload !='') {
            } //try
            //catch exception
            catch(Exception $e) {
                echo 'Message: ' .$e->getMessage();
                //exit;
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

