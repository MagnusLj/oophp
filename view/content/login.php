<h1>Logga in</h1>

<!-- <p>Login to the website by using doe:doe or admin:admin as user and password. The form is posted to a processing page where the session is updated to remeber that the user is logged in, if the user and password matches. The user and password are saved in the config file. The processing page redirects to the status page on successful login, and to the login page on unsuccessful attempts.</p> -->

<form method="post" action="login">

    <fieldset>
        <legend>Logga in</legend>

        <p><label>Användarnamn:<br>
            <input type="text" name="user">
        </label></p>

        <p><label>Lösenord:<br>
            <input type="password" name="password">
        </label></p>

        <input type="submit" name="login" value="Logga in">

    </fieldset>

</form>
