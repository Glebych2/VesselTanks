<?php $title = 'Drawing'; ?>
<?//include_once('../server/v1/views/common/header.php');  ?>
<?include_once('header.php');  ?>
        <div class="main">
            <div class="sub-main">
                <div class="inner-container-config">
                    <div class="vessel8" id="drawElements">
                        <svg width="200" height="100" onclick="svgMouseClick()" id="svgRect" style="grid-row: 1/2">
                            <rect id='a_rectangle1' x="10" width="200" height="100"
                                  style="fill:rgb(0,0,255)" />
                            <text x="10" y="95" fill="#ED6E46" font-size="100"  font-family="'Leckerli One', cursive" id="svgText">W</text>
                        </svg>
                        <svg>
                            <defs>
                                <linearGradient id="Gradient-1">
                                    <stop offset="0%" stop-color="#bbc42a" />
                                    <stop offset="100%" stop-color="#765373" />
                                </linearGradient>
                            </defs>
                            <rect x="10" y="10" width="200" height="100" fill= "url(#Gradient-1)" stroke="#333333" stroke-width="3px" />
                        </svg>
                        <svg height="140" width="140">
                            <defs>
                                <filter id="f3" x="0" y="0" width="200%" height="200%">
                                    <feOffset result="offOut" in="SourceAlpha" dx="20" dy="20" />
                                    <feGaussianBlur result="blurOut" in="offOut" stdDeviation="10" />
                                    <feBlend in="SourceGraphic" in2="blurOut" mode="normal" />
                                </filter>
                            </defs>
                            <rect width="90" height="90" stroke="green" stroke-width="3" fill="yellow" filter="url(#f3)" />
                        </svg>
                    </div>
                    <div class="vessel7" >
                        <svg width="100%" height="100%"  id="svgTest">
                            <svg id='g_rectangle'>
                                <rect id='a_rectangle' x="10" width="300" height="100" onmousedown="svgMouseDown(this.id)"
                                      style="fill:rgb(0,0,255)" />
                            </svg>
                            <svg id='svg_rectangle3' x="400" width="200" height="100" onmousedown="svg3MouseDown(this.id)">
                                <rect id='a_rectangle3' width="200" height="100"
                                      style="fill:rgb(255,0,132)" />
                            </svg>

                        </svg>
                    </div>

                </div>
                <div class="inner-container-config" id="configTanks" style="display: none">

                </div>

            </div>
        </div>
        <? include_once('footer.php'); ?>
    </div>
    <script src="bootstrap/js/jquery-3.6.0.js"></script>
    <script src="js/functions.js"></script>
    <script src="js/main.js"></script>
    <script src="js/drawing.js"></script>
</body>
</html>