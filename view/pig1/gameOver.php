<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<h1>Kasta gris(Controller)!</h1>
<!-- <h1>Guess my number</h1> -->
<p><?= $winner ?> vinner! Använd knappen nedan för att starta ett nytt spel.</p>

<form method="post">
    <input type="submit" name="continue3" style="margin-bottom: 100px;" value="Spela igen">
</form>
