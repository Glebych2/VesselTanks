<?php $title = 'Configuration';
session_start();
if(!isset($_SESSION['info'])){
    $_SESSION['info'] = '';
}?>
<?include_once('header.php');  ?>
        <div class="main">
            <div class="sub-main">
                <div class="inner-container-config" id="configVessel">
                    <div class="vessel5">
                        <input type="button" data-vesselid="" onclick="newVesselConfigPressed()" value="NEW VESSEL">
                    </div>
                    <div class="vessel4" >
                        <form action="http://localhost/vsltanks2/server/v1/vessel" method="POST" >
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configVesselName" >VESSEL NAME:</label>
                                <input type="text" name="vessel" class="form-control" id="configVesselName" autofocus placeholder="VESSEL NAME" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configVesselImo">VESSEL IMO:</label>
                                <input type="text" name="imo" class="form-control" id="configVesselImo" placeholder="VESSEL IMO" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configVesselCall">VESSEL CALL SIGN:</label>
                                <input type="text" name="call" class="form-control" id="configVesselCall" placeholder="VESSEL CALL SIGN" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configVesselNumber">VESSEL OFFICIAL NUMBER:</label>
                                <input type="text" name="officialNumber" class="form-control" id="configVesselNumber" placeholder="VESSEL OFFICIAL NUMBER" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configVesselPort">VESSEL PORT OF REGISTRY:</label>
                                <input type="text" name="port" class="form-control" id="configVesselPort" placeholder="VESSEL PORT OF REGISTRY" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configVesselFlag">VESSEL FLAG:</label>
                                <input type="text" name="flag" class="form-control" id="configVesselFlag" placeholder="VESSEL FLAG" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for=configVesselPhoto">VESSEL PHOTO:</label>
                                <input type="file" name="image" multiple accept=".jpg, .jpeg, .png, .gif" class="form-control" id="configVesselPhoto" placeholder="VESSEL PHOTO">
                            </div>
                            <button type="submit" class="btn btn-primary" formenctype="multipart/form-data" id="vesselConfigButton">Submit</button>
                            <button type="button" class="btn btn-secondary" id="tanksConfig">Next</button>
                            <?php
                            if ($_SESSION['info']){
                                    echo '<p class="success-msg">' . $_SESSION['info'] . '</p>';
                            }
                            $_SESSION['info'] = '';
                            ?>
                        </form>
<!--                        <div class="container-in-config-for-image" id="contInConfForImg">-->
<!--                            <img class="vessel-image"  src="img/san-felix.jpg" alt="">-->
<!--                        </div>-->
                    </div>

                </div>
                <div class="inner-container-config" id="configTanks" style="display: none">

                    <div class="vessel5">
                        <table>
                            <thead>
                            <tr style='height:15.0pt'>

                            </tr>
                            </thead>
                            <tbody class="tank-buttons" id="tanksButtonsConfig">
                            </tbody>
                        </table>
                    </div>
                    <div class="vessel3">

                        <form action="http://localhost/vsltanks2/server/v1/tank" method="POST" >
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configTankName">TANK NAME:</label>
                                <input type="text" name="name" class="form-control" id="configTankName" autofocus placeholder="TANK NAME" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configTankVolume" >TANK VOLUME (m3):</label>
                                <input type="text" name="volume" class="form-control" id="configTankVolume" placeholder="0000.00" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configTankHeight" >TANK HEIGHT (CM):</label>
                                <input type="text" name="height" class="form-control" id="configTankHeight" placeholder="0000.0" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configTankVesselId" >VESSEL ID:</label>
                                <input type="text" name="vesselId" class="form-control" id="configTankVesselId" placeholder="VESSEL ID" required>
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configTankAbbrev" >ABBREVIATION:</label>
                                <input type="text" name="abbrev" class="form-control" id="configTankAbbrev" >
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="currentTankId" >TANK ID:</label>
                                <input type="text" name="tankId" class="form-control" id="currentTankId">
                            </div>
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="configTankType" >TANK TYPE:</label>
                                <select type="text" name="tankType" class="form-control" id="configTankType">
                                    <option value="0">hfo storage</option>
                                    <option value="1">hfo service</option>
                                    <option value="2">do</option>
                                    <option value="3">other</option>
                            </div>
                            <div class="form-group" style="background: #b3c2c4; display: none">
                                <input type="text" name="tableName" class="form-control" id="configTankTableName" style="display: none">
                            </div>
                            <div class="tank-submit">
                                <button type="submit" class="btn btn-primary" id="tankConfigButton" formenctype="multipart/form-data">Submit</button>
                                <button type="button" class="btn btn-secondary" onclick="currentTankDelete()" id="delTank" style="color: #721c24">Delete</button>
                            </div>


                        </form>
                        <form action="http://localhost/vsltanks2/server/v1/sound" method="POST" enctype="multipart/form-data" name="csvForm">
                            <div class="form-group" style="background: #b3c2c4">
                                <label for="loadTable" >CSV FILE:</label>
                                <input type="file" name="csv" class="form-control" id="loadTable" accept=".csv">
                                <input type="text" name="tankId2" class="form-control" id="currentTankId2" style="display: none">
                            </div>
                            <button type="submit" class="btn btn-primary" formenctype="multipart/form-data" id="submitTankTable" value="Upload">Submit</button>
                            <button type="button" class="btn btn-secondary" onclick="allRowsDelete()" id="delTable" style="color: #721c24">Delete</button>
                        </form>

                    </div>
                    <div class="vessel6">
                        <button type="button" class="btn btn-secondary" id="backVesselConfig" >Back</button>
                    </div>

                </div>


            </div>
        </div>
        <? include_once('footer.php'); ?>
    </div>
    <script src="bootstrap/js/jquery-3.6.0.js"></script>
    <script src="js/configuration.js"></script>
</body>
</html>