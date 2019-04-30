<?php

namespace Anax\View;

// include(__DIR__ . "../../autoload.php");
// include(__DIR__ . "../../config.php");

?>

<?php $result = $_SESSION['result']; ?>

<h1>Guess my number!</h1>

<p><?= $result ?></p>

<p>Click below to start new game.</p>




<form method="post">
    <input type="submit" name="doInit" value="Start over">
</form>
