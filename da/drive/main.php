<?php
function split_name($name) {	//SEPARATE FNAME,LANME FROM NAME
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
    return array($first_name, $last_name);
}
function marks_grading($mark){
	$grade = '';
	switch ($mark) {
		case ($mark < 100.01) && ($mark>=80):
			$grade = "A";
			break;
		case ($mark<80) && ($mark>=70):
			$grade = "B";
			break;
		case ($mark<70) && ($mark>=60):
			$grade = "C";
			break;
		case ($mark<60) && ($mark>=50):
			$grade = "D";
			break;
		case ($mark<50) && ($mark>=0):
			$grade = "E";
			break;
		
		default:
			$grade = "-";
			break;
	}
			return $grade;
}
function marks_grading_distanction($mark){
	$grade = '';
	switch ($mark) {
		case ($mark < 100.01) && ($mark>=80):
			$grade = "First Class Honours";
			break;
		case ($mark<80) && ($mark>=70):
			$grade = "Second Class Honours, Upper Division";
			break;
		case ($mark<70) && ($mark>=60):
			$grade = "Second Class Honours,  Lower Division";
			break;
		case ($mark<60) && ($mark>=50):
			$grade = "Second Class Honours, Lower Division";
			break;
		case ($mark<50) && ($mark>=0):
			$grade = "Fail";
			break;
		
		default:
			$grade = "-";
			break;
	}
			return $grade;
}
function deliberation_decision($mark,$pass){
	$decision = '';
	switch ($mark) {
		case ($pass<=$mark):
			$decision = "Promoted";
			break;
		default:
			$decision = "Repeat Modules";
			break;
	}
	return $decision;
}

function select_last_level($student,$conn){
	$sel_last = $conn->prepare("SELECT * FROM Module,ModuleMark,ProgramModule,ModuleLevels,Student WHERE Student.StudentID=? AND ModuleMark.StudentID=Student.StudentID AND ModuleMark.ProgramModuleID=ProgramModule.ProgramModuleID AND ProgramModule.ModuleID=Module.ModuleID AND ModuleLevels.LevelModule=Module.ModuleID AND ModuleMark.IsPublished=1 ORDER BY ModuleLevels.LevelName DESC");
	$sel_last->bindValue(1,$student);
	$sel_last->execute();
	if ($sel_last->rowCount()!=1) {
		$ft_sel_last = $sel_last->fetch(PDO::FETCH_ASSOC);
		$last = $ft_sel_last['LevelName'];
	}else{
		$last = "-";
	}
	return $last;
}

function select_modules_units($conn,$module_id,$credits){
	//============================= SELECING UNITS IN MODULES
        $sel_units = $conn->prepare("SELECT * FROM Unit WHERE Unit.ModuleID=?");
        $sel_units->bindValue(1,$module_id);
        $sel_units->execute();
        if ($sel_units->rowCount()!=0) {
        	while ($ft_sel_units = $sel_units->fetch(PDO::FETCH_ASSOC)) {
        		$credits += $ft_sel_units['TotalCredit'];
        		echo "<li>".$ft_sel_units['Unit']."</li>";
        	}
        }
}


?>