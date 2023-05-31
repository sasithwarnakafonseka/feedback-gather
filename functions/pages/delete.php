<?php
// Start the DB connection
// Delete response from DB
if (isset($_POST["deleteSubmit"])) {
        $sql = "DELETE FROM responses WHERE campaignId=$_GET[campaign]";
        mysqli_query($conn, $sql); 
        $sql2 = "DELETE FROM campaigns WHERE id=$_GET[campaign]";
        mysqli_query($conn, $sql2);
        header("Location:$url");
}
?>