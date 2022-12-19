 //------------------------------------------MY FUNCTIONS
 //---document.getElementById
 function gtId(id){
 	return document.getElementById(id);
 }
 //---document.getElementById.value
  function gtIdVal(id){
 	return document.getElementById(id).value;
 }
//---getting Private,Public and Gov-Aided radios---ON ADD SCHOOL PAGE
 	 var xklCtgr=null;
    var radiosl = document.getElementsByName('xkl_categ');
    	for(var l = 0; l < radiosl.length; l++){
        	radiosl[l].onclick = function(){
          	xklCtgr=this.value;//----------fourth creteria
        	}
    	}
//------------------------- VAlid phone number
function valid_phone(inputtxt){
	var phone = gtIdVal(inputtxt);
	var lnt = phone.length;
	var sub = phone.substr(0, 3);
	const digits_only = string => [...string].every(c => '0123456789'.includes(c));
	if (lnt==10 && ((sub=='078')||(sub=='072')||(sub=='073'))&&digits_only(phone)&&(phone.substr(0, 1)==0)) {
		return true;
	}else{
		return false;
	}
}
//-------------Set Content
function setCont(elm,cnt){
	document.getElementById(""+elm+"").style.display='block';
	document.getElementById(""+elm+"").innerHTML="<strong>"+cnt+"</strong>";
	function clr(){
		document.getElementById(""+elm+"").style.display='none';
		document.getElementById(""+elm+"").innerHTML="";

	}
	setTimeout(clr,5000);

}
//------------- UNFINISHED Set Content
function setContent(elm,cnt){
	document.getElementById(""+elm+"").style.display='block';
	document.getElementById(""+elm+"").innerHTML="<strong>"+cnt+"</strong>";
}
//-------------Set Content With Duration
function setContDir(diration,elm,cnt){
	document.getElementById(""+elm+"").style.display='block';
	document.getElementById(""+elm+"").innerHTML="<strong>"+cnt+"</strong>";
	function clr(){
		document.getElementById(""+elm+"").style.display='none';
		document.getElementById(""+elm+"").innerHTML="";

	}
	setTimeout(clr,diration);

}

function successSetCont(elm,cnt){		//=========================== SUCCESSFULLY SET-CONTENT
	document.getElementById(""+elm+"").style.display='block';
	document.getElementById(""+elm+"").innerHTML="<strong style='color:green;font-weight:bolder'>"+cnt+"</strong>";
	function clr(){
		document.getElementById(""+elm+"").style.display='none';
		document.getElementById(""+elm+"").innerHTML="";

	}
	setTimeout(clr,5000);

}
function failSetCont(elm,cnt){		//=========================== FAILED SET-CONTENT
	document.getElementById(""+elm+"").style.display='block';
	document.getElementById(""+elm+"").innerHTML="<strong style='color:red;'>"+cnt+"</strong>";
	function clr(){
		document.getElementById(""+elm+"").style.display='none';
		document.getElementById(""+elm+"").innerHTML="";

	}
	setTimeout(clr,5000);

}
//.........................................................isEmpty().......................................
function isEmpty(vval){
	if (vval=="") {
		return true;
	}else{
		return false;
	}
}
function login(){
	var user = gtIdVal("user");
	var pass = gtIdVal("pass");
	if (!isEmpty(user) && !isEmpty(pass)) {
		var login = true;
		$.ajax({url:"js/main.php",
		type:"GET",data:{login:login,user:user,pass:pass},cache:false,success:function(res){$("#respp").html(res);}
		});
	}else{
		failSetCont('respp','Fill all fields ...');
	}
}
//================================================== REQUEST DEROGATION BY STUDENT
$( "#frm_derogation" ).submit(function( event ) {
  event.preventDefault();
  var letter = gtIdVal("file");
  if (isEmpty(letter) || letter=="") {
  	setCont("alert","<div class='alert alert-danger' role='alert' style='font-weight: bolder'>Upload your letter ...</div>");
  }else{
    var form = $(this);
    var url = "js/main.php";
    
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
               alert(data); // show response from the php script.
           }
         });
  }
});
var input = document.getElementById("user");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    login();
  }
});
var input = document.getElementById("pass");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    login();
  }
});

