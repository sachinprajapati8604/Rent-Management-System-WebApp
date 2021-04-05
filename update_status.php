<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Rent App</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <?php include 'basic/navbar.php'; ?>
  

<?php
include 'dbconnect.php';
$id=$_GET['id'];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])){

    $status=$_POST['status'];
    $month=$_POST['month'];

    $sql="INSERT INTO `transcations`(`trans_userid`, `trans_status`, `trans_duration`, `trans_date`) VALUES ('$id','$status','$month',current_timestamp())";

    if(mysqli_query($conn,$sql)){
        echo ' <script>
        swal({
            title: "Good job!",
            text: "You have updated a record of status '.$status.'  for  '.$month.'!",
            icon: "success",
      }).then(function() {
          window.location = "index.php";
      }); </script>';
        } else {
           echo "<h1>Somthing went wrong...not uploaded...</h1>";
        }    
    }

?>

    <div class="container shadow-sm">
        <h1 class="my-3">Update the Status</h1>

        <form action="" method="POST">
            <div class="row">
                <div class="col">
                    <select class="form-select" aria-label="Default select example" name="status" required>
                        <option selected>Open this select one </option>
                        <option value="Pending">Pending</option>
                        <option value="Submitted">Submitted</option>
                    </select>
                </div>
                <div class="col">
                    <select class="form-select" aria-label="Default select example" name="month" required>
                        <option selected>select month</option>
                        <option value="1">1 Month</option>
                        <option value="2">2 Month</option>
                        <option value="3">3 Month</option>
                        <option value="4">4 Month</option>
                    </select>
                </div>
            </div>
            <button type="submit" name="update" class="btn btn-primary mb-3 my-4">Update Status</button>
        </form>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


</body>

</html>