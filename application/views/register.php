<!DOCTYPE HTML>
<html>
    <head>
        <title>Register Page</title>
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
                $('#user-register').hide();
                $('.showAlert-div').hide();

                $('#createUser').click(function() {
                    $('#user-register').hide(300);
                    $('#user-register').show(1000);
                    $('#btnUpdate').hide();
                    $('#btnSubmit').show();
                    $('#btnCheckButton').val('register');
                    //clean data for edit user
                    $('#en').val('');
                    $('#full_name').val('');
                    $('#department').val('');
                    $('#cost_center').val('');
                    $('#login_id').val('');
                    $('#manager').val('');
                    $('#ext').val('');
                })

                $('#showUser').click(function() {
                    $('#user-register').hide(1000);
                    var rows = $('#table_user #rowsUser tr');
                    var showList = rows.filter('.showList').show();
                    rows.not(showList).hide();
                    $('#search_user').focus();
                    $('#search_user').val('');
                    var rowsDel = $('#table_user #rowsUser tr');
                    var search = rowsDel.filter('.search').remove();
                })

                jQuery.validator.setDefaults({
                    //debug: true,
                    success: "valid"
                });
                $("#form-register").validate({
                    rules: {
                        en: {
                            required: true,
                            number: true
                        },
                        full_name: {
                            required: true
                        },
                        department: {
                            required: true
                        },
                        cost_center: {
                            required: true,
                            number: true
                        },
                        login_id: {
                            required: true
                        },
                        manager: {
                            required: true,
                        },
                        ext: {
                            required: true,
                            number: true
                        }
                    }

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
                    url: "<?php echo site_url(); ?>/c_register/searchUser",
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
                            url: "<?php echo site_url(); ?>/c_register/getResultSearchUser",
                            data: 'keywordSearch=' + mySelected,
                            dataType: "json",
                            success: function(data) {

                                var en = data.en;
                                var full_name = data.full_name;
                                var department = data.department;
                                var cost_center = data.cost_center;
                                var login_id = data.login_id;
                                var manager = data.manager;
                                var ext = data.ext;
                                //alert('kksk');
                                var tr1 = $('<tr class="search"><td>' + en + '</td><td>' + full_name + '</td><td>' + department + '</td><td>' + cost_center + '</td><td>' + login_id + '</td><td>' + manager + '</td><td>' + ext + '</td><td><button title="edit" id="editClick">Edit</button> <button id="deleteClick">Delete</button></td></tr>');
                                $('#table_user').append(tr1);

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
                    $('#user-register').hide(300);
                    $('#user-register').show(1000);
                    $('#btnSubmit').hide();
                    $('#btnUpdate').show();
                    $('#btnCheckButton').val('update');
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
                var r = confirm("คุณต้องการ Remove ข้อมูลพนักงาน ที่มี EN = " + $mySelected + " นี้หรือไม่");
                if (r == true) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url(); ?>/c_register/deleteUserMember",
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
            #en,#cost_center,#department,#manager,#full_name,#login_id,#search_user,#ext
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
            fieldset 
            { 
                border:3px solid #DCDCDC;
                border-radius: 8px;
                background: #F5F5DC;

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
                                        <li class="current_page_item"><a href="<?php echo site_url(); ?>/c_copier/registerLoadView">Register</a></li> 
                                        <li><a href="<?php echo site_url(); ?>/c_copier/reportView">Report</a></li>
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
                        <section id="content">
                            <h1>Register User</h1>
                            <div class="showAlert-div">

                            </div>
                            <div align="right">
                                <input type="button" name="showUser" value="List User" id="showUser" class="btn btn-success btn-lg">
                                &nbsp;
                                <input type="button" name="createUser" value="Create" id="createUser" class="btn btn-success btn-lg">
                                &nbsp;
                                <input type="button" name="editUser" value="Refresh" id="editUser" class="btn btn-success btn-lg">
                                <p>
                            </div>
                            <fieldset id="user-register">
                                <legend><b>User Register</b></legend>

                                <form id="form-register" action="<?php echo site_url(); ?>/c_register/saveRegister" method="POST">
                                    <table border="0" style="display:inline-table;">
                                        <tr><td align="right"><label for="en"><b>EN : &nbsp;</b></label></td>
                                            <td><font color="red"><b>* </b></font><input type='text' name='en' id='en' placeholder="EN">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label for="full_name"><b>Full Name : &nbsp;</b></label></td>
                                            <td><font color="red"><b>* </b></font><input type="text" name="full_name" id="full_name" placeholder="Full Name"></td>
                                        </tr>

                                        <tr>
                                            <td align="right"><label for="department"><b>Department : &nbsp;</b></label></td>
                                            <td><font color="red"><b>* </b></font><input type="text" id="department" name="department" placeholder="Department"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label for="cost_center"><b>Cost Center : &nbsp;</b></td>
                                            <td><font color="red"><b>* </b></font><input type="text" id="cost_center" name="cost_center" placeholder="Cost Center"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label for="login_id"><b>Login ID : &nbsp;</b></label></td>
                                            <td><font color="red"><b>* </b></font><input type="text" id="login_id" name="login_id" placeholder="Login ID"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label for="manager"><b>Manager : &nbsp;</b></label></td>
                                            <td><font color="red"><b>* </b></font><input type="text" id="manager" name="manager" placeholder="Manager"></td>
                                        </tr>
                                        <tr>
                                            <td align="right"><label for="ext"><b>Ext : &nbsp;</b></label></td>
                                            <td><font color="red"><b>* </b></font><input type="text" id="ext" name="ext" placeholder="External Phone"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="center">
                                                <input type="hidden" name="btnCheckButton" id="btnCheckButton" value="register">
                                                <input type="hidden" name="enOld" id="enOld" value="">
                                                <button class="btn btn-success btn-lg" id="btnUpdate">Update</button>
                                                <button class="btn btn-success btn-lg" id="btnSubmit">Register</button>
                                                <input type="reset" value="Cancel" class="btn btn-warning btn-lg">
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </fieldset>
                            <p>
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
                            <table id="table_user" width="100%" class="table table-bordered table-hover">  
                                <thead>  
                                    <tr>  
                                        <th>EN</th>  
                                        <th>Full Name (A-Z)</th>  
                                        <th>Department</th>  
                                        <th>Cost Center</th>  
                                        <th>Login ID</th>
                                        <th>Manager</th>
                                        <th>Ext</th>
                                        <th>Menu</th>
                                    </tr>  
                                </thead>  
                                <tbody id="rowsUser">  

                                    <?php
                                    foreach ($result as $row) {
                                        echo "<tr class='showList'>";
                                        echo "<td><span>$row->EN</span></td>";
                                        echo "<td><span>$row->Full_Name</span></td>";
                                        echo "<td><span>$row->Department</span></td>";
                                        echo "<td><span>$row->Dept_code</span></td>";
                                        echo "<td><span>$row->Login_ID</span></td>";
                                        echo "<td><span>$row->Manager</span></td>";
                                        echo "<td><span>$row->Ext</span></td>";
                                        ?>		

                                    <td width="120px">
                                        <button  id="editClick">Edit</button>
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
