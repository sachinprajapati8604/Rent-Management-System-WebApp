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
</head>

<body>

    <?php include 'basic/navbar.php'; ?>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">

    <?php
     include 'dbconnect.php';
     // Turn off error reporting
       error_reporting(0);
     $sql = "SELECT * FROM `customers` ORDER BY cust_id ASC";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                
                $id = $row['cust_id'];
                $name = $row['cust_name'];
                $roomno=$row['cust_roomno'];
                $mobile = $row['cust_mobile'];
                $joining_date=$row['cust_joiningdate'];
                $amount=$row['cust_roomprice'];

                $sql2 = "SELECT * FROM transcations WHERE trans_userid=$id order by trans_date DESC LIMIT 1
                    ";
                    $result2 = mysqli_query($conn, $sql2);                   
                    while ($row = mysqli_fetch_assoc($result2)) {
                        $status=$row['trans_status'];
                        $duration=$row['trans_duration'];
                        $trans_date=$row['trans_date'];
    
                    }
                  
                    if($status=="Submitted"){
                        //forwarding date by month
                        $olddate = strtotime($trans_date);
                        $due_date = date("Y-m-d", strtotime("+$duration month", $olddate));
                    }else{
                        $olddate = strtotime($trans_date);
                        $due_date = date("Y-m-d", strtotime("+1 month", $olddate));
                    }

                
                echo '<div class="col">
                <div class="card text-dark bg-light  my-2" >
                    <div class="card-header h5">Room No : '.$roomno.'</div>
                    <div class="card-body">
                        <h5 class="card-title">Name : '.$name.'</h5>
                        <p class="card-text mb-1">Room Joining  Date : '.$joining_date.' </p>
                        <p class="card-text mb-1">Next Due Date  :<span class="bg-warning"> '.$due_date.'</span> </p>
                        <p class="card-text mb-1">Amount  : '.$amount.' </p>
                        <p class="card-text mb-1">Status  : '.$status.' </p>
                        <a href="view_profile.php?id='.$id.'" class="btn btn-primary my-2">View Profile</a>
                    </div>
                </div>
            </div>';
            

            }

    ?>
       
            
            
        </div>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


</body>

</html>