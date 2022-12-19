<?php
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
 * ====================================================== MAIN VIEWS 
 */
class MainView extends DBConnection
{
    
    function student_name($roll){
        $conn = parent::connect();
        $sel_stname = $conn->prepare("SELECT * FROM student WHERE student.regnumber_student=?");
        $sel_stname->bindValue(1,$roll);
        $sel_stname->execute();
        if ($sel_stname->rowCount()==1) {
            $ft_sel_stname = $sel_stname->fetch(PDO::FETCH_ASSOC);
            $name = strtoupper($ft_sel_stname['firstname_student'])." ".ucfirst(strtolower($ft_sel_stname['lastname_student']));
        }else{
            $name='null';
        }
        return $name;
    }
    function student_id($roll){
        $conn = parent::connect();
        $sel_stname = $conn->prepare("SELECT * FROM student WHERE student.regnumber_student=?");
        $sel_stname->bindValue(1,$roll);
        $sel_stname->execute();
        if ($sel_stname->rowCount()==1) {
            $ft_sel_stname = $sel_stname->fetch(PDO::FETCH_ASSOC);
            $id = $ft_sel_stname['id'];
        }else{
            $id='null';
        }
        return $id;
    }
    function document_type($codee){
        $doc = "";
        switch ($codee) {
            case 1:
                $doc = "Data Collection Recommendation Letter";
                break;
            case 2:
                $doc = "English As Medium Of Instruction";
                break;
            case 3:
                $doc = "Internership Recommendation";
                break;
            case 4:
                $doc = "Migration Recommendation For a New Commer";
                break;
            case 5:
                $doc = "Migration Recommendation For a Continuing Student";
                break;
            case 6:
                $doc = "Professional Internalship";
                break;
            case 7:
                $doc = "Suspension Letter";
                break;
            case 8:
                $doc = "Further Studies Recommendation Letter";
                break;
            case 9:
                $doc = "Attendance Testimonial";
                break;
            default:
                $doc = "-";
                break;
        }
        return $doc;
    }
    function requested_documents(){
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_documents WHERE signature_documents.document_status=?");
        $sel_doc->bindValue(1,'P');
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $cnt = 1;
            while ($ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC)) {
                $derogation_id = $ft_sel_doc['document_id'];
                $dc_st = md5($ft_sel_doc['document_status']);
                $content = json_decode($ft_sel_doc['document_contents']);
                $document = base64_encode($ft_sel_doc['document_id']+35456);
                echo "<tr>";
                echo "<td>$cnt. </td>";
                echo "<td>".$this->document_type($ft_sel_doc['document_type'])."</td>";
                $type = $ft_sel_doc['document_type'];
                switch ($type) {
                    case 1:
                        echo "<td>".$content[0]->f_st_name." & ".$content[1]->f_st_name."</td>";
                        break;
                    case 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11:
                        echo "<td>".$content->student_name."</td>";
                        break;
                    
                    default:
                        echo "<td>--------</td>";
                        break;
                }
                echo "<td>".$content->roll."</td>";
                echo "<td>".$content->class."</td>";
                echo "<td>".$content->year."</td>";
                echo "<td>".$content->department."</td>";
                // echo "<td>".$content->phone."</td>";
                // echo "<td>".$content->email."</td>";
?>
                    <td>
                        <a target="__blank" href="view_letter?content=<?=$document?>&type=<?=$type?>&sg=<?=$dc_st?>&dc=<?=$derogation_id?>"><button class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                         </a>
                    </td>
                    <td> 
                        <?php
                        if (isset($_SESSION['da'])) {
                            ?>
                            <button onclick="return rejectDerogation('<?=$derogation_id?>');" class="btn btn-warning"><i class="fa fa-check-circle" aria-hidden="true"></i> Approve (Sign)</button>
                            <button onclick="return rejectDocument('<?=$derogation_id?>');" class="btn btn-danger"><i class="fa fa-check-circle" aria-hidden="true"></i> Reject</button> 

                            <?php
                        }elseif (isset($_SESSION['stuff'])) {
                            ?>
                            <button onclick="return approveDerogation('<?=$derogation_id?>');" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button> 

                            <?php
                        }
                        ?>
                    </td>
<?php
                echo "</tr>";
                $cnt++;
            }
        }else{
            echo "<tr><td colspan='4'><center>No Data Found ...</center></td></tr>";
        }
    }
    function finance_requested_documents(){
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_documents WHERE signature_documents.document_status=?");
        $sel_doc->bindValue(1,'FIN');
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $cnt = 1;
            while ($ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC)) {
                $derogation_id = $ft_sel_doc['document_id'];
                $dc_st = md5($ft_sel_doc['document_status']);
                $content = json_decode($ft_sel_doc['document_contents']);
                $document = base64_encode($ft_sel_doc['document_id']+35456);
                echo "<tr>";
                echo "<td>$cnt. </td>";
                echo "<td>".$this->document_type($ft_sel_doc['document_type'])."</td>";
                $type = $ft_sel_doc['document_type'];
                switch ($type) {
                    case 1:
                    $roll = $content[0]->f_st_roll;
                        echo "<td>".$content[0]->f_st_name." & ".$content[1]->f_st_name."</td>";
                        break;
                    case 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11:
                        echo "<td>".$content->student_name."</td>";
                        break;
                    
                    default:
                        echo "<td>--------</td>";
                        break;
                }
                echo "<td>".@$content->roll."</td>";
                echo "<td>".@$content->class."</td>";
                echo "<td>".@$content->year."</td>";
                echo "<td>".@$content->department."</td>";
                // echo "<td>".$content->phone."</td>";
                // echo "<td>".$content->email."</td>";
                $roll = @$content->roll;
?>
                    <td>


                         
                    </td>
                    <td> 
                        <?php
                        if (isset($_SESSION['da'])) {
                            ?>
                            <button onclick="return rejectDerogation('<?=$derogation_id?>');" class="btn btn-warning"><i class="fa fa-check-circle" aria-hidden="true"></i> Approve (Sign)</button>
                            <button onclick="return rejectDocument('<?=$derogation_id?>');" class="btn btn-danger"><i class="fa fa-check-circle" aria-hidden="true"></i> Reject</button> 

                            <?php
                        }elseif (isset($_SESSION['stuff'])) {
                            ?>
                            <button onclick="return approveDerogation('<?=$derogation_id?>');" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button> 

                            <?php
                        }elseif (isset($_SESSION['fin'])) {
                            ?>
                        <button onclick="return financeApproveDerogation('<?=$derogation_id?>','<?=$type?>');" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Approve</button>
                            <button class="btn btn-danger" onclick="return financeRejectDocument('<?=$derogation_id?>','<?=$roll?>');"><i class="fa fa-ban" aria-hidden="true"></i> Reject</button>

                            <?php
                        }
                        ?>
                    </td>
<?php
                echo "</tr>";
                $cnt++;
            }
        }else{
            echo "<tr><td colspan='4'><center>No Data Found ...</center></td></tr>";
        }
    }


    function daa_requested_documents(){
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_documents WHERE signature_documents.document_status=?");
        $sel_doc->bindValue(1,'DAA');
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $cnt = 1;
            while ($ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC)) {
                $derogation_id = $ft_sel_doc['document_id'];
                $dc_st = md5($ft_sel_doc['document_status']);
                $content = json_decode($ft_sel_doc['document_contents']);
                $document = base64_encode($ft_sel_doc['document_id']+35456);
                echo "<tr>";
                echo "<td>$cnt. </td>";
                echo "<td>".$this->document_type($ft_sel_doc['document_type'])."</td>";
                $type = $ft_sel_doc['document_type'];
                switch ($type) {
                    case 1:
                        echo "<td>".$content[0]->f_st_name." & ".$content[1]->f_st_name."</td>";
                        break;
                    case 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11:
                        echo "<td>".$content->student_name."</td>";
                        break;
                    
                    default:
                        echo "<td>--------</td>";
                        break;
                }
                echo "<td>".$content->roll."</td>";
                echo "<td>".$content->class."</td>";
                echo "<td>".$content->year."</td>";
                echo "<td>".$content->department."</td>";
                // echo "<td>".$content->phone."</td>";
                // echo "<td>".$content->email."</td>";
                $roll = $content->roll;
?>
                    <td>


                         
                    </td>
                    <td> 
                        <?php
                        if (isset($_SESSION['da'])) {
                            ?>
                            <button onclick="return daaApproveDocument('<?=$derogation_id?>','<?=$roll?>');" class="btn btn-warning"><i class="fa fa-check-circle" aria-hidden="true"></i> Approve (Sign)</button>
                            <button onclick="return daaRejectedDocument('<?=$derogation_id?>','<?=$roll?>');" class="btn btn-danger"><i class="fa fa-check-circle" aria-hidden="true"></i> Reject</button> 

                            <?php
                        }elseif (isset($_SESSION['stuff'])) {
                            ?>
                            <button onclick="return approveDerogation('<?=$derogation_id?>');" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button> 

                            <?php
                        }elseif (isset($_SESSION['fin'])) {
                            ?>
                        <button onclick="return financeApproveDerogation('<?=$derogation_id?>','<?=$roll?>');" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Approve</button>
                            <button class="btn btn-danger" onclick="return financeRejectDocument('<?=$derogation_id?>','<?=$roll?>');"><i class="fa fa-ban" aria-hidden="true"></i> Reject</button>

                            <?php
                        }
                        ?>
                    </td>
<?php
                echo "</tr>";
                $cnt++;
            }
        }else{
            echo "<tr><td colspan='4'><center>No Data Found ...</center></td></tr>";
        }
    }    


    function general_requests_report(){
        $con = parent::connect();
        $sell = $con->prepare("SELECT * FROM signature_delivery,signature_documents,signature_student_requests,student where signature_documents.document_roll=signature_delivery.delivery_roll AND signature_documents.document_type=signature_delivery.delivery_doctype AND signature_student_requests.requests_roll=signature_documents.document_roll AND signature_student_requests.requests_type=signature_documents.document_type AND signature_delivery.delivery_roll=student.regnumber_student");
        $ok_sell = $sell->execute();
        if ($ok_sell) {
            $cnt =1;
            while ($ft_sell=$sell->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                    echo "<td>".$cnt.". </td>";
                    echo "<td>".strtoupper($ft_sell['firstname_student'])." ".ucfirst(strtolower($ft_sell['lastname_student']))."</td>";
                    echo "<td>".$ft_sell['requests_date']."</td>";
                    echo "<td>".$ft_sell['document_date']."</td>";
                    echo "<td>".$ft_sell['delivery_finance']."</td>";
                    echo "<td>".$ft_sell['delivery_daa']."</td>";
                    echo "<td> ---- </td>";
                echo "</tr>";
                $cnt++;
            }
        }
    }


    function students_requests(){
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_student_requests WHERE signature_student_requests.requests_status=?");
        $sel_doc->bindValue(1,'FIN');
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $cnt = 1;
            while ($ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC)) {
                $derogation_id = $ft_sel_doc['requests_id'];
                $dc_st = md5($ft_sel_doc['requests_status']);
                $content = json_decode($ft_sel_doc['requests_content']);
                $document = base64_encode($ft_sel_doc['requests_id']+35456);
                echo "<tr>";
                echo "<td>$cnt. </td>";
                echo "<td>".$this->document_type($ft_sel_doc['requests_type'])."</td>";
                $type = $ft_sel_doc['requests_type'];
                //echo "<td>".$content->student_name."</td>";
                echo "<td>".$content->student_name."</td>";
                echo "<td>".$content->roll."</td>";
                echo "<td>".$content->class."</td>";
                echo "<td>".$content->year."</td>";
                echo "<td>".$content->department."</td>";
                echo "<td>".$content->phone."</td>";
                echo "<td>".$content->email."</td>";
?>
                    <td> 
                        <?php
                        if (isset($_SESSION['da'])) {
                            ?>
                            <button onclick="return rejectDerogation('<?=$derogation_id?>');" class="btn btn-warning"><i class="fa fa-check-circle" aria-hidden="true"></i> Approve (Sign)</button>
                            <button onclick="return rejectDocument('<?=$derogation_id?>');" class="btn btn-danger"><i class="fa fa-check-circle" aria-hidden="true"></i> Reject</button> 

                            <?php
                        }elseif (isset($_SESSION['stuff'])) {
                            ?>
                            <button onclick="return approveDerogation('<?=$derogation_id?>');" class="btn btn-danger"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button> 

                            <?php
                        }
                        ?>
                    </td>
<?php
                echo "</tr>";
                $cnt++;
            }
        }else{
            echo "<tr><td colspan='4'><center>No Data Found ...</center></td></tr>";
        }
    }
    function select_facult_name_by_id($id){
        $con = parent::connect();
        $sel_fac = $con->prepare("SELECT * FROM faculty WHERE id=?");
        $sel_fac->bindValue(1,$id);
        $sel_fac->execute();
        if ($sel_fac->rowCount()>=1) {
            $ft_sel_fac = $sel_fac->fetch(PDO::FETCH_ASSOC);
            $facult_name = str_replace("Faculty of ", "", $ft_sel_fac['name_faculty_en']);
        }else{
            $facult_name = " - ";
        }
        return $facult_name;
    }
    function document_letter($doc_id){
        $doc_id = base64_decode($doc_id)-35456;
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_documents WHERE document_id=?");
        $sel_doc->bindValue(1,$doc_id);
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC);
            $content = json_decode($ft_sel_doc['document_contents']);
        }else{
            $content = null;
        }
        return $content;
    }

    function rejected_documents(){
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_documents WHERE signature_documents.document_status=?");
        $sel_doc->bindValue(1,'R');
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $cnt = 1;
            while ($ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC)) {
                $derogation_id = $ft_sel_doc['document_id'];
                $dc_st = md5($ft_sel_doc['document_status']);
                $content = json_decode($ft_sel_doc['document_contents']);
                $document = base64_encode($ft_sel_doc['document_id']+35456);
                echo "<tr>";
                echo "<td>$cnt. </td>";
                echo "<td>".$this->document_type($ft_sel_doc['document_type'])."</td>";
                $type = $ft_sel_doc['document_type'];
                switch ($type) {
                    case 1:
                        echo "<td>".$content[0]->f_st_name." & ".$content[1]->f_st_name."</td>";
                        break;
                    case 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11:
                        echo "<td>".$content->student_name."</td>";
                        break;
                    
                    default:
                        echo "<td>--------</td>";
                        break;
                }
?>
                    <td>
                        <a target="__blank" href="view_letter?content=<?=$document?>&type=<?=$type?>&sg=<?=$dc_st?>&dc=<?=$derogation_id?>"><button class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                         </a>
                    </td>
<!--                     <td> <button onclick="return approveDerogation('<?=$derogation_id?>');" class="btn btn-warning"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button> </td> -->
<?php
                echo "</tr>";
                $cnt++;
            }
        }else{
            echo "<tr><td colspan='4'><center>No Data Found ...</center></td></tr>";
        }
    }
    function approved_documents(){
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_documents WHERE signature_documents.document_status=?");
        $sel_doc->bindValue(1,'A');
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $cnt = 1;
            while ($ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC)) {
                $derogation_id = $ft_sel_doc['document_id'];
                $dc_st = md5($ft_sel_doc['document_status']);
                $content = json_decode($ft_sel_doc['document_contents']);
                $document = base64_encode($ft_sel_doc['document_id']+35456);
                echo "<tr>";
                echo "<td>$cnt. </td>";
                echo "<td>".$this->document_type($ft_sel_doc['document_type'])."</td>";
                $type = $ft_sel_doc['document_type'];
                switch ($type) {
                    case 1:
                        echo "<td>".$content[0]->f_st_name." & ".$content[1]->f_st_name."</td>";
                        echo "<td>".$content[0]->phone."</td>";
                        echo "<td>".$content[0]->email."</td>";
                        break;
                    case 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11:
                        echo "<td>".$content->student_name."</td>";
                        echo "<td>".@$content->phone."</td>";
                        echo "<td>".@$content->email."</td>";
                        break;
                    
                    default:
                        echo "<td>--------</td>";
                        break;
                }
                //echo "<td>".$content->email."</td>";
?>
                    <td>
                        <a target="__blank" href="view_letter?content=<?=$document?>&type=<?=$type?>&sg=<?=$dc_st?>&dc=<?=$derogation_id?>"><button class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                         </a>
                    </td>
<!--                     <td> <button onclick="return approveDerogation('<?=$derogation_id?>');" class="btn btn-warning"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button> </td> -->
<?php
                echo "</tr>";
                $cnt++;
            }
        }else{
            echo "<tr><td colspan='4'><center>No Data Found ...</center></td></tr>";
        }
    }
    function student_approved_documents($roll){
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_documents WHERE signature_documents.document_status=? AND signature_documents.document_roll=?");
        $sel_doc->bindValue(1,'A');
        $sel_doc->bindValue(2,$roll);
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $cnt = 1;
            while ($ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC)) {
                $derogation_id = $ft_sel_doc['document_id'];
                $dc_st = md5($ft_sel_doc['document_status']);
                switch ($ft_sel_doc['document_status']) {
                    case 'A':
                        $sttatus = "Approved";
                        break;
                    case 'P':
                        $sttatus = "Pending";
                        break;
                    case 'R':
                        $sttatus = "Rejected";
                        break;
                    
                    default:
                        $sttatus = "---";
                        break;
                }
                $content = json_decode($ft_sel_doc['document_contents']);
                $document = base64_encode($ft_sel_doc['document_id']+35456);
                echo "<tr>";
                echo "<td>$cnt. </td>";
                echo "<td>".$this->document_type($ft_sel_doc['document_type'])."</td>";
                $type = $ft_sel_doc['document_type'];
                switch ($type) {
                    case 1:
                        echo "<td>".$content[0]->f_st_name." & ".$content[1]->f_st_name."</td>";
                        break;
                    case 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11:
                        echo "<td>".$content->student_name."</td>";
                        break;
                    
                    default:
                        echo "<td>--------</td>";
                        break;
                }
                echo "<td><b>".$sttatus."</b></td>";
?>
                    <td>
                        <a target="__blank" href="view_letter?content=<?=$document?>&type=<?=$type?>&sg=<?=$dc_st?>&dc=<?=$derogation_id?>"><button class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                         </a>
                    </td>
<?php
                echo "</tr>";
                $cnt++;
            }
        }else{
            echo "<tr><td colspan='4'><center>You don't have any approved document yet ...</center></td></tr>";
        }
    }

    function student_pending_documents($roll){
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_documents WHERE signature_documents.document_status=? AND signature_documents.document_roll=?");
        $sel_doc->bindValue(1,'P');
        $sel_doc->bindValue(2,$roll);
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $cnt = 1;
            while ($ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC)) {
                $derogation_id = $ft_sel_doc['document_id'];
                $dc_st = md5($ft_sel_doc['document_status']);
                switch ($ft_sel_doc['document_status']) {
                    case 'A':
                        $sttatus = "Approved";
                        break;
                    case 'P':
                        $sttatus = "Pending";
                        break;
                    case 'R':
                        $sttatus = "Rejected";
                        break;
                    
                    default:
                        $sttatus = "---";
                        break;
                }
                $content = json_decode($ft_sel_doc['document_contents']);
                $document = base64_encode($ft_sel_doc['document_id']+35456);
                echo "<tr>";
                echo "<td>$cnt. </td>";
                echo "<td>".$this->document_type($ft_sel_doc['document_type'])."</td>";
                $type = $ft_sel_doc['document_type'];
                switch ($type) {
                    case 1:
                        echo "<td>".$content[0]->f_st_name." & ".$content[1]->f_st_name."</td>";
                        break;
                    case 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11:
                        echo "<td>".$content->student_name."</td>";
                        break;
                    
                    default:
                        echo "<td>--------</td>";
                        break;
                }
                echo "<td><b>".$sttatus."</b></td>";
?>
                    <td>
                        <?php
                        if ($sttatus=="Approved") {
                        ?>
                        <a target="__blank" href="view_letter?content=<?=$document?>&type=<?=$type?>&sg=<?=$dc_st?>&dc=<?=$derogation_id?>"><button class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                        <?php
                        }
                        ?>

                         </a>
                    </td>
<?php
                echo "</tr>";
                $cnt++;
            }
        }else{
            echo "<tr><td colspan='4'><center>You don't have any pending document ...</center></td></tr>";
        }
    }

    function student_rejected_documents($roll){
        $con = parent::connect();
        $sel_doc = $con->prepare("SELECT * FROM signature_documents WHERE signature_documents.document_status=? AND signature_documents.document_roll=?");
        $sel_doc->bindValue(1,'R');
        $sel_doc->bindValue(2,$roll);
        $sel_doc->execute();
        if ($sel_doc->rowCount()>=1) {
            $cnt = 1;
            while ($ft_sel_doc = $sel_doc->fetch(PDO::FETCH_ASSOC)) {
                $derogation_id = $ft_sel_doc['document_id'];
                $dc_st = md5($ft_sel_doc['document_status']);
                switch ($ft_sel_doc['document_status']) {
                    case 'A':
                        $sttatus = "Approved";
                        break;
                    case 'P':
                        $sttatus = "Pending";
                        break;
                    case 'R':
                        $sttatus = "Rejected";
                        break;
                    
                    default:
                        $sttatus = "---";
                        break;
                }
                $content = json_decode($ft_sel_doc['document_contents']);
                $document = base64_encode($ft_sel_doc['document_id']+35456);
                echo "<tr>";
                echo "<td>$cnt. </td>";
                echo "<td>".$this->document_type($ft_sel_doc['document_type'])."</td>";
                $type = $ft_sel_doc['document_type'];
                switch ($type) {
                    case 1:
                        echo "<td>".$content[0]->f_st_name." & ".$content[1]->f_st_name."</td>";
                        break;
                    case 2 || 3 || 4 || 5 || 6 || 7 || 8 || 9 || 10 || 11:
                        echo "<td>".$content->student_name."</td>";
                        break;
                    
                    default:
                        echo "<td>--------</td>";
                        break;
                }
                echo "<td><b>".$sttatus."</b></td>";
?>
                    <td>
                        <a target="__blank" href="view_letter?content=<?=$document?>&type=<?=$type?>&sg=<?=$dc_st?>&dc=<?=$derogation_id?>"><button class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                         </a>
                    </td>
<?php
                echo "</tr>";
                $cnt++;
            }
        }else{
            echo "<tr><td colspan='4'><center>You don't have any rejected document ...</center></td></tr>";
        }
    }

    function is_derogation_exist($roll){
        $con = parent::connect();
        $sel = $con->prepare("SELECT * FROM delogation,student WHERE student.regnumber_student=? AND delogation.delogation_student=student.id AND delogation.delogation_status=?");
        $sel->bindValue(1,$roll);
        $sel->bindValue(2,"E");
        $sel->execute();
        if ($sel->rowCount()>=1) {
            $status = true;
        }else{
            $status = false;
        }
        return $status;
    }
    function my_rejected_derogation($roll){
        $con = parent::connect($roll);
        $sel = $con->prepare("SELECT * FROM delogation,student WHERE student.regnumber_student=? AND delogation.delogation_student=student.id AND delogation.delogation_status=? AND delogation.delogation_approve_status=?");
        $sel->bindValue(1,$roll);
        $sel->bindValue(2,"E");
        $sel->bindValue(3,"R");
        $sel->execute();
        if ($sel->rowCount()>=1) {
            $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
            @$amount = $ft_sel['delogation_intst1_amount']+$ft_sel['delogation_intst2_amount'];
            $date = $inst = "";
            if ($ft_sel['delogation_intst2_date']) {
                $date = $ft_sel['delogation_intst2_date'];
                $inst = "2 installments";
            }else{
                $date = $ft_sel['delogation_intst1_date'];
                $inst = "1 installment";
            }
            echo "Hello ".strtoupper($ft_sel['firstname_student']).",<br>";
            echo "Your derogation done on ".substr($ft_sel['delogation_date'], 0,10)." to be derogated on payment amount of <b>".number_format($amount)." Rwf</b> till ".$date." in ".$inst;
            echo " <h2><center> HAS BEEN REJECTED</center></h2> You're obliged to pay your full payment.";
        }
    }

    function my_approved_derogation($roll){
        $con = parent::connect($roll);
        $sel = $con->prepare("SELECT * FROM delogation,student WHERE student.regnumber_student=? AND delogation.delogation_student=student.id AND delogation.delogation_status=? AND delogation.delogation_approve_status=?");
        $sel->bindValue(1,$roll);
        $sel->bindValue(2,"E");
        $sel->bindValue(3,"A");
        $sel->execute();
        if ($sel->rowCount()>=1) {
            $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
            @$amount = $ft_sel['delogation_intst1_amount']+$ft_sel['delogation_intst2_amount'];
            $date = $inst = "";
            if ($ft_sel['delogation_intst2_date']) {
                $date = $ft_sel['delogation_intst2_date'];
                $inst = "2 installments";
            }else{
                $date = $ft_sel['delogation_intst1_date'];
                $inst = "1 installment";
            }
            echo "Hello ".strtoupper($ft_sel['firstname_student']).",<br>";
            echo "Your derogation done on ".substr($ft_sel['delogation_date'], 0,10)." to be derogated on payment amount of <b>".number_format($amount)." Rwf</b> till ".$date." in ".$inst;
            echo " <h2><center> HAS BEEN APPROVED</center></h2> You're encouraged to pay your full payment on time <b>(Not later than $date)</b>.";
        }
    }
    function my_notyet_derogation($roll){
        $con = parent::connect($roll);
        $sel = $con->prepare("SELECT * FROM delogation,student WHERE student.regnumber_student=? AND delogation.delogation_student=student.id AND delogation.delogation_status=? AND delogation.delogation_approve_status IS NULL");
        $sel->bindValue(1,$roll);
        $sel->bindValue(2,"E");
        $sel->execute();
        if ($sel->rowCount()>=1) {
            $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
            @$amount = $ft_sel['delogation_intst1_amount']+$ft_sel['delogation_intst2_amount'];
            $date = $inst = "";
            if ($ft_sel['delogation_intst2_date']) {
                $date = $ft_sel['delogation_intst2_date'];
                $inst = "2 installments";
            }else{
                $date = $ft_sel['delogation_intst1_date'];
                $inst = "1 installment";
            }
            echo "Hello ".strtoupper($ft_sel['firstname_student']).",<br>";
            echo "Your derogation done on ".substr($ft_sel['delogation_date'], 0,10)." to be derogated on payment amount of <b>".number_format($amount)." Rwf</b> till ".$date." in ".$inst;
            echo " <h2><center> IS NOT YET DEROGATED</center></h2> Try checking out later.</b>.";
        }
    }

    function derogation_status($roll){
        $con = parent::connect($roll);
        $sel = $con->prepare("SELECT * FROM delogation,student WHERE student.regnumber_student=? AND delogation.delogation_student=student.id AND delogation.delogation_status=?");
        $sel->bindValue(1,$roll);
        $sel->bindValue(2,"E");
        $sel->execute();
        $stt = "";
        if ($sel->rowCount()>=1) {
            $ft_sel = $sel->fetch(PDO::FETCH_ASSOC);
            $status = $ft_sel['delogation_approve_status'];
            switch ($status) {
                case 'A':
                    $stt = "Approved";
                    break;
                case 'R':
                    $stt = "Rejected";
                    break;
                
                default:
                    $stt = null;
                    break;
            }
        }
        return $stt;
    }

    function availble_depatments(){
        $conn = parent::connect();
        $dept = $conn->prepare("SELECT * FROM `department`");
        $dept->execute();
        while ($ft_dept = $dept->fetch(PDO::FETCH_ASSOC)) {
            $dept_name = $ft_dept['name_department_en'];
            $dept_id = $ft_dept['id'];
            echo "<option value='$dept_id'>".$dept_name."</option>";
        }
    }
    function availble_faculties(){
        $conn = parent::connect();
        $dept = $conn->prepare("SELECT * FROM `faculty`");
        $dept->execute();
        while ($ft_dept = $dept->fetch(PDO::FETCH_ASSOC)) {
            $dept_name = $ft_dept['name_faculty_en'];
            $dept_id = $ft_dept['id'];
            echo "<option value='$dept_id'>".$dept_name."</option>";
        }
    }
    function availble_academic_year(){
        $conn = parent::connect();
        $dept = $conn->prepare("SELECT * FROM `academic_year` ORDER BY year DESC");
        $dept->execute();
        while ($ft_dept = $dept->fetch(PDO::FETCH_ASSOC)) {
            $dept_name = $ft_dept['year'];
            $dept_id = $ft_dept['year'];
            echo "<option value='$dept_id'>".$dept_name."</option>";
        }
    }
    function availble_academic_classes(){
        echo "<option>Year 1</option>";
        echo "<option>Year 2</option>";
        echo "<option>Year 3</option>";
    }
    function check_if_student_is_polytechnic($rollnumber){
        $con = parent::connect();
        $sel = $con->prepare("SELECT * FROM student,student_year,class WHERE student.id=student_year.id_student AND student_year.id_class=class.id AND class.id_faculty IN(7,8,9) AND student.regnumber_student=?");
        $sel->bindValue(1,$rollnumber);
        $sel->execute();
        if ($sel->rowCount()==1) {
            $stt = $sel->rowCount();
        }else{
            $stt = $sel->rowCount();
        }
        return $stt;
    }
}
?>