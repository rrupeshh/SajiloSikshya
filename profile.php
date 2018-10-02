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
    $sql = "SELECt * FROM register";
    $result = mysqli_query($con,$sql);
    while ( $row = mysqli_fetch_array($result) ) {
        if($row['username'] == $_SESSION['username']) {
            $username = $row['username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $college = $row['college'];
            $birthplace = $row['birthplace'];
            $userpost = $row['post'];
            $usersex = $row['usersex'];
            $dob = $row['dob'];
            $biography = $row['biography'];
            $image = $row['image'];
            $role = $row['role'];
        }
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
                Profile
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <div class="ss-row" style="align-items: center;">
                    <div class="ss-grid-2" style="border-right: 2px solid #f1f1f1;padding: 10px;">
                        <?php           //code to check if profile picture is set or not
                            if(empty($image)){
                                echo "<img class='ss-img' src='user_logo.bmp'>";
                            }else{
                                echo "<img class='ss-img' src='image/".$image."'>";    
                            }
                        ?>
                    </div>
                    <div class="ss-grid-10">
                        <div class="ss-container">
                            <h1>
                                <?php 
                                    echo $firstname; 
                                    echo " ";
                                    echo $lastname;
                                ?>
                            </h1>
                        </div>
                        
                        <div class="ss-container" style="color: #555;">
                            <h3>
                                <?php echo $college; ?> 
                            </h3>
                        </div>
                    </div>
                </div>
                
                <div class="ss-separator"></div>
                
                <div class="ss-row">
                    <div class="ss-grid-8" style="border-right: 2px solid #f1f1f1;">
                        <div class="ss-container">
                            <div style="margin: 5px 0px;">
                                <h4>Email:</h4> <?php echo $email; ?>
                            </div>
                            <div style="margin: 5px 0px;">
                                <h4>Birthplace:</h4> 
                                <?php echo $birthplace; ?>
                            </div>
                            <div style="margin: 5px 0px;">
                                <h4>Post:</h4> 
                                <?php echo $userpost; ?>
                            </div>
                            <div style="margin: 5px 0px;">
                                <h4>Gender:</h4> 
                                <?php echo $usersex; ?>
                            </div>
                            <div style="margin: 5px 0px;">
                                <h4>Date of Birthday:</h4>
                                <?php echo $dob; ?>
                            </div>
                            <div style="margin: 5px 0px;">
                                <h4>Biography:</h4>
                                <?php echo $biography; ?>
                            </div>
                            <div style="margin: 5px 0px;">
                                <h4>Role:</h4> 
                                <?php echo $role; ?>
                            </div>
                       </div>
                    </div>
                    <div class="ss-grid-4">
                        <div class="ss-container">
                            <h3>Profile Setting</h3>
                            <a style="text-decoration: none;color: #39f;border-left: 5px solid #39f;padding-left: 10px;" href="edit_profile.php">Edit Profile</a>
                        </div>
                        <div class="ss-separator"></div>
                        <div class="ss-container">
                            <h3>Account Setting</h3>
                            <a style="text-decoration: none;color: #39f;border-left: 5px solid #39f;padding-left: 10px;" href="change_password.php">Change Password</a>
                        </div>
                    </div>
                </div>
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