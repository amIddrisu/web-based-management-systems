<?php
require 'global.php';

if (isset($_SESSION["loggedin"])) {
    
} else {
    header("Location: ../logout.php");
}
//Active menus arrays
$parts = explode("/", $_SERVER['PHP_SELF']); //get path and explode it
$current_page = $parts[count($parts) - 1]; //get current page from the explode

//$roleAccess = findMyAccess($current_page);




//qms
$auditScheduleActive = array('auditScheduleList.php','auditScheduleAdd.php','auditScheduleEdit.php','auditScheduleView.php','auditScheduleDelete.php');
$compStatusActive = array('compStatusList.php','compStatusAdd.php','compStatusEdit.php','compStatusView.php','compStatusDelete.php');
$correctiveActionActive = array('correctiveActionList.php','correctiveActionAdd.php','correctiveActionEdit.php','correctiveActionView.php','correctiveActionDelete.php');
$crtElementActive = array('crtElementList.php','crtElementAdd.php','crtElementEdit.php','crtElementView.php','crtElementDelete.php');
$findingActive = array('findingList.php', 'findingAdd.php', 'findingEdit.php', 'findingView.php', 'findingDelete.php');
$protocolActive = array('protocolList.php','protocolAdd.php','protocolEdit.php','protocolView.php','protoclDelete.php');
$scopeActive = array('scopeList.php','scopeAdd.php','scopeEdit.php','scopeView.php','scopeDelete.php');
$toReferenceActive = array('toReferenceList.php','toReferenceAdd.php','toReferenceEdit.php','toReferenceView.php','toReferenceDelete.php');


//report
$invoiceActive = array('enroute.php','landing.php');
$exportActive=array('exportData.php');


//admin
$userActive = array('userList.php','userAdd.php','userEdit.php','userView.php','userDelete.php');
$roleActive = array('roleList.php','roleAdd.php','roleEdit.php','roleView.php','roleDelete.php');
$importActive = array('importData.php');
$departmentActive = array('departmentList.php','departmentAdd.php','departmentEdit.php','departmentView.php','departmentDelete.php');
$unitActive = array('unitList.php','unitAdd.php','unitEdit.php','unitView.php','unitDelete.php');
$sectionActive = array('sectionList.php','sectionAdd.php','sectionEdit.php','sectionView.php','sectionDelete.php');

//Menus
$qmsMenu = array_merge($auditScheduleActive,$compStatusActive,$correctiveActionActive,$crtElementActive,$findingActive,$protocolActive,$scopeActive,$toReferenceActive);
$reportMenu = array_merge($invoiceActive,$exportActive);
$adminMenu = array_merge($userActive,$roleActive,$departmentActive,$sectionActive,$unitActive);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ABC Insurance Brokers Ltd</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
<!--        <link rel="stylesheet" type="text/css" href="../css/dataTables.tableTools.css">
        <link rel="stylesheet" type="text/css" href="../css/dataTables.bootstrap.css">-->
        <link rel="stylesheet" type="text/css" href="../css/bootstrapValidator.css"/>
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui.min.css"/>
        <link rel="stylesheet" type="text/css" href="../css/jquery-ui.theme.min.css"/>
        <link rel="stylesheet" type="text/css" href="../css/jquery.ui.timepicker.css"/>
        <link rel="stylesheet" type="text/css" href="../css/fontello.css"/>
        <!-- <link rel="stylesheet" type="text/css" media="screen" href="../css/jquery-ui-1.7.1.custom.css" /> -->
        <link rel="stylesheet" type="text/css" media="screen" href="../css/ui.jqgrid.css" />
        <link rel="stylesheet" type="text/css" href="../css/select2.css"/>
        <link rel="stylesheet" type="text/css" href="../css/select2-bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <script type="text/javascript" src="../js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/bootstrapValidator.js"></script>
<!--        <script type="text/javascript"  src="../js/jquery.dataTables.js"></script>
        <script type="text/javascript"  src="../js/dataTables.bootstrap.js"></script>
        <script type="text/javascript"  src="../js/dataTables.tableTools.js"></script>-->
        <script type="text/javascript"  src="../js/jquery.ui.timepicker.js"></script>
        <script type="text/javascript" src="../js/checkbfdel.js"></script>
        <script type="text/javascript"  src="../js/fusioncharts.js"></script>
        <script type="text/javascript"  src="../js/fusioncharts.charts.js"></script>
        <script type="text/javascript"  src="../js/fusioncharts.gantt.js"></script>
        <script src="../js/i18n/grid.locale-en.js" type="text/javascript"></script>
        <script src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
        <!--        <script type="text/javascript"  src="../js/fusioncharts.map.js"></script>-->
        <script type="text/javascript"  src="../js/fusioncharts.powercharts.js"></script>
        <script type="text/javascript" src="../js/select2.min.js"></script>
