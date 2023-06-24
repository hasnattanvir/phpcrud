<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('dbcon/db_connection.php');
// $conn = mysqli_connect('localhost','root','','phpcrud_db');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="container">
            <?php
                if($_GET['editid']){
                    $editid = base64_decode($_GET['editid']);
                    // echo $editid;
                    $sqledit = "SELECT * FROM students WHERE id = $editid";
                    $data = mysqli_query($conn,$sqledit);
                    // var_dump($data);
                    $editdat = mysqli_fetch_assoc($data);

                    $id = $editdat['id'];
                    $name = $editdat['name'];
                    $phone = $editdat['phone'];
                    $gender = $editdat['gender'];
                    $dprt = $editdat['dprt'];
                    $amount_range = $editdat['amount_range'];
                    $color = $editdat['color'];
                    $photo = $editdat['photo'];
                    $address = $editdat['address'];
                    $reg = $editdat['reg'];
                    $date = $editdat['date'];
                    $status = $editdat['status'];
                }
                

                if(isset($_POST['update'])){
                    $upid = $_POST['updateid'];
                    $name = $_POST['uname'];
                    $phone = $_POST['uphone'];
                    $uimage = $_POST['uimage'];
                    $ugender = $_POST['ugender'];
                    $department = $_POST['department'];
                    $range = $_POST['range'];
                    $fcolor = $_POST['fcolor'];
                    $regi = $_POST['regi'];
                    $address = $_POST['address'];
                    $date = $_POST['date'];
                    $status = $_POST['status'];

                    $imagename = $_FILES['uimage']['name'];
                    $tmpname = $_FILES['uimage']['tmp_name'];
                    $imgetype = $_FILES['uimage']['type'];
                    $imagesize = $_FILES['uimage']['size'];

                    // old image check
                    $oldimage = $_POST['old_image'];
                    if($imagename != ''){
                        $update_image_filename = $imagename;
                    }else{
                        $update_image_filename = $oldimage;
                    }
                    if(file_exists("images/".$imagename)){
                        $_SESSION['status'] = "Image already Exists".$imagename;
                    }


                    $uplodeloc = "images/".$imagename;
                    if($imagesize<1000000){
                        echo "Success";
                    }else{
                        echo "Max file Size Lessthen 10000";
                    }
                    // echo '<hr>';
                    // echo $destination_path = getcwd().DIRECTORY_SEPARATOR. 'images/';
                    // echo $target_path = $destination_path . basename( $_FILES["uimage"]["name"]);
                    // echo '<hr>';

                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"){
                        echo 'type ok';
                        if(move_uploaded_file($tmpname, $uplodeloc)){
                            echo "<h3> Image Upload Successfully </h3>";
                        }else{
                            echo "<h3> Failed to upload image </h3>";
                        }
                    }else{
                        echo "<h3>Please Select an image file</h3>";
                    }


                    $sql = "UPDATE students SET name='$name',phone='$phone',gender='$ugender',dprt='$department',amount_range='$range',color='$fcolor',photo='$imagename',address='$address',reg='$regi',date='$date', status='$status' where id = $upid";

                    if(mysqli_query($conn,$sql)==true){
                        unlink("images/".$oldimage);
                        echo "Data Update success";
                        header('location:index.php');
                    }else{
                        echo "Data Not Update";
                        // header('location:edit.php');

                    }

                }
            ?>
            
            <form action="edit.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="uname" class="form-label">Name</label>
                            <input type="text" class="form-control" value="<?php echo $name; ?>" name="uname" id="uname">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="uphone" class="form-label">Phone</label>
                            <input type="text" class="form-control" value="<?php echo $phone; ?>" name="uphone" id="uphone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="uimage" class="form-label">Photo</label>
                            <input type="file" class="form-control"  name="uimage" id="uimage">                            
                            <img src="images/<?php echo $photo; ?>" width="60px" alt="photo">
                            <!-- old image -->
                            <input type="hidden" name="old_image" value="<?php echo $photo; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Gender</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" value="Male" <?php if($gender=="Male"){echo "checked";} ?>  name="ugender" id="male" >
                              <label class="form-check-label" for="male">
                                Male
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" value="Female" name="ugender" id="female" <?php if($gender=="Female"){echo "checked";} ?> >
                              <label class="form-check-label" for="female">
                                Female
                              </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="department" class="form-label">Deparment</label>
                            <select class="form-select form-select-lg" name="department" id="department">
                                <option>Select one</option>
                                <option value="Dental Hygienist" <?php if($dprt=='Dental Hygienist'){echo "selected";} ?> >Dental Hygienist</option>
                                <option value="Diagnostic Medical Sonographer" <?php if($dprt=='Diagnostic Medical Sonographer'){echo "selected";} ?> >Diagnostic Medical Sonographer</option>
                                <option value="Web Developer" <?php if($dprt=='Web Developer'){echo "selected";} ?> >Web Developer</option>
                                <option value="Respiratory Therapist" <?php if($dprt=='Respiratory Therapist'){echo "selected";} ?> >Respiratory Therapist</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="customRange1" class="form-label">Example range</label>
                            <input type="range" value="<?php echo $amount_range; ?>" name="range" min="0" max="5" class="form-range" id="customRange1">
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="fcolor" class="form-label">Color</label>
                            <input type="Color" value="<?php echo $color; ?>" class="form-control" name="fcolor" id="fcolor">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="regi" class="form-label">Reg No</label>
                            <input type="text" value="<?php echo $reg; ?>" class="form-control" name="regi" id="regi">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="address" cols="30" rows="10"><?php echo $address; ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <?php echo $date; ?>
                            <input type="date" value="<?php  ?>" class="form-control" name="date" id="date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if($status=='on'){echo 'checked';}; ?> name="status" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                            </div>
                        </div>
                    </div>
                    <!-- HIDDEN ID -->
                    <input type="text" name="updateid" value="<?php echo $id; ?>" hidden>
                    <div class="col-md-12">
                        <div class="mt-5">
                            <input type="submit" name="update" value="Update Data" class="btn btn-secondary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>