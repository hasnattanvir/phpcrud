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
            <a href="index.php" class="btn btn-primary">Go View Page</a>
        </div>
        <div class="container">
            <?php
                if(isset($_POST['insert'])){
                    echo $name = $_POST['uname'];
                    echo '<br>';
                    echo $phone = $_POST['uphone'];
                    echo '<br>';
                    // $uimage = $_POST['uimage'];
                    // echo $uimage;
                    echo '<br>';
                    echo $ugender = $_POST['ugender'];
                    echo '<br>';
                    echo $department = $_POST['department'];
                    echo '<br>';
                    echo $range = $_POST['range'];
                    echo '<br>';
                    echo $fcolor = $_POST['fcolor'];
                    echo '<br>';
                    echo $regi = $_POST['regi'];
                    echo '<br>';
                    echo $address = $_POST['address'];
                    echo '<br>';
                    echo $date = $_POST['date'];
                    echo '<br>';
                    echo $status = $_POST['status'];
                    echo '<br>';

                    echo $imagename = $_FILES['uimage']['name'];
                    $tmpname = $_FILES['uimage']['tmp_name'];
                    echo '<br>';
                    $imgetype = $_FILES['uimage']['type'];
                    echo $imagesize = $_FILES['uimage']['size'];
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
                    $sql = "INSERT INTO students(name,phone,gender,dprt,amount_range,color,photo,address,reg,date, status) VALUES('$name','$phone','$ugender','$department','$range','$fcolor','$imagename','$address','$regi','$date','$status')";

                    if(mysqli_query($conn,$sql)==true){
                        echo "Data insert success";
                    }else{
                        echo "Data Not insert";
                    }

                }
            ?>
            <form action="insert.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="uname" class="form-label">Name</label>
                            <input type="text" class="form-control" name="uname" id="uname">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="uphone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="uphone" id="uphone">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="uimage" class="form-label">Photo</label>
                            <input type="file" class="form-control" name="uimage" id="uimage">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="" class="form-label">Gender</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" value="Male"  name="ugender" id="male">
                              <label class="form-check-label" for="male">
                                Male
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" value="Female" name="ugender" id="female">
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
                                <option selected>Select one</option>
                                <option value="Dental Hygienist">Dental Hygienist</option>
                                <option value="Diagnostic Medical Sonographer">Diagnostic Medical Sonographer</option>
                                <option value="Web Developer">Web Developer</option>
                                <option value="Respiratory Therapist">Respiratory Therapist</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="customRange1" class="form-label">Example range</label>
                            <input type="range" name="range" min="0" max="5" class="form-range" id="customRange1">
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="fcolor" class="form-label">Color</label>
                            <input type="Color" class="form-control" name="fcolor" id="fcolor">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="regi" class="form-label">Reg No</label>
                            <input type="text" class="form-control" name="regi" id="regi">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="address" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="date" class="form-label">Reg No</label>
                            <input type="date" class="form-control" name="date" id="date">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mt-5">
                            <input type="submit" name="insert" value="Insert Data" class="btn btn-secondary">
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