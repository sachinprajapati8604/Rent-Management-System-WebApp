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
error_reporting(0);
include 'dbconnect.php';

$gender=$_POST['gender'];
$name=$_POST['name'];
$fullname=$gender. $name;
$fname=$_POST['fname'];
$mname=$_POST['mname'];
$mobile=$_POST['mobile'];
$aadhar=$_POST['aadhar'];
$email=$_POST['email'];
$roomno=$_POST['roomno'];
$joingdate=$_POST['joiningdate'];
$address=$_POST['address'];
$dob=$_POST['dob'];
$room_price=$_POST['roomprice'];

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])){

if(($gender && $name && $fname && $mname && $mobile && $aadhar && $email && $roomno && $joingdate && $address)!=""){
    
    $sql="INSERT INTO `customers`(`cust_name`, `cust_fname`, `cust_mname`,`cust_dob`, `cust_mobile`, `cust_aadhar`, `cust_gmail`, `cust_roomno`,`cust_roomprice`, `cust_joiningdate`, `cust_address`, `created`) VALUES ('$fullname','$fname','$mname','$dob','$mobile','$aadhar','$email','$roomno','$room_price','$joingdate','$address',current_timestamp())";

    if(mysqli_query($conn,$sql)){
        echo ' <script>
        swal({
            title: "Good job!",
            text: "You have registered a customer name '.$fullname.'  room no. '.$roomno.'!",
            icon: "success",
      }).then(function() {
          window.location = "index.php";
      }); </script>';
        } else {
           echo "<h1>Somthing went wrong...not uploaded...</h1>";
        }

}
else{
    echo 'Please fill all fields';
}
}
?>

<!-- registration form -->
    <div class="container my-4 mx-auto shadow-sm p-3  ">
        <div class="main grad p-2">

        <header class="mb-4">
            <h1 class="text-center">REGISTRATION FORM</h1>
            <hr>
        </header>
        <form action="" method="POST" class="grad">
            <div class="row ">
                <div class="col-4">
                    <select class="form-select form-select mb-3" aria-label=".form-select example" name="gender" required>
                        <option selected>Choose Prefix</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms">Ms.</option>
                    </select>
                </div>
                <div class="col-8">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="John" name="name" required>
                        <label for="floatingInput">Name</label>
                    </div>
                </div>
            </div>

         

            <div class="row">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput2" placeholder="John" name="fname" required>
                        <label for="floatingInput2">Father's name</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="John" name="mname" required>
                        <label for="floatingInput">Mother's name</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInput2" placeholder="John" name="dob" required>
                        <label for="floatingInput2">Date of Birth</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="John" name="roomprice" required>
                        <label for="floatingInput">Room Rent Price</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="John" name="mobile" required>
                        <label for="floatingInput">Mobile No.</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="John" name="aadhar" required>
                        <label for="floatingInput">Aadhar No.</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" placeholder="John" name="email" required>
                <label for="floatingInput">Email Id</label>
            </div>
                </div>
               
            </div>
            <div class="row">
                <div class="col-6">
                <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingInput" placeholder="John" name="roomno" required>
                <label for="floatingInput">Room No.</label>
            </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="floatingInput" placeholder="John" name="joiningdate" required>
                        <label for="floatingInput">Joining Date</label>
                    </div>
                </div>
            </div>

           

            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="address" required></textarea>
                <label for="floatingTextarea2">Address</label>
            </div>

            <button name="register" type="submit" class="btn btn-success my-2">Submit</button>
        </form>

    </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


</body>

</html>