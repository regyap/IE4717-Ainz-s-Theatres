<?php
    if(isset($_POST['FB_time']) && $_POST['FB_time']>0){
        $screeningId = $_POST['FB_time'];
        header("Location:../seatSelection.php?screeningId=".$screeningId);
    }
?>