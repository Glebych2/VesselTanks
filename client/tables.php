<?php $title = 'Ship tables';?>
<?include_once('header.php');?>

        <div class="main">

            <div class="table-container">
                <div class="sub-main3">
                    <table>
                        <thead>
                        <tr style='height:15.0pt'>

                        </tr>
                        </thead>
                        <tbody class="tank-buttons" id="tanksButtons">

                        </tbody>
                    </table>
                </div>
                <div class="sub-main4">
<!--                    <iframe src="./tanks%20tables/hfo1S.htm" frameborder="0" height="100%" width="52%" style="margin-left: 200pt; background: #E5FEFC"></iframe>-->
                    <div class="tables-sub-container">
<!--                        <div class="head-container">-->
<!--                            <table class="tank-table">-->
<!--                                <thead>-->
<!--                                <tr style='height:15.0pt' id="headTankTable">-->
<!---->
<!--                                </tr>-->
<!--                                </thead>-->
<!--                            </table>-->
<!--                        </div>-->
                        <div class="body-container">
                            <table class="tank-table">
                                <thead>
                                    <tr id="headTankTable">

                                    </tr>
                                </thead>
                                <tbody class="tank-rows" id="oneTankRows">
                                </tbody>
                            </table>
                        </div>
                        <div class="footer-container">
                            <table class="tank-table">
                                <tfoot class="tank-rows" id="oneTankRows">
                                    <tr class="tfoot-tr" id="tfootTrTankName">

                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


        </div>

        <? include_once('footer.php'); ?>
    </div>
    <link rel="stylesheet" href="css/tables.css">
    <script src="js/functions.js"></script>
    <script src="js/main.js"></script>
    <script src="js/tables.js"></script>
</body>
</html>