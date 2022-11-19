<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Модальное содержание -->
    <div class="modal-content">
        <div class="modal-header">
            <h2>Tank Sounding Report</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <table class="hfo-tanks">
                <thead id="tanksReportGeneral">

                </thead>

            </table>
            <table class="hfo-tanks" id="hfoTanksReportTable">
                <thead>
                <tr>
                    <td>HFO</td>
                </tr>
                <tr class="hfo-report-head">
                    <td class="tdHeadInReport">TANK NAME</td>
                    <td class="tdHeadInReport">CAPACITY</td>
                    <td class="tdHeadInReport">ULLAGE</td>
                    <td class="tdHeadInReport">SOUND</td>
                    <td class="tdHeadInReport">M3</td>
                    <td class="tdHeadInReport">T</td>
                    <td class="tdHeadInReport">DENSITY</td>
                    <td class="tdHeadInReport">CORRECTED DENS</td>
                    <td class="tdHeadInReport">MT</td>
                    <td class="tdHeadInReport">%</td>
                </tr>
                </thead>
                <tbody id="hfoTanksReportTableTbody">
                </tbody>
            </table>
            <table class="hfo-tanks" id="mdoTanksReportTable">
                <thead>
                <tr>
                    <td>MDO</td>
                </tr>
                <tr class="hfo-report-head">
                    <td class="tdHeadInReport">TANK NAME</td>
                    <td class="tdHeadInReport">CAPACITY</td>
                    <td class="tdHeadInReport">ULLAGE</td>
                    <td class="tdHeadInReport">SOUND</td>
                    <td class="tdHeadInReport">M3</td>
                    <td class="tdHeadInReport">T</td>
                    <td class="tdHeadInReport">DENSITY</td>
                    <td class="tdHeadInReport">CORRECTED DENS</td>
                    <td class="tdHeadInReport">MT</td>
                    <td class="tdHeadInReport">%</td>
                </tr>
                </thead>
                <tbody id="mdoTanksReportTableTbody">
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button class="btn-print-report" onclick="printReport()">PRINT</button>
        </div>
    </div>

</div>


<div class="sub-main2">
    <div class="above-tabs">
        <div class="above-tabs-container">
            <button class="btn-insert" onclick="insertPressed()" id="insertButton">INSERT</button>
            <button class="btn-save" onclick="savePressed()">SAVE</button>
            <button class="btn-load" onclick="loadPressed()">LOAD</button>
            <button class="btn-now" onclick="nowPressed()">NOW</button>
            <input class="time-now" type="datetime-local" value="2021-06-01T08:30" id="time-now-id">
            <label class="trim-label" for="trim-id">TRIM</label>
            <input class="trim" type="number" min="-2.0" max="5.0" value="0" step="0.1" id="trim-id">
            <select class="save-time" name="saveOfTime" id="save-of-time-id"></select>
            <input class="comment" type="text" inputmode="" id="comment-id">
            <div class="hfo-input-container">
                <label class="hfo-label" for="hfo-before-id">HFO</label>
                <input class="hfo-before" type="number" min="0" value="0" step="0.1" id="idHfoBefore">
                <input class="hfo-total" type="number" min="0" value="0" step="0.1" id="hfoTotal">
                <input class="hfo-diff" type="number"  value="0" step="0.1" id="hfoDiff">
                <input class="hfo-checkbox" type="checkbox" onclick="hfoCheckboxBefore()" id="hfoCheckbox">
            </div>
            <button class="btn-delete" onclick="deletePressed()">DELETE</button>
            <button class="btn-report" onclick="openReport()">REPORT</button>
            <div class="mdo-input-container">
                <label class="mdo-label" for="mdo-before-id">MDO</label>
                <input class="mdo-before" type="number" min="0" value="0" step="0.1" id="idMdoBefore">
                <input class="mdo-total" type="number" min="0" value="0" step="0.1" id="mdoTotal">
                <input class="mdo-diff" type="number"  value="0" step="0.1" id="mdoDiff">
                <input class="mdo-checkbox" type="checkbox" onclick="mdoCheckboxBefore()" id="mdoCheckbox">
            </div>
        </div>
    </div>
    <div class="tab-header" id="tab-tanks">
        <a class="tab-ref" href="#tab-hfo"><input class="tabTanks" type="button" name="btn-hfo" id="btn-hfo" value="HFO TANKS"></a>
        <a class="tab-ref" href="#tab-mdo"><input class="tabTanks" type="button" name="btn-mdo" id="btn-mdo" value="MDO TANKS"></a>
        <a class="tab-ref" href="#tab-other"><input class="tabTanks" type="button" name="btn-other" id="btn-other" value="OTHER TANKS"></a>
        <?
        $tabs = array(
                array("classTab"=>"tab tab1", "idTab"=>"tanksRowsOnFirstTab", "idNameTab"=>"tab-hfo", "idTableName"=>"idTableHfo", "idDrwL"=>"hfo-drw-left1", "idDrwR"=>"hfo-drw-right1", 'checkboxId'=> 'mainCheckboxHfo'),
            array("classTab"=>"tab tab2", "idTab"=>"tanksRowsOnSecondTab", "idNameTab"=>"tab-mdo", "idTableName"=>"idTableMdo", "idDrwL"=>"hfo-drw-left2", "idDrwR"=>"hfo-drw-right2", 'checkboxId'=> 'mainCheckboxMdo'),
            array("classTab"=>"tab tab3", "idTab"=>"tanksRowsOnThirdTab", "idNameTab"=>"tab-other", "idTableName"=>"idTableOther", "idDrwL"=>"hfo-drw-left3", "idDrwR"=>"hfo-drw-right3", 'checkboxId'=> 'mainCheckboxOther')
        );
        ?>
    </div>
    <div class="tab-container">
        <? foreach ($tabs as $tab): ?>
            <div class="<?= $tab['classTab']; ?>" id="<?= $tab['idNameTab']; ?>">
                <div class="container-for-table">
                    <table class="hfo-tanks" id="<?= $tab['idTableName']; ?>">
                        <thead>
                        <tr class="hfo-row hfo-head">
                            <td class="hfo-head-tank-name">TANK NAME</td>
                            <td class="hfo-head-tank-vol">VOLUME</td>
                            <td class="td-with-checkbox"><input class="input-checkbox" type="checkbox" id="<?= $tab['checkboxId']; ?>" onclick="checkBoxClick()"></td>
                            <td class="hfo-head-tank">SOUND</td>
                            <td class="hfo-head-tank">M3</td>
                            <td class="hfo-head-tank">ULLAGE</td>
                            <td class="td-space"></td>
                            <td class="hfo-head-tank">%</td>
                            <td class="hfo-head-tank">T</td>
                            <td class="hfo-head-tank">DENSITY</td>
                            <td class="hfo-head-tank">MT</td>
                        </tr>
                        </thead>
                        <tbody id="<?= $tab['idTab']; ?>">
                        </tbody>
                    </table>
                </div>
                <div class="hfo-drw-container">
                    <div class="hfo-drw-left" id="<?= $tab['idDrwL']; ?>"></div>
                    <div class="hfo-drw-right" id="<?= $tab['idDrwR']; ?>"></div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
<!--    <div class="mobil-keyboard" id="keyboard">-->
<!--        <div class="keyboard-content"></div>-->
<!--    </div>-->
</div>
