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
    $id = $_GET['id'];
    include 'dbconnect.php';
    $sql = "insert into past_customers select *from customers where cust_id=$id";
    $sql = "insert into past_documents select *from documents where doc_userid=$id";

    
    $sql2 = "delete from customers where cust_id=$id";
    $sql3 = "delete from documents where doc_userid=$id";
    $result2 = mysqli_query($conn, $sql2);
    if ($result2) {
       echo ' <script>
        swal({
            title: "Good job!",
            text: "You have removed a customer.",
            icon: "success",
      }).then(function() {
          window.location = "rooms.php";
      }); </script>';
        } else {
           echo "<h1>Somthing went wrong...</h1>";
        }
    ?>




    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


</body>

</html>