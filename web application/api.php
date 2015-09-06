<?php

include('querytest.php');

$array = explode('/', $_SERVER['REQUEST_URI']);
//////////////////////////////////////////RoadMap/////////////////////////////////////////////////////
/*if($array[2]=="getbus")
{
    
	$test= new query;
	$test->getbus();
}


else if($array[2]=="route")
{
	$source=$array[3];
	$destination=$array[4];
	$test= new query;
	$test->get_long_lat($source,$destination);
}
else if($array[2]=="bus")
{
    $name=$array[3];
	$test= new query;
	$test->get_bus_route($name);
}
else if($array[2]=="destination")
{
$destination=$array[3];
	$test= new query;
	$test->get_destination($destination);
}
else if($array[2]=="getsomebuses")
{
$source=$array[3];
	$destination=$array[4];
	$test= new query;
	$test->get_some_buses($source,$destination);
}
*/
////////////////////////////////////////////////////////////////CARE 24 ///////////////////////////////////////////


if($array[2]=="get_dept_hospital")
{
$dept_id=$array[3];
	$test= new query;
	$test->get_dept_hospital($dept_id);

}
else if($array[2]=="get_all_doc_hospital")
{
$hos_id=$array[3];
	$test= new query;
	$test->get_all_doc_hospital($hos_id);

}

else if($array[2]=="get_doc_hospital")
{
$dept_id=$array[3];

$h_id=$array[4];
	$test= new query;
	$test->get_doc_hospital($dept_id,$h_id);

}
else if($array[2]=="login")
{
    $user_name=$array[3];
	$pass=$array[4];
	$test= new query;
	$test->checklogin($user_name,$pass);
}


else if($array[2]=="prescription")
{
	$username=$array[3];
	$test= new query;
	$test->get_prescription($username);
	
}

else if($array[2]=="report")
{
	$p_id=$array[3];
	$test= new query;
	$test->get_report($p_id);
}

else if($array[2]=="medicine")
{
	$pres_id=$array[3];
	$test= new query;
	$test->get_medicine($pres_id);
}
else if($array[2]=="hospital")
{
	
	$test= new query;
	$test->get_hospital();
}
else if($array[2]=="doctor_list")
{
	
	$test= new query;
	$test->get_all_doctor();
}
else if($array[2]=="department_list")
{
	
	$test= new query;
	$test->get_all_department();
}

else if($_POST['tag']=="admin")
{
	$username = $_POST['username'];
    $password = $_POST['password'];
	//$amount=$array[5];
	//$interest=$array[6];
	//$type=$array[7];
	//$due_date=$array[8];
	$test= new query;
	$test->admin($username,$password);
}
else if($_POST['tag']=="appointment_request")
{
	$d_id = $_POST['d_id'];
    $h_id = $_POST['h_id'];
	$u_id = $_POST['u_id'];
    $description = $_POST['description'];
	$invoice_no = $_POST['invoice_no'];
	$bkash_no = $_POST['bkash_no'];
	$date = $_POST['date'];
	
	$test= new query;
	$test->appointment_request($d_id,$h_id,$u_id,$description,$invoice_no,$bkash_no,$date);
}

///////////////////////////////////////////////////////////////

/*
else if($array[2]=="adddebt")
{
	$user_mail=$array[3];
	$name=$array[4];
	$amount=$array[5];
	$interest=$array[6];
	$type=$array[7];
	$due_date=$array[8];
	$test= new query;
	$test->add_debt($user_mail,$name,$amount,$interest,$type,$due_date);
}


else if($array[2]=="deletedebt_id")
{
	$id=$array[3];
	$test= new query;
	$test->delete_debt_by_id($id);
}


else if($array[2]=="deletedebt_mail")
{
	$email=$array[3];
	$test= new query;
	$test->delete_debt_by_mail($email);
}


else if($array[2]=="expense")
{
	$email=$array[3];
	$test= new query;
	$test->get_expense($email);
}

else if($array[2]=="addexpense")
{
	$user_mail=$array[3];
	$source=$array[4];
	$amount=$array[5];
	$type=$array[6];
	$test= new query;
	$test->add_expense($user_mail,$source,$amount,$type);
}


else if($array[2]=="deleteexpense_id")
{
	$id=$array[3];
	$test= new query;
	$test->delete_expense_by_id($id);
}


else if($array[2]=="deleteexpense_mail")
{
	$email=$array[3];
	$test= new query;
	$test->delete_expense_by_mail($email);
}




else if($array[2]=="income")
{
	$email=$array[3];
	$test= new query;
	$test->get_income($email);
}

else if($array[2]=="addincome")
{
	$user_mail=$array[3];
	$source=$array[4];
	$amount=$array[5];
	$type=$array[6];
	$test= new query;
	$test->add_income($user_mail,$source,$amount,$type);
}


else if($array[2]=="deleteincome_id")
{
	$id=$array[3];
	$test= new query;
	$test->delete_income_by_id($id);
}


else if($array[2]=="deleteincome_mail")
{
	$email=$array[3];
	$test= new query;
	$test->delete_income_by_mail($email);
}
*/


?>
