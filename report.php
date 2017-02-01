<?php
session_start();

if(!ISSET($_SESSION['username'])){
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OMS Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">

        <script>

function calc(){

var Time_select = document.getElementById("HoursInput");
var mw = document.getElementById("MWW");
var out = document.getElementById("outage");
var tel =document.getElementById("total_Energy_lost");
var trl =document.getElementById("total_revenue_lost");
var trg = document.getElementById("total_revenue_gained");

if(Time_select.value>0){
out.innerHTML="OFF";
}
else{
out.innerHTML="ON";
  
}
tel.innerHTML=(Time_select.value*mw.innerHTML*1000).toFixed(2);
trl.innerHTML=(Time_select.value*mw.innerHTML*1000*15.41).toFixed(2);
trg.innerHTML=((24-Time_select.value)*mw.innerHTML*1000*15.41).toFixed(2);
}


 

function  showFeeder(str){

 
    if (str == "") {
        document.getElementById("tHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("tHint").innerHTML = xmlhttp.responseText;
            }
        };
        var res = str.replace("&", "%");
        xmlhttp.open("POST","report_ajax/feeder.php?q="+res,true);
        xmlhttp.send();
    }
}

function  showUser(str){

 
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        };
        var res = str.replace("&", "^");
        
        xmlhttp.open("POST","report_ajax/getuser.php?q="+res,true);
        xmlhttp.send();
    }
}
</script>

    <!-- bootstrap 3.0.2 -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- fullCalendar -->
    <!-- <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->

          <style type="text/css">

          </style>
      </head>
      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <img src="img/logo_white1.png"/>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        
                       <li class="dropdown user user-menu">
                            
                            <a href="#" class="dropdown-toggle">
                                <i class="fa fa-user"></i>
                                <span>Hello 
								<?php
                                echo $_SESSION['username'];

                                    ?> </i></span>
                            </a>
                          
                            </li>
						<li class="dropdown user user-menu">
						
						<a href="logout.php" class="dropdown-toggle">
							<i class="fa fa-sign-out"></i>
							<span>Logout</span>
						</a>
						</li>
                            </ul>
                        </div>
				   </nav>
                </header>
                <div class="wrapper row-offcanvas row-offcanvas-left">
                    <!-- Left side column. contains the logo and sidebar -->
                    <aside class="left-side sidebar-offcanvas">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                           
                            <!-- search form -->
                            
                            <!-- /.search form -->
                            <!-- sidebar menu: : style can be found in sidebar.less -->
                            <ul class="sidebar-menu">
                                 <?php
   

    if(ISSET($_SESSION['category'])){  
            Switch($_SESSION['category']){
                case "Admin":
                        echo "
                                <li>
                                    <a href=\"dashboard.php\">
                                        <i class=\"fa fa-dashboard\"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=\"file.php\">
                                        <i class=\"fa fa-globe\"></i> <span>File Upload</span>
                                    </a>
                                </li>
                                <li class=\"active\">
                                    <a href=\"report.php\">
                                        <i class=\"fa fa-gavel\"></i> <span>Reports</span>
                                    </a>
                                </li>
                                <li >
                                    <a href=\"edit_users.php\">
                                        <i class=\"fa fa-globe\"></i> <span>Admin</span>
                                    </a>
                                </li>";                        
                    break;

                case "Tech Ops":
                    echo "
                                 <li>
                                    <a href=\"dashboard.php\">
                                        <i class=\"fa fa-dashboard\"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                <li>
                                    <a href=\"file.php\">
                                        <i class=\"fa fa-globe\"></i> <span>File Upload</span>
                                    </a>
                                </li>";
                                
                    break;

                case "MD":
                            echo "
                            <li>
                                    <a href=\"dashboard.php\">
                                        <i class=\"fa fa-dashboard\"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                
                                <li class=\"active\">
                                    <a href=\"report.php\">
                                        <i class=\"fa fa-gavel\"></i> <span>Reports</span>
                                    </a>
                                </li>";
                    break;
            }
    }
