<?php

  class query
  {
    function __construct() {
       
       include('connect.php');
   }
	
	public function checklogin($username,$password)
	{
		$sql="SELECT * from user where password='{$password}' and username='{$username}'";
		$result=mysql_query($sql);
		
		
		if(!empty($result))
		{
			if(mysql_num_rows($result)>0)
			{
				$response['status']="success";
				echo json_encode($response);
				
			}
			else
			{
				$response['status']="fail";
				echo json_encode($response);
			}
			
		}
	}
	
	public function get_prescription($username)
	{
		//$sql="SELECT * from prescription where username='{$username}'";
		$sql_user="SELECT * from user where username='{$username}'";
					$result_user=mysql_query($sql_user);
					if(mysql_num_rows($result_user)>0)
					{
					 while ($row = mysql_fetch_array($result_user)) {
					         
					         $user_id=$row['id'];
					   }
					}
					
		$sql="SELECT * FROM prescription WHERE prescription.u_id='{$user_id}'";
		$result=mysql_query($sql);
		// AND prescription.u_id='{$user_id}'
		
		if(!empty($result))
		{
			if(mysql_num_rows($result)>0)
			{
			
				$response['prescription']=array();
			    while ($row = mysql_fetch_array($result)) {
					$prescription=array();
					$prescription['p_id']=$row['id'];
					$prescription['date']=$row['date'];
					$prescription['doc_sig']=$row['doc_sig'];
					$prescription['date']=$row['date'];
					$prescription['disease']=$row['disease'];
					$prescription['suggestion']=$row['suggestion'];
					
					//$prescription['dose_quantity']=$row['dose_quantity'];
					//$prescription['dose_rate']=$row['dose_rate'];
					//$prescription['course_time']=$row['course_time'];
					//$prescription['refill']=$row['refill'];
					//$prescription['doc_sig']=$row['doc_sig'];
					//$book['due_date']=$row['due_date'];
					//$sql_doctor="SELECT * from doctor where id='{$doctor_id}'";
					//$result_doctor=mysql_query($sql_doctor);
					//if(mysql_num_rows($result_doctor)>0)
					//{
					 //while ($row = mysql_fetch_array($result_doctor)) {
					         
					   //      $prescription['doctor_name']=$row['name'];
					   //}
					//}
		            //$sql_hospital="SELECT * from hospital where id='{$hospital_id}'";
					//$result_hospital=mysql_query($sql_hospital);
					//if(mysql_num_rows($result_hospital)>0)
					//{
					 //while ($row = mysql_fetch_array($result_hospital)) {
					
					    //     $prescription['hospital_name']=$row['h_name'];
					  // }
					array_push($response['prescription'], $prescription);
					}
					echo json_encode($response);
					
				}
				
			
			}
				
		}
	
	///////////////////////////////////////////////////////////////////
	public function get_report($p_id)
	{
		$sql="SELECT * from reports where p_id='{$p_id}'";
		$result=mysql_query($sql);
		
		
		if(!empty($result))
		{
			if(mysql_num_rows($result)>0)
			{
				$response['report']=array();
			    while ($row = mysql_fetch_array($result)) {
					$report=array();
					$report['p_id']=$row['p_id'];
					$report['date']=$row['date'];
					$report['pdf']=$row['pdf'];
					
					array_push($response['report'], $report);
				}
				
				echo json_encode($response);
			}
			
		}
	}
	
	///////////////////////////////////////////////////////////////////
	public function get_medicine($prescription_id)
	{
		            $sql_medicine="SELECT * from pres_medication where p_id='{$prescription_id}'";
					$result_medicine=mysql_query($sql_medicine);
					
		if(!empty($result_medicine))
		    {
			
        		if(mysql_num_rows($result_medicine)>0)
					{
					$response['medicine']=array();
					 while ($row = mysql_fetch_array($result_medicine)) {
	             			
					
					         $medicine['med_name']=$row['med_name'];
							 $medicine['regulation']=$row['regulation'];
							 $medicine['details']=$row['details'];
							 $medicine['dose']=$row['dose'];
							 
							 array_push($response['medicine'], $medicine);
					   }
					   echo json_encode($response);
					}
		        }			
					
		    }
				public function get_hospital()
            	{
		            $sql="SELECT * from hospital";
					$result=mysql_query($sql);
				if(!empty($result))
				{
					if(mysql_num_rows($result)>0)
					{
					$response['hospital']=array();
					 while ($row = mysql_fetch_array($result)) {
	             			
					         $hospital['id']=$row['id'];
					         $hospital['h_name']=$row['h_name'];
							 $hospital['address']=$row['address'];
							 //$hospital['longitude']=$row['longitude'];
							 //$hospital['landitude']=$row['landitude'];
							 
							 $hospital['email']=$row['email'];
							 $hospital['details']=$row['details'];
							 $hospital['phone_no']=$row['phone_no'];
							 $hospital['website']=$row['website'];
							 $hospital['emergency_no']=$row['emergency_no'];
							 $hospital['ambulance']=$row['ambulance'];
							 
							 array_push($response['hospital'], $hospital);
					   }
					   echo json_encode($response);
					}
					
				}
			}
				public function get_all_doctor()
             	{
		            $sql="SELECT * from doctor";
					$result=mysql_query($sql);
            if(!empty($result))
               {			
				if(mysql_num_rows($result)>0)
					{
					$response['doctor']=array();
					 while ($row = mysql_fetch_array($result)) {
	             			
					         $doctor['id']=$row['id'];
					         $doctor['name']=$row['name'];
							 $doctor['specialist']=$row['specialist'];
							 $doctor['email']=$row['email'];
							 $doctor['phone_no']=$row['phone_no'];
							 $doctor['address']=$row['address'];
							 //$doctor['course_time']=$row['course_time'];
							 //$doctor['dose_quantity']=$row['dose_quantity'];
							 //$doctor['refill']=$row['refill'];
							 
							 array_push($response['doctor'], $doctor);
					   }
					   echo json_encode($response);
					}
					
				}	
			}
			public function get_all_doc_hospital($h_id)
			{
			$sql="SELECT doctor.id AS d_id,doctor.name AS d_name,doctor.specialist AS d_specialist
			FROM hospital_doc_dept,doctor WHERE hospital_doc_dept.d_id=doctor.id 
			AND hospital_doc_dept.approve=1 AND hospital_doc_dept.h_id=".$h_id;
					$result=mysql_query($sql);
					if(!empty($result))
                    {			
			
					if(mysql_num_rows($result)>0)
					{
					//$response['hospital']=array();
					$response['doctor']=array();
					 while ($row = mysql_fetch_array($result)) {
	             			$doctor['h_id']=$h_id;
					         $doctor['id']=$row['d_id'];
					         $doctor['name']=$row['d_name'];
							 $doctor['specialist']=$row['d_specialist'];
							 //$doctor['email']=$row['email'];
							 //$doctor['phone_no']=$row['phone_no'];
							 //$doctor['address']=$row['address'];
							 //$doctor['course_time']=$row['course_time'];
							 //$doctor['dose_quantity']=$row['dose_quantity'];
							 //$doctor['refill']=$row['refill'];
							 
							 array_push($response['doctor'], $doctor);
					   }
					echo json_encode($response);
					}
				}	
			
			}
			public function appointment_request($d_id,$h_id,$u_id,$description,$invoice_no,$bkash_no,$date)
			{
			if(mysql_query("insert into appointments(d_id,h_id,u_id,description,invoice_no,bkash_no,date)
			values('{$d_id}','{$h_id}','{$u_id}','{$description}','{$invoice_no}','{$bkash_no}','{$date}')")){		
			$response['status']="success";
			echo json_encode($response);	
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}	
	
			}
			public function get_doc_hospital($dept_id,$h_id)
			{
			$sql="SELECT doctor.id AS d_id,doctor.name AS d_name,doctor.specialist AS d_specialist
			FROM hospital_doc_dept,doctor WHERE hospital_doc_dept.d_id=doctor.id 
			AND hospital_doc_dept.approve=1 AND hospital_doc_dept.dept_id=".$dept_id." AND hospital_doc_dept.h_id=".$h_id;
					$result=mysql_query($sql);
					if(!empty($result))
                    {			
			
					if(mysql_num_rows($result)>0)
					{
					//$response['hospital']=array();
					$response['doctor']=array();
					 while ($row = mysql_fetch_array($result)) {
	             			$doctor['h_id']=$h_id;
					         $doctor['id']=$row['d_id'];
					         $doctor['name']=$row['d_name'];
							 $doctor['specialist']=$row['d_specialist'];
							 //$doctor['email']=$row['email'];
							 //$doctor['phone_no']=$row['phone_no'];
							 //$doctor['address']=$row['address'];
							 //$doctor['course_time']=$row['course_time'];
							 //$doctor['dose_quantity']=$row['dose_quantity'];
							 //$doctor['refill']=$row['refill'];
							 
							 array_push($response['doctor'], $doctor);
					   }
					echo json_encode($response);
					}
				}	
			
			}
			
			public function get_dept_hospital($dept_id)
			{
			$sql="SELECT hospital.id AS h_id,hospital.h_name AS h_name,hospital.address AS h_address,
			hospital_doc_dept.dept_id AS dept_id 
			FROM hospital_doc_dept,hospital WHERE hospital_doc_dept.h_id=hospital.id 
			AND hospital_doc_dept.approve=1 AND hospital_doc_dept.dept_id=".$dept_id;
					$result=mysql_query($sql);
					if(!empty($result))
                    {			
			
					if(mysql_num_rows($result)>0)
					{
					$response['hospital']=array();
					 while ($row = mysql_fetch_array($result)) {
	             			
					         $hospital['h_id']=$row['h_id'];
					         $hospital['h_name']=$row['h_name'];
							 $hospital['address']=$row['h_address'];
							 //$hospital['longitude']=$row['longitude'];
							 //$hospital['landitude']=$row['landitude'];
							 
							 $hospital['dept_id']=$row['dept_id'];
							 //$hospital['details']=$row['details'];
							 //$hospital['phone_no']=$row['phone_no'];
							 //$hospital['website']=$row['website'];
							 //$hospital['emergency_no']=$row['emergency_no'];
							 //$hospital['ambulance']=$row['ambulance'];
							 
							 array_push($response['hospital'], $hospital);
					   }
				   echo json_encode($response);
					}
				}	
			
			}
				public function get_all_department()
				{
				$sql="SELECT * from departments";
					$result=mysql_query($sql);
			if(!empty($result))
               {			
			
					if(mysql_num_rows($result)>0)
					{
					$response['department']=array();
					 while ($row = mysql_fetch_array($result)) {
	             			
					         $department['id']=$row['id'];
					         $department['department_name']=$row['department_name'];
							 $department['details']=$row['details'];
							// $doctor['email']=$row['disease'];
							 //$doctor['phone_no']=$row['dose'];
							 //$doctor['address']=$row['dose_route'];
							 //$doctor['course_time']=$row['course_time'];
							 //$doctor['dose_quantity']=$row['dose_quantity'];
							 //$doctor['refill']=$row['refill'];
							 
							 array_push($response['department'], $department);
					   }
					   echo json_encode($response);
					}
				}	
			}
	public function admin($username,$password)
	{
		if(mysql_query("insert into admin values('','{$username}','{$password}')")){		
			$response['status']="success";
			echo json_encode($response);	
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}	
	
	}
	
	/*
	public function add_debt($user_mail,$name,$amount,$interest,$type,$due_date)
	{
		if(mysql_query("insert into debt values('','{$user_mail}','{$name}','{$amount}','{$interest}','{$type}',CURRENT_TIMESTAMP,'{$due_date}')")){		
			$response['status']="success";
			echo json_encode($response);
			
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}	
	
	}
	
	
	public function get_expense($email)
	{
		$sql="SELECT * from expense where user_mail='{$email}'";
		$result=mysql_query($sql);
		
		
		if(!empty($result))
		{
			if(mysql_num_rows($result)>0)
			{
				$response['yourarray']=array();
			    while ($row = mysql_fetch_array($result)) {
					$book=array();
					$book['ex_id']=$row['ex_id'];
					$book['user_mail']=$row['user_mail'];
					$book['source']=$row['source'];
					$book['amount']=$row['amount'];
					$book['type']=$row['type'];
					$book['date']=$row['date'];
					
					array_push($response['yourarray'], $book);
				}
				
				echo json_encode($response);
			}
			
		}
	}
	
	
	public function add_expense($user_mail,$source,$amount,$type)
	{
		if(mysql_query("insert into expense values('','{$user_mail}','{$source}','{$amount}','{$type}',CURRENT_TIMESTAMP)")){		
			$response['status']="success";
			echo json_encode($response);
			
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}	
	
	}
	
	
	
	public function get_income($email)
	{
		$sql="SELECT * from income where user_mail='{$email}'";
		$result=mysql_query($sql);
		
		
		if(!empty($result))
		{
			if(mysql_num_rows($result)>0)
			{
				$response['yourarray']=array();
			    while ($row = mysql_fetch_array($result)) {
					$book=array();
					$book['in_id']=$row['in_id'];
					$book['user_mail']=$row['user_mail'];
					$book['source']=$row['source'];
					$book['amount']=$row['amount'];
					$book['type']=$row['type'];
					$book['date']=$row['date'];
					
					array_push($response['yourarray'], $book);
				}
				
				echo json_encode($response);
			}
			
		}
	}
	
	
	public function add_income($user_mail,$source,$amount,$type)
	{
		if(mysql_query("insert into income values('','{$user_mail}','{$source}','{$amount}','{$type}',CURRENT_TIMESTAMP)")){		
			$response['status']="success";
			echo json_encode($response);
			
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}	
	
	}
	
	
	public function delete_debt_by_id($id)
	{
		if(mysql_query("delete from debt where debt_id='{$id}'")){		
			$response['status']="success";
			echo json_encode($response);
			
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}

	}
	
	
	public function delete_debt_by_mail($email)
	{
		if(mysql_query("delete from debt where user_mail='{$email}'")){		
			$response['status']="success";
			echo json_encode($response);
			
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}

	}
	
	
	public function delete_expense_by_id($id)
	{
		if(mysql_query("delete from expense where ex_id='{$id}'")){		
			$response['status']="success";
			echo json_encode($response);
			
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}

	}
	
	
	public function delete_expense_by_mail($email)
	{
		if(mysql_query("delete from expense where user_mail='{$email}'")){		
			$response['status']="success";
			echo json_encode($response);
			
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}

	}
	
	
	
	public function delete_income_by_id($id)
	{
		if(mysql_query("delete from income where in_id='{$id}'")){		
			$response['status']="success";
			echo json_encode($response);
			
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}

	}
	
	
	public function delete_income_by_mail($email)
	{
		if(mysql_query("delete from income where user_mail='{$email}'")){		
			$response['status']="success";
			echo json_encode($response);
			
		}
		else 
		{
			$response['status']="fail";
			echo json_encode($response);
		}

	}
	
	*/
  }

?>
