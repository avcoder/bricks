<?php 
// for <title> tag
    $page_title = 'Login';

    include_once 'header.php' 
?>


<div class="divider"></div>
  <div class="section">

    <div class="container">

        <div class="row">
        <div class="col s6 offset-s4">
            <h1>Login</h1>

<?php
// display error message if this was an invalid login attempt
    $isInvalid = (isset($_GET['invalid']) ? $_GET['invalid'] : false);
    if ($isInvalid) {
        echo '<p class="red lighten-3 center-align">Invalid Login Attempt. Try again</p>';
    }
?>

            <form method="post" action="validate.php">
                <div class="row">
                    <div class="input-field col s8">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="icon_prefix" type="email" class="validate" name="username" required>
                    <label for="icon_prefix">Email address</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s8">
                    <i class="material-icons prefix">vpn_key</i>
                    <input id="password" type="password" class="validate" name="password" required>
                    <label for="password">Password</label>
                    </div>
                </div>

                <div class="row">
                    <button class="btn-large blue darken-4 waves-effect waves-light col s8" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>       
                </div>
            </form>
        </div>
        </div>

    </div> <!-- container -->
</div> <!-- section -->

        

<?php include_once 'footer-admin.php' ?>