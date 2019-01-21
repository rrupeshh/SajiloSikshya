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
    $date = date("y-m-d"); // Getting the server date
    $numofans = 0;
    $question = "";

    if( isset( $_POST["submit"] ) ) {

        $question = str_replace("\n","<br>",$_POST["question"]);

        if( $question ) {

            $sql = "
                INSERT INTO forum_questions VALUES (NULL,'$firstname','$lastname','$username','$question','$date','$numofans');
            ";

            mysqli_query($con, $sql); 

            header('Location: Main_Forum.php');
        } else {
            $errormessage = "Fill up the form!";
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
                Question Forum
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <textarea id="textarea" name="question" placeholder="Any Question?"></textarea>  <br>
                    <input name="submit" type="submit" value="Submit">
                    <div class="ss-clear"></div>
                </form>  
                
                <div class="ss-separator">
                </div>
                <div class="ss-article-header">
                    Questions asked:
                </div>
                <div class="ss-separator"></div>
                
                <div id="forum_section">

                    <div id="question_section">
                        <?php
                            $query = "SELECT * FROM forum_questions ORDER BY id DESC";

                            $result = mysqli_query($con, $query);

                            if( mysqli_num_rows($result) == 0 ) {
                                echo '
                                    <div style="color: #39f;">No questions to display!</div>
                                ';
                            }

                            while( $rows = mysqli_fetch_assoc($result) ) {
                                $askedid = $rows['id'];
                                $fname = $rows['firstname'];
                                $lname = $rows['lastname'];
                                $askedby = $rows['firstname'] . ' ' . $rows['lastname'];
                                $askedquestion = $rows['question'];
                                $askeddate = $rows['date'];
                                $noofans = $rows['num_answers'];
                                $sql1 = "SELECT * FROM register WHERE firstname='$fname' AND lastname='$lname'";
                                $result1 = mysqli_query($con,$sql1);
                                if(!$result1){
                                    $errormessage = "Error  ";
                                }else{
                                    while($row1= mysqli_fetch_array($result1)){
                                        $image = $row1['image'];
                                echo '

                                    <div class="each_question">
                                        <div class="user_image">';
                                          if(empty($image)){ 
                                            echo '<img src="user_logo.bmp" width="60">';
                                          } else{
                                              echo "<img src='image/".$image."' width='60'>";
                                          }
                                    echo '
                                        </div>
                                        <div class="each_question_comment">
                                            <span class="aksed_by"><a href="javascript: void(0)">'.$askedby.'</a></span>
                                            <div class="asked_date">Posted On: '.$askeddate.'</div>
                                            <div class="noofans">Replies: '.$noofans.'</div>
                                            <div class="asked_question"><a href="forum.php?id='.$askedid.'">'.$askedquestion.'</a></div>
                                        </div>';
                                       if($_SESSION['role'] == 'admin'){
                                        ?>
                                        <div class="edit_delete_buttons" style="float: right;">
                                           <?php
                                           if($rows['username'] == $_SESSION['username']){
                                    ?>  
                                   <a href="edit_delete_forum.php?function=edit&id=<?php echo $rows['id'] ?>"><img src="edit.png" width="20"></a>
                                    <?php             
                                    }
                                    ?>


                                   <a href="edit_delete_forum.php?function=delete&id=<?php echo $rows['id'] ?>" onclick="return confirm('Are you sure want to delete this comment?');"><img src="delete.png" width="20"></a>
                                </div>
                        <?php
                                } 
                                else{
                                   if ($rows['username'] == $_SESSION['username']){
                                       ?>
                        <div class="edit_delete_buttons">
                            <a href="edit_delete_forum.php?function=edit&id=<?php echo $rows['id'] ?>" ><img src="edit.png" width="20"></a>
                            <a href="edit_delete_forum.php?function=delete&id=<?php echo $rows['id']; ?>" onclick="return confirm('Are you sure want to delete this comment?');"><img src="delete.png" width="20"></a>
                        </div>

                            <?php
                                    }
                                }        
                                    echo    '<div style="clear: both;"></div>
                                    </div>

                                    <div style="border-bottom: 1px solid #e1e1e1;margin:10px 0px 10px 0px;"></div>

                                ';

                            }
                            }
                            }
                        ?>
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