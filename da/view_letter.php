<?php
@session_start();
?>
<style type="text/css">
        @page { size: auto; margin: 12px; size: portrait;}
        @media print{
            #header_btns{
            	display: none;
            }
            #qrcode{
            	width: 200px;
            	height: 200px;
            	margin-top: 7%;
            }
            }
body {
  background: rgb(204,204,204); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: 29.7cm; 
}
page[size="A4"][layout="landscape"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="landscape"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="landscape"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
.qrcode{
	width:30;
	 height:30;
	 margin-top:15px;
}
		.content{
/*			line-height: 25px;
			width: 400px;*/
			text-align: justify;
		}
		.editable.active{
			padding: 2px;
			background: #f1f1f1;
			border: 1px solid #ddd;

		}
		.h{
			display: none;
		}
</style>
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../libs/qr/jquery.min.js"></script>
<script type="text/javascript" src="../libs/qr/qrcode.js"></script>

    <span style="position: absolute;margin-left: 5%" id="header_btns">
    	    
    		<?php
    		if (isset($_SESSION['da'])) {
    			$doc = $_GET['dc'];
    			?>
<button class="btn btn-primary" onclick="return window.print();"><i class="fa fa-print" aria-hidden="true"></i> Print</button>&nbsp;&nbsp;&nbsp;
<button class="btn btn-success" onclick="return rejectDerogationnn('<?=$doc?>');" style=""><i class="fa fa-check" aria-hidden="true"></i> Approve</button>
    			<?php
    		}elseif (isset($_SESSION['staff'])) {
    			?>
<button class="btn btn-primary" onclick="return window.print();"><i class="fa fa-print" aria-hidden="true"></i> Print</button>&nbsp;&nbsp;&nbsp;
<div id="qr" data-rollnumber="12345"></div>

<button class="btn btn-info" id="modify">Modify</button>
<div class="h">
<button class="btn" id="save">Save</button>
<button class="btn" id="cancel">Cancel</button>
</div>
    			<?php
    		}else{
     			?>
<button class="btn btn-primary" onclick="return window.print();"><i class="fa fa-print" aria-hidden="true"></i> Print</button>&nbsp;&nbsp;&nbsp;

    			<?php   			
    		}
    		?>
    </span>
<page size="A4">
	<?php
require("../js/view.php");
$MainView = new MainView();

$content = $MainView->document_letter($_GET['content']);
	$rollnumber = array();
	switch ($_GET['type']) {
		case 1:
			$rollnumber[0] = $content[0]->f_st_roll;
			$rollnumber[1] = $content[1]->f_st_roll;
			$status = "";
			echo "<div class='content'><center><h1><br>TO WHOM IT MAY CONCERN</h1></center><br><br><br>";
			echo "<div style='margin-left:60px;font-size:18px;line-height: 1.8'>";
			echo "<p>I, the undersigned, ".$status." at Kigali Independent University ULK/ Kigali campus, hereby attest that <b>".$content[0]->f_st_name." & ".$content[1]->f_st_name."</b> are regular students in the Department of Accounting , respectively under the registration numbers <b>".$content[0]->f_st_roll." & ".$content[1]->f_st_roll.".</b> <span class='editable'>In the framework of completing their studies, they need to collect data in your institution.</span></p>";
			echo "<p><span class='editable'>The University will highly appreciate any assistance regarding their application for data collection as well as its success.</p></span>";
			echo "<br><br><br>";
			echo "<p><span class='editable'>Thank you for your collaboration.</p>";
			echo "<br>";
			echo "<p>Done at Kigali, on ".date("F dS, Y").".</p>";
			//echo "<br>";
			if (md5("A")==$_GET['sg']) {
				?>
								<table>
					<tr>
						<td><img src="../img/signed.jpeg" style="width: 260px;height: 200px;"></td>
						<td style="font-style: italic;">
							Digitally signed By<br>
							[ULK]<br>
							<?=$status?> <br>
							Date: <?=date("Y-m-d H:i:s")?>
						</td>
					</tr>
				</table>
				<?php
			}
			echo "<p><b>RUGWIZANGOGA Emmanuel</b></p>";
			echo "<p><b>".$status."</b></p>";
			echo "<p><b>ULK/Kigali</b></p>";
			if (md5("A")==$_GET['sg']) {echo "<div id='qrcode'  class='qrcode'></div>";}
			echo "</div></div>";
			break;
		case 2:
			$rollnumber[0] = $content->roll;
			$status = "";
			echo "<div class='content'><div style='margin-left:8%;margin-right:8%;font-size:18px;'>";
			echo "<br><br><br><br><br>";
			echo "<p> ".date("F dS, Y")."</p><br>";
			echo "<center><h1><br>TO WHOM IT MAY CONCERN</h1></center><br><br><br>";
			echo "<p>I, the undersigned, <b>RUGWIZANGOGA Emmanuel</b>, ".$status." of Kigali Independent University ULK hereby certify that <b>".$content->student_name."</b>  studied within the aforementioned University in the School of ".$MainView->select_facult_name_by_id($content->facult)." ".$content->department.".</p>";
			echo "<p class='editable'>This serves to confirm that English is the medium of instruction at Kigali Independent University ULK.</p>";
			echo "<p class='editable'>This document is made upon the bearer requesting for it to serve purposes he/she may need it for.</p>";
			echo "<p class='editable'>Sincerely,</p><br><br>";
			echo "<br>";
			//echo "<br>";
			if (md5("A")==$_GET['sg']) {
				?>
								<table>
					<tr>
						<td><img src="../img/signed.jpeg" style="width: 260px;height: 200px;"></td>
						<td style="font-style: italic;">
							Digitally signed By<br>
							[ULK]<br>
							<?=$status?> <br>
							Date: <?=date("Y-m-d H:i:s")?>
						</td>
					</tr>
				</table>
				<?php
			}
			echo "<p><b>RUGWIZANGOGA Emmanuel</b></p>";
			echo "<p><b>".$status."</b></p>";
			echo "<p><b>ULK/Kigali</b></p>";
			if (md5("A")==$_GET['sg']) {echo "<div id='qrcode'  class='qrcode'></div>";}
			echo "</div></div>";
			break;
		case 3:
			$rollnumber[0] = $content->roll;
			$status = "";
			echo "<div class='content'><div style='margin-left:8%;margin-right:8%;font-size:18px;'>";
			echo "<br><br><br><br><br>";
			echo "<p> ".date("F dS, Y")."</p><br>";
			echo "<center><h1><br>TO WHOM IT MAY CONCERN</h1></center><br><br><br>";
			echo "<p>I, the undersigned, <b>RUGWIZANGOGA Emmanuel</b>, ".$status." of Kigali Independent University ULK / Kigali campus, hereby certify that <b>".$content->student_name."</b>, (Roll Number <b>".$content->roll."</b>, Class of <b>".$content->class ."</b>, School of <b>".$MainView->select_facult_name_by_id($content->facult) ."</b>, <b>".$content->department ."</b>, Academic year <b>".$content->year ."</b>) <span class='editable'> is a registered student of this University, in the above mentioned class. She/he would like to conduct Internship in your organization.</span></p>";
			echo "<p class='editable'>Therefore, I recommend him/her for any assistance regarding its success.</p>";
			echo "<p class='editable'>Sincerely yours,</p><br><br>";
			echo "<br>";
			//echo "<br>";
			if (md5("A")==$_GET['sg']) {
				?>
								<table>
					<tr>
						<td><img src="../img/signed.jpeg" style="width: 260px;height: 200px;"></td>
						<td style="font-style: italic;">
							Digitally signed By<br>
							[ULK]<br>
							<?=$status?> <br>
							Date: <?=date("Y-m-d H:i:s")?>
						</td>
					</tr>
				</table>
				<?php
			}
			echo "<p><b>RUGWIZANGOGA Emmanuel</b></p>";
			echo "<p><b>".$status."</b></p>";
			echo "<p><b>ULK/Kigali</b></p>";
			if (md5("A")==$_GET['sg']) {echo "<div id='qrcode'  class='qrcode'></div>";}
			echo "</div></div>";
			break;
		case 4:
			$rollnumber[0] = $content->roll;
			$status = "Registrar";
			echo "<div class='content'><div style='margin-left:8%;margin-right:8%;font-size:18px;'>";
			echo "<br><br><br><br><br>";
			echo "<p>Kigali, ".date("F dS, Y")."</p><br>";
			echo "<p><b>Att</b>, Director General of Immigration and Emigration </p><br>";
			echo "<p><b>Kigali - Rwanda</b> </p><br>";
			echo "<p>Dear Sir,  </p><br>";
			echo "<p><b>Re: Recommendation for Mr. /Mrs. ".$content->student_name."</b> </p><br>";
			//echo "<center><h1><br>TO WHOM IT MAY CONCERN</h1></center><br><br><br>";
			echo "<p>I, the undersigned, <b>RUGWIZANGOGA Emmanuel</b>, ".$status." of Kigali Independent University ULK / Kigali campus, hereby recommend <b>".$content->student_name."</b>, a ".$content->nationality." <span class='editable'> citizen applying for admission at our University for the Academic Year 2020-2021 for help from your office.</p>";
			echo "<p class='editable'>This student has expressed interest to study in Rwanda but more specifically at Kigali Independent University ULK, he/she would wish to get official documents authorizing him/her to stay in Rwanda while pursuing his/her studies.</p>";
			echo "<p class='editable'>Please accept our highest consideration and regards.</p><br><br>";
			echo "<br>";
			//echo "<br>";
			if (md5("A")==$_GET['sg']) {
				?>
								<table>
					<tr>
						<td><img src="../img/signed.jpeg" style="width: 260px;height: 200px;"></td>
						<td style="font-style: italic;">
							Digitally signed By<br>
							[ULK]<br>
							<?=$status?> <br>
							Date: <?=date("Y-m-d H:i:s")?>
						</td>
					</tr>
				</table>
				<?php
			}
			echo "<p><b>RUGWIZANGOGA Emmanuel,</b></p>";
			echo "<p><b>Registrar-ULK/Kigali</b></p>";
			if (md5("A")==$_GET['sg']) {echo "<div id='qrcode'  class='qrcode'></div>";}
			echo "</div></div>";
			break;
		case 5:
			$rollnumber[0] = $content->roll;
			$status = "Registrar";
			echo "<div class='content'><div style='margin-left:8%;margin-right:8%;font-size:18px;'>";
			echo "<br><br><br><br><br>";
			echo "<p>Kigali, ".date("F dS, Y")."</p><br>";
			echo "<p><b>Att</b>, Director General of Immigration and Emigration </p><br>";
			echo "<p><b>Kigali - Rwanda</b> </p><br>";
			echo "<p>Dear Sir,  </p><br>";
			echo "<p><b>Re: Recommendation for Mr. /Mrs. ".$content->student_name."</b> </p><br>";
			//echo "<center><h1><br>TO WHOM IT MAY CONCERN</h1></center><br><br><br>";
			echo "<p>I, the undersigned, <b>RUGWIZANGOGA Emmanuel</b>, ".$status." of Kigali Independent University ULK / Kigali campus, hereby recommend <b>".$content->student_name."</b>, a ".$content->nationality." <span class='editable'> citizen applying for admission at our University for the Academic Year 2020-2021 for help from your office.</span></p>";
			echo "<p class='editable'>This student has expressed interest to study in Rwanda but more specifically at Kigali Independent University ULK, he/she would wish to get official documents authorizing him/her to stay in Rwanda while pursuing his/her studies.</p>";
			echo "<p class='editable'>Please accept our highest consideration and regards.</p><br><br>";
			echo "<br>";
			//echo "<br>";
			if (md5("A")==$_GET['sg']) {
				?>
								<table>
					<tr>
						<td><img src="../img/signed.jpeg" style="width: 260px;height: 200px;"></td>
						<td style="font-style: italic;">
							Digitally signed By<br>
							[ULK]<br>
							<?=$status?> <br>
							Date: <?=date("Y-m-d H:i:s")?>
						</td>
					</tr>
				</table>
				<?php
			}
			echo "<p><b>RUGWIZANGOGA Emmanuel,</b></p>";
			echo "<p><b>Registrar-ULK/Kigali</b></p>";
			if (md5("A")==$_GET['sg']) {echo "<div id='qrcode'  class='qrcode'></div>";}
			echo "</div></div>";
			break;
		case 6:
			$rollnumber[0] = $content->roll;
			$status = "";
			echo "<div class='content'><div style='margin-left:8%;margin-right:8%;font-size:18px;'>";
			echo "<br><br><br><br><br>";
			echo "<p> ".date("F dS, Y")."</p><br>";
			echo "<center><h1><br>TO WHOM IT MAY CONCERN</h1></center><br><br><br>";
			echo "<p>I, the undersigned, <b>RUGWIZANGOGA Emmanuel</b>, ".$status." of Kigali Independent University ULK / Kigali campus, hereby certify that <b> Mr. /Mrs. ".$content->student_name."</b> whose Roll Number is <b>".$content->roll."</b> School of <b>".$MainView->select_facult_name_by_id($content->facult) ."</b>, Department of <b>".$content->department ."</b> in the <b>Third Year,</b> Academic year <b>".$content->year ."</b><span class='editable'> is a registered student of this University, in the above mentioned School. She/he would like to conduct <b>Professional Internship </b> in your organization.<span></p>";
			echo "<p class='editable'>Therefore, I recommend her for any assistance regarding the success of it.</p>";
			echo "<p class='editable'>Sincerely yours,</p>";
			echo "<p>Done at Kigali, ".date("F dS, Y")."</p><br>";
			echo "<br>";			

			//echo "<br>";
			if (md5("A")==$_GET['sg']) {
				?>
								<table>
					<tr>
						<td><img src="../img/signed.jpeg" style="width: 260px;height: 200px;"></td>
						<td style="font-style: italic;">
							Digitally signed By<br>
							[ULK]<br>
							<?=$status?> <br>
							Date: <?=date("Y-m-d H:i:s")?>
						</td>
					</tr>
				</table>
				<?php
			}

			echo "<p><b>RUGWIZANGOGA Emmanuel</b></p>";
			echo "<p><b>".$status." - ULK/Kigali</b></p>";
			if (md5("A")==$_GET['sg']) {echo "<div id='qrcode'  class='qrcode'></div>";}
			echo "</div></div>";
			break;
		case 7:
			$rollnumber[0] = $content->roll;
			$status = "Registrar";
			echo "<div class='content'><div style='margin-left:8%;margin-right:8%;font-size:18px;'>";
			echo "<br><br><br><br><br>";
			echo "<p>Kigali, ".date("F dS, Y")."</p>";
			echo "<p>".$content->student_name."</p>";
			echo "<p>".$content->class." ".$content->department."</p>";
			echo "<p>Roll number: ".$content->roll."</p><br>";
			echo "<p class='editable'><b>Re: Answer to your letter “Request for Postponement of Course”</b> </p><br>";
			echo "<p class='editable'>I acknowledge receipt of your letter requesting for postponement of your course due to personal issues  </p><br>";
			echo "<p class='editable'> I wish to inform you that your request is granted. However you should go to the finance office and clear any unpaid debt.</p><br>";
			echo "<p class='editable'>Kind regards,</p><br>";
			echo "<br>";
			//echo "<br>";
			if (md5("A")==$_GET['sg']) {
				?>
								<table>
					<tr>
						<td><img src="../img/signed.jpeg" style="width: 260px;height: 200px;"></td>
						<td style="font-style: italic;">
							Digitally signed By<br>
							[ULK]<br>
							<?=$status?> <br>
							Date: <?=date("Y-m-d H:i:s")?>
						</td>
					</tr>
				</table>
				<?php
			}
			echo "<p><b>RUGWIZANGOGA Emmanuel,</b></p>";
			echo "<p><b>Registrar-ULK/Kigali</b></p><br>";
			echo "<b><u>C.C:</u></b>";
			echo "<ul>";
			echo "   -The Director of Administration and Finance.<br>";
			echo "   -Head of the Department of Development Studies.";
			if (md5("A")==$_GET['sg']) {echo "<div id='qrcode'  class='qrcode'></div>";}
			echo "</div></div>";
			break;
		case 8:
			$rollnumber[0] = $content->roll;
			$status = "Registrar";
			echo "<center><h3><br><br><br><b>FURTHER STUDIES RECOMMENDATION</h3></center></b><br><br><br>";
			echo "<div class='content'><div style='margin-left:60px;font-size:18px;line-height: 1.8;margin-right:8%'>";
			echo "<p>I, the undersigned, Registrar of Kigali Independent University ULK/ Kigali, hereby attest that <b> Mr./Mrs. ".$content->student_name."</b> , Roll Number <b>".$content->roll."</b> , School of <b>".$MainView->select_facult_name_by_id($content->facult)."</b> , Department  of <b>".$content->department."</b>  was a Regular Student at the above mentioned university and  completed the Undergraduate Studies  in the Academic Year <b>".$content->year."</b> </p><br>";
			echo "<p><b> Mr./Mrs. ".$content->student_name."</b> <span class='editable'> has been a very hardworking and disciplined student. She/he demonstrated a very good performance which can be associated to his/her ability to acquire new knowledge easily and faster.</span></p>";
			echo "<p class='editable'>Therefore, I recommend him/her for any assistance regarding the further studies.   </p>";
			echo "<p class='editable'>Done at Kigali, ".date("F dS, Y")."</p>";
			echo "<p class='editable'>Sincerely yours,</p>";
			echo "<br>";
			echo "<p>Done at Kigali, on ".date("F dS, Y").".</p>";
			//echo "<br>";
			if (md5("A")==$_GET['sg']) {
				?>
								<table>
					<tr>
						<td><img src="../img/signed.jpeg" style="width: 260px;height: 200px;"></td>
						<td style="font-style: italic;">
							Digitally signed By<br>
							[ULK]<br>
							<?=$status?> <br>
							Date: <?=date("Y-m-d H:i:s")?>
						</td>
					</tr>
				</table>
				<?php
			}
			echo "<p><b>RUGWIZANGOGA Emmanuel</b></p>";
			echo "<p><b>Registrar-ULK/Kigali</b></p>";
			if (md5("A")==$_GET['sg']) {echo "<div id='qrcode'  class='qrcode'></div>";}
			echo "</div></div>";
			break;
		case 9:
			$rollnumber[0] = $content->roll;
			$status = "";
			echo "<center><h1><br>TO WHOM IT MAY CONCERN</h1></center><br><br><br>";
			echo "<div class='content'><div style='margin-left:60px;font-size:18px;line-height: 2.5'>";
			echo "<p>I, the undersigned, ".$status." at Kigali Independent University ULK/ Kigali campus,, do hereby certify that Mrs. /Mr. <b>".$content->student_name."</b> is a regular student under roll number <b>".$content->roll.".</b> in ".$content->class." in  Department of <b>".$content->department."</b> , School of ".$MainView->select_facult_name_by_id($content->facult)." for the academic year ".$content->year.".</p>";
			echo "<p class='editable'>This document is issued to her/him to serve the purpose it is required for.</p>";
			echo "<br><br><br>";

			echo "<p class='editable'>Done at Kigali, on ".date("F dS, Y").".</p><br>";
			//echo "<br>";
			if (md5("A")==$_GET['sg']) {
				?>
								<table>
					<tr>
						<td><img src="../img/signed.jpeg" style="width: 260px;height: 200px;"></td>
						<td style="font-style: italic;">
							Digitally signed By<br>
							[ULK]<br>
							<?=$status?> <br>
							Date: <?=date("Y-m-d H:i:s")?>
						</td>
					</tr>
				</table>
				<?php
			}
			echo "<p><b>RUGWIZANGOGA Emmanuel</b></p>";
			echo "<p>".$status."</p>";
			echo "<p>ULK Kigali campus</p>";
			echo "<p>Tel. 0788304086/dakigali@ulk.ac.rw</p>";
			if (md5("A")==$_GET['sg']) {echo "<div id='qrcode' class='qrcode'></div>";}
			echo "</div></div>";
			break;
		default:

			# code...
			break;
	}
//var_dump($content);
	?>
</page>
<span id="active"></span>


<script type="text/javascript" src="../libs/qr/jquery.min.js"></script>
<script type="text/javascript" src="../libs/qr/qrcode.js"></script>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../js/web.js"></script>
<!-- <div id="qrcode" style="width:100px; height:100px; margin-top:15px;"></div>
 --><script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
    width : 100,
    height : 100,

});

function makeCode () {   
    var elText = "https://inkuge.com/signature/information.php?rollnumber=<?= implode(',', $rollnumber)?>";
    
    if (!elText) {
        alert("Incoplete data");
        elText.focus();
        return;
    }
    
    qrcode.makeCode(elText);
}

makeCode();




	$('#modify').click(function(){
		$(this).hide();
		$('.editable').attr('contenteditable',true).addClass('active');
		$('.h').show();
	})
	$('#cancel').click(function(){
		$('.editable').attr('contenteditable',false).removeClass('active');
		$('.h').hide();
		$('#modify').show();

	})
	$('#save').click(function(){
		var data = $('.content').html();
		$.ajax({
			url:'path/page.php',
			method:'POST',
			data:{content:data},
			success:function(data){

			}
		})
		$('.editable').attr('contenteditable',false).removeClass('active');
		$('.h').hide();
		$('#modify').show();

	})
</script>