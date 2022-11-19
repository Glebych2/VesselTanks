<?php $title = 'Registration';
session_start();
if(!isset($_SESSION['message'])){
    $_SESSION['message'] = '';
}?>
<?include_once('header.php');  ?>
        <div class="main">
            <div class="sub-main">
                <div class="inner-container">
                    <div class="vessel">
                        <form action="http://localhost/vsltanks/server/api/v1/reg" method="POST">
                            <h4>REGISTRATION</h4>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="exampleInputEmail1" >Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your e-mail">
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="inputPassword">Password</label>
                                <input type="password" name="password" class="form-control" id="inputPassword" aria-describedby="emailHelp" placeholder="Enter your password">
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="inputPassword2">Repeat</label>
                                <input type="password" name="repeat_password" class="form-control" id="inputPassword2" aria-describedby="emailHelp" placeholder="Repeat your password">
                            </div>
                            <button type="submit" class="btn btn-primary" >Submit</button>
                            <p class="reg-Redirect">If you have account follow on <a href="auth.php">authorisation</a> page</p>
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