<?php

include(__DIR__ . "../../autoload.php");
include(__DIR__ . "../../config.php");

?>

<?php $result = $_SESSION['result']; ?>

<p><?= $result ?></p>

<p>Click below to start new game.</p>




<form method="post" action="../../guess/redirect.php">
    <input type="submit" name="doInit" value="Start over">
</form>
