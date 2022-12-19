<?php
session_start();
/**
 * =====================================connection
 */
class DBConnection
{
	
    private $host='localhost';
    private $dbName = 'cards';
    private $user = 'root';
    private $pass = '';
    public $conn;
    
    // private $host='localhost';
    // private $dbName = 'dbj2xatqktawv9';
    // private $user = 'u4ezgg6xw5d8v';
    // private $pass = 'inkugechurch123';
    // public $conn;


    public function connect()
    {
        try {
         $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName, $this->user, $this->pass);
         return $conn;
        } catch (PDOException $e) {
            echo "Database Error ".$e->getMessage();
            return null;
        }
	}
}
/**
 * =========================================== MAIN OPPERATIONS CLASS
 */
class MainOperations extends DBConnection
{
	
	function login($user,$pass){
    $con = parent::connect();
    $log = $con->prepare("SELECT * FROM signature_users WHERE user_email=? AND user_pass=? AND user_status=?");
    $log->bindValue(1,$user);
    $log->bindValue(2,$pass);
    $log->bindValue(3,"E");
    $log->execute();
    if ($log->rowCount()==1) {
      echo "<span style='color:blue'>Login successful</span>, <span style='color:green'>Redirecting ...</span>";
      $ft_log = $log->fetch(PDO::FETCH_ASSOC);
      $_SESSION['staff']['id'] = $ft_log['user_id'];
      $_SESSION['staff']['email'] = $ft_log['user_email'];
      $_SESSION['staff']['name'] = $ft_log['user_fname']." ".$ft_log['user_lname'];
      echo "<script>window.location='staff/'</script>";
    }else{
      $log = $con->prepare("SELECT * FROM signature_users WHERE user_email=? AND user_pass=? AND user_status=?");
      $log->bindValue(1,$user);
      $log->bindValue(2,$pass);
      $log->bindValue(3,"DA");
      $log->execute();
      if ($log->rowCount()==1) {
        echo "<span style='color:blue'>Login successful</span>, <span style='color:green'>Redirecting ...</span>";
        $ft_log = $log->fetch(PDO::FETCH_ASSOC);
        $_SESSION['da']['id'] = $ft_log['user_id'];
        $_SESSION['da']['email'] = $ft_log['user_email'];
        $_SESSION['da']['name'] = $ft_log['user_fname']." ".$ft_log['user_lname'];
        echo "<script>window.location='da/'</script>";
      }else{
        $log = $con->prepare("SELECT * FROM signature_users WHERE user_email=? AND user_pass=? AND user_status=?");
        $log->bindValue(1,$user);
        $log->bindValue(2,$pass);
        $log->bindValue(3,"FIN");
        $log->execute();
        if ($log->rowCount()==1) {
          echo "<span style='color:blue'>Login successful</span>, <span style='color:green'>Redirecting ...</span>";
          $ft_log = $log->fetch(PDO::FETCH_ASSOC);
          $_SESSION['fin']['id'] = $ft_log['user_id'];
          $_SESSION['fin']['email'] = $ft_log['user_email'];
          $_SESSION['fin']['name'] = $ft_log['user_fname']." ".$ft_log['user_lname'];
          echo "<script>window.location='finance/'</script>";
        }else{
          echo "<span style='color:red'>Wrong username or password ...</span>";
        }
      }
    }
  }

  function approve_derogation($derogation){
    $con = parent::connect();
    $approve = $con->prepare("UPDATE signature_documents SET document_status=? WHERE document_id=?");
    $approve->bindValue(1,'C');
    $approve->bindValue(2,$derogation);
    $approve->execute();
    if ($approve->rowCount()==1) {
      echo "<script>window.location.reload();</script>";
    }else{
      echo "<script>window.location.reload();</script>";
    }
  }

