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
                News
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <?php 
                    $id = $_GET['id']; // getiing submitted id from previous page
                    $sql = "SELECT * FROM news WHERE news_id='$id'";
                    $result = mysqli_query($con,$sql);
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_array($result)){
                ?>
                        
                    <div class="h1 ss-text-center ss-text-teal"><?php echo $row['news_headline']; ?></div>
                    <div class="ss-text-justify ss-card-2" style="padding: 10px;margin: 10px 0px;"><em><?php echo $row['news_full_story']; ?></em></div>
                    <div class="ss-text-right"><em><?php echo "- On: " . $row['date']; ?></em></div>
                <?php
                        }
                    }
                ?>
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