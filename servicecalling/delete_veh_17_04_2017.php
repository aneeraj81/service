<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');

/*include($_SERVER['DOCUMENT_ROOT']."/service/include/header.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/service/include/leftmenu.php");*/

$action=$_GET['action'];
$id=$_GET['id'];
$page=$_POST['page'];
if($action=='edit' or $action=='editp')
    {
        $result=mysql_fetch_array(mysql_query("select * from deletion where id=$id"));    
    }
?> 

<div class="top-bar">
    <h1>Delete Vehicle </h1>
</div>
<div class="table"> 
 

<?php


if(isset($_POST["submit"]))
{ 
  
    $date = date("Y-m-d H:m:s");
    $acc_manager = $_SESSION['username'];
    $client=$_POST["company"];
    $user_id=$_POST["main_user_id"];
    
    $veh_reg=$_POST["veh_reg"];
    $device_model=$_POST["Device_model"];
    $imei_no = str_replace("_","",$_POST["TxtDeviceIMEI"]);
    $device_imei= str_replace(" ","",$imei_no);
    $Devicemobile=$_POST["Devicemobile"]; 
    $date_of_install=$_POST["date_of_install"];   
    
    $device_status=$_POST["device_status"]; 
    if($device_status == "Sold Vehicle" || $device_status == "Vehicle Stand For Long Time" || $device_status == "Stop GPS" || $device_status == "Device Lost" || $device_status == "Device Dead" || $device_status == "Buy Back" || $device_status == "Device Removed Against Non-Payment" || $device_status == "Account Deactivate Against Non-Payment" )
    { 
        $Txt_location=(isset($_POST["gtrac_location"])) ? trim($_POST["gtrac_location"]): ""; 
    }
    elseif($device_status == "Physical Damage" || $device_status == "Vehicle Theft" || $device_status == "Sold Vehicle With Device" || $device_status == "Other(Device Not In Existence)")
    {
        $Txt_location=(isset($_POST["Txt_location"])) ? trim($_POST["Txt_location"]): ""; 
    }
    //$Txt_contactperson=$_POST["Txt_contactperson"];   
    $DeactiveSim=$_POST["DeactiveSim"];   
    
    $TxtReason=$_POST["TxtReason"];
    $Txtrdd_date=$_POST["rdd_date"];
    $service_comment=$_POST["service_comment"];
    $sales_manager=$_POST["sales_manager"];  

   //$payment_status=$_POST["payment_status"];

    if($veh_reg=="") {
        $veh_reg_edit=$result['reg_no'];
    }
    else {
        $veh_reg_edit=$veh_reg;
    }

 
  if($action=='edit')
    {
    
         $query="update deletion set sales_manager='".$sales_manager."',client='".$client."',user_id='".$user_id."',device_model='".trim($device_model)."',reg_no='".$veh_reg_edit."',device_sim_no='".$Devicemobile."',imei='".trim($device_imei)."',date_of_installation='".$date_of_install."',vehicle_location='".$Txt_location."',device_status='".$device_status."',deactivation_of_sim='".$DeactiveSim."',deletion_date='".$Txtrdd_date."',reason='".$TxtReason."',service_comment='".$result["service_comment"]."<br/>".date("Y-m-d H:i:s")." - " .$service_comment."',delete_veh_status=1 where id=$id";
         
        mysql_query($query);
        echo "<script>document.location.href ='list_delete_vehicle.php'</script>";
    }

 else {
 
           $query="INSERT INTO `deletion` (`date`,acc_manager, `sales_manager`, `client`, `user_id`, `device_model`, `reg_no`, `imei`, `device_sim_no`, `date_of_installation`, `vehicle_location`, `device_status`, `deactivation_of_sim`, `deletion_date`, `reason`) VALUES ('".$date."','".$acc_manager."','".$sales_manager."','".$client."','".$user_id."','".$device_model."','".$veh_reg."','".trim($device_imei)."','".$Devicemobile."','".$date_of_install."','".$Txt_location."','".$device_status."','".$DeactiveSim."','".$Txtrdd_date."','".$TxtReason."')";
           
        mysql_query($query);
        echo "<script>document.location.href ='list_delete_vehicle.php'</script>";
    }

}
?>

 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(function() {
$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });

