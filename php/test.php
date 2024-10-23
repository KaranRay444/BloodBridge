<?php

$conn = mysqli_connect("localhost","root","","satyam");

if(isset($_POST['btnsubmit']))
{
    // $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $mobile = $_POST['mobile'];

    $str = "insert into satyamt(name,address,city,mobile) values('$name','$address','$city','$mobile')";

    mysqli_query($conn,$str);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    
    <!-- ID:
    <input type="text" name="id" id=""> <br><br> -->

    Name:
    <input type="text" name="name" id=""> <br><br>

    Ciy:
    <input type="text" name="city" id=""> <br><br>

    Address:
    <input type="text" name="address" id=""> <br><br>

    Mobile No.
    <input type="text" name="mobile" id=""> <br><br>

    <input type="submit" value="Submit" name="btnsubmit">

    </form>

    <form action="" method="post">
        <input type="submit" value="show" name="btnshow"> <br><br>
    </form>

    <form action="" method="post">
        <input type="number" name="deleteid" id="" placeholder="enter your number">
        <input type="submit" value="Delete" name="deletebtn">
    </form>
</body>
</html>

<?php

     if(isset($_POST['deletebtn'])){
        $deleteid = $_POST['deleteid'];
        
        $str1 = "delete from satyamt where id = $deleteid";
        mysqli_query($conn,$str1);
     }
   
   if(isset($_POST['btnshow'])){

    $str = "select * from satyamt";
   $show= mysqli_query($conn,$str);

     while($show2 = mysqli_fetch_array($show))
     {
        echo $show2['id']." || ";
      echo  $show2['name']."||";
      echo  $show2['address']."||";
      echo  $show2['city']."||";
       echo $show2['mobile']."||";
       echo "<br>";
     }

   }
?>