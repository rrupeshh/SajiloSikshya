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
    $retrived_id = $_GET['id']; // from main_forum page

    $date = date("y-m-d"); // getting the server date
    $agree = 0; // default vote
    $comment = "";

    // check the no of comments

    $resultofcomments = mysqli_query($con, "SELECT * FROM forum WHERE comment_id = '$retrived_id'");
    $noofcomments = mysqli_num_rows($resultofcomments);

    $noofcomments++;

    if( isset( $_POST["submit"] ) ) {

        $comment = str_replace("\n","<br>",$_POST["comment"]);

        if( $comment ) {

            $sql = "INSERT INTO forum VALUES (NULL, '$firstname','$lastname','$username','$date','$agree','$comment','$retrived_id')";

            $insert = mysqli_query($con, $sql) or die("Error!"); // insert the comment into the database

            $sqlnew = "UPDATE forum_questions SET num_answers='$noofcomments' WHERE id='$retrived_id'";

            mysqli_query($con,$sqlnew);

            if( $insert ) {
                header('Location: Forum.php?id=' . $retrived_id);
            }

        } else {
            $errormessage = "Fill up all the fields!";
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
                <?php
                    $retrive_question = mysqli_query($con,"SELECT question FROM forum_questions WHERE id = '$retrived_id'");
                    $result_question = mysqli_fetch_assoc($retrive_question);

                    echo $result_question["question"];
                ?>
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <div id="forum_section">
                <div id="comment_section">
                    <?php
                        $query = "SELECT * FROM forum WHERE comment_id = '$retrived_id' ORDER BY id ASC";

                        $result = mysqli_query($con, $query);

                        if( mysqli_num_rows($result) == 0 ) {
                            echo '
                                <div style="color: #39f;">No comments to display!</div>
                            ';
                        }

                        while( $rows = mysqli_fetch_assoc($result) ) {
                            $fname = $rows['firstname'];
                            $lname = $rows['lastname'];
                            $user = $rows['firstname'] . ' ' . $rows['lastname'];
                            $displaycomment = $rows['comment'];
                            $displaydate = $rows['date'];
                            $sql1 = "SELECT * FROM register WHERE firstname='$fname' AND lastname='$lname'";
                            $result1 = mysqli_query($con,$sql1);
                            if(!$result1){
                                $errormessage = "Error ";
                            }else{
                                while($row1=mysqli_fetch_array($result1)){
                                    $image = $row1['image'];
                            echo '
                                <div class="each_reply">
                                    <div class="user_image">';
                                       if(empty($image)){
                                        echo '   <img src="user_logo.bmp" width="60">';
                                       } else{
                                           echo "<img src='image/".$image."' width='60'>";
                                       }
                                 echo '
                                 </div>
                                    <div class="each_reply_comment">
                                        <span class="displayuser">'. $user .'</span>
                                        <div class="displaydate">Posted on: '. $displaydate .'</div>
                                        <div class="displaycomment">'. $displaycomment .'</div>
                                    </div>

                                    <!-- <div class="agree_button"><a href="javascript: void(0);">Agree</a></div> --> ';
                                     if($_SESSION['role'] == 'admin'){
                                    ?>
                                    <div class="edit_delete_buttons" style="float: right;">
                                       <?php
                                       if($rows['username'] == $_SESSION['username']){
                                ?>  
                               <a href="edit_delete_forum_reply.php?function=edit&id=<?php echo $rows['id'] ?>&question_id=<?php echo $retrived_id ?>"><img src="edit.png" width="20"></a>
                                <?php             
                                }
                                ?>
                            
                            
                               <a href="edit_delete_forum_reply.php?function=delete&id=<?php echo $rows['id'] ?>&question_id=<?php echo $retrived_id ?>" onclick="return confirm('Are you sure want to delete this comment?');"><img src="delete.png" width="20"></a>
                            </div>
                    <?php
                            } 
                            else{
                               if ($rows['username'] == $_SESSION['username']){
                                   ?>
                    <div class="edit_delete_buttons">
                        <a href="edit_delete_forum_reply.php?function=edit&id=<?php echo $rows['id'] ?>&question_id=<?php echo $retrived_id ?>" ><img src="edit.png" width="20"></a>
                        <a href="edit_delete_forum_reply.php?function=delete&id=<?php echo $rows['id']; ?>&question_id=<?php echo $retrived_id ?>" onclick="return confirm('Are you sure want to delete this comment?');"><img src="delete.png" width="20"></a>
                    </div>
                            
                        <?php
                                }
                            }         
                                    
                                  echo '  <div style="clear: both;"></div>
                                </div>

                                <div style="border-bottom: 1px solid #e1e1e1;margin:10px 0px 10px 0px;"></div>
                            ';
                        }
                        }
                        }
                    ?>
                </div>


                <div id="comment_input_section">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $retrived_id; ?>">
                        <textarea id="textarea" name="comment" placeholder="Reply your answer ..."></textarea>
                        <br>
                        <input name="submit" type="submit" value="Submit">

                        <div style="clear: both;"></div>
                    </form>
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