?>
                      
                            </ul>
                        </section>
                        <!-- /.sidebar -->
                    </aside>

                    <aside class="right-side">

                <!-- Main content -->
                <section class="content">
           
                    <div class="row" style="margin-bottom:5px;">


                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-bolt"></i></span>
                                <div class="sm-st-info">
                                    <span>
                                     <p id="outage">

                                     </p>
                                    </span>
                                    Status
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-orange" style="font-weight:bolder; font-size:20px">kWh</span>
                                <div class="sm-st-info">
                                    <span>
                                        <p id="total_Energy_lost">
                                           
                                        </p>

                                    </span>
                                    Total Energy Lost
                                </div>
                            </div>
                        </div>
            <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-red">&#8358;</span>
                                <div class="sm-st-info">
                                    <span>
                                       <p id="total_revenue_lost">
                                       </p>

                                    </span>
                                    Total Revenue Loss</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green">&#8358;</span>
                                <div class="sm-st-info">
                                    <span>
                                      <p id="total_revenue_gained">

                                      </p>
                                    </span>
                                    Total Revenue Gained
                                </div>
                            </div>
                        </div>
                    </div>

<div class="col-lg-6">

                          <section class="panel">
                              <header class="panel-heading">
                                 CUSTOMER CALCULATOR
                              </header>
                              <div class="panel-body">
                    
                                      <div class="form-group">


                                          
                                      
                    
                                                                                            <?php
include 'conn.php';

echo "<select id=\"CustomerInput\" onchange=\"showUser(this.value)\" class=\"form-control input m-b-10\">";
echo "<option value=\"\">SELECT CUSTOMER</option>";
$check = "SELECT Customer_Name FROM table_clone";
$retval = mysqli_query($con, $check);
    if(! $retval )
      {
      die('Could not get data: ' . mysql_error());
      }

     

      while($row = mysqli_fetch_array($retval))
      {
            echo "<option value=\"{$row['Customer_Name']}\">{$row['Customer_Name']}</option>";

            
          } 


echo   "</select>";

?>
                                      </div>
                             <div class="form-group">
                    <label for="HoursInput">Outage Duration</label>
                                      
                    <select id="HoursInput" name="HoursInput" class="form-control input m-b-10">
                       <option value="0">0 Hrs</option>
                      <option value="1">1 Hrs</option>
                      <option value="2">2 Hrs</option>
                      <option value="3">3 Hrs</option>
                      <option value="4">4 Hrs</option>
                      <option value="5">5 Hrs</option>
                      <option value="6">6 Hrs</option>
                      <option value="7">7 Hrs</option>
                      <option value="8">8 Hrs</option>
                      <option value="9">9 Hrs</option>
                      <option value="10">10 Hrs</option>
                      <option value="11">11 Hrs</option>
                      <option value="12">12 Hrs</option>
                      <option value="13">13 Hrs</option>
                      <option value="14">14 Hrs</option>
                      <option value="15">15 Hrs</option>
                      <option value="17">16 Hrs</option>
                      <option value="18">17 Hrs</option>
                      <option value="19">18 Hrs</option>
                      <option value="19">19 Hrs</option>
                      <option value="20">20 Hrs</option>
                      <option value="21">21 Hrs</option>
                      <option value="22">22 Hrs</option>
                      <option value="23">23 Hrs</option>
                      <option value="24">24 Hrs</option>
                                           </select>
                                      </div>
                                      <p>
                                       <input type="button" value="Calculate" class="btn btn-info" onclick="calc()">
                                     </p>
                                      <p id="txtHint">

                                      </p>

                                        <p id="Hint">

                                      </p>
                                     
                                  

                              </div>
                          </section>
                      </div>



					<div class="col-lg-6">

                          <section class="panel">
                              <header class="panel-heading">
                                  CUSTOMER FACILITY CONNECTIVITY
                              </header>
                              <div class="panel-body">
                    
                                      <div class="form-group">


                                          
                                      
										 
                                                                                            <?php


