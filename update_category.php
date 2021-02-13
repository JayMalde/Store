<link rel="stylesheet" type="text/css" href="style1.css">
<body>
<?php
error_reporting(E_WARNING);
session_start();
if(!isset($_SESSION['user_id']))
{
  header('location: login.php');
}
else if(isset($_SESSION['user_id']) && $_SESSION['user_type']=="user"){
  header('location: show_product.php');
}
$category_id = $_REQUEST['category_id'];
$category_name = $_POST['category_name'];
$con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
if($category_name){
    $query = "update category set category_name='$category_name' where category_id=$category_id";
    if(mysqli_query($con,$query))
    {
        header("location:admin_page.php?page=categories");
    }else {
       echo "<br>0 Records in Row".mysqli_error($con);
    }
}
else{
    $query = "select * from category where category_id = $category_id";
    $result = mysqli_query($con,$query);
    if($result>0){
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="container">
            <form action="update_category.php" method="post">
                <label>Category ID :</label><input type="text" readonly value="<?php echo $row['category_id']; ?>" name="category_id"/><br>
                <label>Category Name :</label><input type="text" value="<?php echo $row['category_name']; ?>" name="category_name"/><br>
                <input type="submit" value="Submit">
            </form>
        </div>
    <?php
        }
    }else {
           echo "<br>0 Records in Row".mysqli_error($con);
    }   
}
?>