<?php include "includes/header.php"; ?>

<div class="container" style="margin-bottom: 10em;">
<?php
        $get_queue = "SELECT * From queuenumber 
        WHERE queuenumber.queue_status = 'Queuing'
        LIMIT 5";
        $get_num = mysqli_query($conn, $get_queue); 
        ?>
                <?php if(mysqli_num_rows($get_num)>0) {
                while($row = mysqli_fetch_array($get_num)){ 
                    $ticket = $row['ticket'];
                ?>
            
                <form action="" method="POST">
                    <p class="h5 text-center mb-5" style="font-size:2.4em;"><?php echo $ticket ?></p>
                </form>
    
            <?php
            }
            }else{
                echo "<span style='display:grid; place-items:center;'>No Queued yet</span>";
            }
            ?>
            </div>
        </div>
</div>
<?php include "includes/footer.php"; ?>