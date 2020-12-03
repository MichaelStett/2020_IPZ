<?php  
if (isset($_POST['user_name']) and isset($_POST['user_password'])) {
    $connection = mysqli_connect('localhost', 'root', '');
    
    $select_db = mysqli_select_db($connection, 'project_alpha');
    
    // Assigning POST values to variables.
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];

    // CHECK FOR THE RECORD FROM TABLE
    $query = "SELECT * FROM `users` WHERE name='$username' and password='$password'";
    
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1){
        echo "<script type='text/javascript'>alert('Login Credentials verified')</script>";
    } else {
        echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
    }
}

?>