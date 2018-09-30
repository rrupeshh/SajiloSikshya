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
    if(isset($_SESSION['username']))
        { $current_sql = "SELECT * FROM register";
            $current_result = mysqli_query($con,$current_sql);
         while($row=mysqli_fetch_array($current_result)){
             if ($row['username'] == $_SESSION['username']){
                 $curr_username = $row['username'];
                 $curr_firstname = $row['firstname'];
                 $curr_lastname = $row['lastname'];
                 $curr_email = $row['email'];
                 $curr_college = $row['college'];
                 $curr_birthplace = $row['birthplace'];
                 $curr_userpost = $row['post'];
                 $curr_usersex = $row['usersex'];
                 $curr_dob = $row['dob'];
                 $curr_biography = $row['biography'];
                 $curr_image = $row['image'];
                 
             }
         }
          
         
        if(isset($_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['college'],$_POST['birthplace'],$_POST['userpost'],$_POST['usersex'],$_POST['bday'],$_POST['biography']))
        {   $target = "image/".basename($_FILES['image']['name']);
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = test_input($_POST['email']);
            $college = $_POST['college'];
            $birthplace = $_POST['birthplace'];
            $userpost = $_POST['userpost'];
            $usersex = $_POST['usersex'];
            $dob = $_POST['bday'];
            $biography = $_POST['biography'];
            if (!empty($_FILES['image']['name'])){
            $image = $_FILES['image']['name'];
            }else
            {
                $image = $curr_image;
            }
            $sql='UPDATE register SET firstname ="'. $firstname.' ", lastname="'.$lastname.'", email = "'.$email.'",post="'.$userpost.'",college="'.$college.'",usersex="'.$usersex.'",dob="'.$dob.'",birthplace="'.$birthplace.'",biography="'.$biography.'",image="'.$image.'" WHERE username ="'.$_SESSION['username'].'" ';
        $result=mysqli_query($con,$sql);
         if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
             $errormessage="Uploaded";
         } else{
             $errormessage="problem in uploading";
         }  
         if (!$result){
                $errormessage="Couldnt insert!";
            }else{
                $errormessage="Updated Profile! Redirecting...";
                header('refresh:1,url="profile.php"');
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
                Edit Profile!
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                    <table id="profile-table">
                        <tr>
                            <td>First Name: </td>
                            <td>
                                <input type="text" name="firstname" value="<?php echo $curr_firstname ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Last Name: </td>
                            <td>
                                <input type="text" name="lastname" value="<?php echo $curr_lastname?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Email Address: </td>
                            <td>
                                <input type="email" name="email" value="<?php echo $curr_email?>">
                            </td>
                        </tr>
                        <tr>
                            <td>University/College: </td>
                            <td>
                                <input type="text" name="college" value="<?php echo $curr_college ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Birthplace: </td>
                            <td>
                                <input type="text" name="birthplace" value="<?php echo $curr_birthplace ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Your Post: </td>
                            <td>
                                <input type="radio" name="userpost" value="Teacher">&nbsp;Teacher
                                &nbsp;&nbsp;
                                <input type="radio" name="userpost" value="Student">&nbsp;Student
                            </td>
                        </tr>
                        <tr>
                            <td>Gender: </td>
                            <td>
                                <input type="radio" name="usersex"  value="Male">&nbsp;Male &nbsp;&nbsp;
                                <input type="radio" name="usersex" value="Female">&nbsp;Female 
                            </td>
                        </tr>
                        <tr>
                            <td>Date of Birth: (YYYY-MM-DD)</td>
                            <td><input type="text" name="bday" value="<?php echo date('Y-m-d',strtotime($curr_dob));?>" ></td>
                        </tr>
                        <tr>
                            <td>Biography:</td>
                            <td><textarea id="textarea" name="biography" cols="40" rows="3"><?php echo $curr_biography; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Upload Image</td>
                        <td><input type="file" name="image" value="<?php echo $curr_image; ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="reset" value="Reset">
                                &nbsp;&nbsp;
                                <input type="submit" name="submit" value="Update">
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