$( "#datepickercheque" ).datepicker({ dateFormat: "yy-mm-dd" });

});
      
      
function validateForm()
{
     
  if(document.myForm.sales_manager.value=="")
  {
  alert("please Select Sales Manager Name") ;
  return false;
  }  
  if(document.myForm.TxtMainUserId.value=="")
  {
  alert("please choose Client Name") ;
  document.myForm.TxtMainUserId.focus();
  return false;
  }  
  if(document.myForm.Device_model.value=="")
  {
  alert("please Enter Model") ;
  document.myForm.Device_model.focus();
  return false;
  }  
  if(document.myForm.device_status.value=="")
  {
  alert("please Select Device Status") ;
  document.myForm.device_status.focus();
  return false;
  }
  var device_status = document.myForm.device_status.value;
  if(device_status=="Sold Vehicle" || device_status=="Vehicle Stand For Long Time" || device_status=="Stop GPS" || device_status=="Device Lost" || device_status=="Device Dead"  || device_status=="Buy Back" || device_status=="Device Removed Against Non-Payment" || device_status=="Account Deactivate Against Non-Payment")
  {
      if(document.myForm.gtrac_location.value=="")
      {
      alert("please Select Location") ;
      document.myForm.gtrac_location.focus();
      return false;
      }
  }
  if(device_status=="Physical Damage" || device_status=="Vehicle Theft" || device_status=="Sold Vehicle With Device" || device_status=="Other(Device Not In Existence)")
  {
      if(document.myForm.Txt_location.value=="")
      {
      alert("please Select Location") ;
      document.myForm.Txt_location.focus();
      return false;
      }
  }
  /*if(document.myForm.Txt_contactperson.value=="")
  {
  alert("please Enter Contact Person") ;
  document.myForm.Txt_contactperson.focus();
  return false;
  }*/
  
    var DeactiveSim = document.myForm.DeactiveSim[0].checked;
    var DeactiveSim1 = document.myForm.DeactiveSim[1].checked;
    if(DeactiveSim  == false && DeactiveSim1  == false)
    {
     alert("please Select Deactivation of SIM");
     return false;
    }

    if(document.myForm.rdd_date.value=="")
    {
      alert("please Enter Date") ;
      document.myForm.rdd_date.focus();
      return false;
      }
    if(document.myForm.TxtReason.value=="")
    {
      alert("please Enter Reason") ;
      document.myForm.TxtReason.focus();
      return false;
    }
    if(document.myForm.TxtServiceComment.value=="")
    {
      alert("please Enter Service Comment") ;
      document.myForm.TxtServiceComment.focus();
      return false;
    }
} 

    
function DeviceCase(deviceValue)
{

    if(deviceValue=="Sold Vehicle" || deviceValue=="Vehicle Stand For Long Time" || deviceValue=="Stop GPS" || deviceValue=="Device Lost" || deviceValue=="Device Dead" || deviceValue=="Buy Back" || deviceValue=="Device Removed Against Non-Payment" || deviceValue=="Account Deactivate Against Non-Payment")
    {
        document.getElementById('notexists').style.display = "none";
        document.getElementById('gtracpending').style.display = "block";
    }
    else if(deviceValue=="Physical Damage" || deviceValue=="Vehicle Theft" || deviceValue=="Sold Vehicle With Device" || deviceValue=="Other(Device Not In Existence)")
    {
        document.getElementById('notexists').style.display = "block";
        document.getElementById('gtracpending').style.display = "none";
    }
    else
    {
        document.getElementById('notexists').style.display = "none";
        document.getElementById('gtracpending').style.display = "none";
    }
    

}
            
