<? include_once('header.php'); ?>
        <div class="main">
            <div class="sub-main">
                <div class="inner-container">
                    <div class="vessel">
                        <form>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configTankQuantity" >Fuel Tanks Quantity:</label>
                                <input type="number" name="tanks" class="form-control" id="configTankQuantity" autofocus>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="tanksQuantity()">OK</button>
                        </form>
                    </div>
                    <div class="vessel2">
                        <form action="http://localhost/vsltanks2/server/v1/tank" method="POST" >
                            <div class="form-group" style="background: #b3c2c4">
                                <table class="hfo-tanks">
                                    <thead>
                                        <tr class="hfo-row hfo-head">
                                            <td>TANK NAME</td>
                                            <td>VOLUME</td>
                                            <td>HEIGHT</td>
                                        </tr>
                                    </thead>
                                    <tbody id="tankConfigTable">
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
        </div>
        <div class="footer">
        </div>
    </div>

    <script src="bootstrap/js/jquery-3.6.0.js"></script>
    <script src="js/sounding.js"></script>
    <script src="js/nextconfig.js"></script>
</body>
</html>