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
    <h1 class="m-4">Dashboard</h1>
    <hr class="m-4">
    <!-- table for list -->
    <div class="table-responsive m-2 p-2">
        <table class="table my-2 table-bordered table-striped table-hover caption-top ">
           
            <thead class="table-dark">
                <tr>
                    <th scope="col">Sr</th>
                    <th scope="col">Name</th>
                    <th scope="col">Room No.</th>
                    <th scope="col">Mobile No.</th>
                    <th scope="col">Last Submission</th>
                    <th scope="col">Due date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                include 'dbconnect.php';
                // Turn off error reporting
                //  error_reporting(0);

               

                $sql = "SELECT *  FROM customers order by customers.cust_id ASC";
                $result = mysqli_query($conn, $sql);
                $rowcount = mysqli_num_rows($result);
                $sr = 0;
                echo ' <caption>
                <h1>List of Users, Total ' . $rowcount . '  record</h1>
                        </caption>';
                while ($row = mysqli_fetch_assoc($result)) {
                    $sr++;
                    $id = $row['cust_id'];
                    $name = $row['cust_name'];
                    $roomno=$row['cust_roomno'];
                    $mobile = $row['cust_mobile'];
                    $joining_date=$row['cust_joiningdate'];
                    $amount = $row['cust_roomprice'];

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

                    echo '   <tr>
                    <th scope="row">' . $sr . '</th>
                    <td>' . $name . '</td>
                    <td>' . $roomno . '</td>
                    <td><mark>' . $mobile . '</mark></td>
                    <td>' . $trans_date . '</td>
                    <td>' . $due_date . '</td>
                    <td> '. $amount.'</td>
                    <td> '. $status.'</td>
                    <td>  <a href="update_status.php?id='.$id.'" class="btn btn-primary ">Update</a></td>
                    </tr>'
                    ;
                }

                ?>
            </tbody>
        </table>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>


</body>

</html>