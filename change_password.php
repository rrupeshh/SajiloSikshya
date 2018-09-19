<?php 
    session_start();
    require_once('connect.php');
    
    $username = $_SESSION['username'];
    
    $errormessage="No Notifications";
    
    if(!$username) {
        echo '<script type="text/javascript"> alert("Access Denied!"); </script>';
        header('refresh:0;url=login.php');
    }
?>

<?php 
    include_once 'includes/header.php'; // Header of the page
?>

<?php
    if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $sql ="SELECT * FROM register";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result)){
        if(isset($_POST['username'],$_POST['current_password'],$_POST['password'],$_POST['passwordagain'])){
        if($_SESSION['username'] == $row['username']){
            $username = test_input($_POST['username']);
            $current_password = test_input($_POST['current_password']);
            $password = test_input($_POST['password']);
            $passwordagain = test_input($_POST['passwordagain']);
            
            if(!preg_match("/^[a-z0-9._]*$/i",$username)){
                $errormessage = "Username Not valid!";
            }else{
                if ($password != $passwordagain){
                    $errormessage = "Password Not Match!";
                }else
                {
                    if(md5($current_password) != $_SESSION['password']){
                        $errormessage = "Invalid Current Password";
                    }else
                    {
                    $newpassword = md5($password);
                    $n_sql = "SELECT * FROM register WHERE username='$username' ";
                    $res = mysqli_query($con,$n_sql);
                    $count = mysqli_num_rows($res);
                    if (($count == 1) or ($username == $_SESSION['username'])){
                        $s_sql = 'UPDATE register SET username ="'.$username.'" , password = "'.$newpassword.'" WHERE username ="'.$_SESSION['username'].'"';
                        $n_result = mysqli_query($con, $s_sql);
                    
                    if(!$n_result){
                        $errormessage = "Couldn't update account!";
                    }else{
                        $errormessage = "Updating Account! Redirecting...";
                       echo '<script type="text/javascript">
                            alert("Updated Profile! Log In Again!");
                            </script> ';
                        error_reporting(0);
                        unset($_SESSION['username'],$_SESSION['password']);
                        header('refresh: 0 ;url="login.php" ');
                       
                    }
                    
                    }else{
                        $errormessage = "Username already exists Choose another!";
                    }
                    }
                }
            }
        }
    }
    }
    }else{
        header('location:login.php');
    }
    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<?php
    include_once 'includes/information_section.php';
?>

<div id="main_section">
    
    <!-- Left Side Section -->
    <div id="left_section" class="ss-card-2">
        <div id="left_section_header">
            Notification:
        </div>
        <div id="left_section_content">
            <?php echo $errormessage; ?>
        </div>
    </div>
    <!-- Left Side Section Ends Here -->
    
    <!-- Middle Section Starts Here -->
    <div id="middle_section">
        <div class="ss-article ss-card-8">
            <div class="ss-article-header">
                Change username / password:
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <form action="<?php $_PHP_SELF ?>" method="post">
                    <table id="profile-table">
                        <tr>
                            <td>UserName:</td>
                            <td>
                                <input type="text" name="username" autocomplete="on" value="<?php echo $_SESSION['username'] ?>" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>Current Password:</td>
                            <td><input type="password" name="current_password" autofocus="on" autocomplete="off" placeholder="Current Password..." required ></td>
                        </tr>
                        <tr>
                        <td>New Password:</td>
                            <td>
                                <input type="password" name="password" autocomplete="off" placeholder="New Password" required/>
                            </td>
                        </tr>
                        <tr>
                            <td>Re- New Password:</td>
                        <td>
                            <input type="password" name="passwordagain" autocomplete="off" placeholder="Re-enter New password..." required>
                            </td>
                        </tr>
                        <tr>
                        <td></td>
                            <td>
                            <input type="submit" name="submit" value="Upload"/>
                        </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <!-- Middle Section Ends Here -->
    
    <!-- Right Section Starts Here -->
    <div id="right_section" class="ss-card-2">
        <div id="right_section_header">
            Side News
        </div>
        <div id="right_section_content">
            <?php include('aside_news.php'); ?>
        </div>
    </div>
    <!-- Right Section Ends Here -->
</div>

<?php
    include_once 'includes/footer.php'; // Footer of the page
?>