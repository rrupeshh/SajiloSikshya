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
    $ansArray = array(); // default answers
    $newArray = array(); // user answers
    
    $set_no = $_GET['set'];
    
    if( !isset( $set_no ) ) {
        header('refresh:0;url=mcq_section.php');
    }
    
    $ansquery = mysqli_query($con, "SELECT * FROM mcq_section_sets WHERE set_no = '$set_no'");
    if( !$ansquery ) {
        $errormessage = "Cannot fetch the questions!"; 
    }

    $loop = 0;
    while( $row = mysqli_fetch_assoc( $ansquery ) ) {
        $correct = $row['opt_corr'];

        addArray($correct,$loop);
        $loop++;
    }

    // After the submission
    if(isset($_POST['submit'])) {
        
        for( $x=0, $i = 1; $x < $loop ; $x++) {
            addChoosenArray( $_POST[$i] , $x);
            $i++;  
        }
        
        // comparing each index of two arrays 
        
        $count = 0; // for counting the correct no of answers ticked
        
        for( $j = 0; $j < $loop; $j++ ) {
            if( $ansArray[$j] == $newArray[$j] ) {
                $count++;
            }
        }
        
        $date = date('y-m-d');
        $correctans = $count;
        $outof = $loop;
        
        $insertQuery = "INSERT INTO mcq_section VALUES (NULL,'$username','$firstname','$lastname','$set_no','$date','$correctans','$outof')";
        $insert = mysqli_query($con,$insertQuery);
        
        if( $insert ) {
            $errormessage =  "Successfully inserted your result of this model test!";
        }
        
    }
    
    function addArray( $option, $loop ) {
        global $ansArray;
        
        $ansArray[$loop] = $option;
    }
    
    function addChoosenArray( $option, $loop ) {
        global $newArray;
        
        $newArray[$loop] = $option;
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
                Model Test <?php echo $set_no; ?>
            </div>
            <div class="ss-separator"></div>
            <div class="ss-article-content">
                <form action="mcq_section_set.php?set=<?php echo $set_no; ?>" method="post">
                    <?php

                        $getquery = mysqli_query($con, "SELECT * FROM mcq_section_sets WHERE set_no = '$set_no'");
                        $question_no = 1;
                        if( !$getquery ) {
                            $errormessage = "Cannot get questions!";
                        } else {

                            if( mysqli_num_rows($getquery) == 0 ) {
                                $errormessage = "No Questions to display!";
                            } else {

                                $iteration = 0;
                                while( $rows = mysqli_fetch_assoc($getquery) ) {
                                    $iteration++;
                                    $question = $rows['question'];
                                    $opt_one = $rows['opt_one'];
                                    $opt_two = $rows['opt_two'];
                                    $opt_three = $rows['opt_three'];
                                    $opt_four = $rows['opt_four'];

                                    ?>
                                        <fieldset>
                                            <legend><?php echo $question_no . ' ' . $question; ?></legend>
                                            <input type="radio" name="<?php echo $iteration; ?>" value="<?php echo $opt_one; ?>"> <?php echo $opt_one; ?> <br>
                                            <input type="radio" name="<?php echo $iteration; ?>" value="<?php echo $opt_two; ?>"> <?php echo $opt_two; ?> <br>
                                            <input type="radio" name="<?php echo $iteration; ?>" value="<?php echo $opt_three; ?>"> <?php echo $opt_three; ?> <br>
                                            <input type="radio" name="<?php echo $iteration; ?>" value="<?php echo $opt_four; ?>"> <?php echo $opt_four; ?> <br>
                                        </fieldset>
                                    <?php

                                    $question_no++;
                                }
                            }

                        }

                    ?>

                    <input type="submit" name="submit" value="Submit" onclick="return confirm('Are you sure? You want to submit?');">

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