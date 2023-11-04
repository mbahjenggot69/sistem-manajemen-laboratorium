<?php
// JIKA BELUM LOGIN
if(isset($_SESSION['log'])){
} else {
    header('location:../login.php');
}
?>