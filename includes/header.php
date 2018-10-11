<?php
    $result = mysqli_query($con, "SELECT * FROM register WHERE username = '$username'");

    while( $row = mysqli_fetch_assoc($result) ) {
      $firstname = $row['firstname'];
      $lastname = $row['lastname'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/sajilosikshya.css">
        <link rel="stylesheet" href="styles/profile.css">
        <link rel="stylesheet" href="styles/forum.css">
        <link rel="stylesheet" href="styles/mcq_section.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="SajiloSikshya.png">
        
        <title>www.SajiloSikshya.com</title>
    </head>
    
    <body>
        <div id="wrapper">
            <header id="main_header">
                <div id="main_header_content">
                    <div id="main_header_title">
                        <div>
                            <img style="margin-right: 10px;" src="logo.png" width="50" alt="SajiloSikshya.com">
                        </div>
                        <div>
                            SajiloSikshya
                        </div>
                    </div>

                    <div id="main_header_links">
                        <div>
                            <span>Logged In as: </span>
                            <a style="text-decoration: underline;" href="profile.php"><?php echo $firstname . ' ' . $lastname; ?></a>
                            <a href="logout.php">Log Out</a>
                        </div>
                        <div>
                            <input type="search" placeholder="Search ..." onkeydown="if(event.keyCode == 13) alert('You searched ' + this.value)">
                        </div>
                    </div>
                </div>

                <div id="main_header_seperator"></div>

                <div id="navigation_menu">
                    <ul>
                        <li><a href="welcome.php">Home</a></li>
                        <li><a href="profile.php">Profile</a></li>
                        <li><a href="main_forum.php">Forum</a></li>
                        <li><a href="mcq_section.php">MCQ's</a></li>
                        <li><a href="javascript: void(0)">E-Library</a></li>
                        <?php 
                            $sql= "SELECT * FROM register WHERE username='$_SESSION[username]'";
                            $result = mysqli_query($con,$sql);
                            $row = mysqli_fetch_assoc($result);
                            if ($row["role"] == "admin"){
                                $_SESSION['role'] = 'admin';
                                ?>
                                <li class="dropdown">
                                    <a href="javascript: void(0)">Admin Panel</a>
                                    
                                    <div class="dropdown_content animation_div">
                                        <div>
                                            <a href="admin.php">News</a>
                                            <div style="text-indent: 8px;">
                                                <a href="create_news.php">* Create News</a>
                                                <a href="view_news.php">* View News</a>
                                                <a href="edit_delete_news.php">* Edit/Delete</a>
                                            </div>
                                        </div>
                                        <div><a href="javascript: void(0)">Discussion</a></div>
                                        <div><a href="mcq_section_edit.php">MCQ's Edit</a></div>
                                        <div><a href="javascript: void(0)">Resources</a></div>
                                    </div>
                                </li>
                                <?php 
                            } else{
                                $_SESSION['role'] = 'user';
                            }
                        ?>
                    </ul>
                </div>

                <div id="main_header_seperator"></div>
            </header>