function rejectDerogation(derogation){
	var rejectDerogation = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{rejectDerogation:rejectDerogation,derogation:derogation},cache:false,success:function(res){$("#active").html(res);}
		});
}
function rejectDerogationnn(derogation){
	var rejectDerogationnn = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{rejectDerogationnn:rejectDerogationnn,derogation:derogation},cache:false,success:function(res){$("#active").html(res);}
		});
}
function rejectDocument(derogation){
	var rejectDocument = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{rejectDocument:rejectDocument,derogation:derogation},cache:false,success:function(res){$("#active").html(res);}
		});
}
function terminateStudentRequest(derogation){
	var terminateStudentRequest = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{terminateStudentRequest:terminateStudentRequest,derogation:derogation},cache:false,success:function(res){$("#active").html(res);}
		});
}
function approveDerogation(derogation){
	var approveDerogation = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{approveDerogation:approveDerogation,derogation:derogation},cache:false,success:function(res){$("#active").html(res);}
		});
}

function selDeptFat(){
	var selFacult = gtIdVal("sel_fac_3");
	if (!isEmpty(selFacult)) {
		document.getElementById("sel_dept_3").disabled = false;
	var selDeptFat = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{selDeptFat:selDeptFat,selFacult:selFacult},cache:false,success:function(res){$("#sel_dept_3").html(res);}
		});
	}else{
		document.getElementById("sel_dept_3").disabled = true;
	}
}
function selDeptFatOne(){
	var selFacult = gtIdVal("sel_fac");
	if (!isEmpty(selFacult)) {
		document.getElementById("sel_dept").disabled = false;
	var selDeptFat = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{selDeptFat:selDeptFat,selFacult:selFacult},cache:false,success:function(res){$("#sel_dept").html(res);}
		});
	}else{
		document.getElementById("sel_dept").disabled = true;
	}
}
function selDeptFatFive(){
	var selFacult = gtIdVal("sel_fac_6");
	if (!isEmpty(selFacult)) {
		document.getElementById("sel_dept_6").disabled = false;
	var selDeptFat = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{selDeptFat:selDeptFat,selFacult:selFacult},cache:false,success:function(res){$("#sel_dept_6").html(res);}
		});
	}else{
		document.getElementById("sel_dept_6").disabled = true;
	}
}
function selDeptFatNive(){
	var selFacult = gtIdVal("sel_fac_9");
	if (!isEmpty(selFacult)) {
		document.getElementById("sel_dept_9").disabled = false;
	var selDeptFat = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{selDeptFat:selDeptFat,selFacult:selFacult},cache:false,success:function(res){$("#sel_dept_9").html(res);}
		});
	}else{
		document.getElementById("sel_dept_9").disabled = true;
	}
}
function selDeptFatSeven(){
	var selFacult = gtIdVal("sel_fac_7");
	if (!isEmpty(selFacult)) {
		document.getElementById("sel_dept_7").disabled = false;
	var selDeptFat = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{selDeptFat:selDeptFat,selFacult:selFacult},cache:false,success:function(res){$("#sel_dept_7").html(res);}
		});
	}else{
		document.getElementById("sel_dept_7").disabled = true;
	}
}
function selDeptFatEight(){
	var selFacult = gtIdVal("sel_fac_8");
	if (!isEmpty(selFacult)) {
		document.getElementById("sel_dept_8").disabled = false;
	var selDeptFat = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{selDeptFat:selDeptFat,selFacult:selFacult},cache:false,success:function(res){$("#sel_dept_8").html(res);}
		});
	}else{
		document.getElementById("sel_dept_8").disabled = true;
	}
}
function selDeptFatStudent(){
	var selFacult = gtIdVal("sel_fac_std");
	if (!isEmpty(selFacult)) {
		document.getElementById("sel_dept_std").disabled = false;
	var selDeptFat = true;
		$.ajax({url:"js/main.php",
		type:"GET",data:{selDeptFat:selDeptFat,selFacult:selFacult},cache:false,success:function(res){$("#sel_dept_std").html(res);}
		});
	}else{
		document.getElementById("sel_dept_std").disabled = true;
	}
}
function switchForms(){
	var switchData = gtIdVal("documents");
	switch (switchData){
		case "1":
		document.getElementById("data_collection").style.display = "block";
		document.getElementById("migration_for_new").style.display = "none";
		document.getElementById("internership_recommendation").style.display = "none";
		document.getElementById("english_as_medium").style.display = "none";
		document.getElementById("migration_for_student").style.display = "none";
		document.getElementById("suspension_letter").style.display = "none";
		document.getElementById("further_studies").style.display = "none";
		document.getElementById("attendance_testimonial").style.display = "none";
		document.getElementById("professional_internership").style.display = "none";
		break;
		case "2":
		document.getElementById("data_collection").style.display = "none";
		document.getElementById("migration_for_new").style.display = "none";
		document.getElementById("internership_recommendation").style.display = "none";
		document.getElementById("migration_for_student").style.display = "none";
		document.getElementById("professional_internership").style.display = "none";
		document.getElementById("suspension_letter").style.display = "none";
		document.getElementById("further_studies").style.display = "none";
		document.getElementById("attendance_testimonial").style.display = "none";
		document.getElementById("english_as_medium").style.display = "block";
		break;
		case "3":
		document.getElementById("data_collection").style.display = "none";
		document.getElementById("english_as_medium").style.display = "none";
		document.getElementById("migration_for_new").style.display = "none";
		document.getElementById("migration_for_student").style.display = "none";
		document.getElementById("professional_internership").style.display = "none";
		document.getElementById("suspension_letter").style.display = "none";
		document.getElementById("further_studies").style.display = "none";
		document.getElementById("attendance_testimonial").style.display = "none";
		document.getElementById("internership_recommendation").style.display = "block";
		break;
		case "4":
		document.getElementById("data_collection").style.display = "none";
		document.getElementById("english_as_medium").style.display = "none";
		document.getElementById("internership_recommendation").style.display = "none";
		document.getElementById("migration_for_student").style.display = "none";
		document.getElementById("professional_internership").style.display = "none";
		document.getElementById("suspension_letter").style.display = "none";
		document.getElementById("further_studies").style.display = "none";
		document.getElementById("attendance_testimonial").style.display = "none";
		document.getElementById("migration_for_new").style.display = "block";
		break;
		case "5":
		document.getElementById("data_collection").style.display = "none";
		document.getElementById("english_as_medium").style.display = "none";
		document.getElementById("internership_recommendation").style.display = "none";
		document.getElementById("migration_for_new").style.display = "none";
		document.getElementById("professional_internership").style.display = "none";
		document.getElementById("suspension_letter").style.display = "none";
		document.getElementById("further_studies").style.display = "none";
		document.getElementById("attendance_testimonial").style.display = "none";
		document.getElementById("migration_for_student").style.display = "block";
		break;
		case "6":
		document.getElementById("data_collection").style.display = "none";
		document.getElementById("english_as_medium").style.display = "none";
		document.getElementById("internership_recommendation").style.display = "none";
		document.getElementById("migration_for_new").style.display = "none";
		document.getElementById("migration_for_student").style.display = "none";
		document.getElementById("suspension_letter").style.display = "none";
		document.getElementById("further_studies").style.display = "none";
		document.getElementById("attendance_testimonial").style.display = "none";
		document.getElementById("professional_internership").style.display = "block";
		break;
		case "7":
		document.getElementById("data_collection").style.display = "none";
		document.getElementById("english_as_medium").style.display = "none";
		document.getElementById("internership_recommendation").style.display = "none";
		document.getElementById("migration_for_new").style.display = "none";
		document.getElementById("migration_for_student").style.display = "none";
		document.getElementById("professional_internership").style.display = "none";
		document.getElementById("further_studies").style.display = "none";
		document.getElementById("attendance_testimonial").style.display = "none";
		document.getElementById("suspension_letter").style.display = "block";
		break;
		case "8":
		document.getElementById("data_collection").style.display = "none";
		document.getElementById("english_as_medium").style.display = "none";
		document.getElementById("internership_recommendation").style.display = "none";
		document.getElementById("migration_for_new").style.display = "none";
		document.getElementById("migration_for_student").style.display = "none";
		document.getElementById("professional_internership").style.display = "none";
		document.getElementById("suspension_letter").style.display = "none";
		document.getElementById("attendance_testimonial").style.display = "none";
		document.getElementById("further_studies").style.display = "block";
		break;
		case "9":
		document.getElementById("data_collection").style.display = "none";
		document.getElementById("english_as_medium").style.display = "none";
		document.getElementById("internership_recommendation").style.display = "none";
		document.getElementById("migration_for_new").style.display = "none";
		document.getElementById("migration_for_student").style.display = "none";
		document.getElementById("professional_internership").style.display = "none";
		document.getElementById("suspension_letter").style.display = "none";
		document.getElementById("further_studies").style.display = "none";
		document.getElementById("attendance_testimonial").style.display = "block";
		break;
		default:

		break;
	}
}
function subDataCollection(){
	var subType=1;
	var fstStName = gtIdVal("data_collectionfstStName");
	var fstStRoll = gtIdVal("data_collectionfstStRoll");
	var secdStName = gtIdVal("data_collectionsendStName");
	var scndStRoll = gtIdVal("data_collectionsendStRoll");
	var dept = gtIdVal("data_collectiondept");
	if (!isEmpty(fstStName) && !isEmpty(fstStRoll) && !isEmpty(secdStName) && !isEmpty(scndStRoll) && !isEmpty(dept)) {
		var subDataCollection = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{subDataCollection:subDataCollection,subType:subType,fstStName:fstStName,fstStRoll:fstStRoll,secdStName:secdStName,scndStRoll:scndStRoll,dept:dept},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("data_collectionresp","Request sent successfull !");

					document.getElementById('data_collectionfstStName').value ='';
					document.getElementById('data_collectionfstStRoll').value ='';
					document.getElementById('data_collectionsendStName').value ='';
					document.getElementById('data_collectionsendStRoll').value ='';
					document.getElementById('data_collectiondept').value ='';
				break;
				case "fail":
					failSetCont("data_collectionresp","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("data_collectionresp","Fill all fields ...");
	}
}

function subEnglishAsMedium(){
	var subType = 2;
	var studentName = gtIdVal("studentName");
	var studentRoll = gtIdVal("rollMed");
	var studentFact = gtIdVal("sel_fac");
	var studentDept = gtIdVal("sel_dept");
	if (!isEmpty(studentName) && !isEmpty(studentFact) && !isEmpty(studentDept) && !isEmpty(studentRoll)) {
		var subEnglishAsMedium = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{roll:studentRoll,subEnglishAsMedium:subEnglishAsMedium,studentName:studentName,studentFact:studentFact,studentDept:studentDept,subType:subType},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("english_as_mediumresp","Request sent successfull !");

					document.getElementById('studentName').value ='';
					document.getElementById('sel_fac').value ='';
					document.getElementById('rollMed').value ='';
					document.getElementById('sel_dept').value ='';
				break;
				case "fail":
					failSetCont("data_collectionresp","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("english_as_mediumresp","Fill all fields ...");
	}
}
function internershipRecommendation(){
	var subType = 3;
	var studentName = gtIdVal("internership_recommendation_name");
	var studentRoll = gtIdVal("internership_recommendation_roll");
	var studentYear = gtIdVal("internership_recommendation_year");
	var studentFact = gtIdVal("sel_fac_3");
	var studentDept = gtIdVal("sel_dept_3");
	if (!isEmpty(studentName) && !isEmpty(studentFact) && !isEmpty(studentDept) && !isEmpty(studentRoll) && !isEmpty(studentYear)) {
		var internershipRecommendation = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{internershipRecommendation:internershipRecommendation,studentName:studentName,studentFact:studentFact,studentDept:studentDept,subType:subType,studentRoll:studentRoll,studentYear:studentYear},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("internership_recommendation_resp","Request sent successfull !");

					document.getElementById('internership_recommendation_name').value ='';
					document.getElementById('sel_fac_3').value ='';
					document.getElementById('sel_dept_3').value ='';
					document.getElementById('internership_recommendation_roll').value ='';
					document.getElementById('internership_recommendation_year').value ='';
				break;
				case "fail":
					failSetCont("internership_recommendation_resp","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("internership_recommendation_resp","Fill all fields ...");
	}
}
function migrationForNew(){
	var subType = 4;
	var studentName = gtIdVal("migration_for_new_name");
	var studentRoll = gtIdVal("rollNewSt");
	var studentNationality = gtIdVal("migration_for_new_nationality");
	var studentYear = gtIdVal("migration_for_new_year");

	if (!isEmpty(studentName) && !isEmpty(studentYear) && !isEmpty(studentNationality) && !isEmpty(studentRoll)) {
		var migrationForNew = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{roll:studentRoll,migrationForNew:migrationForNew,studentName:studentName,subType:subType,studentYear:studentYear,studentNationality:studentNationality},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("migration_for_new_resp","Request sent successfull !");

					document.getElementById('migration_for_new_name').value ='';
					document.getElementById('migration_for_new_nationality').value ='';
					document.getElementById('rollNewSt').value ='';
					document.getElementById('migration_for_new_year').value ='';
				break;
				case "fail":
					failSetCont("migration_for_new_resp","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("migration_for_new_resp","Fill all fields ...");
	}
}
function migrationForStudent(){
	var subType = 5;
	var studentName = gtIdVal("migration_for_student_name");
	var studentRoll = gtIdVal("rollStd");
	var studentNationality = gtIdVal("migration_for_student_nationality");
	var studentYear = gtIdVal("migration_for_student_year");

	if (!isEmpty(studentName) && !isEmpty(studentYear) && !isEmpty(studentNationality) && !isEmpty(studentRoll)) {
		var migrationForStudent = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{roll:studentRoll,migrationForStudent:migrationForStudent,studentName:studentName,subType:subType,studentYear:studentYear,studentNationality:studentNationality},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("migration_for_student_resp","Request sent successfull !");

					document.getElementById('migration_for_student_name').value ='';
					document.getElementById('migration_for_student_nationality').value ='';
					document.getElementById('rollStd').value ='';
					document.getElementById('migration_for_student_year').value ='';
				break;
				case "fail":
					failSetCont("migration_for_student_resp","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("migration_for_student_resp","Fill all fields ...");
	}
}
function professionalInternership(){
	var subType = 6;
	var studentName = gtIdVal("professional_internership_name");
	var studentRoll = gtIdVal("professional_internership_roll");
	var studentYear = gtIdVal("professional_internership_year");
	var studentClass = gtIdVal("professional_internership_class");
	var studentFact = gtIdVal("sel_fac_6");
	var studentDept = gtIdVal("sel_dept_6");
	if (!isEmpty(studentName) && !isEmpty(studentFact) && !isEmpty(studentDept) && !isEmpty(studentRoll) && !isEmpty(studentYear) && !isEmpty(studentClass)) {
		var professionalInternership = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{professionalInternership:professionalInternership,studentName:studentName,studentFact:studentFact,studentDept:studentDept,subType:subType,studentRoll:studentRoll,studentYear:studentYear,studentClass:studentClass},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("professional_internership_resp","Request sent successfull !");

					document.getElementById('professional_internership_name').value ='';
					document.getElementById('sel_fac_6').value ='';
					document.getElementById('sel_dept_6').value ='';
					document.getElementById('professional_internership_roll').value ='';
					document.getElementById('professional_internership_year').value ='';
					document.getElementById('professional_internership_class').value ='';
				break;
				case "fail":
					failSetCont("professional_internership_resp","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("professional_internership_resp","Fill all fields ...");
	}
}
function suspensionLetter(){
	var subType = 7;
	var studentName = gtIdVal("suspension_letter_name");
	var studentRoll = gtIdVal("suspension_letter_roll");
	//var studentYear = gtIdVal("professional_internership_year");
	var studentClass = gtIdVal("suspension_letter_class");
	var studentFact = gtIdVal("sel_fac_7");
	var studentDept = gtIdVal("sel_dept_7");
	if (!isEmpty(studentName) && !isEmpty(studentFact) && !isEmpty(studentDept) && !isEmpty(studentRoll) && !isEmpty(studentClass)) {
		var suspensionLetter = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{suspensionLetter:suspensionLetter,studentName:studentName,studentFact:studentFact,studentDept:studentDept,subType:subType,studentRoll:studentRoll,studentClass:studentClass},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("suspension_letter_resp","Request sent successfull !");

					document.getElementById('suspension_letter_name').value ='';
					document.getElementById('sel_fac_7').value ='';
					document.getElementById('sel_dept_7').value ='';
					document.getElementById('suspension_letter_roll').value ='';
					//document.getElementById('professional_internership_year').value ='';
					document.getElementById('suspension_letter_class').value ='';
				break;
				case "fail":
					failSetCont("suspension_letter_resp","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("suspension_letter_resp","Fill all fields ...");
	}
}
function furtherStudies(){
	var subType = 8;
	var studentName = gtIdVal("further_studies_name");
	var studentRoll = gtIdVal("further_studies_roll");
	var studentYear = gtIdVal("further_studies_year");
	var studentClass = gtIdVal("further_studies_class");
	var studentFact = gtIdVal("sel_fac_8");
	var studentDept = gtIdVal("sel_dept_8");
	if (!isEmpty(studentName) && !isEmpty(studentFact) && !isEmpty(studentDept) && !isEmpty(studentRoll) && !isEmpty(studentYear) && !isEmpty(studentClass)) {
		var furtherStudies = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{furtherStudies:furtherStudies,studentName:studentName,studentFact:studentFact,studentDept:studentDept,subType:subType,studentRoll:studentRoll,studentYear:studentYear,studentClass:studentClass},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("further_studies_resp","Request sent successfull !");

					document.getElementById('further_studies_name').value ='';
					document.getElementById('sel_fac_8').value ='';
					document.getElementById('sel_dept_8').value ='';
					document.getElementById('further_studies_roll').value ='';
					document.getElementById('further_studies_year').value ='';
					document.getElementById('further_studies_class').value ='';
				break;
				case "fail":
					failSetCont("further_studies_resp","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("further_studies_resp","Fill all fields ...");
	}
}
function attendanceTestimonial(){
	var subType = 9;
	var studentName = gtIdVal("attendance_testimonial_name");
	var studentRoll = gtIdVal("attendance_testimonial_roll");
	var studentYear = gtIdVal("attendance_testimonial_year");
	var studentClass = gtIdVal("attendance_testimonial_class");
	var studentFact = gtIdVal("sel_fac_9");
	var studentDept = gtIdVal("sel_dept_9");
	if (!isEmpty(studentName) && !isEmpty(studentFact) && !isEmpty(studentDept) && !isEmpty(studentRoll) && !isEmpty(studentYear) && !isEmpty(studentClass)) {
		var attendanceTestimonial = true;
		$.ajax({url:"../js/main.php",
		type:"GET",data:{attendanceTestimonial:attendanceTestimonial,studentName:studentName,studentFact:studentFact,studentDept:studentDept,subType:subType,studentRoll:studentRoll,studentYear:studentYear,studentClass:studentClass},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("attendance_testimonial_resp","Request sent successfull !");

					document.getElementById('attendance_testimonial_name').value ='';
					document.getElementById('sel_fac_9').value ='';
					document.getElementById('sel_dept_9').value ='';
					document.getElementById('attendance_testimonial_roll').value ='';
					document.getElementById('attendance_testimonial_year').value ='';
					document.getElementById('attendance_testimonial_class').value ='';
				break;
				case "fail":
					failSetCont("attendance_testimonial_resp","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("attendance_testimonial_resp","Fill all fields ...");
	}
}
function subStudentReq(){
	var subType = gtIdVal("documents");
	var studentName = gtIdVal("su_std_request_name");
	var studentRoll = gtIdVal("insu_std_request_roll");
	var studentYear = gtIdVal("insu_std_request_year");
	var studentClass = gtIdVal("su_std_request_class");
	var studentFact = gtIdVal("sel_fac_std");
	var studentDept = gtIdVal("sel_dept_std");
	var studentReason= gtIdVal("sub_reason");
	var studentPhone= gtIdVal("sub_phone");
	var studentEmail= gtIdVal("sub_email");
	var studentSection= gtIdVal("std_section");
	if (!isEmpty(studentName) && !isEmpty(studentFact) && !isEmpty(studentDept) && !isEmpty(studentRoll) && !isEmpty(studentYear) && !isEmpty(studentClass)) {
		var subStudentReq = true;
		$.ajax({url:"js/main.php",
		type:"GET",data:{subStudentReq:subStudentReq,studentReason:studentReason,studentPhone:studentPhone,studentEmail:studentEmail,studentSection:studentSection,studentName:studentName,studentFact:studentFact,studentDept:studentDept,subType:subType,studentRoll:studentRoll,studentYear:studentYear,studentClass:studentClass},cache:false,success:function(res){
			switch(res){
				case "success":
					successSetCont("alert","Request sent successfull !");

					document.getElementById('su_std_request_name').value ='';
					document.getElementById('sel_fac_std').value ='';
					document.getElementById('sel_dept_std').value ='';
					document.getElementById('insu_std_request_roll').value ='';
					document.getElementById('insu_std_request_year').value ='';
					document.getElementById('su_std_request_class').value ='';
				break;
				case "fail":
					failSetCont("alert","Submission failed, try again ...");
				break;
				default:
				break
			}
		}
		});
	}else{
		failSetCont("alert","Fill all fields ...");
	}
}
function financeApproveDerogation(){
		$.ajax({url:"js/main.php",
		type:"GET",data:{derogation:derogation,roll:roll},cache:false,success:function(res){
		}
		});
}