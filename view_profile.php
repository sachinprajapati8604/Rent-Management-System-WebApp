<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Rent App</title>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body>

    <?php include 'basic/navbar.php'; ?>

<!-- writing script for the insertion of the docuemtns  -->

<?php

  include 'dbconnect.php';
$id=$_GET['id'];
  if (count($_FILES) > 0) {

    if (is_uploaded_file($_FILES['profile']['tmp_name']) || is_uploaded_file($_FILES['sign']['tmp_name']) ||is_uploaded_file($_FILES['aadhar']['tmp_name'])) {

      require_once "dbconnect.php";
      //variable for storing the images in folder and database
      $filename1 = $_FILES["profile"]["name"];
      $filename2 = $_FILES["sign"]["name"];
      $filename3 = $_FILES["aadhar"]["name"];
    
      $tempname1 = $_FILES["profile"]["tmp_name"];
      $tempname2 = $_FILES["sign"]["tmp_name"];
      $tempname3 = $_FILES["aadhar"]["tmp_name"];
    
     
      $folder1 = "img/" . $filename1;
      $folder2 = "img/" . $filename2;
      $folder3 = "img/" . $filename3;

      $sql2="SELECT * FROM `documents` WHERE doc_userid=$id";
      $result2=mysqli_query($conn,$sql2);
      $rowcount2=mysqli_num_rows($result2);
      if($rowcount2>0){
          $sql="UPDATE `documents` SET `doc_photo`='$filename1',`doc_sign`='$filename2',`doc_aadhar`='$filename3',`created`=current_timestamp() WHERE doc_userid=$id";
      }else{
        $sql="INSERT INTO `documents`(`doc_userid`, `doc_photo`, `doc_sign`, `doc_aadhar`, `created`) VALUES ('$id','$filename1','$filename2','$filename3',current_timestamp())";
      }
    

      $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));


      $showalert = true;

      // Now let's move the uploaded image into the folder: image 
      if (move_uploaded_file($tempname1, $folder1)) {
        $msg = "Image uploaded successfully";
      } else {
        $msg = "Failed to upload image";
      }
      if (move_uploaded_file($tempname2, $folder2)) {
        $msg = "Image uploaded successfully";
      } else {
        $msg = "Failed to upload image";
      }
      if (move_uploaded_file($tempname3, $folder3)) {
        $msg = "Image uploaded successfully";
      } else {
        $msg = "Failed to upload image";
      }


      if ($showalert) {

        echo ' <script>
        swal({
            title: "Good job!",
            text: "You have upoaded a book!",
            icon: "success",
      }).then(function() {
          window.location = "view_profile.php?id='.$id.'";
      }); </script>';
      } else {
        $showalert = "Somthing went wrong";
      }
    }
  }

  ?>


<!-- html container for siplay result  -->
    <div class="container">
        <!-- table for list -->
        <div class=" m-2 p-2">
            <div class="row">
                <div class="col-12">
                    <table>
                        <?php
                        include 'dbconnect.php';
                        // Turn off error reporting
                        //  error_reporting(0);
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM customers left JOIN documents on customers.cust_id=documents.doc_userid WHERE customers.cust_id=$id
                        ";

                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['cust_id'];
                            $name = $row['cust_name'];
                            $fname = $row['cust_fname'];
                            $mname = $row['cust_mname'];
                            $dob = $row['cust_dob'];
                            $room_price = $row['cust_roomprice'];
                            $roomno = $row['cust_roomno'];
                            $mobile = $row['cust_mobile'];
                            $gmail = $row['cust_gmail'];
                            $address = $row['cust_address'];
                            $joining_date = $row['cust_joiningdate'];

                            $doc_photo=$row['doc_photo'];
                            $doc_sign=$row['doc_sign'];
                            $doc_aadhar=$row['doc_aadhar'];

                            if($doc_aadhar==""){
                                $msg='Please upload document';
                            }else{
                              $msg='<a href="img/'.$doc_aadhar.'"> View Aadhar card<a/>';
                            }
                            if($doc_sign==""){
                                $msg2='Please upload document ';
                            }else{
                              $msg2='<a href="img/'.$doc_sign.'"> View Signature<a/>';
                            }


                            echo '  <tr>
                                        <th>Name</th>
                                        <td class="text-left align-middle"> <b class="h4">' . $name . ' </b><img align="right" src="img/'.$doc_photo.'" alt="photo_name" width="200px" height="200px"/> </td>
                                        
                                   </tr>
                                    <tr>
                                        <th>Father Name</th>
                                        <td>' . $fname . '</td>
                                    </tr>
                                    <tr>
                                        <th>Mother Name</th>
                                        <td>' . $mname . '</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td>' . $dob . '</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile No.</th>
                                        <td>' . $mobile . ' <a href="tel:'.$mobile.'"> <i class="fa fa-phone" aria-hidden="true"></i></a></td>
                                    </tr>
                                    <tr>
                                        <th>Gmail id </th>
                                        <td>' . $gmail . '</td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Address</th>
                                        <td>' . $address . '</td>
                                    </tr>
                                    <tr>
                                        <th>Room No.</th>
                                        <td>' . $roomno . '</td>
                                    </tr>
                                    <tr>
                                        <th>Room Price</th>
                                        <td>' . $room_price . '</td>
                                    </tr>
                                    <tr>
                                        <th>Joining Date</th>
                                        <td>' . $joining_date . '</td>
                                    </tr>
                                    <tr>
                                    <th>Aadhar Card</th>
                                    <td>'.$msg.'</td>
                                 </tr>
                                <tr>
                                    <th>Signature</th>
                                    <td>'.$msg2.'</td>
                                </tr>
                                
                                    ';
                                  
                        }
                        ?>

                    </table>
                </div>

            </div>


           <?php echo'  <a  onclick="javascript:confirmationDelete($(this));return false;" href="remove_user.php?id='.$id.'"   class="btn btn-danger my-4">Remove from Room</a> '; ?>


           
    <script>
    
    function confirmationDelete(anchor)
    {
      swal()
    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover this.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal("Poof! Your  file has been deleted!", {
          icon: "success",
        });
        window.location=anchor.attr("href");
      } else {
        swal("Your  file is safe!");
      }
    });
    }
    </script>
    
            <!--opening document files  -->
            <div class="documents my-4">
                <h1>Documents</h1>
                <form class="row g-2" method="POST" action="" enctype="multipart/form-data">
                    <div class="col-4">
                        <label for="staticEmail2" class="">Profile Photo</label>
                    </div>
                    <div class="col-8">
                        <input class="form-control form-control-sm" id="formFileSm" type="file" name="profile" required>
                    </div>
                    
                    <div class="col-4">
                        <label for="staticEmail2" class="">Signature &nbsp; &nbsp; &nbsp;</label>
                    </div>
                    <div class="col-8">
                        <input class="form-control form-control-sm" id="formFileSm" type="file" name="sign" required>
                    </div>
                  
                    <div class="col-4">
                        <label for="staticEmail2" class="">Aadhar Card</label>
                    </div>
                    <div class="col-8">
                        <input class="form-control form-control-sm" id="formFileSm" type="file" name="aadhar" required>
                    </div>
                   
                        <button type="submit" class="btn btn-primary w-25 mb-3">Update</button>
                </form>

              

               
            </div>
            <!-- closing documents file. -->

        </div>

    </div>



     <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>

</body>
 </html>