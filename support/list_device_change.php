<?php
session_start();
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');

/*include($_SERVER['DOCUMENT_ROOT']."/service/include/header.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/service/include/leftmenu.php");*/
 
?> 
<script>
 
function ConfirmPaymentClear(row_id)
{
  var x = confirm("All payment cleared?");
  if (x)
  {
  PaymentClear(row_id);
      return ture;
  }
  else
    return false;
}

function PaymentClear(row_id)
{
    //alert(user_id);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=DeviceChangePaymentClear",
         data:"row_id="+row_id,
        success:function(msg){
         
        location.reload(true);        
        }
    });
}

function ConfirmPaymentPending(row_id)
{
   var retVal = prompt("Pending Amount : ", "Pending Amount");
  if (retVal)
  {
  PaymentPending(row_id,retVal);
      return ture;
  }
  else
    return false;
}

function PaymentPending(row_id,retVal)
{
    //alert(user_id);
    //return false;
$.ajax({
        type:"GET",
        url:"userInfo.php?action=DeviceChangePaymentPending",
          
         data:"row_id="+row_id+"&comment="+retVal,
        success:function(msg){
              
        location.reload(true);        
        }
    });
}
</script>

<div class="top-bar">
        <div align="center">
            <form name="myformlisting" method="post" action="">
                <select name="Showrequest" id="Showrequest" onchange="form.submit();" >
                    <option value="0" <? if($_POST['Showrequest']==0){ echo 'Selected'; }?>>Select</option>
                    <option value=3 <?if($_POST['Showrequest']==3){ echo "Selected"; }?>>Admin Approved</option>
                    <option value="" <?if($_POST['Showrequest']==''){ echo "Selected"; }?>>Pending</option>
                    <option value="1" <?if($_POST['Showrequest']==1){ echo "Selected"; }?>>Closed</option>
                    <option value="4" <?if($_POST['Showrequest']==4){ echo "Selected"; }?>>Billing Changes</option>
                    <option value="2" <?if($_POST['Showrequest']==2){ echo "Selected" ;}?>>All</option>
                
                </select>
            </form>
        </div>
                    
                    <h1>Device Change List</h1>
                  </div>
                  <div class="top-bar">
                    
                <div style="float:right";><font style="color:#B6B6B4;font-weight:bold;">Grey:</font> Approved</div>
                <br/>
                <div style="float:right";><font style="color:#68C5CA;font-weight:bold;">Blue:</font> Back from support</div>
                <br/>
                <div style="float:right";><font style="color:#F2F5A9;font-weight:bold;">Yellow:</font> Back from Admin</div>
                
                
                <br/>
                <div style="float:right";><font style="color:#99FF66;font-weight:bold;">Green:</font> Completed your requsest.</div>              
           
                
                <div class="table">
<?php
 
if($_SESSION['username']=="dservicehead" || $_SESSION['username']=="misexecutive"){$request = "('triloki','jaipurrequest','ragini','asaleslogin','pankaj','ksaleslogin','mumbai')";}
/*elseif($_SESSION['username']=="misexecutive"){$request = "('triloki')";}*/
elseif($_SESSION['username']=="ragini"){$request = "('ragini','pankaj','mumbai','msaleslogin')";}
elseif($_SESSION['username']=="rajeshree"){$request = "('asaleslogin')";}
elseif($_SESSION['username']=="jaipursupport"){$request = "('jaipurrequest')";}

if($_POST["Showrequest"]==1)
 {
      $WhereQuery=" where approve_status=1 and final_status=1 and acc_manager in ".$request;
 }
 else if($_POST["Showrequest"]==2)
 {
     $WhereQuery="where acc_manager in ".$request;
 }
  else if($_POST["Showrequest"]==3)
 {
     $WhereQuery=" where approve_status=1 and final_status!=1 and acc_manager in ".$request;
 }
  else if($_POST["Showrequest"]==4)
 {
     $WhereQuery=" where billing='Yes' and acc_manager in ".$request;
 }
 else
 { 
      
     $WhereQuery=" where approve_status=0 and final_status!=1 and acc_manager in ".$request;
  
 }
  
  
$query = select_query("SELECT * FROM device_change ".$WhereQuery."  order by id desc ");

?>
 <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    <thead>
        <tr>
            <th>SL.No</th>
            <th>Date</th>
            <th>Account Manager</th>
            <th>User Name</th>
            <th>Vehicle Number</th>
            <th>Replaced Device Type</th>
            <th>Device_IMEI</th>
            <th>Replaced Device IMEI</th>
            <th>Billing</th> 
            <th>Reason</th> 
            <th>View Detail</th>
            <!--<th>Add Details</th>-->
        </tr>
    </thead>
    <tbody>


 
<?php 

//while($row=mysql_fetch_array($query))
for($i=0;$i<count($query);$i++)
{
?>

<tr align="center" <? if( $query[$i]["support_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#68C5CA"';} elseif($query[$i]["final_status"]==1){ echo 'style="background-color:#99FF66"';}elseif($query[$i]["approve_status"]==1){ echo 'style="background-color:#B6B6B4"';}elseif( $query[$i]["admin_comment"]!="" && $query[$i]["final_status"]!=1 ){ echo 'style="background-color:#F2F5A9"';}?> >

<td><?php echo $i+1;?></td>
<td><?php echo $query[$i]["date"];?></td>
<td><?php echo $query[$i]["sales_manager"];?></td>
<? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$query[$i]["user_id"];
$rowuser=select_query($sql);
?>
<td><?php echo $query[$i]["client"];?></td>
<td><?php echo $query[$i]["reg_no"];?></td> 
<td><?php echo $query[$i]["rdd_device_type"];?></td> 
<td><?php echo $query[$i]["device_imei"];?></td> 
<td><?php echo $query[$i]["rdd_device_imei"];?></td> 
<td style="background-color:#8CEAEA"><?php echo $query[$i]["billing"];?></td> 
<td style="background-color:#8CEAEA"><?php echo $query[$i]["rdd_reason"];?></td> 
<td><a href="#" onClick="Show_record(<?php echo $query[$i]["id"];?>,'device_change','popup1'); " class="topopup">View Detail</a>
 </td>
<!-- <td><?php 
if($query[$i]["approve_status"]==0 && $query[$i]["approve_status"]!=1) {?>  <a href="device_change.php?id=<?=$query[$i]['id'];?>&action=edit<? echo $pg;?>">Edit</a>
        
<?php } ?>
</td>-->
</tr> <?php }?>
</table>
     
   <div id="toPopup"> 
        
        <div class="close">close</div>
           <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
        <div id="popup1"> <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
    <div class="loader"></div>
       <div id="backgroundPopup"></div>
</div>
 
<?php
include("../include/footer.inc.php"); ?>