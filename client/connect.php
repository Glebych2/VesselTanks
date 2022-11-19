<?php $title = 'Connect';
session_start();?>
<?include_once('header.php');  ?>
    <div class="main">
        <div class="sub-main">
            <div class="inner-container">
                <div class="vessel">
                    <form action="http://localhost/vsltanks2/server/v1/message" method="POST">
                        <h4>FEEDBACK</h4>
                        <div class="form-group" style="background: #b3c2c4">
                            <label for="exampleInputEmail1" >Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your e-mail">
                        </div>
                        <div class="form-group" style="background: #b3c2c4" hidden>
                            <label for="inputUserId">User ID</label>
                            <input type="number" name="userId" class="form-control" id="inputUserId" placeholder="User ID" required>
                        </div>
                        <div class="form-group" style="background: #b3c2c4">
                            <label for="inputUserId">Print here your message</label>
                            <textarea class="form-control" name="message" aria-label="With textarea" placeholder="Your message"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <?php
                        if ($_SESSION['message']){
                            echo '<p class="success-msg">' . $_SESSION['message'] . '</p>';
                        }
                        if (isset($_SESSION['message'])){
                            $_SESSION['message'] = '';
                        }

                        ?>

                    </form>
                </div>

            </div>

        </div>
    </div>
    <? include_once('footer.php'); ?>
</div>

<script src="bootstrap/js/jquery-3.6.0.js"></script>

<script src="js/main.js"></script>
</body>
</html>
