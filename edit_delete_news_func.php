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
    if(!($_SESSION['role'])=='admin'){
        header('location:login.php');
    }
    
    $id = (isset($_GET['id']))?$_GET['id']:"";
    $function = (isset($_GET['function']))?$_GET['function']:"";

    if ($function == 'delete'){
    $sql = "DELETE FROM news WHERE news_id='$id'";
    $result = mysqli_query($con,$sql);
    if(!$result){
        echo "<script type='text/javascript'>";
        echo "alert('Couldnt Delete!')"; 
        echo "</script>";
        header('refresh:1,url="edit_delete_news.php"');
    } else{
           echo "<script type='text/javascript'>";
        echo "alert(' Deleted!')";
        echo "</script>";
        header('refresh:0,url="edit_delete_news.php"');
    }
} else{

    $id1=$GLOBALS['id'];
    $sql="SELECT * FROM news WHERE news_id='$id1'";
    $result=mysqli_query($con,$sql);
    while($row=mysqli_fetch_object($result)){
        $news_id = $row->news_id;
        $news_headline = $row->news_headline;
        $news_short_description = $row->news_short_description;
        $news_full_story = $row->news_full_story;
    }


}


    if(isset($_POST['news_headline'],$_POST['news_short_description'],$_POST['news_full_story']))
    {
        $news_id = $_POST['news_id'];
        $news_headline = $_POST['news_headline'];
        $news_short_description = $_POST['news_short_description'];
        $news_full_story = $_POST['news_full_story'];

        $sql1 = 'UPDATE news SET news_headline="'.$news_headline.'",news_short_description="'.$news_short_description.'",news_full_story="'.$news_full_story.'" WHERE news_id="'.$news_id.'" ';
        $result1 = mysqli_query($con,$sql1);
        if(!$result1){
            $errormessage = "Couldnt Update";
        } else{
            $errormessage = "Updated Successfully. Redirecting...";
            header('refresh:1,url="view_full_news.php?id='.$news_id.'"');
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
                Edit News!
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                    <input type="hidden" name="news_id" id="news_id" value="<?php echo $news_id?>" />
                    
                    <div class="ss-container ss-card-4" style="margin-bottom: 20px;">
                        <h4>News Headline:</h4>
                        <input type="text" name="news_headline" autocomplete="off" autofocus="on" value="<?php echo $news_headline; ?>"/>
                    </div>
                    
                    <div class="ss-container ss-card-4" style="margin-bottom: 20px;">
                        <h4>News Short Description</h4>
                        <textarea id="textarea" name="news_short_description" rows="4" cols="33"><?php echo $news_short_description; ?> </textarea>
                    </div>
                    
                    <div class="ss-container ss-card-4" style="margin-bottom: 20px;">
                        <h4>News Description</h4>
                        <textarea id="textarea" name="news_full_story" rows="8" cols="33"><?php echo $news_full_story; ?></textarea>

                    </div>
                    <div class="ss-container">
                        <input style="
                            padding: 12px;
                            font-size: 14px;
                            border-radius: 100px;
                            outline: none;
                            border: none;
                            transition: border 0.3s;
                            background: #39f;
                            color: #fff;
                            cursor: pointer;
                            box-shadow: 0px 1px 1px rgba(0,0,0,0.5);
                            margin-left: 10px;
                            float: right;
                        " type="reset" value="reset"/>    
                        <input type="submit" name="submit" value="Update"/>
                    </div>
                    <div class="ss-clear"></div>
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