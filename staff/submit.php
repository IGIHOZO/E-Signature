<?php
require("../js/view.php");
$MainView = new MainView();

session_start();
if (!isset($_SESSION['staff'])) {
    echo "<script>window.location='../'</script>";
}
?>
<!DOCTYPE html><script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULK - Submit Documents</title>

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
                    <li><a href="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit Document</a></li>
                    <li class="selected"><a href="index"><i class="fa fa-clock-o" aria-hidden="true"></i> Students-Pending Documents</a></li>

                    <li><a href="."><i class="fa fa-clock-o" aria-hidden="true"></i> DA-Pending</a></li>
                    <li><a href="approved"><i class="fa fa-check" aria-hidden="true"></i> DA-Appproved</a></li>
                    <li><a href="rejected"><i class="fa fa-ban" aria-hidden="true"></i> DA-Rejected</a></li>

                    <li><a href="fin-pending"><i class="fa fa-clock-o" aria-hidden="true"></i> Finance-Pending</a></li>
                    <li><a href="fin-approved"><i class="fa fa-check" aria-hidden="true"></i> Finance-Appproved</a></li>
                    <li><a href="fin-rejected"><i class="fa fa-ban" aria-hidden="true"></i> Finance-Rejected</a></li>


                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="../logout"><i class="fa fa-power-off"></i> Log Out</a>
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
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_SESSION['staff']['name']?></a>

                    </li>
                    <li class="divider-vertical"></li>
                    <li>
                        <form class="navbar-search">
                            <input type="text" placeholder="Search" class="form-control">
                        </form>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="color: black">
                            <h2 class="panel-title" style="font-weight: bolder;font-size: 20px"><i class="fa fa-bar-chart-o"></i>Signature Requesting Form
                            <span style="font-size: 18px;margin-left: 10%">
                                <label for="documents">Select Document:</label>
                                <select id="documents" class="form-control" style="width: 30%;float: right;margin-top: -5px;margin-right: 10%" onchange="return switchForms();">
                                    <option value="1">Data Collection Recommendation</option>
                                    <option value="2">English As Medium Of Instruction</option>
                                    <option value="3">Internership Recommendation</option>
                                    <option value="4">Migration Recommendation For a New Commer</option>
                                    <option value="5">Migration Recommendation For a Continuing Student</option>
                                    <option value="6">Professional Internalship</option>
                                    <option value="7">Suspension Letter</option>
                                    <option value="8">Further Studies Recommendation Letter</option>
                                    <option value="9">Attendance Testimonial</option>
                                </select>
                            </span>
                            </h2>

                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12" style="background-color: #fcf2eb;height: 400px;margin-top: -10px">
                                    <!-- ============================================= DATA COLLECTION =============================== -->
<formm style="display:block;" id="data_collection">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">First Student Names</label>
      <input type="text" class="form-control" id="data_collectionfstStName" placeholder="First Student Names">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">First Student RollNumber</label>
      <input type="number" class="form-control" id="data_collectionfstStRoll" placeholder="First Student RollNumber">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Second Student Names</label>
      <input type="text" class="form-control" id="data_collectionsendStName" placeholder="Second Student Names">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Second Student RollNumber</label>
      <input type="number" class="form-control" id="data_collectionsendStRoll" placeholder="Second Student RollNumber">
    </div>
  </div>

    <div class="form-group col-md-6">
      <label for="inputZip">Department</label>
      <select class="form-control" id="data_collectiondept">
          <?=$MainView->availble_depatments();?>
      </select>
    </div>
    <div class="form-group col-md-6">
        <label for="inputZip">&nbsp;</label><br>
      <button class="btn btn-success" onclick="return subDataCollection();">Submit</button>
      <span style="color: red;font-weight: bolder;" id="data_collectionresp">  </span>
    </div>

</formm>
                                    <!-- ============================================= ENGLISH AS MEDIUM =============================== -->
<formm style="display:none;" id="english_as_medium">
  <div class="form-row">
    <div class="form-group col-md-8">
      <label for="inputEmail4">Student Names</label>
      <input type="text" class="form-control" id="studentName" placeholder="Student Names" style="width: 49%">
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">RollNumber</label>
      <input type="text" class="form-control" id="rollMed" placeholder="RollNumber" style="width: 49%">
    </div>

  </div>

  <!-- </div> -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputZip">Faculty</label>
      <select class="form-control" onchange="return selDeptFatOne();" id="sel_fac">
        <option selected="true" value="">Select facult</option>
          <?=$MainView->availble_faculties();?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Department</label>
      <select class="form-control" disabled="true" id="sel_dept">
          <option>Select department</option>
      </select>
    </div>
  </div> 
    <div class="form-group col-md-6">
        <label for="inputZip">&nbsp;</label><br>
      <button class="btn btn-success" onclick="return subEnglishAsMedium();">Submit</button>
      <span style="color: red;font-weight: bolder;" id="english_as_mediumresp">  </span>
    </div>

