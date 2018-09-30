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
                News!
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                
                
                <?php
                    $sql1 = "SELECT * FROM news";
                    $result1 = mysqli_query($con,$sql1);
                    while ($row1=mysqli_fetch_array($result1)){
                ?>
                <div class="ss-container ss-card-4" style="margin-bottom: 10px;">
                    <h4><?php echo $row1['news_headline']; ?></h4>
                    <div class="ss-separator" style="margin-bottom: 5px;"></div>
                    <?php echo $row1['news_short_description'] . "<br>"; ?>
                    <a style="text-decoration: none;float: right;color: #39f;border-left: 5px solid #39f;font-style:italic;padding-left: 10px;" href="view_full_news.php?id=<?php  echo $row1['news_id']?>">More...</a>
                    <div class="ss-clear"></div>
                </div>
                <?php 
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