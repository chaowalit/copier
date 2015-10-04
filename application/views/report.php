<!DOCTYPE HTML>
<html>
    <head>
        <title>Report Page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style-desktop.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/5grid/core.css" type="text/css" />

        <script src="<?php echo base_url(); ?>assets/css/5grid/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/css/5grid/init.js"></script>
        <script src="<?php echo base_url(); ?>assets/css/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/css/jquery.validate.js"></script>
        <script src="<?php echo base_url(); ?>assets/css/additional-methods.js"></script>
        <!--[if IE 9]><link rel="stylesheet" href="css/style-ie9.css" /><![endif]-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#showSearchExportToExcel').click(function(){
                    var start_date = $('#start_date').val();
                    var end_date = $('#end_date').val();
                    if(start_date == ""){
                        $('#start_date').after("<font class='error-date'></font>").css('border-color', 'red').css('color', '#F62817');
                        $('#end_date').after("<font class='error-date'></font>").css('border-color', '#c6c9cc').css('color', '#555');
                    }else if(end_date == ""){
                        $('#end_date').after("<font class='error-date'></font>").css('border-color', 'red').css('color', '#F62817');
                        $('#start_date').after("<font class='error-date'></font>").css('border-color', '#c6c9cc').css('color', '#555');
                    }else{
                        $('#start_date').after("<font class='error-date'></font>").css('border-color', '#c6c9cc').css('color', '#555');
                        $('#end_date').after("<font class='error-date'></font>").css('border-color', '#c6c9cc').css('color', '#555');
                        $.ajax({type: 'POST',
                            url: "<?php echo site_url(); ?>/c_report/searchShowExportData",
                            data: "start_date="+start_date+"&end_date="+end_date,
                            success: function(data) {
                                $('table #showSearchExport').html(data);
                            }
                        });
                    }
                });
                $('#search-export-to-excel').hide();
                $('.showAlert-div').hide();

                $('#export-to-excel-file').click(function() {
                    $('#search-export-to-excel').hide(300);
                    $('#search-export-to-excel').show(1000);
                });
                $('#refresh').click(function(){
                    $('#search-export-to-excel').hide(1000);
                    var rows = $('#table_user #rowsUser tr');
                    var showList = rows.filter('.showList').show();
                    rows.not(showList).hide();
                    $('#search_user').focus();
                    $('#search_user').val('');
                    var rowsDel = $('#table_user #rowsUser tr');
                    var search = rowsDel.filter('.search').remove();
                    $('#showMenu').css("display", "none");
                    $('#showSearchExport tr').remove();
                });
                $('#list-user-activity').click(function() {
                    $('#search-export-to-excel').hide(1000);
                    var rows = $('#table_user #rowsUser tr');
                    var showList = rows.filter('.showList').show();
                    rows.not(showList).hide();
                    $('#search_user').focus();
                    $('#search_user').val('');
                    var rowsDel = $('#table_user #rowsUser tr');
                    var search = rowsDel.filter('.search').remove();
                    
                    $('#showMenu').css("display", "none");
                    $('#showSearchExport tr').remove();
                });

                //ปุ่มกดตรง HTML--------------------------------------------------------------------
                $("#table_user #rowsUser tr").on('click', '#editClick', function() {
                    var periodStart = $(this).closest('tr').children('td:eq(0)').text();
                    userEditClick(periodStart);
                });
                $("#table_user #rowsUser tr").on('click', '#deleteClick', function() {
                    var periodStart = $(this).closest('tr').children('td:eq(0)').text();
                    userDeleteClick(periodStart);
                });
                //------------------------------------------------------------------------------
                $('#search_user').focus();
                makeTip();
                $('#showMenu').css("display", "none");
            });

            function makeTip() {
                $('#search_user').keyup(function(event) {
                    if ($(this).val() != "") {

                        showTip();
                    } else {
                        $('#showMenu').css("display", "none");
                    }

                });
            }
            function showTip() {
                var sentData = $('#search_user').val();
                var p = $('#search_user').position();
                var posX = p.left + 2;
                var posY = p.top + 35;
                $.ajax({type: 'POST',
                    url: "<?php echo site_url(); ?>/c_register/searchUserCopy",
                    data: {myInput: sentData},
                    success: function(data) {
                        $('div.toolTip').remove();
                        $('#showMenu').html(data);
                        $('#showMenu').css({
                            "display": "block",
                            "top": posY,
                            "left": posX,
                        });

                        selectTip();

                    }
                });
            }
            function selectTip() {
                $('div.toolTip a').each(function() {
                    $(this).click(function() {
                        $('#search_user').focus();
                        var mySelected = $(this).html();
                        $('#search_user').val(mySelected);

                        //$('div.toolTip').css("display","none");
                        $('#showMenu').css("display", "none");

                        var rowsDel = $('#table_user #rowsUser tr');
                        var search = rowsDel.filter('.search').remove();

                        var rows = $('#table_user #rowsUser tr');
                        var search = rows.filter('.search').show();
                        rows.not(search).hide();

                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url(); ?>/c_register/getResultSearchUserCopy",
                            data: 'keywordSearch=' + mySelected,
                            dataType: "json",
                            success: function(data) {
                                for(var i in data){
                                    var id = data[i].id;
                                    var en = data[i].en;
                                    var full_name = data[i].full_name;
                                    var department = data[i].department;
                                    var cost_center = data[i].cost_center;
                                    var login_id = data[i].login_id;
                                    var manager = data[i].manager;
                                    var ext = data[i].ext;
                                    var activity = data[i].activity;
                                    var amount = data[i].amount;
                                    var date = data[i].date;
                                    //alert('kksk');
                                    var tr1 = $('<tr class="search"><td>' + id + '</td><td>' + en + '</td><td>' + full_name + '</td><td>' + department + '</td><td>' + cost_center + '</td><td>' + login_id + '</td><td>' + manager + '</td><td>' + ext + '</td><td>' + activity + '</td><td>' + amount + '</td><td>' + date + '</td><td> <button id="deleteClick">Delete</button></td></tr>');
                                    $('#table_user').append(tr1);
                                }
                                $("#table_user #rowsUser tr").on('click', '#editClick', function() {
                                    var periodStart = $(this).closest('tr').children('td:eq(0)').text();
                                    userEditClick(periodStart);
                                });
                                $("#table_user #rowsUser tr").on('click', '#deleteClick', function() {
                                    var periodStart = $(this).closest('tr').children('td:eq(0)').text();
                                    userDeleteClick(periodStart);
                                });
                            }
                        });



                    });
                });


            }
            function userEditClick($mySelected) {
                var inputSend = $mySelected;
                var r = confirm("คุณต้องการแก้ไขข้อมูลพนักงาน ที่มี EN = " + inputSend + " นี้หรือไม่");
                if (r == true) {
                    $('#search-export-to-excel').hide(300);
                    $('#search-export-to-excel').show(1000);
                    
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url(); ?>/c_register/editUserMember",
                        data: 'keywordSearch=' + inputSend,
                        dataType: "json",
                        success: function(data) {
                            $('#en').val(data.en);
                            $('#full_name').val(data.full_name);
                            $('#department').val(data.department);
                            $('#cost_center').val(data.cost_center);
                            $('#login_id').val(data.login_id);
                            $('#manager').val(data.manager);
                            $('#ext').val(data.ext);
                            $('#enOld').val(data.en);
                        }
                    });
                }
            }
            function userDeleteClick($mySelected) {
                var r = confirm("คุณต้องการ 'ลบ' ข้อมูลการถ่ายเอกสารนี้หรือไม่");
                if (r == true) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url(); ?>/c_report/deleteActivityUser",
                        data: 'keywordSearch=' + $mySelected,
                        success: function(data) {
                            alert(data);
                            location.reload(false);
                        }
                    });

                }

            }
        </script>
        <style type="text/css">
            input[type='text']
            {
                background: #FFE4C4;
                border: 2px solid #c6c9cc;
                border-radius: 4px;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1), 0 1px 0 #fff;
                color: #555;
                font: 14px/16px 'Droid Sans', Arial, 'Helvetica Neue', 'Lucida Grande', sans-serif;
                padding: 5px 2px 5px 2px;
                margin-bottom: 4px;
                width: 270px;
                height: 20px;
            }
            input[type='date']
            {
                background: #F5F5DC;
                border: 2px solid #c6c9cc;
                border-radius: 4px;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1), 0 1px 0 #fff;
                color: #555;
                font: 14px/16px 'Droid Sans', Arial, 'Helvetica Neue', 'Lucida Grande', sans-serif;
                padding: 5px 2px 5px 2px;
                margin-bottom: 4px;
                width: 270px;
                height: 20px;
            }
            fieldset 
            { 
                border:3px solid #DCDCDC;
                border-radius: 8px;
                background: #F5F5DC;
                width:98%;
            }
            legend 
            {
                padding: 0.3em 0.2em 0.2em 0.2em;
                border:3px solid #808080;
                border-radius: 12px;
                color: #A52A2A;
                background: #FFE4C4;
                font-size:100%;
                text-align:right;
            }
            .pagination_list_user{
                text-align: center;
                float: center;
                width: 100%;
                height: 30px;
                margin-top: 0px;
            }
            .pagination_list_user strong{
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #FFF;
                color: red;
            }
            .pagination_list_user a{
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #eee;
                color: #555;
                text-decoration: none;
            }
            .pagination_list_user a:hover{
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #F2F2F2;
                color: red;
            }
            .pagination_list_user a:active{
                padding: 3px 5px;
                border: 1px solid #ccc;
                background: #FFF;
                color: red;
            }
            .layout-search-user{
                display: inline-block;
                width:100%;
                text-align:left;
            }
            label{
                font-size: 14pt;
                font: 14px/16px 'Droid Sans', Arial, 'Helvetica Neue', 'Lucida Grande', sans-serif;
                font-weight: 400;
            }
            #showMenu{
                position:absolute;
                border: 1px solid #e3e3e3;
                width:250px;
                background-color: #CCFFFF;
                border-radius: 4px;
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.1), 0 1px 0 #fff;
            }
            div.toolTip{
                height: 20px;
                font: 18px/18px 'Droid Sans';
                font-weight: 400;
                margin-bottom: 2px;
            }
            div.toolTip:hover{
                border:2px solid #e3e3e3;
                background-color: #CCFF99;
                color: #666633;
            }
            .showAlert-div{
                border:2px solid #e3e3e3;
                border-radius: 4px;
                background-color: #EBF4FA;
                color: green;
                height: 30px;
                text-align: left;
                padding: 13px 0px 0px 10px;
                margin-bottom: 5px;
            }
            .showTabelExport{
                height:400px;
                overflow:auto;
            }
        </style>
    </head>
    <body>
        <div id="header-wrapper">
            <header id="header">
                <div class="5grid-layout">
                    <div class="row">
                        <div class="12u" id="logo"> <!-- Logo -->
                            <h1><a href="#" class="mobileUI-site-name">Copiers&nbsp;&nbsp;System</a></h1>
                            <p>Western Digital (Thailand) Co.,Ltd.</p>
                        </div>
                    </div>
                </div>
                <div id="menu-wrapper">
                    <div class="5grid-layout">
                        <div class="row">
                            <div class="12u" id="menu">
                                <nav class="mobileUI-site-nav">
                                    <ul>
                                        <li><a href="<?php echo site_url(); ?>/c_copier/index">Copiers</a></li>
                                        <li><a href="<?php echo site_url(); ?>/c_copier/registerLoadView">Register</a></li> 
                                        <li class="current_page_item"><a href="<?php echo site_url(); ?>/c_copier/reportView">Report</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        <div id="page-wrapper">

            <div id="page" class="5grid-layout">
                <div id="page-content-wrapper">

                    <div align="center">
                        <section id="content-report">
                            <h1>Activity Report</h1>
                            <div class="showAlert-div">

                            </div>
                            <div align="right">
                                <input type="button" name="list-user-activity" value="List User Activity" id="list-user-activity" class="btn btn-success btn-lg">
                                &nbsp;
                                <input type="button" name="export-to-excel-file" value="Export to Excel File" id="export-to-excel-file" class="btn btn-success btn-lg">
                                &nbsp;
                                <input type="button" name="refresh" value="Refresh" id="refresh" class="btn btn-success btn-lg">
                                <p>
                            </div>
                            <div align="center">
                            <fieldset id="search-export-to-excel">
                                <legend><b>Export to Excel File</b></legend>

                                <form id="form-search-export-activity" action="<?php echo site_url(); ?>/c_report/exportExcelTo" method="POST">
                                    <table border="0" style="display:inline-table;">
                                        <tr><td align="center" colspan="2"><b>-- Select day for Download excel file (.xls) --<p></b></td>
                                        </tr>
                                        <tr><td align="right"><label for="start_date"><b>Start Date : &nbsp;</b></label></td>
                                            <td><font color="red"><b>* </b></font><input type='date' name='start_date' id='start_date' placeholder="Start Date">
                                            </td>
                                        </tr>
                                        <tr><td align="center" colspan="2"><label><b></b></label></td>
                                        </tr>
                                        <tr><td align="right"><label for="end_date"><b>End Date : &nbsp;</b></label></td>
                                            <td><font color="red"><b>* </b></font><input type='date' name='end_date' id='end_date' placeholder="End Date">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center">
                                                <br>
                                                <button id="showSearchExportToExcel" type="button" class="btn btn-info">Search</button>
                                                <button type="submit" class="btn btn-info">Download Excel File</button>
                                                <br>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                                <div class="showTabelExport">
                                    <table width="100%" class="table table-bordered table-hover">  
                                        <thead>  
                                            <tr>
                                                <th>EN</th>  
                                                <th>Full Name (A-Z)</th>  
                                                <th>Department</th>  
                                                <th>Cost Center</th>  
                                                <th>Login ID</th>
                                                <th>Manager</th>
                                                <th>Ext</th>
                                                <th>Activity</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                            </tr>  
                                        </thead>  
                                        <tbody id="showSearchExport">  

                                        </tbody>  
                                    </table>
                                </div>
                            </fieldset>
                            </div>
                            <p>
                            <!-- ทำการค้นหารายชื่อพนักงานที่มีกิจกรรมในการใช้ห้องถ่ายเอกสาร  -->
                            
                            <div class="layout-search-user">
                                <table border="0">
                                    <tr>
                                        <td align="right"><label for="search_user"><b>Search Data : &nbsp;</b></label></td>
                                        <td align="left">
                                            <input type="text" id="search_user" name="search_user" placeholder=" -- Search Data --">
                                        </td>
                                    </tr>
                                </table>
                                <div id="showMenu">

                                </div>
                            </div>
                            <!-- end Search  -->
                            <table id="table_user" width="100%" class="table table-bordered table-hover">  
                                <thead>  
                                    <tr>
                                        <th>ID</th>
                                        <th>EN</th>  
                                        <th>Full Name (A-Z)</th>  
                                        <th>Department</th>  
                                        <th>Cost Center</th>  
                                        <th>Login ID</th>
                                        <th>Manager</th>
                                        <th>Ext</th>
                                        <th>Activity</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Menu</th>
                                    </tr>  
                                </thead>  
                                <tbody id="rowsUser">  

                                    <?php
                                    foreach ($result as $row) {
                                        echo "<tr class='showList'>";
                                        echo "<td><span>$row->ID</span></td>";
                                        echo "<td><span>$row->EN</span></td>";
                                        echo "<td><span>$row->Full_Name</span></td>";
                                        echo "<td><span>$row->Department</span></td>";
                                        echo "<td><span>$row->Dept_Code</span></td>";
                                        echo "<td><span>$row->Login_ID</span></td>";
                                        echo "<td><span>$row->Manager</span></td>";
                                        echo "<td><span>$row->Ext</span></td>";
                                        echo "<td><span>$row->Activity</span></td>";
                                        echo "<td><span>$row->amount</span></td>";
                                        echo "<td><span>$row->date</span></td>";
                                        ?>		

                                    <td width="70px">
                                        
                                        <button  id="deleteClick">Delete</button>
                                    </td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>  
                            </table> 
                            <?php echo $this->pagination->create_links(); ?>

                        </section>
                    </div>

                </div>

            </div>

        </div>
        <div id="copyright" class="5grid-layout">
            <section>
                <p>©Copy Right 2014, Rajamangala University of Technology Isan - Western Digital (Thailand) Co.,Ltd.</p>
            </section>
        </div>
        <script>
            $(document).ready(function() {
                $(".showAlert-div").hide();
<?php if ($this->session->flashdata('msg')) { ?>
                    $('.showAlert-div').html("<?php echo $this->session->flashdata('msg'); ?>").show();
                });
<?php } ?>
        </script>

    </body>
</html>
