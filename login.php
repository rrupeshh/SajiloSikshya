<?php 
    session_start();
    
    require_once("connect.php");
    if (isset($_SESSION['username'])){
        header('location: welcome.php');
    }
    
    $errormessage = "No Notification!";
    
    if (isset($_POST) && !empty($_POST)){
        $username = mysqli_real_escape_string($con,$_POST['username']);
        
        if (!preg_match("/^[a-z0-9._]*$/i",$username)){
            $errormessage = "Invalid username and password!";
        } else {
            $password = md5($_POST['password']);
            $sql = "SELECT * FROM register WHERE BINARY username='$username' AND password='$password'"; 
            $result = mysqli_query($con,$sql);
            
            $count =  mysqli_num_rows($result);
            
            if ($count==1){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $curr_sql = "SELECt * FROM register";
                $curr_result = mysqli_query($curr_sql);
                
                while($row=mysqli_fetch_array($curr_result)){
                    if (row['username'] == $username){
                        $_SESSION[user_id]=$row['id'];
                        $_SESSION['firstname']=$row['firstname'];
                        $_SESSION['lastname']=$row['lastname'];
                    }
                }

            }
                else{
                    $errormessage = "Invalid Username and Password";
                }
        }
        if(isset($_SESSION['username'])){
            header('Location: welcome.php');
        }    
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/login.css">
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
                            <a href="index.php">Sign Up</a>
                            <a href="javascript: void(0)">Log In</a>
                        </div>
                        <div>
                            <input type="search" placeholder="Search ..." onkeydown="if(event.keyCode == 13) alert('You searched ' + this.value)">
                        </div>
                    </div>
                </div>

                <div id="main_header_seperator"></div>

                <div id="navigation_menu">
                    <ul>
                        <li><a href="javascript: void(0)">Log In</a></li>
                    </ul>
                </div>

                <div id="main_header_seperator"></div>
            </header>
            
            <?php
                include_once 'includes/information_section.php';
            ?>
            
            <div id="index_main_section">
                <div id="registration_section">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                        <table id="register-login-table">
                            <tr>
                                <td>UserName:</td>
                                <td>
                                    <input type="text" name="username" autocomplete="on" autofocus="on" placeholder="UserName" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>Password:</td>
                                <td>
                                    <input type="password" name="password" autocomplete="off" placeholder="Password" required/>
                                </td>
                            </tr>
                            <tr>
                                <td style="color: red;border-left: 5px solid red;"><?php echo $errormessage; ?></td>
                                <td>
                                    <input type="submit" name="submit" value="Login"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>