$dataa = array();
echo  "<select id=\"CustomerInput\" onchange=\"showFeeder(this.value)\" class=\"form-control input m-b-10\">";
echo "<option value=\"\">SELECT FEEDER</option>";
$check = "SELECT distinct ikV_Line FROM table_2";
$retval = mysqli_query($con, $check);
    if(! $retval )
      {
      die('Could not get data: ' . mysql_error());
      }

     

      while($row = mysqli_fetch_array($retval))
      {
        array_push($dataa,"<option value=\"{$row['ikV_Line']}\">{$row['ikV_Line']}</option>");

        $chec = "SELECT distinct TS_Bank_No FROM table_2 WHERE ikV_Line='{$row['ikV_Line']}' and TS_Bank_No<>'-' and TS_Bank_No<>''";
        
        $retva = mysqli_query($con, $chec);
            while($row1 = mysqli_fetch_array($retva)){
                      $clear = $row1['TS_Bank_No'];
                    
               array_push($dataa,"<option value=\"{$clear}\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>{$clear}</b></option>");
                     $che = "SELECT distinct iikV_Line FROM table_2 WHERE TS_Bank_No='{$row1['TS_Bank_No']}' and iikV_Line<>'-' and iikV_Line<>''";
                     $retv = mysqli_query($con, $che);
                     while($row2 = mysqli_fetch_array($retv)){
                       
                            
                                $clear2 = $row2['iikV_Line'];
                          
                         array_push($dataa,"<option value=\"{$clear2}\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>{$clear2}</b></option>");
                                 $ch = "SELECT Distinct Inj_Sub_Bank_No FROM table_2 WHERE iikV_Line = '{$row2['iikV_Line']}' and Inj_Sub_Bank_No<>'-' and Inj_Sub_Bank_No<>''";
                                 $ret = mysqli_query($con, $ch);
                                 while($row3 = mysqli_fetch_array($ret)){
                                   
                                            $clear3 = $row3['Inj_Sub_Bank_No'];
                                     
                                        
                                     array_push($dataa,"<option value=\"{$clear3}\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>{$clear3}</b></option>");
                                              $c = "SELECT Distinct iiikV_Line FROM table_2 WHERE iikV_Line = '{$row2['iikV_Line']}' and iiikV_Line<>'-' and iiikV_Line<>''";
                                             $re = mysqli_query($con,$c);
                                             while($row4 = mysqli_fetch_array($re)){
                                               
                                                        $clear4 = $row4['iiikV_Line'];
                                                 
                                                    
                                                 array_push($dataa,"<option value=\"{$clear4}\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>{$clear4}</b></option>");
                                                   
                                             }
                                 }
                     }
            }
        
        

            
          } 

          foreach ($dataa as $value) {
              echo $value;
          }


echo   "</select>";

mysqli_close($con);

?>

                                          
                                      </div>
                             <div class="form-group">
									
                                        <p/>
                                      <p id="tHint">

                                      </p>
                                      <p/>
                                      <p id="Hint">

                                      </p>
                                       <p id="int">

                                      </p>
                                       <p id="nt">

                                      </p>
                                       <p id="t">

                                      </p>

                                     

                              </div>
                          </section>
                      </div>

                    
                    <!-- Main row -->
                    
                   
                  </div>
              </section>


          </div><!--end col-6 -->
          

                   
                  </div>
              <!-- row end -->
                </section><!-- /.content -->
                <div class="footer-main">
                    Copyright &copy Ibadan Electricity Distribution Company Plc, 2015
                </div>
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/jquery.min.js" type="text/javascript"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <script src="js/plugins/chart.js" type="text/javascript"></script>

        <!-- datepicker
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
        <!-- Bootstrap WYSIHTML5
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <!-- calendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>

        <!-- Director App -->
        <script src="js/Director/app.js" type="text/javascript"></script>

        <!-- Director dashboard demo (This is only for demo purposes) -->
        <script src="js/Director/dashboard.js" type="text/javascript"></script>

        <!-- Director for demo purposes -->
        <script type="text/javascript">
            $('input').on('ifChecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().addClass('highlight');
                $(this).parents('li').addClass("task-done");
                console.log('ok');
            });
            $('input').on('ifUnchecked', function(event) {
                // var element = $(this).parent().find('input:checkbox:first');
                // element.parent().parent().parent().removeClass('highlight');
                $(this).parents('li').removeClass("task-done");
                console.log('not');
            });

        </script>
        <script>
            $('#noti-box').slimScroll({
                height: '400px',
                size: '5px',
                BorderRadius: '5px'
            });

            $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });
</script>
<script type="text/javascript">
    $(function() {
                "use strict";
                //BAR CHART
                var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor: "rgba(220,220,220,0.2)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [65, 59, 80, 81, 56, 55, 40]
                        },
                        {
                            label: "My Second dataset",
                            fillColor: "rgba(151,187,205,0.2)",
                            strokeColor: "rgba(151,187,205,1)",
                            pointColor: "rgba(151,187,205,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(151,187,205,1)",
                            data: [28, 48, 40, 19, 86, 27, 90]
                        }
                    ]
                };
            new Chart(document.getElementById("linechart").getContext("2d")).Line(data,{
                responsive : true,
                maintainAspectRatio: false,
            });

            });
            // Chart.defaults.global.responsive = true;
</script>
</body>
</html>