<?php $title = 'Admin';?>
<?include_once('header.php');  ?>

        <div class="main">
            <div class="sub-main">
                <div class="admin-container" id="adminContainer">
                    <div class="users-admin" id="usersAdmin">
<!--                        --><?php
//                            require "../server/api/v1/views/common/table.php";
//                        ?>
                    </div>
                    <div class="user-vessels" id="userVessels">

                    </div>
                    <div class="user-vessels" id="allVessels">
                        <table class="table table-striped .table-hover table-sm  .table-responsive .table_sort" id="allVesselsTable">
                            <thead class="thead-dark">
                            <tr class="m-0">
                                <th class="w-25"  data-sort="user" data-alg="number" scope="col">ID</a></th>
                                <th class="w-50" data-sort="vessel" data-alg="string" scope="col">Vessel name</th>
                                <th class="w-25" data-sort="imo" data-alg="number" scope="col">IMO number</th>
                                <th class="w-25" data-sort="imo" data-alg="number" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody id="allVesselsList">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <? include_once('footer.php'); ?>
    </div>
    <link rel="stylesheet" href="css/admin.css">
    <script src="bootstrap/js/jquery-3.6.0.js"></script>
    <script src="bootstrap/js/bootstrap.js" ></script>
    <script src="js/admin.js" ></script>

</body>
</html>