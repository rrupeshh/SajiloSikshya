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
                View Your Result:
            </div>
            <div class="ss-article-content">
                <a style="
                    text-decoration: none;
                    color: #39f;
                    border-left: 5px solid #39f;
                    padding-left: 10px;
                    font-style: italic;
                " href="view_mcq_result.php">View Result</a>
            </div>
        </div>
        
        <div class="ss-article ss-card-8">
            <?php
                $newQuery = mysqli_query($con, "SELECT * FROM mcq_number");

                if( !$newQuery ) {
                    $errormessage = "Error in loading model questions!";
                } 

                while( $row = mysqli_fetch_assoc($newQuery) ) {
                    $model_no = $row['model_no'];

                ?>
            <div class="ss-article-header">
                <?php echo "Model Set " . $model_no; ?>
            </div>
            <div class="ss-article-content">
                <a style="
                    text-decoration: none;
                    color: #39f;
                    border-left: 5px solid #39f;
                    padding-left: 10px;
                    font-style: italic;
                " href="mcq_section_set.php?set=<?php echo $model_no; ?>">click here to give exam..</a>
            </div>
            
            <div class="ss-separator"></div>
                    <?php
                }
            ?>
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