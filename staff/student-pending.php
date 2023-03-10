<?php
require("../js/view.php");
$MainView = new MainView();
if (!isset($_GET['roll'])) {
    echo "<script>window.location='../'</script>";
}else{
    $roll = $_GET['roll'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULK - Approved Documents</title>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- you need to include the shieldui css and js assets in order for the charts to work -->
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
    <link id="gridcss" rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/dark-bootstrap/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="http://prepbootstrap.com/Content/js/gridData.js"></script>
</head>
<body>
    <div id="wrapper">
          <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index">Admin Panel</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul id="active" class="nav navbar-nav side-nav">
                    <li class="selected"><a href="student-documents?roll=<?=$roll?>"><i class="fa fa-clock-o" aria-hidden="true"></i> Approved Documents</a></li>
                    <li><a href="student-pending?roll=<?=$roll?>"><i class="fa fa-check" aria-hidden="true"></i> Pending Documents</a></li>
                    <li><a href="student-rejected?roll=<?=$roll?>"><i class="fa fa-ban" aria-hidden="true"></i> Rejected Documents</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">2 New Messages</li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><i class="fa fa-bell"></i></span>
                                    <span class="message">Security alert</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><i class="fa fa-bell"></i></span>
                                    <span class="message">Security alert</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Go to Inbox <span class="badge">2</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="../" style="float: left;font-weight: bolder;color: #fff;font-size: 20px">Logout</a>
                    </li>
                    <li class="dropdown user-dropdown">
                        <ul class="dropdown-menu">
                     <!--        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li> -->
                            <li class="divider"></li>
                            <!-- <li><a href="../logout"><i class="fa fa-power-off"></i> Log Out</a></li> -->

                        </ul>
                    </li>
                    <li class="divider-vertical"></li>
                    <li>

                        <form class="navbar-search">
                            
                            <input style="float: right;" type="text" placeholder="Search" class="form-control">
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2 class="panel-title" style="color: black;font-weight: bolder;font-size: 20px"><i class="fa fa-bar-chart-o"></i> Approved Documents</h2>
                        </div>
                        <div class="panel-body">
                            <table class="table">
                                <thead class="thead-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Document Type</th>
                                    <th scope="col">Requester </th>
                                    <th scope="col">Signature Status </th>
                                    <th scope="col" colspan="3"></th>
                                </thead>
                                <?=$MainView->student_pending_documents($_GET['roll']);?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /#wrapper -->

</body>
    <script type="text/javascript" src="../js/web.js"></script>
</html>
