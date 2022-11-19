<?php $title = 'Authorisation';
session_start();
//$_SESSION['capture'] = rand(10000, 99999);

?>
<?include_once('header.php'); ?>

        <div class="main">
            <div class="sub-main">
                <div class="inner-container">
                    <div class="vessel">
                        <form action="http://localhost/vsltanks2/server/v1/auth" method="POST">
                            <h4>AUTHORISATION</h4>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="exampleInputEmail1" >Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your login">
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="inputPassword">Password</label>
                                <input type="password" name="password" class="form-control" id="inputPassword" aria-describedby="emailHelp"placeholder="Enter your password">
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
<!--                                <input type="text" name="random" class="form-control" style="display: none" value="--><?//= $_SESSION['capture']; ?><!--">-->
                                <label for="inputCaptcha" style="margin: 0"><img src="../server/v1/components/captcha.php" width="220" height="60" alt="capture"/></label>
                                <input type="text" name="captcha" class="form-control" id="inputCaptcha" placeholder="Enter code from picture">
                            </div>

                            <p id="authError"></p>
                            <button type="submit" class="btn btn-primary" >Submit</button>
                            <p class="reg-Redirect">If You have no account follow <a href="registration.php">registration </a>page</p>
                            <?php
                            if ($_SESSION['message']){
                                if ($_SESSION['success'] === 'OK'){
                                    echo '<p class="success-msg">' . $_SESSION['message'] . '</p>';
                                }else{
                                    echo '<p class="error-msg">' . $_SESSION['message'] . '</p>';
                                }
                            }
                            $_SESSION['message'] = '';
                            ?>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="footer"></div>
    </div>
    <script src="bootstrap/js/jquery-3.6.0.js"></script>
    <script src="bootstrap/js/bootstrap.js" ></script>

</body>
</html>