  function daa_approve_document($derogation,$roll){
    $con = parent::connect();
    $approve = $con->prepare("UPDATE signature_documents SET document_status=? WHERE document_id =?");
    $approve->bindValue(1,'A');
    $approve->bindValue(2,$derogation);
    $approve->execute();
    if ($approve->rowCount()==1) {
      $sel = $con->prepare("SELECT * FROM signature_documents WHERE document_id='$derogation'");
      $ok_sel = $sel->execute();
      if ($sel->rowCount()==1) {
        $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
        $doc_type = $ft_sel['document_type'];
        date_default_timezone_set("Africa/Cairo");
        $date = date("Y-m-d H:i:sa");
        $record = $con->prepare("UPDATE signature_delivery SET delivery_daa=?,delivery_status=? WHERE delivery_doctype=? AND delivery_roll=? AND delivery_status=?");
        $record->bindValue(1,$date);
        $record->bindValue(2,"A");
        $record->bindValue(3,$doc_type);
        $record->bindValue(4,$roll);
        $record->bindValue(5,"P");
        $ok_record = $record->execute();
        if ($ok_record) {
          echo "<script>window.location.reload();</script>";
        }else{
          echo "<script>alert('failed');</script>";
        }
      }else{
        echo "<script>alert('Error Occured');</script>";
      }
    }else{
      echo "<script>window.location.reload();</script>";
    }
  }

  function finance_approve_derogation($derogation,$roll){
    $con = parent::connect();
    $approve = $con->prepare("UPDATE signature_documents SET document_status=? WHERE document_id =?");
    $approve->bindValue(1,'DAA');
    $approve->bindValue(2,$derogation);
    $approve->execute();
    if ($approve->rowCount()==1) {
      $sel = $con->prepare("SELECT * FROM signature_documents WHERE document_id='$derogation'");
      $ok_sel = $sel->execute();
      if ($sel->rowCount()==1) {
        $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
        $doc_type = $ft_sel['document_type'];
        date_default_timezone_set("Africa/Cairo");
        $date = date("Y-m-d H:i:sa");
        $record = $con->prepare("INSERT INTO signature_delivery(delivery_doctype,delivery_roll,delivery_finance,delivery_status) VALUES(?,?,?,?)");
        $record->bindValue(1,$doc_type);
        $record->bindValue(2,$roll);
        $record->bindValue(3,$date);
        $record->bindValue(4,"P");
        $ok_record = $record->execute();
        if ($ok_record) {
          echo "<script>window.location.reload();</script>";
        }else{
          echo "<script>alert('failed');</script>";
        }
      }else{
        echo "<script>alert('Error Occured');</script>";
      }
    }else{
      echo "<script>window.location.reload();</script>";
    }
  }

  function finance_reject_derogation($derogation,$roll){
    $con = parent::connect();
    $approve = $con->prepare("UPDATE signature_documents SET document_status=? WHERE document_id =?");
    $approve->bindValue(1,'REJ-FIN');
    $approve->bindValue(2,$derogation);
    $approve->execute();
    if ($approve->rowCount()==1) {
      $sel = $con->prepare("SELECT * FROM signature_documents WHERE document_id='$derogation'");
      $ok_sel = $sel->execute();
      if ($sel->rowCount()==1) {
        $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
        $doc_type = $ft_sel['document_type'];
        date_default_timezone_set("Africa/Cairo");
        $date = date("Y-m-d H:i:sa");
        $record = $con->prepare("INSERT INTO signature_delivery(delivery_doctype,delivery_roll,delivery_finance_reject,delivery_status) VALUES(?,?,?,?)");
        $record->bindValue(1,$doc_type);
        $record->bindValue(2,$roll);
        $record->bindValue(3,$date);
        $record->bindValue(4,"P");
        $ok_record = $record->execute();
        if ($ok_record) {
          echo "<script>window.location.reload();</script>";
        }else{
          echo "<script>alert('failed');</script>";
        }
      }else{
        echo "<script>alert('Error Occured');</script>";
      }
    }else{
      echo "<script>window.location.reload();</script>";
    }
  }

