<?php 
    // for <title> tag
    $page_title = 'Register';

    include_once 'header.php' 
?>

<div class="divider"></div>
  <div class="section">

    <div class="container">

        <div class="row">
        <div class="col s6 offset-s4">
            <h1>Register</h1>
            <form method="post" action="save-registration.php">
                <div class="row">
                    <div class="input-field col s8">
                    <i class="material-icons prefix">account_circle</i>
                    <input id="username" type="email" class="validate" name="username" required>
                    <label for="username">Email address</label>
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
                    <div class="input-field col s8">
                    <i class="material-icons prefix">repeat</i>
                    <input id="confirm" type="password" class="validate" name="confirm" required>
                    <label for="confirm">Confirm Password</label>
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