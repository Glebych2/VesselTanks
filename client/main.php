<?// include_once('header.php'); ?>
<?php $title = 'Vessels'; ?>


<?include_once('header.php');  ?>

<!-- <link rel="stylesheet" media="(max-width: 700px)" href="../server/api/v1/views/common/smallheader.php" />-->

        <div class="main">
            <div class="sub-main">
                <div class="inner-container">
                    <div class="vessel" id="vesselSlider" >
                    </div>
                    <div class="vessel-particulars">
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 1; border-top-left-radius: 17px">VESSEL NAME:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 1; border-top-right-radius: 17px"" id="vesselParticularsName"></div>
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 2">IMO NUMBER:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 2" id="vesselParticularsImo">567879</div>
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 3">CALL SIGN:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 3" id="vesselParticularsCall"></div>
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 4">OFFICIAL NUMBER:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 4" id="vesselParticularsNumber"></div>
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 5">PORT OF REGISTRY:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 5" id="vesselParticularsPort"></div>
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 6">FLAG:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 6" id="vesselParticularsFlag"></div>
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 7">CLASS SOCIETY:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 7">ABCD</div>
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 8">OWNER:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 8">SFL</div>
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 9">DEADWEIGHT:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 9">123 382.7 T</div>
                        <div class="vessel-particulars-head" style="grid-column: 1/3; grid-row: 10; border-bottom-left-radius: 17px"">LOA:</div>
                        <div class="vessel-particulars-body" style="grid-column: 3/5; grid-row: 10; border-bottom-right-radius: 17px"">331.10 M</div>
                    </div>
                </div>
            </div>
        </div>
<div class="cookie-msg" id="cookieMsg">
    <p>This site is using Cookies. If you are not agree, pls leave the site.</p>
    <button class="btn btn-secondary" onclick="cookieOk()">OK</button>

</div>
        <? include_once('footer.php'); ?>
    </div>

</body>
</html>