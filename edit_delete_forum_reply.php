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
    $id=(isset($_GET['id']))?$_GET['id']:"";
    $function = (isset($_GET['function']))?$_GET['function']:"";
    $question_id = @$_GET['question_id'];



    if ($function == 'delete'){
        $sql = "DELETE FROM forum WHERE id='$id'";
        $result = mysqli_query($con,$sql);
        if (!$result){
            echo "<script type='text/javascript'>";
            echo "alert('Couldnt Delete!')"; 
            echo "</script>";
            $id_question_value = $GLOBALS['question_id'];
            header('refresh:1,url="forum.php?id='.$id_question_value.'"');
        } else{
            echo "<script type='text/javascript'>";
                echo "alert(' Deleted!')";
                echo "</script>";
                     $id_question_value = $GLOBALS['question_id'];
                header('refresh:0,url="forum.php?id='.$id_question_value.'"');
        }
    } else{
        $id1= $GLOBALS['id'];
        $question_id1 = $GLOBALS['question_id'];
        $sql = "SELECT * FROM forum WHERE id='$id1'";
        $result= mysqli_query($con,$sql);
        if(!$result){
            $errormessage="Couldnt select replies";
        }else{
        while($row= mysqli_fetch_object($result)){
            $id_forum = $row->id;
            $comment = $row->comment;
            $comment_id = $row->comment_id;
            $GLOBALS['value']=$comment_id;
        }
    }
    }

    if(isset($_POST['comment'])){
        $id_forum =$_POST['id_forum'];
        $comment = $_POST['comment'];
        $questionId = $_POST['question_id'];

        $sql1 = 'UPDATE forum SET comment="'.$comment.'" WHERE id="'.$id_forum.'" ';
        $result1 = mysqli_query($con,$sql1);
        if(!$result1){
            $errormessage = "Couldnt Update";
        } else{
            $errormessage ="Updated Successfully. Redirecting...";
            header('refresh:1,url="forum.php?id='.$question_id.'"');
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
                Edit Reply Comment!
            </div>
            <div class="ss-article-content">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?function=edit&amp;id=" . $id . "&amp;question_id=" . $question_id; ?>" method="post">
                    <input type="hidden" name="id_forum" id="id" value="<?php echo $id_forum?>" />
                    <textarea id="textarea" name="comment"><?php echo $comment ?></textarea>
                    <input type="hidden" name="question_id" value="<?php echo $question_id; ?>">
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
                    " type="reset" value="reset" />
                    <input type="submit" value="Update" name="update">
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