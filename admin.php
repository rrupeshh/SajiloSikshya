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
    $sql= "SELECT * FROM register WHERE username='$_SESSION[username]'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
    if(!($row['role'] == 'admin') && !(isset($_SESSION['username']))){
        header('location:login.php');
    }else{
        $_SESSION['role']=$row['role'];
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
                News Section
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <div class="ss-row">
                    <div class="ss-grid-4">
                        <div class="ss-container ss-card-4" style="margin: 20px;">
                            <h3 class="ss-text-center">Create news</h3>
                            <div class="ss-separator ss-margin-4"></div>
                            <a style="text-decoration: none;color: #39f;border-left: 5px solid #39f;padding-left: 10px;" href="create_news.php">Click Here...</a>
                        </div>
                    </div>
                    <div class="ss-grid-4">
                        <div class="ss-container ss-card-4" style="margin: 20px;">
                            <h3 class="ss-text-center">View news</h3>
                            <div class="ss-separator ss-margin-4"></div>
                            <a style="text-decoration: none;color: #39f;border-left: 5px solid #39f;padding-left: 10px;" href="view_news.php">Click Here...</a>
                        </div>
                    </div>
                    <div class="ss-grid-4">
                        <div class="ss-container ss-card-4" style="margin: 20px;">
                            <h3 class="ss-text-center">Edit/Delete News</h3>
                            <div class="ss-separator ss-margin-4"></div>
                            <a style="text-decoration: none;color: #39f;border-left: 5px solid #39f;padding-left: 10px;" href="edit_delete_news.php">Click Here...</a>
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