</formm>
                                    <!-- ============================================= INTERNERSHIP RECOMMENDATION =============================== -->
<formm style="display:none;" id="internership_recommendation">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Student Names</label>
      <input type="text" class="form-control" id="internership_recommendation_name" placeholder="Student Names" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Rollnumber</label>
      <input type="text" class="form-control" id="internership_recommendation_roll" placeholder="Rollnumber" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Academic Year</label>
      <select class="form-control" id="internership_recommendation_year">
        <option value="">Select academic year</option>
        <?=$MainView->availble_academic_year();?>
      </select>
    </div>
  </div>

  <!-- </div> -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputZip">Faculty</label>
      <select class="form-control" onchange="return selDeptFat();" id="sel_fac_3">
        <option selected="true" value="">Select facult</option>
          <?=$MainView->availble_faculties();?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Department</label>
      <select class="form-control" disabled="true" id="sel_dept_3">
          <option>Select department</option>
      </select>
    </div>
  </div> 
    <div class="form-group col-md-6">
        <label for="inputZip">&nbsp;</label><br>
      <button class="btn btn-success" onclick="return internershipRecommendation();">Submit</button>
      <span style="color: red;font-weight: bolder;" id="internership_recommendation_resp">  </span>
    </div>

</formm>
                                    <!-- ============================================= Migration Recommendation For a New Student =============================== -->
<formm style="display:none;" id="migration_for_new">
  <div class="form-row">
    <div class="form-group col-md-5">
      <label for="inputEmail4">Student Names</label>
      <input type="text" class="form-control" id="migration_for_new_name" placeholder="Student Names" style="width: 100%">
    </div>
    <div class="form-group col-md-2">
      <label for="inputEmail4">RollNumber</label>
      <input type="text" class="form-control" id="rollNewSt" placeholder="Rollnumber" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Nationality</label>
      <input type="text" class="form-control" id="migration_for_new_nationality" placeholder="eg:Rwandese,Congolese,..." style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-2">
      <label for="inputEmail4">Academic Year</label>
      <select class="form-control" id="migration_for_new_year">
        <option value="">Select academic year</option>
        <?=$MainView->availble_academic_year();?>
      </select>
    </div>
  </div>

  <!-- </div> -->
    <div class="form-group col-md-6">
        <label for="inputZip">&nbsp;</label><br>
      <button class="btn btn-success" onclick="return migrationForNew();">Submit</button>
      <span style="color: red;font-weight: bolder;" id="migration_for_new_resp">  </span>
    </div>

</formm>
                                    <!-- ============================================= Migration Recommendation For a  Student =============================== -->
<formm style="display:none;" id="migration_for_student">
  <div class="form-row">
    <div class="form-group col-md-5">
      <label for="inputEmail4">Student Names</label>
      <input type="text" class="form-control" id="migration_for_student_name" placeholder="Student Names" style="width: 100%">
    </div>
    <div class="form-group col-md-2">
      <label for="inputEmail4">RollNumber</label>
      <input type="text" class="form-control" id="rollStd" placeholder="RollNumber" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Nationality</label>
      <input type="text" class="form-control" id="migration_for_student_nationality" placeholder="eg:Rwandese,Congolese,..." style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-2">
      <label for="inputEmail4">Academic Year</label>
      <select class="form-control" id="migration_for_student_year">
        <option value="">Select academic year</option>
        <?=$MainView->availble_academic_year();?>
      </select>
    </div>
  </div>

  <!-- </div> -->
    <div class="form-group col-md-6">
        <label for="inputZip">&nbsp;</label><br>
      <button class="btn btn-success" onclick="return migrationForStudent();">Submit</button>
      <span style="color: red;font-weight: bolder;" id="migration_for_student_resp">  </span>
    </div>

</formm>
                                    <!-- ============================================= Professional Internalship =============================== -->
<formm style="display:none;" id="professional_internership">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Student Names</label>
      <input type="text" class="form-control" id="professional_internership_name" placeholder="Student Names" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Rollnumber</label>
      <input type="text" class="form-control" id="professional_internership_roll" placeholder="Rollnumber" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Academic Year</label>
      <select class="form-control" id="professional_internership_year">
        <option value="">Select academic year</option>
        <?=$MainView->availble_academic_year();?>
      </select>
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputZip">Class</label>
      <select class="form-control" id="professional_internership_class">
        <option selected="true" value="">Select class</option>
          <?=$MainView->availble_academic_classes();?>
      </select>
    </div>
  </div> 
    <!-- </div> -->
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputZip">Faculty</label>
      <select class="form-control" onchange="return selDeptFatFive();" id="sel_fac_6">
        <option selected="true" value="">Select facult</option>
          <?=$MainView->availble_faculties();?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="inputZip">Department</label>
      <select class="form-control" disabled="true" id="sel_dept_6">
          <option>Select department</option>
      </select>
    </div>
  </div> 
    <div class="form-group col-md-6">
        <label for="inputZip">&nbsp;</label><br>
      <button class="btn btn-success" onclick="return professionalInternership();">Submit</button>
      <span style="color: red;font-weight: bolder;" id="professional_internership_resp">  </span>
    </div>