  function reject_derogationnn($derogation){
    $con = parent::connect();
    $approve = $con->prepare("UPDATE signature_documents SET document_status=? WHERE document_id =?");
    $approve->bindValue(1,'A');
    $approve->bindValue(2,$derogation);
    $approve->execute();
    if ($approve->rowCount()==1) {
      echo "<script>window.open('','_self').close();</script>";
    }else{
      echo "<script>window.open('','_self').close();</script>";
    }
  }  
  function daa_rejected_document($derogation,$roll){
    $con = parent::connect();
    $approve = $con->prepare("UPDATE signature_documents SET document_status=? WHERE document_id =?");
    $approve->bindValue(1,'REJ-DAA');
    $approve->bindValue(2,$derogation);
    $approve->execute();
    if ($approve->rowCount()==1) {
      $sel = $con->prepare("SELECT * FROM signature_documents WHERE document_id='$derogation'");
      $ok_sel = $sel->execute();
      if ($sel->rowCount()==1) {
        $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
        $doc_type = $ft_sel['document_type'];
        date_default_timezone_set("Africa/Cairo");
        $date = date("Y-m-d H:i:sa");
        $record = $con->prepare("UPDATE signature_delivery SET delivery_daa_reject=?,delivery_status=? WHERE delivery_doctype=? AND delivery_roll=? AND delivery_status=?");
        $record->bindValue(1,$date);
        $record->bindValue(2,"R");
        $record->bindValue(3,$doc_type);
        $record->bindValue(4,$roll);
        $record->bindValue(5,"P");
        $ok_record = $record->execute();
        if ($ok_record) {
          echo "<script>window.location.reload();</script>";
        }else{
          echo "<script>alert('failed');</script>";
        }
      }else{
        echo "<script>alert('Error Occured');</script>";
      }
    }else{
      echo "<script>window.location.reload();</script>";
    }
  }
  function terminate_student_request($derogation){
    $con = parent::connect();
    $approve = $con->prepare("UPDATE signature_student_requests SET requests_status=? WHERE requests_id=?");
    $approve->bindValue(1,'T');
    $approve->bindValue(2,$derogation);
    $approve->execute();
    if ($approve->rowCount()==1) {
      echo "<script>window.location.reload();</script>";
    }else{
      echo "<script>window.location.reload();</script>";
    }
  }
    function sel_dept_by_fac($fac){
        $conn = parent::connect();
        $dept = $conn->prepare("SELECT * FROM department WHERE id_faculty=?");
        $dept->bindValue(1,$fac);
        $dept->execute();
        while ($ft_dept = $dept->fetch(PDO::FETCH_ASSOC)) {
            $dept_name = $ft_dept['name_department_en'];
            $dept_id = $ft_dept['id'];
            echo "<option value'$dept_id'>".$dept_name."</option>";
        }
    }
    function submit_data_collection_document($type,$fstStName,$fstStRoll,$secdStName,$scndStRoll,$dept){
      $content = array(
        array("f_st_name" => $fstStName,"f_st_roll" => $fstStRoll),
        array("f_st_name" => $secdStName,"f_st_roll" => $scndStRoll),
        array("department" => $dept)
      );

      $content = json_encode($content);

      $con = parent::connect();
      $ins_document = $con->prepare("INSERT INTO signature_documents(document_type,document_contents,document_status,document_roll) VALUES(?,?,?,?)");
      $ins_document->bindValue(1,$type);
      $ins_document->bindValue(2,$content);
      $ins_document->bindValue(3,"FIN");
      $ins_document->bindValue(4,$fstStRoll);
      $ok_ins_document = $ins_document->execute();
      if ($ok_ins_document) {
        echo "success";
      }else{
          echo "fail";
      }
    }

