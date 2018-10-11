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
                Your Result:
            </div>
            <div class="ss-article-content">
                <?php 
                    $result = mysqli_query($con, "SELECT * FROM mcq_section WHERE username = '$username' ORDER BY id ASC");
                    if(mysqli_num_rows($result) == 0 ) {
                        ?>
                            <p>
                                No result to display!
                            </p>
                        <?php
                    } else {
                        ?>
                            <table class="ss-table ss-table-centered">
                                <tr>
                                    <th>Model Set Number</th>
                                    <th>Correct Answers</th>
                                    <th>Out Of</th>
                                    <th>Date</th>
                                </tr>

                                <?php
                                    while( $row = mysqli_fetch_assoc($result) ) {
                                        $model_no = $row['set_no'];
                                        $correctans = $row['correct_ans'];
                                        $outof = $row['outof'];
                                        $date = $row['date'];

                                        ?>
                                            <tr>
                                                <td><?php echo $model_no; ?></td>
                                                <td><?php echo $correctans; ?></td>
                                                <td><?php echo $outof; ?></td>
                                                <td><?php echo $date; ?></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </table>
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