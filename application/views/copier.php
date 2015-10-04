<!DOCTYPE HTML>
<html>
    <head>
        <title>Copiers Page</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style-desktop.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.css" type="text/css" />

        <script src="<?php echo base_url(); ?>assets/css/5grid/jquery.js"></script>
        <script src="<?php echo base_url(); ?>assets/css/5grid/init.js"></script>
        <script src="<?php echo base_url(); ?>assets/css/jquery-1.7.2"></script>
        <!--[if IE 9]><link rel="stylesheet" href="css/style-ie9.css" /><![endif]-->
        <script type="text/javascript">
            $(document).ready(function() {
                $('#barCode').focus();

                $('#setFocus').click(function() {
                    $('#barCode').focus();
                    $('#barCode').val('');
                    $('#full_name').val('');
                    $('#department').val('');
                    $('#cost_center').val('');
                    $('#login_id').val('');
                    $('#manager').val('');
                    $('#ext').val('');
                    $('#amount').val('1');
                });

                $('#submit').click(function() {
                    $("#copier-form").submit();
                });
                $("#copier-form").submit(function(event) {
                    if ($('#activity').val() == "") {
                        $('#activity').after("<font class='error-activity'> Please insert data</font>").css('border-color', 'red').css('color', 'red');
                    } else {
                        var en = $('#barCode').val();
                        var full_name = $('#full_name').val();
                        var department = $('#department').val();
                        var cost_center = $('#cost_center').val();
                        var login_id = $('#login_id').val();
                        var manager = $('#manager').val();
                        var ext = $('#ext').val();
                        var activity = $('#activity').val();
                        var amount = $('#amount').val();
                        var date = $('#date').val();

                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url(); ?>/c_copier/saveCopierActivity",
                            data: 'en=' + en + '&full_name=' + full_name + '&department=' + department + '&cost_center=' + cost_center + '&login_id=' + login_id + '&manager=' + manager + '&ext=' + ext + '&activity=' + activity + '&amount=' + amount + '&date=' + date,
                            success: function(data) {
                                $('#barCode').focus();
                                $('#barCode').val('');
                                $('#full_name').val('');
                                $('#department').val('');
                                $('#cost_center').val('');
                                $('#login_id').val('');
                                $('#manager').val('');
                                $('#ext').val('');
                                $('#amount').val('1');
                                alert(data);
                            }
                        });
                    }

                    event.preventDefault();
                });
                $('#activity').change(function() {
                    $('#activity').css('border-color', 'gray').css('color', 'gray');
                    $('.error-activity').remove();
                });
            });

            function splitValue()
            {
                var input = document.getElementById('barCode');
                var barCode = input.value;
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(); ?>/c_copier/getMemberToCopier",
                    data: 'barCodeData=' + barCode,
                    dataType: "json",
                    success: function(data) {
                        $('#full_name').val(data.full_name);
                        $('#department').val(data.department);
                        $('#cost_center').val(data.cost_center);
                        $('#login_id').val(data.login_id);
                        $('#manager').val(data.manager);
                        $('#ext').val(data.ext);
                    }
                });
            }
        </script>
        <style>
            .error-activity{
                color: red;
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
                                        <li class="current_page_item"><a href="<?php echo site_url(); ?>/c_copier">Copiers</a></li>
                                        <li><a href="<?php echo site_url(); ?>/c_copier/registerLoadView">Register</a></li> 
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
                    <h2>Copiers Activity</h2>
                    <div class="row">
                        <div class="12u">
                            <div class="row">

                                <div class="8u" align="center">
                                    <section id="content-copier">
                                        <div align="right">
                                            <input type="button" name="setFocus" id="setFocus" value="New Data" class="btn btn-success btn-lg">
                                            <p>
                                        </div>
                                        <form method="post" accept-charset="utf-8" action="<?php echo site_url(); ?>/c_copier/saveCopierActivity" id="copier-form">
                                            <table width="40%"  class="table table-bordered">
                                                <thead>

                                                </thead>
                                                <tbody>
                                                    <tr><td>BarCode : </td>
                                                        <td><input type='text' name='barCode' id='barCode' onchange='splitValue();' class="form-control">

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Full Name : </td>
                                                        <td><input type="text" name="full_name" id="full_name" class="form-control"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Department : </td>
                                                        <td><input type="text" id="department" name="department"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Cost Center : </td>
                                                        <td><input type="text" id="cost_center" name="cost_center"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Login ID : </td>
                                                        <td><input type="text" id="login_id" name="login_id"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Manager : </td>
                                                        <td><input type="text" id="manager" name="manager"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>External Phone : </td>
                                                        <td><input type="text" id="ext" name="ext"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Activity : </td>
                                                        <td><select name="activity" id="activity">
                                                                <option value="">Please Select</option>
                                                                <option value="Copy Black">Copy Black</option>
                                                                <option value="Copy Color">Copy Color</option>
                                                                <option value="Print Black">Print Black</option>
                                                                <option value="Print Color">Print Color</option>
                                                                <option value="Scanner">Scanner</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Amount : </td>
                                                        <td><input type="number" id="amount" name="amount" value="1"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date : </td>
                                                        <td><input type="date" id="date" name="date" value="<?php echo date("Y-m-d"); ?>"></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" align="center"><input type="button" name="submit" id="submit" value="Submit" class="btn btn-success btn-lg">
                                                            <input type="reset" name="setFocus" id="setFocus" value="Cancel" class="btn btn-warning btn-lg">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </section>
                                </div>
                                <div class="4u">
                                    <section id="sidebar">
                                        <h2>Welcome To System</h2>
                                        <p class="subtitle">Please To Select Activity ...</p>
                                        <ul class="style1">
                                            <li class="first">
                                                <p class="date"><a href="#">Number<b>01</b></a></p>
                                                <p><a href="#">-xxxxxxxxxxxxx  xxxxxxxxxxxxxxxxx  xxxxxxxxxxxxxxx-</a></p>
                                            </li>
                                            <li>
                                                <p class="date"><a href="#">Number<b>02</b></a></p>
                                                <p><a href="#">-xxxxxxxxxxxxx  xxxxxxxxxxxxxxxxx  xxxxxxxxxxxxxxx-</a></p>
                                            </li>
                                            <li>
                                                <p class="date"><a href="#">Number<b>03</b></a></p>
                                                <p><a href="#">-xxxxxxxxxxxxx  xxxxxxxxxxxxxxxxx  xxxxxxxxxxxxxxx-</a></p>
                                            </li>
                                        </ul>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div id="copyright" class="5grid-layout">
            <section>
                <p>©Copy Right 2014, Rajamangala University of Technology Isan - Western Digital (Thailand) Co.,Ltd.</p>
            </section>
        </div>
    </body>
</html>