<!--        <script type="text/javascript" src="../fc/themes/fusioncharts.theme.fint.js"></script>-->
        <script type="text/javascript" src="../js/bootstrap.min.js">
            $(document).ready(function() {

                $(".collapse").collapse();
            });

        </script>
    </head>
    <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="welcome.php"><b>ABC INSURANCE BROKERS LIMITED</b></a>
    </div>
    <div class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
    <li><a href="../view/userEdit.php?id=<?php echo $_SESSION['loggedid']?>"><?php if (!empty($_SESSION['photo'])) { ?>
                                    <img src="<?php echo '../images/thumbs/' . $_SESSION['photo']; ?>" height="25" />
                                <?php } else { ?>
                                    <span class="glyphicon glyphicon-user"></span>
                                <?php } ?> 
                            </a>
                        </li>
                        <li><a href="../view/userEdit.php?id=<?php echo $_SESSION['loggedid']?>"  style="color:#ffffff; text-transform: capitalize"><?php echo $_SESSION['rolename'] . ': ' . $_SESSION["firstname"] . ' ' . $_SESSION["lastname"]; ?></a></li>
                        <li><a href="../logout.php"><span class="glyphicon glyphicon-off"></span> Log out</a></li>
                    </ul>
          </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3 col-md-2 sidebar">
                    <div class="panel-group" id="accordion">
                        
                            <div class="panel panel-accordion">

<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="text-decoration:none">
<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Income Management System</a>
</h4>
</div>
                                
<div id="collapseOne" class="panel-collapse collapse<?php
if (in_array($current_page, $qmsMenu)) {
echo " in";
}
?>">
<div class="panel-accordion-background">
<div class="panel-body">
<ul class="nav nav-sidebar nav-accordion">

<li <?php
if (in_array($current_page, $auditScheduleActive)) {
echo "class = 'active'";
}
?> ><a href="auditScheduleList.php"><span class="glyphicon glyphicon-time"/></span>&nbsp;&nbsp;&nbsp;&nbsp;Audit Schedule</a></li>
                                                
<li  <?php
if (in_array($current_page, $compStatusActive)) {
echo "class='active'";
}
?>><a href="compStatusList.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-plane"></span>&nbsp;&nbsp;Compliance Status</a></li>

<li <?php
if (in_array($current_page, $correctiveActionActive)) {
echo "class='active'";
}
?>><a href="correctiveActionList.php">&nbsp;&nbsp;<span><img src="../images/airport.png"/></span>&nbsp;&nbsp;Investment Income</a></li>

<li <?php
if (in_array($current_page, $crtElementActive)) {
echo "class='active'";
}
?>><a href="crtElementList.php">&nbsp;&nbsp;<span><img src="../images/airport.png"/></span>&nbsp;&nbsp;Total Investment</a></li>
                                                
<li <?php
if (in_array($current_page, $findingActive)) {
echo "class='active'";
}
?>><a href="findingList.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-road"></span>&nbsp;&nbsp;Profit/Loss Before Tax</a></li>
<li <?php
if (in_array($current_page, $protocolActive)) {
echo "class='active'";
}
?>><a href="protocolList.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-random"></span>&nbsp;&nbsp;Taxation</a></li>
                                                
<li <?php
if (in_array($current_page, $scopeActive)) {
echo "class='active'";
}
?>><a href="scopeList.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-random"></span>&nbsp;&nbsp;Profit After Tax</a></li>
                                               
                                              
<li <?php
if (in_array($current_page, $toReferenceActive)) {
echo "class='active'";
}
?>><a href="toReferenceList.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-random"></span>&nbsp;&nbsp;Income Surplus</a></li>
                                                
</ul>
</div>
</div>
</div>
</div>
                       

<div class="panel panel-accordion">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" style="text-decoration:none">
<span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;Reports</a>
</h4>
</div>

<div id="collapseTwo" class="panel-collapse collapse<?php
if (in_array($current_page, $reportMenu)) {
echo " in";
}
?>">
<div class="panel-accordion-background">
<div class="panel-body">
<ul class="nav nav-sidebar nav-accordion">
<!--  <li><a href="reports/invoices/enroute.php">&nbsp;&nbsp;<span class="icon-money"></span>&nbsp;&nbsp;Invoice</a></li> -->
<li><a href="exportData.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-export"></span>&nbsp;&nbsp;Export</a></li>
</ul>
</div>
</div>
</div>
</div>
                        
<?php if('Administrator'===$_SESSION['rolename']){ ?>
<div class="panel panel-accordion">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="text-decoration:none">
<span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;Administrator</a>
</h4>
</div>
                            
<div id="collapseThree" class="panel-collapse collapse<?php
if (in_array($current_page, $adminMenu)) {
echo " in";
}
?>">
<div class="panel-accordion-background">
<div class="panel-body">
<ul class="nav nav-sidebar nav-accordion">

<li <?php
if (in_array($current_page, $userActive)) {
echo "class='active'";
}
?>><a href="userList.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Users</a></li>

<li <?php
if (in_array($current_page, $roleActive)) {
echo "class='active'";
}
?>
> <a href="roleList.php">&nbsp;&nbsp;<span class="icon-users"></span>&nbsp;&nbsp;Role</a></li>

<li <?php
if (in_array($current_page, $departmentActive)) {
echo "class='active'";
}
?>><a href="departmentList.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-headphones"></span>&nbsp;&nbsp;Department</a></li>
                                              
<li <?php
if (in_array($current_page, $sectionActive)) {
echo "class='active'";
}
?>><a href="sectionList.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-headphones"></span>&nbsp;&nbsp;Section</a></li>

<li <?php
if (in_array($current_page, $unitActive)) {
echo "class='active'";
}
?>><a href="unitList.php">&nbsp;&nbsp;<span class="glyphicon glyphicon-headphones"></span>&nbsp;&nbsp;Unit</a></li>

                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>  
                    </div>
                </div>
            </div>

        </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               