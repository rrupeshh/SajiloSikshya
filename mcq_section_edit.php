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
    $result = mysqli_query($con, "SELECT * FROM register WHERE username = '$username'");

    while( $row = mysqli_fetch_assoc($result) ) {
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
    }
    
    if( isset( $_POST['submit'] ) ) {
        $question = $_POST['question'];
        $opt_one = $_POST['optionone'];
        $opt_two = $_POST['optiontwo'];
        $opt_three = $_POST['optionthree'];
        $opt_four = $_POST['optionfour'];
        $opt_corr = $_POST['optioncorrect'];
        $set_no = $_POST['setnumber'];
        
        if( ($question != "") && ($opt_one != "") && ($opt_three != "") && ($opt_four != "") && ($opt_corr != "") && ($set_no != "") ) {
            if( $set_no <= 0 ) {
                $errormessage = "Invalid Model Set Number!";
                header('refresh: 2,url=mcq_section_edit.php');
            } else {
               $check_model_number = mysqli_query($con, "SELECT model_no FROM mcq_number WHERE model_no = '$set_no'");
            
                if( mysqli_num_rows($check_model_number) == 0 ) {
                    mysqli_query($con, "INSERT INTO mcq_number (model_no) VALUES ('$set_no')");
                }

                $insert = mysqli_query($con, "INSERT INTO mcq_section_sets VALUES (NULL,'$question','$opt_one','$opt_two','$opt_three','$opt_four','$opt_corr','$set_no')");

                if( !$insert ) {
                    $errormessage = "Couldn't upload the question!";
                } else {
                    $errormessage = "Successfully uploaded the new question!";
                    header('refresh: 2,url=mcq_section_edit.php');
                } 
            }
            
        } else {
            $errormessage = "Fill up all the boxes!";
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
                Add New Questions for model sets!
            </div>
            <div class="ss-article-content">
                <form action="mcq_section_edit.php" method="post">
                    <textarea id="textarea" name="question" placeholder="New Question ?" autofocus="on"></textarea> <br>
                    <input type="text" name="optionone" placeholder="Option One"> <br>
                    <input type="text" name="optiontwo" placeholder="Option Two"> <br>
                    <input type="text" name="optionthree" placeholder="Option Three"> <br>
                    <input type="text" name="optionfour" placeholder="Option Four"> <br>
                    <input type="text" name="optioncorrect" placeholder="Correct Option" autocomplete="off"> <br>
                    Select Model Set Number: <input type="number" name="setnumber" placeholder="Input Set Number"> <br>

                    <input type="submit" name="submit" value="Submit">
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