</formm>
                                    <!-- ============================================= >Suspension Letter =============================== -->
<formm style="display:none;" id="suspension_letter">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Student Names</label>
      <input type="text" class="form-control" id="suspension_letter_name" placeholder="Student Names" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Rollnumber</label>
      <input type="text" class="form-control" id="suspension_letter_roll" placeholder="Rollnumber" style="width: 100%">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputZip">Class</label>
      <select class="form-control" id="suspension_letter_class">
        <option selected="true" value="">Select class</option>
          <?=$MainView->availble_academic_classes();?>
      </select>
    </div>
  </div> 
    <!-- </div> -->
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputZip">Faculty</label>
      <select class="form-control" onchange="return selDeptFatSeven();" id="sel_fac_7">
        <option selected="true" value="">Select facult</option>
          <?=$MainView->availble_faculties();?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputZip">Department</label>
      <select class="form-control" disabled="true" id="sel_dept_7">
          <option>Select department</option>
      </select>
    </div>
  </div> 
    <div class="form-group col-md-6">
        <label for="inputZip">&nbsp;</label><br>
      <button class="btn btn-success" onclick="return suspensionLetter();">Submit</button>
      <span style="color: red;font-weight: bolder;" id="suspension_letter_resp">  </span>
    </div>

</formm>

                                    <!-- ============================================= >Further Studies Recommendation Letter =============================== -->
<formm style="display:none;" id="further_studies">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Student Names</label>
      <input type="text" class="form-control" id="further_studies_name" placeholder="Student Names" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Rollnumber</label>
      <input type="text" class="form-control" id="further_studies_roll" placeholder="Rollnumber" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Academic Year</label>
      <select class="form-control" id="further_studies_year">
        <option value="">Select academic year</option>
        <?=$MainView->availble_academic_year();?>
      </select>
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputZip">Class</label>
      <select class="form-control" id="further_studies_class">
        <option selected="true" value="">Select class</option>
          <?=$MainView->availble_academic_classes();?>
      </select>
    </div>
  </div> 
    <!-- </div> -->
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputZip">Faculty</label>
      <select class="form-control" onchange="return selDeptFatEight();" id="sel_fac_8">
        <option selected="true" value="">Select facult</option>
          <?=$MainView->availble_faculties();?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="inputZip">Department</label>
      <select class="form-control" disabled="true" id="sel_dept_8">
          <option>Select department</option>
      </select>
    </div>
  </div> 
    <div class="form-group col-md-6">
        <label for="inputZip">&nbsp;</label><br>
      <button class="btn btn-success" onclick="return furtherStudies();">Submit</button>
      <span style="color: red;font-weight: bolder;" id="further_studies_resp">  </span>
    </div>

</formm>
                                    <!-- ============================================= Attendance Testimonial =============================== -->
<formm style="display:none;" id="attendance_testimonial">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Student Names</label>
      <input type="text" class="form-control" id="attendance_testimonial_name" placeholder="Student Names" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Rollnumber</label>
      <input type="text" class="form-control" id="attendance_testimonial_roll" placeholder="Rollnumber" style="width: 100%">
    </div>
  </div>
    <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Academic Year</label>
      <select class="form-control" id="attendance_testimonial_year">
        <option value="">Select academic year</option>
        <?=$MainView->availble_academic_year();?>
      </select>
    </div>
  </div>


  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputZip">Class</label>
      <select class="form-control" id="attendance_testimonial_class">
        <option selected="true" value="">Select class</option>
          <?=$MainView->availble_academic_classes();?>
      </select>
    </div>
  </div> 
    <!-- </div> -->
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputZip">Faculty</label>
      <select class="form-control" onchange="return selDeptFatNive();" id="sel_fac_9">
        <option selected="true" value="">Select facult</option>
          <?=$MainView->availble_faculties();?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="inputZip">Department</label>
      <select class="form-control" disabled="true" id="sel_dept_9">
          <option>Select department</option>
      </select>
    </div>
  </div> 
    <div class="form-group col-md-6">
        <label for="inputZip">&nbsp;</label><br>
      <button class="btn btn-success" onclick="return attendanceTestimonial();">Submit</button>
      <span style="color: red;font-weight: bolder;" id="attendance_testimonial_resp">  </span>
    </div>

</formm>

  <!-- </div> -->

                                </div>
                            </div>
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
