<?php
require('dbcon/db_connection.php');
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
        <?php
        $query = "SELECT * FROM students";
        $getdata = mysqli_query($conn,$query);
        ?>
        <div class="container">
        <a href="insert.php" class="btn btn-primary">Go Insert Page</a>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">SL NO</th>
                        <th scop="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Dprt</th>
                        <th scope="col">Range</th>
                        <th scope="col">Color</th>
                        <th scope="col">Action</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $count=1;
                    while($item = mysqli_fetch_assoc($getdata)): 
                    ?>
                    <tr>
                        <th scope="row"><?php echo $count++; ?></th>
                        <th scope="row"><?php echo $item['id']; ?></th>
                        <td><?php echo $item['name']; ?></td>
                        <td><img src="images/<?php echo $item['photo']; ?>" alt="photo" width="80px"></td>
                        <td><?php echo $item['phone']; ?></td>
                        <td><?php echo $item['gender']; ?></td>
                        <td><?php echo $item['dprt']; ?></td>
                        <td><?php echo $item['amount_range']; ?></td>
                        <td>
                            <div style="width:30px; height:30px; margin:auto; background-color:<?php echo $item['color']; ?>;"></div>
                            <span><?php echo $item['color']; ?></span>
                        </td>
                        <td>
                            <a href="edit.php?editid=<?php echo base64_encode($item['id']); ?>" class="btn btn-success">Edit</a>
                            <a href="delete.php?delid=<?php echo $item['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                        <td>
                            <div class="status">
                                <?php
                                    if($item['status_pro']==1){
                                        echo '<p><a class="btn btn-success" href="status.php?en_id='.$item['id'].'&status_pro=0">enable</a></p>';
                                    }else{
                                        echo '<p><a class="btn btn-warning" href="status.php?en_id='.$item['id'].'&status_pro=1">disable</a></p>';
                                    }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
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