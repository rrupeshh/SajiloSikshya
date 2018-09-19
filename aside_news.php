<?php 
   
    $sql= "SELECT * FROM news ORDER BY news_id DESC LIMIT 5";
    $result = mysqli_query($con,$sql);
    while ($row= mysqli_fetch_array( $result)){
        ?>
 
       <a href="view_full_news.php?id=<?php echo $row['news_id']?>"><?php
        echo $row['news_headline'];
        ?></a>    
        <br>
<?php
    }
?>