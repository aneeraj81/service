<?php
 session_start();
 include("../connection.php");
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER["DOCUMENT_ROOT"]."/service/connection.php");
include($_SERVER["DOCUMENT_ROOT"]."/service/sqlconnection.php");*/

    $q=$_GET["user_id"];
    $inst_id=$_GET["inst_id"];
    
    $veh_reg=$_GET["veh_reg"];
    $row_id=$_GET["row_id"];
    $comment=addslashes($_GET["comment"]);
    $_GET['action'];
  

if(isset($_GET['action']) && $_GET['action']=='deactivateaccountbackComment')
{
    
        $query = "SELECT forward_back_comment FROM deactivation_of_account  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update deactivation_of_account set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='deletefromdebtorsbackComment')
{
    
        $query = "SELECT forward_back_comment FROM del_form_debtors  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update del_form_debtors set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='devicechangebackComment')
{
    
        $query = "SELECT forward_back_comment FROM device_change  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update device_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='newdeviceadditionbackComment')
{
    
        $query = "SELECT forward_back_comment FROM new_device_addition  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update new_device_addition set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='vehiclenochangebackComment')
{
    
        $query = "SELECT forward_back_comment FROM vehicle_no_change  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update vehicle_no_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='DeviceChangeAddComment')
{
 
     $query = "SELECT service_support_com FROM device_change  where id=".$row_id;
  $row=select_query($query);

   $Updateapprovestatus="update device_change set service_support_com='".$row[0]["service_support_com"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."', device_change_status='1' where id=".$row_id;
  if(mysql_query($Updateapprovestatus))
 echo "Comment added Successfully";
}

 if(isset($_GET['action']) && $_GET['action']=='deletevehiclebackComment')
{
    
        $query = "SELECT forward_back_comment FROM deletion  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update deletion set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='deactivatesimbackComment')
{
    
        $query = "SELECT forward_back_comment FROM deactivate_sim  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update deactivate_sim set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='aacountcreationbackComment')
{
    
        $query = "SELECT forward_back_comment FROM new_account_creation  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update new_account_creation set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='stopgpsbackComment')
{
    
     $query = "SELECT forward_back_comment FROM stop_gps  where id=".$row_id;
     $row=select_query($query);

    $Updateapprovestatus="update stop_gps set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='startgpsbackComment')
{
    
     $query = "SELECT forward_back_comment FROM start_gps  where id=".$row_id;
     $row=select_query($query);

    $Updateapprovestatus="update start_gps set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."' where id=".$row_id;
    
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='discountbackComment')
{
    
     $query = "SELECT forward_back_comment FROM discount_details  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update discount_details set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - ".$comment."' where id=".$row_id;
    
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='nobillbackComment')
{
    
    $query = "SELECT forward_back_comment FROM no_bills  where id=".$row_id;
    $row=select_query($query);
    
    $Updateapprovestatus="update no_bills set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    mysql_query($Updateapprovestatus);
}


if(isset($_GET['action']) && $_GET['action']=='transferthevehiclebackComment')
{
    
        $query = "SELECT forward_back_comment FROM transfer_the_vehicle  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update transfer_the_vehicle set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='ffcDeviceConfirmation')
{
     
     $query_inv = select_query_inventory("select distinct(device.device_imei), device_repair.client_name, device.recd_date, device.device_id, 
  DATEDIFF(MONTH, device.recd_date, GETDATE()) as age from inventory.device join inventory.device_repair on 
  device.device_id=device_repair.device_id where is_permanent=1 and device_repair.current_record=1 and device.device_id='".$row_id."'");
     
     $device_warranty = select_query_live_con("SELECT sys_added_date,TIMESTAMPDIFF(DAY, sys_added_date, NOW()) as age, veh_reg, imei, 
      sys_group_id,NAME FROM matrix.group_services 
      LEFT JOIN  matrix.services ON group_services.sys_service_id=services.id
      LEFT JOIN matrix.`group` ON `group`.id=group_services.sys_group_id
      LEFT JOIN  matrix.devices ON services.sys_device_id = devices.id
      WHERE devices.imei ='".$query_inv[0]['device_imei']."' AND sys_parent_group_id=1 AND sys_group_id!=1998 LIMIT 0,1");
     //$device_warranty = mysql_fetch_assoc($device_query);
    
     select_query_inventory("insert into inventory.device_replace_ffc(old_client_name, imei_no, old_veh, ffc_date, imei_old_installtion_date) 
     values('".$query['client_name']."','".$query['device_imei']."','".$device_warranty[0]['veh_reg']."','".date("Y-m-d H:i:s")."','".$device_warranty[0]['sys_added_date']."')");
     
     $Updateapprovestatus="update inventory.device set is_ffc='1',device_status='69' where device_id=".$row_id;
     select_query_inventory($Updateapprovestatus);

	 /*mssql_query("insert into device_replace_ffc(old_client_name, imei_no, old_veh, ffc_date, imei_old_installtion_date) 
     values('".$query['client_name']."','".$query['device_imei']."','".$device_warranty[0]['veh_reg']."','".date("Y-m-d H:i:s")."','".$device_warranty[0]['sys_added_date']."')");
     
     $Updateapprovestatus="update device set is_ffc='1',device_status='69' where device_id=".$row_id;
     mssql_query($Updateapprovestatus);*/
        
 }
 
if(isset($_GET['action']) && $_GET['action']=='TemptoPermanentConfirmation')
{
      $imei_no=$_GET["imei"];
     if($_SESSION['BranchId']!="")
     { 
        $Updatepermanent="update services set temp_to_permanent='Temporary To Permanent', temp_permnt_date='".date("Y-m-d H:i:s")."' where id=".$row_id;
         mysql_query($Updatepermanent);
        
		$Updateapprovestatus = "update inventory.device set is_permanent='1', dispatch_branch='".$_SESSION['BranchId']."' where device_imei='".trim($imei_no)."'";
        select_query_inventory($Updateapprovestatus);

        /*$Updateapprovestatus = "update device set is_permanent='1', dispatch_branch='".$_SESSION['BranchId']."' where device_imei='".trim($imei_no)."'";
        mssql_query($Updateapprovestatus);*/
        
		echo "Successfully Update";

        /*$total = mssql_query("Select * from device_repair where device_imei='".$imei_no."'"); 
        $total_count = mssql_num_rows($total);
        
        if($total_count == 0)
        {        
            $query= mysql_fetch_array(mysql_query("SELECT * FROM services WHERE id='".$row_id."'"));
            
            $device_id =mssql_fetch_array(mssql_query("Select device_id from device where device_imei='".$imei_no."'"));
            
            mssql_query("insert into device_repair(device_id, client_name,device_imei,veh_no, device_removed_date,device_removed_branch, device_removed_problem,current_record,device_status, Remove_installer_name) values('".$device_id['device_id']."','".$query['name']."','".$query['device_imei']."','".$query['veh_reg']."','".$query['close_date']."','".$_SESSION['BranchId']."','".$query['reason']."','1','66','".$query['inst_name']."')");
        }*/
     }
    
 }

if(isset($_GET['action']) && $_GET['action']=='read_temp_request')
{
    $Updateapprovestatus="update services set read_unread_status='1' where id=".$row_id;
    mysql_query($Updateapprovestatus);    
    //echo "Successfully Read";
}    

/*
if(isset($_GET['action']) && $_GET['action']=='simchangebackComment')
{
    
        $query = "SELECT forward_back_comment FROM sim_change  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update sim_change set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='devicelostbackComment')
{
    
        $query = "SELECT forward_back_comment FROM device_lost  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update device_lost set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}

if(isset($_GET['action']) && $_GET['action']=='dimtsimeibackComment')
{
    
        $query = "SELECT forward_back_comment FROM dimts_imei  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update dimts_imei set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='subusercreationbackComment')
{
    
        $query = "SELECT forward_back_comment FROM sub_user_creation  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update sub_user_creation set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}


if(isset($_GET['action']) && $_GET['action']=='nobillbackComment')
{
    
        $query = "SELECT forward_back_comment FROM no_bills  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update no_bills set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='discountingbackComment')
{
    
        $query = "SELECT forward_back_comment FROM discounting  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update discounting set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}
if(isset($_GET['action']) && $_GET['action']=='softwarerequestbackComment')
{
    
        $query = "SELECT forward_back_comment FROM software_request  where id=".$row_id;
     $row=select_query($query);

      
    $Updateapprovestatus="update software_request set forward_back_comment='".$row[0]["forward_back_comment"]."<br/>".date("Y-m-d")." - " .$comment."' where id=".$row_id;
    
    
    //$Updateapprovestatus="update stop_gps set admin_comment='".$comment."' where id=".$row_id;
    if(mysql_query($Updateapprovestatus))
    echo "Comment added Successfully";
}*/