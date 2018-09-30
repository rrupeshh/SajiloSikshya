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
                Welcome to SajiloSikshya!!
            </div>
            <img class="ss-img ss-bordered" src="online.jpg" style="width: 100%;">
            <div class="ss-article-content">
                Hello everyone! This is sajilosikshya!!
            </div>
        </div>
        
        <div class="ss-article ss-card-8">
            <div class="ss-article-header">
                Results (Model Test) :
            </div>
            <div class="ss-article-content">
                <?php
                    $newquery = mysqli_query($con, "SELECT model_no FROM mcq_number");
                    while( $row = mysqli_fetch_assoc($newquery) ) {
                        $model_number = $row['model_no'];
                       $query = "SELECT * FROM mcq_section WHERE set_no = '$model_number' ORDER BY correct_ans DESC";

                        $result = mysqli_query($con, $query);

                        if( mysqli_num_rows($result) == 0 ) {
                            echo '
                                <div class="ss-text-blue">No any result!</div>
                            ';
                        } else {

                            ?>
                    <p class="ss-padding-2 ss-text-red">Result of model set : <?php echo $model_number; ?></p>
                    <table class="ss-animation-zoom ss-table ss-table-centered">
                                    <tr>
                                        <th>
                                            First Name
                                        </th>
                                        <th>
                                            Last Name
                                        </th>
                                        <th>
                                            Set Number
                                        </th>
                                        <th>
                                            Correct
                                        </th>
                                        <th>
                                            Out Of
                                        </th>
                                        <th>
                                            Date
                                        </th>
                                    </tr>
                                    <?php

                                        while($row = mysqli_fetch_assoc($result)) {

                                            $firstname = $row['firstname'];
                                            $lastname = $row['lastname'];
                                            $set_no = $row['set_no'];
                                            $correctans = $row['correct_ans'];
                                            $outof = $row['outof'];
                                            $date = $row['date'];

                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $firstname; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $lastname; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $set_no; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $correctans; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $outof; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $date; ?>
                                                    </td>
                                                </tr>
                                            <?php 
                                        }

                                    ?>
                                </table>
                                <div class="ss-separator"></div>
                            <?php 

                        } 
                    }
                ?>
            </div>
        </div>
        
        <div class="ss-article ss-card-8">
            <div class="ss-article-header">
                New Model Questions Available:
            </div>
            <div class="ss-article-content">
                <div class="ss-row">
                    <div class="ss-grid-6">
                        <div class="ss-container ss-margin-left-right-8 ss-card-4 ss-text-center ss-blue">
                            <h2 style ="cursor: pointer;" onclick="location.href='mcq_section_set.php?set=1'">Model 1</h2>
                        </div>
                    </div>
                    <div class="ss-grid-6">
                        <div class="ss-container ss-margin-left-right-8 ss-card-4 ss-text-center ss-blue">
                            <h2 style ="cursor: pointer;" onclick="location.href='mcq_section_set.php?set=2'">Model 2</h2>
                        </div>
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