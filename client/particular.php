<?php $title = 'Ship particular'; ?>
<?include_once('header.php');  ?>

            <div class="main">
                <div class="sub-main">
            <!--        <iframe src="Ship%20Particular.htm" frameborder="0" height="100%" width=100% style="background: rgba(229,254,252,0.2)"></iframe>-->
                    <div class="help-container">
                        <div class="instruction">
                            <h3>INSTRUCTION</h3>
                            <div class="div-text">
                                1. First of&nbsp;all, you should go&nbsp;through the registration procedure, and then log in&nbsp;to&nbsp;the site under your username.
                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/registration.png" alt="registration form">
                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/authorisation.png" alt="registration form">
                            </div>
                            <br>
                            <div class="div-text">
                                2. Next, you need to&nbsp;go&nbsp;to&nbsp;the configuration for registering the vessel. If&nbsp;the vessel that you are going to&nbsp;register is&nbsp;already in&nbsp;the database,
                                you will get access to&nbsp;this vessel without the possibility of&nbsp;changing anything there. If&nbsp;you are the first to&nbsp;register this vessel,
                                then in&nbsp;the future you have the opportunity to&nbsp;make changes.
                                When you fill in&nbsp;all the fields, select a&nbsp;photo of&nbsp;the vessel.
                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/vessel_config.png" alt="registration form">
                            </div>
                            <br>
                            <div class="div-text">
                                3. Go&nbsp;to&nbsp;the fuel tank configuration on&nbsp;the next page. Click the &laquo;New Tank&raquo; button.
                                Fill in&nbsp;four fields: TANK NAME, TANK VOLUME, TANK HEIGHT and TANK TYPE. Click the &laquo;Submit&raquo; button under the form.
                                Repeat this step for all tanks.

                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/tanks_config.png" alt="registration form">
                            </div>
                            <br>
                            <div class="div-text">
                                4. To&nbsp;follow further, you need to&nbsp;prepare tables. To&nbsp;do&nbsp;this, you need to&nbsp;scan tables from a&nbsp;paper book.
                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/table_scan.png" alt="registration form">
                            </div>
                            <br>
                            <div class="div-text">
                                4.1 Install the FineReader application. Using this application, convert the scanned image to&nbsp;&laquo;excel&raquo; format.
                                In&nbsp;this way, scan and convert all the pages of&nbsp;the tank.
                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/Fine%20reader.png" alt="registration form">
                            </div>
                            <br>
                            <div class="div-text">
                                4.2 Assemble into one &laquo;excel&raquo; file as&nbsp;in&nbsp;the image below. Convert to &rsquo;csv&rsquo; format.
                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/cvs%20foramt.png" alt="registration form">
                            </div>
                            <br>
                            <div class="div-text">
                                4.3 The order of&nbsp;the columns should be&nbsp;as&nbsp;in&nbsp;the picture below. If&nbsp;you have a&nbsp;different number of&nbsp;columns and differents,
                                you should recalculate them using &rsquo;excel&rsquo; and bring them to&nbsp;this form.
                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/table_head.png" alt="registration form">
                            </div>
                            <br>
                            <div class="div-text">
                                5. Now you can select this &rsquo;csv&rsquo; file and upload&nbsp;it. Repeat it for all tanks you need.
                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/load_table.png" alt="registration form">
                            </div>
                            <br>
                            <div class="div-text">
                                6. When all configuration done and all tanks tables loaded, this web portal ready to&nbsp;use.
                                Follow onto the &rsquo;sounding&rsquo; page.
                            </div>
                            <br>
                            <div class="img-container">
                                <img src="./img/sounding.png" alt="registration form">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <? include_once('footer.php'); ?>
        </div>

        <link rel="stylesheet" href="css/help.css">
        <script src="js/main.js"></script>
    </body>
</html>