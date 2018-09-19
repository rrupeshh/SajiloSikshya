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
    if(isset($_POST) && !empty($_POST)){
        $headline = $_POST['news_headline'];
        $short_description = $_POST['short_description'];
        $full_description = $_POST['full_description'];
        $current_date = date('Y-m-d');
        
        $sql = "INSERT INTO news (news_headline,news_short_description,news_full_story,date) VALUES ('$headline','$short_description','$full_description','$current_date')";
        $result  = mysqli_query($con,$sql);
        if(!$result){
            $errormessage = "Couldn/'t Update!";
        }else{
            $errormessage = "News Updated.Sucessfully!";
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
                Create News!
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <div class="ss-container ss-card-4" style="margin-bottom: 20px;">
                        <h4>News Headline:</h4>
                        <input type="text" name="news_headline" autocomplete="off" autofocus="on" placeholder="News Headline" required/>
                    </div>
                    <div class="ss-container ss-card-4" style="margin-bottom: 20px;">
                        <h4>News Short Description</h4>
                        <textarea id="textarea" name="short_description" rows="4" cols="33" value="news_short_description" placeholder="News Short Description" required></textarea>
                    </div>
                    <div class="ss-container ss-card-4">
                        <h4>News Description</h4>
                        <textarea id="textarea" name="full_description" rows="8" cols="33" value="news_description" placeholder="News Description" required></textarea>
                        <input style="margin-top: 30px;" type="submit" name="submit" value="Submit"/>
                    </div>
                </form>
                <div class="ss-clear"></div>
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