    function submit_english_as_medium_document($roll,$student,$facult,$deprtment,$subType){
      $content = array("student_name" => $student,"facult" => $facult,"department" => $deprtment,"roll" => $roll);

      $content = json_encode($content);

      $con = parent::connect();
      $ins_document = $con->prepare("INSERT INTO signature_documents(document_type,document_contents,document_status,document_roll) VALUES(?,?,?,?)");
      $ins_document->bindValue(1,$subType);
      $ins_document->bindValue(2,$content);
      $ins_document->bindValue(3,"FIN");
      $ins_document->bindValue(4,$roll);
      $ok_ins_document = $ins_document->execute();
      if ($ok_ins_document) {
        echo "success";
      }else{
          echo "fail";
      }
    }
    function internership_ecommendation($student,$roll,$year,$facult,$deprtment,$subType){
      $content = array("student_name" => $student,"facult" => $facult,"department" => $deprtment,"class" => "Y3","roll" => $roll,"year" => $year);

      $content = json_encode($content);

      $con = parent::connect();
      $ins_document = $con->prepare("INSERT INTO signature_documents(document_type,document_contents,document_status,document_roll) VALUES(?,?,?,?)");
      $ins_document->bindValue(1,$subType);
      $ins_document->bindValue(2,$content);
      $ins_document->bindValue(3,"FIN");
      $ins_document->bindValue(4,$roll);
      $ok_ins_document = $ins_document->execute();
      if ($ok_ins_document) {
        echo "success";
      }else{
          echo "fail";
      }
    }
    function student_doc_request($student,$roll,$year,$facult,$deprtment,$subType,$class,$reason,$phone,$email,$section){
      $content = array("student_name" => $student,"facult" => $facult,"department" => $deprtment,"roll" => $roll,"year" => $year,"class" => $class,"reason" => $reason,"phone" => $phone,"email" => $email,"section" => $section);

      $content = json_encode($content);

      $con = parent::connect();
      $ins_document = $con->prepare("INSERT INTO signature_student_requests(requests_type,requests_content,requests_status,requests_roll) VALUES(?,?,?,?)");
      $ins_document->bindValue(1,$subType);
      $ins_document->bindValue(2,$content);
      $ins_document->bindValue(3,"FIN");
      $ins_document->bindValue(4,$roll);
      $ok_ins_document = $ins_document->execute();
      if ($ok_ins_document) {
        echo "success";
      }else{
          echo "fail";
      }
    }
    function attendance_testimonial($student,$roll,$year,$facult,$deprtment,$subType,$class){
      $content = array("student_name" => $student,"facult" => $facult,"department" => $deprtment,"roll" => $roll,"year" => $year,"class" => $class);

      $content = json_encode($content);

      $con = parent::connect();
      $ins_document = $con->prepare("INSERT INTO signature_documents(document_type,document_contents,document_status,document_roll) VALUES(?,?,?,?)");
      $ins_document->bindValue(1,$subType);
      $ins_document->bindValue(2,$content);
      $ins_document->bindValue(3,"FIN");
      $ins_document->bindValue(4,$roll);
      $ok_ins_document = $ins_document->execute();
      if ($ok_ins_document) {
        echo "success";
      }else{
          echo "fail";
      }
    }
    function further_studies($student,$roll,$year,$facult,$deprtment,$subType,$class){
      $content = array("student_name" => $student,"facult" => $facult,"department" => $deprtment,"roll" => $roll,"year" => $year,"class" => $class);

      $content = json_encode($content);

      $con = parent::connect();
      $ins_document = $con->prepare("INSERT INTO signature_documents(document_type,document_contents,document_status,document_roll) VALUES(?,?,?,?)");
      $ins_document->bindValue(1,$subType);
      $ins_document->bindValue(2,$content);
      $ins_document->bindValue(3,"FIN");
      $ins_document->bindValue(4,$roll);
      $ok_ins_document = $ins_document->execute();
      if ($ok_ins_document) {
        echo "success";
      }else{
          echo "fail";
      }
    }
    function suspension_letter($student,$roll,$facult,$deprtment,$subType,$class){
      $content = array("student_name" => $student,"facult" => $facult,"department" => $deprtment,"roll" => $roll,"class" => $class);

      $content = json_encode($content);

      $con = parent::connect();
      $ins_document = $con->prepare("INSERT INTO signature_documents(document_type,document_contents,document_status,document_roll) VALUES(?,?,?,?)");
      $ins_document->bindValue(1,$subType);
      $ins_document->bindValue(2,$content);
      $ins_document->bindValue(3,"FIN");
      $ins_document->bindValue(4,$roll);
      $ok_ins_document = $ins_document->execute();
      if ($ok_ins_document) {
        echo "success";
      }else{
          echo "fail";
      }
    }
    function migration_for_new($roll,$student,$nationality,$year,$subType){
      $content = array("student_name" => $student,"nationality" => $nationality,"year" => $year,"roll" => $year);

      $content = json_encode($content);

      $con = parent::connect();
      $ins_document = $con->prepare("INSERT INTO signature_documents(document_type,document_contents,document_status,document_roll) VALUES(?,?,?,?)");
      $ins_document->bindValue(1,$subType);
      $ins_document->bindValue(2,$content);
      $ins_document->bindValue(3,"FIN");
      $ins_document->bindValue(4,$roll);
      $ok_ins_document = $ins_document->execute();
      if ($ok_ins_document) {
        echo "success";
      }else{
          echo "fail";
      }
    }
    function migration_for_student($roll,$student,$nationality,$year,$subType){
      $content = array("student_name" => $student,"nationality" => $nationality,"year" => $year,"roll" => $year);

      $content = json_encode($content);

      $con = parent::connect();
      $ins_document = $con->prepare("INSERT INTO signature_documents(document_type,document_contents,document_status,document_roll) VALUES(?,?,?,?)");
      $ins_document->bindValue(1,$subType);
      $ins_document->bindValue(2,$content);
      $ins_document->bindValue(3,"FIN");
      $ins_document->bindValue(4,$roll);
      $ok_ins_document = $ins_document->execute();
      if ($ok_ins_document) {
        echo "success";
      }else{
          echo "fail";
      }
    }

}
$MainOperations = new MainOperations();
if (isset($_GET['login'])) {
  $MainOperations->login($_GET['user'],$_GET['pass']);
}
if (isset($_GET['approveDerogation'])) {
  $MainOperations->approve_derogation($_GET['derogation']);
}
if (isset($_GET['daaApproveDocument'])) {
  $MainOperations->daa_approve_document($_GET['derogation'],$_GET['roll']);
}
if (isset($_GET['financeApproveDerogation'])) {
  $MainOperations->finance_approve_derogation($_GET['derogation'],$_GET['roll']);
}
if (isset($_GET['financeRejectDocument'])) {
  $MainOperations->finance_reject_derogation($_GET['derogation'],$_GET['roll']);
}
if (isset($_GET['rejectDerogationnn'])) {
  $MainOperations->reject_derogationnn($_GET['derogation']);
}
if (isset($_GET['daaRejectedDocument'])) {
  $MainOperations->daa_rejected_document($_GET['derogation'],$_GET['roll']);
}
if (isset($_GET['terminateStudentRequest'])) {
  $MainOperations->terminate_student_request($_GET['derogation']);
}
if (isset($_GET['selDeptFat'])) {
  $MainOperations->sel_dept_by_fac($_GET['selFacult']);
}
if (isset($_GET['subDataCollection'])) {
  $MainOperations->submit_data_collection_document($_GET['subType'],$_GET['fstStName'],$_GET['fstStRoll'],$_GET['secdStName'],$_GET['scndStRoll'],$_GET['dept']);
}
if (isset($_GET['subEnglishAsMedium'])) {
  $MainOperations->submit_english_as_medium_document($_GET['roll'],$_GET['studentName'],$_GET['studentFact'],$_GET['studentDept'],$_GET['subType']);
}
if (isset($_GET['internershipRecommendation'])) {
  $MainOperations->internership_ecommendation($_GET['studentName'],$_GET['studentRoll'],$_GET['studentYear'],$_GET['studentFact'],$_GET['studentDept'],$_GET['subType']);
}
if (isset($_GET['professionalInternership'])) {
  $MainOperations->professional_internership($_GET['studentName'],$_GET['studentRoll'],$_GET['studentYear'],$_GET['studentFact'],$_GET['studentDept'],$_GET['subType'],$_GET['studentClass']);
}
if (isset($_GET['migrationForNew'])) {
  $MainOperations->migration_for_new($_GET['roll'],$_GET['studentName'],$_GET['studentNationality'],$_GET['studentYear'],$_GET['subType']);
}
if (isset($_GET['migrationForStudent'])) {
  $MainOperations->migration_for_student($_GET['roll'],$_GET['studentName'],$_GET['studentNationality'],$_GET['studentYear'],$_GET['subType']);
}
if (isset($_GET['suspensionLetter'])) {
  $MainOperations->suspension_letter($_GET['studentName'],$_GET['studentRoll'],$_GET['studentFact'],$_GET['studentDept'],$_GET['subType'],$_GET['studentClass']);
}
if (isset($_GET['furtherStudies'])) {
  $MainOperations->further_studies($_GET['studentName'],$_GET['studentRoll'],$_GET['studentYear'],$_GET['studentFact'],$_GET['studentDept'],$_GET['subType'],$_GET['studentClass']);
}
if (isset($_GET['attendanceTestimonial'])) {
  $MainOperations->attendance_testimonial($_GET['studentName'],$_GET['studentRoll'],$_GET['studentYear'],$_GET['studentFact'],$_GET['studentDept'],$_GET['subType'],$_GET['studentClass']);
}
if (isset($_GET['subStudentReq'])) {
  $MainOperations->student_doc_request($_GET['studentName'],$_GET['studentRoll'],$_GET['studentYear'],$_GET['studentFact'],$_GET['studentDept'],$_GET['subType'],$_GET['studentClass'],$_GET['studentReason'],$_GET['studentPhone'],$_GET['studentEmail'],$_GET['studentSection']);
}
?>