function DeviceCase12(deviceValue)
{

    if(deviceValue=="Sold Vehicle" || deviceValue=="Vehicle Stand For Long Time" || deviceValue=="Stop GPS" || deviceValue=="Device Lost" || deviceValue=="Device Dead" || deviceValue=="Buy Back" || deviceValue=="Device Removed Against Non-Payment" || deviceValue=="Account Deactivate Against Non-Payment")
    {
        document.getElementById('notexists').style.display = "none";
        document.getElementById('gtracpending').style.display = "block";
    }
    else if(deviceValue=="Physical Damage" || deviceValue=="Vehicle Theft" || deviceValue=="Sold Vehicle With Device" || deviceValue=="Other(Device Not In Existence)")
    {
        document.getElementById('notexists').style.display = "block";
        document.getElementById('gtracpending').style.display = "none";
    }
    else
    {
        document.getElementById('notexists').style.display = "none";
        document.getElementById('gtracpending').style.display = "none";
    }
    

}
</script>
    
 <form name="myForm" action="" onsubmit="return validateForm()" method="post">
 

   <table style="padding-left:100px;width:500px;" cellspacing="5" cellpadding="5">

        <!-- <tr>
            <td>Date</td>
            <td><input type="text" name="date" id="datepicker1" readonly value="<?= date("Y-m-d H:m:s")?>" /></td>
        </tr>

        <tr>
            <td>Account Manager</td>
            <td><input type="text" name="account_manager" id="TxtAccManager" readonly value="<?echo $_SESSION['username'];?>"/></td>
        </tr>-->
         <tr>
            <td>Sales Manager</td>
            <td><select name="sales_manager" id="sales_manager">
            <option value="" >-- select one --</option>
              <?php
        $sales_manager=mysql_query("SELECT name FROM sales_person where active=1 and branch_id=".$_SESSION['BranchId']);
        while ($data=mysql_fetch_assoc($sales_manager))
        {
        ?>
        
        <option name="sales_manager" value="<?=$data['name']?>" <? if($result['sales_manager']==$data['name']) {?> selected="selected" <? } ?> >
        <?php echo $data['name']; ?>
        </option>
        <?php 
        } 
        ?>
          
            </select> 
            </td>
        </tr>
        <tr>
            <td>Client User Name</td>
            <td> 
          
            <select name="main_user_id" id="TxtMainUserId"  onchange="
            showUser(this.value,'ajaxdata'); 
            getCompanyName(this.value,'TxtCompany');">
            <option value="">-- Select One --</option>
            <?php
            $main_user_id=mysql_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE Branch_id=".$_SESSION['BranchId']." order by name asc");
            while ($data=mysql_fetch_assoc($main_user_id))
            {
            ?>
            
           <option name="main_user_id" value="<?=$data['user_id']?>" <? if($result['user_id']==$data['user_id']) {?> selected="selected" <? } ?> >
            <?php echo $data['name']; ?>
            </option>
            <?php 
            } 
            
            ?>
            </select>
        
        
        
            </td>
        </tr>
        
        
        <tr>
            <td>
            Company Name</td>
            <td><input type="text" name="company" id="TxtCompany" value="<?=$result['client']?>" readonly />
            </td>
        </tr>
        
        
       
        <tr>
            <td>
            Registration No</td>
            <td><!-- <input type="value" name="reg_no_of_vehicle_to_move" id="TxtRegNoOfVehicle" /> --> 
            <div id="ajaxdata">
            <?=$result['reg_no']?>
            </div> 
        
            </td>
        </tr>
        <tr>
            <td>
            <label for="DeviceMOdel" id="lblDeviceModel">Device Model</label></td>
            <td>
            <select name="Device_model" id="Device_model">
            <option value="" name="Device_model" id="Device_model">-- Select One --</option>
            <?php
            $main_user_id=mysql_query("SELECT * FROM `device_type`");
            while ($data=mysql_fetch_assoc($main_user_id))
            {
            ?>
            
            <option value ="<?php echo $data['device_type'] ?>" <? if($result['device_model']==$data['device_type']) {?> selected="selected" <? } ?> > 
                <?php echo $data['device_type']; ?>    
            </option>
            <?php 
            } 
            
            ?>
            </select></td>
        </tr>
        <tr>
            <td>
            <label for="DeviceIMEI"  id="lblDeviceImie">Device IMEI</label></td>
            <td>
            <input type="text" name="TxtDeviceIMEI" id="TxtDeviceIMEI" value="<?=$result['imei']?>" readonly/></td>
        </tr>
       
        <tr>
            <td>
            <label for="DeviceIMEI"  id="lblDeviceImie">Device Mobile Number</label></td>
            <td>
            <input type="text" name="Devicemobile" id="Devicemobile" value="<?=$result['device_sim_no']?>" readonly/></td>
        </tr>
       
        <tr>
            <td>
            <label for="DtInstallation" id="lblDtInstallation">Date Of Installation</label></td>
            <td>
            <input type="text" name="date_of_install" id="date_of_install" value="<?=$result['date_of_installation']?>" readonly/></td>
        </tr> 
        
        
        <tr>
            <td colspan="2"><h2>Present Status of device</h2></td>
        
        </tr>
        <tr><td> <label  id="lbDlDate">Device Status</label></td>
            <td> <select name="device_status" id="device_status" onchange="DeviceCase(this.value)">
                    <option value="">-- Select One --</option>
                    <option value="Sold Vehicle"<? if($result['device_status']=="Sold Vehicle"){?> selected="selected" <? }?>>Sold Vehicle</option>
                    <option value="Vehicle Stand For Long Time"<? if($result['device_status']=="Vehicle Stand For Long Time"){?> selected="selected" <? }?>>
                    Vehicle Stand For Long Time</option>
                    <option value="Stop GPS"<? if($result['device_status']=="Stop GPS"){?> selected="selected" <? }?>>Stop GPS</option>
                    <option value="Device Lost"<? if($result['device_status']=="Device Lost"){?> selected="selected" <? }?>>Device Lost</option>
                    <option value="Device Dead"<? if($result['device_status']=="Device Dead"){?> selected="selected" <? }?>>Device Dead</option>
                    
                    <option value="Physical Damage"<? if($result['device_status']=="Physical Damage"){?> selected="selected" <? }?>>Physical Damage</option>
                    <option value="Vehicle Theft"<? if($result['device_status']=="Vehicle Theft"){?> selected="selected" <? }?>>Vehicle Theft</option>
                    <option value="Sold Vehicle With Device"<? if($result['device_status']=="Sold Vehicle With Device"){?> selected="selected" <? }?>>
                    Sold Vehicle With Device</option>
                    <option value="Buy Back"<? if($result['device_status']=="Buy Back"){?> selected="selected" <? }?>>Buy Back</option>
                    <option value="Other(Device Not In Existence)"<? if($result['device_status']=="Other(Device Not In Existence)"){?> selected="selected" <? }?>>
                    Other(Device Not In Existence)</option> 
                    <option value="Device Removed Against Non-Payment"<? if($result['device_status']=="Device Removed Against Non-Payment"){?> selected="selected" <? }?>>Device Removed Against Non-Payment</option>
                    <option value="Account Deactivate Against Non-Payment"<? if($result['device_status']=="Account Deactivate Against Non-Payment"){?> selected="selected" <? }?>>Account Deactivate Against Non-Payment</option>  
                </select>
            </td>
        </tr>
        <!--<tr><td> <label  id="lbDlDate">Location</label></td>
            <td> <select name="Txt_location" id="Txt_location">
                    <option value="">-- Select One --</option>
                    <option value="gtrack office"<? if($result['vehicle_location']=="gtrack office"){?> selected="selected" <? }?>>Gtrack office</option>
                    <option value="client office"<? if($result['vehicle_location']=="client office"){?> selected="selected" <? }?>>Client Office</option>
                    <option value="client vehicle"<? if($result['vehicle_location']=="client vehicle"){?> selected="selected" <? }?>>Client Vehicle</option>
                    <option value="device lost"<? if($result['vehicle_location']=="device lost"){?> selected="selected" <? }?>>Device Lost</option>
                </select>
            </td>
        </tr>-->
        <tr>
            <td colspan="2">
            <?php //if($action=='edit') {?>
                   <!--<table id="showlocation"  style="width: 300px;"  cellspacing="0" cellpadding="0">
                    <tr>
                        <td> <label  id="lbDlDate">Location</label></td>
                        <td ><?=$result['vehicle_location']?></td>
                     </tr>
                 </table>-->
            <? //} ?>
                <table  id="gtracpending"    style="padding-left:60px;width: 500px;display:none;"  cellspacing="5" cellpadding="5">
                    <tr><td> <label  id="lbDlDate">Device Location</label></td>
                        <td> <select name="gtrac_location" id="gtrac_location">
                                <option value="">-- Select One --</option>
                                <option value="gtrack office"<? if($result['vehicle_location']=="gtrack office"){?> selected="selected" <? }?>>Gtrack office</option>
                                <option value="client office"<? if($result['vehicle_location']=="client office"){?> selected="selected" <? }?>>Client Office</option>
                            </select>
                        </td>
                    </tr>
                </table>
                
                <table  id="notexists"   style="padding-left:60px;width: 500px;display:none;"  cellspacing="5" cellpadding="5">
                    <tr><td> <label  id="lbDlDate">Device Location</label></td>
                        <td> <select name="Txt_location" id="Txt_location">
                                <option value="">-- Select One --</option>
                                <option value="client vehicle"<? if($result['vehicle_location']=="client vehicle"){?> selected="selected" <? }?>>Client Vehicle</option>
                                <!--<option value="device lost"<? if($result['vehicle_location']=="device lost"){?> selected="selected" <? }?>>Device Lost</option>-->
                            </select>
                        </td>
                    </tr>
                </table>
                
            </td>
        </tr>
        <!--<tr><td> <label  id="lblReason">Contact person</label></td>
        <td> <input type="text" name="Txt_contactperson" id="Txt_contactperson" value="<?=$result['Contact_person']?>" />
        </td>
        </tr>-->
          
        
        <tr><td> <label  id="lblReason">Deactivation of SIM</label></td>
            <td> 
            <Input type = 'Radio' Name ='DeactiveSim' id="DeactiveSim" value= 'Yes'<?php if($result['deactivation_of_sim']=="Yes"){echo "checked=\"checked\""; }?>
            <?PHP //print $male_status; ?>
            >Yes
            
            <Input type = 'Radio' Name ='DeactiveSim' id="DeactiveSim" value= 'No'<?php if($result['deactivation_of_sim']=="No"){echo "checked=\"checked\""; }?>
            <?PHP //print $female_status; ?>
            >No
            
            </td>
        </tr>
        
        
         <!--<tr><td> <label  id="lbDlDate">Payment Status</label></td>
        <td> 
        
        <select name="payment_status" id="payment_status" >
            <option value="" >-- select one --</option>
            
            <option value="Paid" <? //if($result['payment_status']=='Paid') {?> selected="selected" <? //} ?> > Paid</option>
            <option value="UnPaid" <? //if($result['payment_status']=='UnPaid') {?> selected="selected" <? //} ?> > UnPaid</option>
            
            </select> 
        
        </td>
              </tr>-->
        
        <tr><td> <label  id="lbDlDate">Deletion date </label></td>
            <td> <input type="text" name="rdd_date" id="datepicker" value="<?=$result['deletion_date']?>" /></td>
            </tr>
            <tr><td> <label  id="lblReason">Reason</label></td>
            <td> <textarea rows="5" cols="25"  type="text" name="TxtReason" id="TxtReason" ><?=$result['reason']?></textarea>
            </td>
        </tr>
        <?php 
        if($action=='edit') {
        ?>
         <tr>
            <td class="style2">
                Service Comment</td>
            <td><textarea rows="5" cols="25"  type="text" name="service_comment" id="TxtServiceComment" ></textarea>
                </td>
        </tr>
        <?php } ?>
        
        <tr><td colspan="2" align="center"> <input type="submit" name="submit" id="button1" value="submit"  />
                   <input type="button" name="Cancel" value="Cancel" onClick="window.location = 'list_delete_vehicle.php' " /></td>

        </tr>

     </table>
      </form>
   </div>
 
<?php
include("../include/footer.php"); ?>

<script>DeviceCase12("<?=$result['device_status'];?>");</script>