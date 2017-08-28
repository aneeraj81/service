<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');

/*include($_SERVER['DOCUMENT_ROOT']."/service/include/header.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/service/include/leftmenu.php"); */ 
?> 

<link  href="../css/auto_dropdown.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">

/*Start auto ajax value load code*/

$(document).ready(function(){
	$(document).click(function(){
		$("#ajax_response").fadeOut('slow');
	});
	$("#Zone_area").focus();
	var offset = $("#Zone_area").offset();
	var width = $("#Zone_area").width()-2;
	$("#ajax_response").css("left",offset); 
	$("#ajax_response").css("width","15%");
	$("#ajax_response").css("z-index","1");
	$("#Zone_area").keyup(function(event){
		 //alert(event.keyCode);
		 var keyword = $("#Zone_area").val();
		 if(keyword.length)
		 {
			 if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
			 {
				 $("#loading").css("visibility","visible");
				 $.ajax({
				   type: "POST",
				   url: "load_zone_area.php",
				   data: "data="+keyword,
				   success: function(msg){	
					if(msg != 0)
					  $("#ajax_response").fadeIn("slow").html(msg);
					else
					{
					  $("#ajax_response").fadeIn("slow");	
					  $("#ajax_response").html('<div style="text-align:left;">No Matches Found</div>');
					}
					$("#loading").css("visibility","hidden");
				   }
				 });
			 }
			 else
			 {
				switch (event.keyCode)
				{
				 case 40:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:first").addClass("selected");
					 }
				 break;
				 case 38:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:last").addClass("selected");
				 }
				 break;
				 case 13:
					$("#ajax_response").fadeOut("slow");
					$("#Zone_area").val($("li[class='selected'] a").text());
				 break;
				}
			 }
		 }
		 else
			$("#ajax_response").fadeOut("slow");
	});
	$("#ajax_response").mouseover(function(){
		$(this).find("li a:first-child").mouseover(function () {
			  $(this).addClass("selected");
		});
		$(this).find("li a:first-child").mouseout(function () {
			  $(this).removeClass("selected");
		});
		$(this).find("li a:first-child").click(function () {
			  $("#Zone_area").val($(this).text());
			  $("#ajax_response").fadeOut("slow");
		});
	});
});
/* End auto ajax value load code*/
</script>
 
<div class="top-bar">
<h1>ADD Crack Device Service</h1>
</div>
<div class="table"> 

<?

if($_GET["edit"]==true && $_GET["rowid"]!='')
{
	$query=mysql_query("SELECT * FROM services WHERE id='".$_GET["rowid"]."'",$dblink2);
	$rows=mysql_fetch_array($query);
		 
	$main_user_id=$rows["user_id"]; 
	$company=$rows["company_name"]; 
	$veh_reg=$rows["veh_reg"]; 

	$Zone_area = $rows["Zone_area"];
	$area = mysql_fetch_array(mysql_query("SELECT id,`name` FROM re_city_spr_1 WHERE id='".$Zone_area."'")); 
	$location = $rows["location"]; 

	$atime=$rows["atime"]; 
	$atimeto=$rows["datetimepickerto"]; 
	$pname=$rows["pname"]; 
	$cnumber=$rows["cnumber"]; 
	$required=$rows['required'];
	$atime_status=$rows['atime_status'];
	
	$datapullingtime=$rows["datapullingtime"]; 
	$comment=$rows["comment"]; 
	
	$sql = mysql_query("SELECT Userid AS id,UserName AS sys_username FROM addclient WHERE Userid='$main_user_id' and Branch_id='".$_SESSION['BranchId']."'",$dblink2);
	$row = mysql_fetch_array($sql);
	$username = $row['sys_username'];

}


if(isset($_POST['submit']))
{ 
	$date = date("Y-m-d H:i:s");
	$account_manager = $_SESSION['username'];
	$main_user_id = $_POST['main_user_id'];
	$company = $_POST['company'];
	$veh_reg = $_POST['veh_reg'];

	$Zone_id = mysql_query("SELECT id,`name` FROM re_city_spr_1 WHERE `name`='".$_POST['Zone_area']."'");
	$zone_count = mysql_num_rows($Zone_id);
	$Zone_data = mysql_fetch_array($Zone_id);	
	if($zone_count > 0)
	{
		$Zone_area = $Zone_data["id"];
		$errorMsg = "";
	}
	else
	{
		$errorMsg = "Please Select Type View Listed Area. Not Fill Your Self.";
	}
	
	$location=$_POST['location'];
	$pname=$_POST['pname'];
	$cnumber=$_POST['cnumber'];
	$status=$_POST['status'];
	$required=$_POST['required'];
	
	$datapullingtime=$_POST['datapullingtime'];
	$comment=$_POST['TxtComment'];
	$atime_status=$_POST['atime_status'];
	$service_reinstall = 'service';
	
	$sql=mysql_query("SELECT UserName AS sys_username FROM addclient  WHERE Userid='$main_user_id'",$dblink2);
	$row=mysql_fetch_array($sql);
	$username=$row['sys_username'];


// `inst_name`, `inst_cur_location`, `inst_date`, `reason`, `time`, `payment_status`, `amount`, `paymode`, `back_reason`, `close_date`, `pending`, `newpending`, `status`, `newstatus`, `move_vehicles`, `billing`, `payment`, `required`, `datapullingtime`, `IP_Box`, `updated_date`, `pending_closed`, `branch_id`,

if($errorMsg=="")	
{
	if($_GET["edit"]==true && $_GET["rowid"]!='')
	{
	  if($atime_status=="Till")
	  {
			$time=(isset($_POST["time"])) ? trim($_POST["time"])  : "";
			
		$sql="update `services` set `name`= '".$username."', `user_id`= '".$main_user_id."', `company_name`='".$company."', `veh_reg`='".$veh_reg."', `location`='".$location."', `atime`='".$time."',`atime_status`='".$atime_status."', `pname`='".$pname."', `cnumber`= '".$cnumber."', `comment`='".$comment."',`required`='".$required."', Zone_area='".$Zone_area."',service_reinstall='".$service_reinstall."',service_status=1,`inter_branch`='0' where id='".$_GET["rowid"]."'";
		
		$execute=mysql_query($sql);
		header("location:services.php");
	  }
	  
	  if($atime_status=="Between")
	  {
			$time=(isset($_POST["time1"])) ? trim($_POST["time1"])  : "";
			$totime=(isset($_POST["totime"])) ? trim($_POST["totime"])  : "";
			//$time=$_POST['time1'];
			//$totime=$_POST['totime'];
			
			$sql="update `services` set `name`= '".$username."', `user_id`= '".$main_user_id."', `company_name`='".$company."', `veh_reg`='".$veh_reg."', `location`='".$location."', `atime`='".$time."', atimeto='".$totime."',`atime_status`='".$atime_status."', `pname`='".$pname."', `cnumber`= '".$cnumber."', `comment`='".$comment."',`required`='".$required."', Zone_area='".$Zone_area."',service_reinstall='".$service_reinstall."',service_status=1,`inter_branch`='0' where id='".$_GET["rowid"]."'";
			
			$execute=mysql_query($sql);
			header("location:services.php");
	  }
	}
	else
	{
	  if($atime_status=="Till")
	   {
			$time=$_POST['time'];
	
	//1-New,2-assigned,3-newbacktoservice,4-backtoservice,5-close,6-callingclose
			 $sql="INSERT INTO `services` (`req_date`, `request_by`, `name`, `user_id`, `company_name`, `veh_reg`, `location`, `atime`, `pname`,atime_status, `cnumber`, `comment`,`required`,branch_id,service_status,Zone_area,service_reinstall,`inter_branch`) VALUES ('".$date."','".$account_manager."', '".$username."', '".$main_user_id."', '".$company."', '".$veh_reg."', '".$location."', '".$time."','".$pname."','".$atime_status."', '".$cnumber."', '".$comment."','".$required."','".$_SESSION['BranchId']."',1,'".$Zone_area."','".$service_reinstall."','0');";
			
			$execute=mysql_query($sql);
			header("location:services.php");
		}
		if($atime_status=="Between")
		{
			$time=$_POST['time1'];
			$totime=$_POST['totime'];
			
			//1-New,2-assigned,3-newbacktoservice,4-backtoservice,5-close,6-callingclose
			$sql="INSERT INTO `services` (`req_date`, `request_by`, `name`, `user_id`, `company_name`, `veh_reg`, `location`, `atime`, `atimeto`, `pname`,atime_status, `cnumber`, `comment`,`required`, branch_id,service_status,Zone_area,service_reinstall,`inter_branch`) VALUES ('".$date."','".$account_manager."', '".$username."', '".$main_user_id."', '".$company."', '".$veh_reg."','".$location."', '".$time."','".$totime."','".$pname."','".$atime_status."', '".$cnumber."','".$comment."','".$required."','".$_SESSION['BranchId']."',1,'".$Zone_area."','".$service_reinstall."','0');";
			
			$execute=mysql_query($sql);
			header("location:services.php");  
		}
	 }	 
   }
}




?>
<script type="text/javascript">

 
 function validateForm()
 { 
		var main_user_id=document.forms["myForm"]["main_user_id"].value;
		if (main_user_id==null || main_user_id=="")
		  {
		  alert("Select Username");
		  return false;
		  }
		 
		var veh_reg=document.forms["myForm"]["Txtveh_reg"].value;
		if (veh_reg==null || veh_reg=="")
		  {
		  alert("Please Enter Registration No");
		  return false;
		  } 
		  
		var location=document.forms["myForm"]["Zone_area"].value;
		if (location==null || location=="")
		  {
		alert("Please Select Area") ;
		  return false;
		  }
		 
		var location=document.forms["myForm"]["location"].value;
		if (location==null || location=="")
		  {
		  alert("Enter location");
		  return false;
		  }
		 
		var timestatus=document.forms["myForm"]["atime_status"].value;
		if (timestatus==null || timestatus=="")
		{
			alert("Please select Availbale Time");
			return false;
		}
		
		var tilltime=document.forms["myForm"]["datetimepicker"].value;
		if(timestatus == "Till" && (tilltime==null || tilltime==""))
		{
			alert("Please select Time");
			return false;
		}
		
		var betweentime=document.forms["myForm"]["datetimepicker1"].value;
		var betweentime2=document.forms["myForm"]["datetimepicker2"].value;
		if(timestatus == "Between" && (betweentime==null || betweentime==""))
		{
			alert("Please select From Time");
			return false;
		}
		
		if(timestatus == "Between" && (betweentime2==null || betweentime2==""))
		{
			alert("Please select To Time");
			return false;
		}			  
	   
		var pname=document.forms["myForm"]["pname"].value;
		if (pname==null || pname=="")
		{
			alert("Enter Person Name");
			return false;
		}
	  
		var cnumber=document.forms["myForm"]["cnumber"].value;
		
		if (cnumber==null || cnumber=="")
		{
			alert("Enter Contact Number");
			return false;
		}
		if(cnumber!="")
		{			   
			var charnumber=cnumber.length;
			if(charnumber < 10 || charnumber > 12 || cnumber.search(/[^0-9\-()+]/g) != -1) {
			alert("Please enter valid mobile number");
			document.myForm.cnumber.focus();
			document.myForm.cnumber.value="";
			return false;
			}
		}
				
			  
}

function TillBetweenTime(radioValue)
{
 if(radioValue=="Till")
	{
		document.getElementById('TillTime').style.display = "block";
		document.getElementById('BetweenTime').style.display = "none";
	}
	else if(radioValue=="Between")
	{
		document.getElementById('TillTime').style.display = "none";
		document.getElementById('BetweenTime').style.display = "block";
	}
	else
	{
		document.getElementById('TillTime').style.display = "none";
		document.getElementById('BetweenTime').style.display = "none";
	} 
	
}

function TillBetweenTime12(radioValue)
{
 if(radioValue=="Till")
	{
		document.getElementById('TillTime').style.display = "block";
		document.getElementById('BetweenTime').style.display = "none";
	}
	else if(radioValue=="Between")
	{
		document.getElementById('TillTime').style.display = "none";
		document.getElementById('BetweenTime').style.display = "block";
	}
	else
	{
		document.getElementById('TillTime').style.display = "none";
		document.getElementById('BetweenTime').style.display = "none";
	} 
	
} 

</script>


<script type="text/javascript">

	$(function () {
		 
		$("#datetimepicker").datetimepicker({});
		$("#datetimepicker1").datetimepicker({});
		$("#datetimepicker2").datetimepicker({});
		$("#datetimepicker3").datetimepicker({});
	});
</script>      

<?php echo "<p align='left' style='padding-left: 250px;width: 500px;' class='message'>" .$errorMsg. "</p>" ; ?>

<style type="text/css" >
.errorMsg{border:1px solid red; }
.message{color: red; font-weight:bold; }
</style>

 <form name="myForm" action="" onsubmit="return validateForm()" method="post">

   <table style=" padding-left: 100px;width: 500px;" cellspacing="5" cellpadding="5">

        <tr>
            <td  align="right">
            Client User Name*:</td>
            <td> 
            
            <select name="main_user_id" id="TxtMainUserId"  onchange="getCompanyName(this.value,'TxtCompany');">
            <option value="" name="main_user_id" id="TxtMainUserId">-- Select One --</option>
            <?php
            $main_user_iddata=mysql_query("SELECT Userid AS user_id,UserName AS `name` FROM addclient WHERE sys_active=1 ORDER BY `name` asc");
            while ($data=mysql_fetch_assoc($main_user_iddata))
            {
            if($data['user_id']==$rows['user_id'])
            {
                $selected="selected";
            }
            else
            {
                $selected="";
            }
            ?>
            
            <option name="main_user_id" value ="<?php echo $data['user_id'] ?>"  <?echo $selected;?>>
            <?php echo $data['name']; ?>
            </option>
            <?php 
            } 
            
            ?>
            </select>
            </td>
        </tr>
        
        <tr>
            <td  align="right">
            Company Name*:</td>
            <td><input type="text" name="company" id="TxtCompany" readonly value="<?echo $company?>"/>
            </td>
        </tr>
        
        <tr>
            <td  align="right">
            Registration No*:</td>
            <td>
            <input type="text" name="veh_reg" id="Txtveh_reg" value="<?echo $veh_reg?>"/>
            </td>
        </tr>
        
        <tr>
            <td  align="right"> Area:*</td>
            <td> <input type="text" name="Zone_area" id="Zone_area" value="<?php echo $area["name"];?>" /> <div id="ajax_response"></div></td>
        </tr> 
         
        <tr>
          <td  align="right">Location:*</td>
        <td  ><input type="text" name="location"  id="location"   style="width:147px" value="<?echo $location?>"/></td>
        </tr>
        
 		<tr>
            <td align="right">Availbale Time status:*</td>
            <td>
                <select name="atime_status" id="atime_status" style="width:150px" onchange="TillBetweenTime(this.value)">
                    <option value="">Select Status</option>
                    <option value="Till" <? if($atime_status=='Till') {?> selected="selected" <? } ?> >Till</option>
                    <option value="Between" <? if($atime_status=='Between') {?> selected="selected" <? } ?> >Between</option>
                </select>
            </td>
            <td colspan="2">
                
                <table  id="TillTime" align="left" style="width: 240px;display:none;border:1"  cellspacing="5" cellpadding="5">
                        <tr>
                            <td height="32" align="right">Time:*</td>
                            <td>
                                 <input type="text" name="time" id="datetimepicker" value="<?=$rows['atime']?>" style="width:147px"/>
                                   
                             </td>
                        </tr>
                </table>
                
                <table  id="BetweenTime" align="left" style="width: 240px;display:none;border:1"  cellspacing="5" cellpadding="5">
                        <tr>
                            <td height="32" align="right">From Time:*</td>
                            <td>
                                 <input type="text" name="time1" id="datetimepicker1" value="<?=$rows['atime']?>" style="width:147px"/>
                                   
                             </td>
                        </tr>
                        <tr>
                            <td height="32" align="right">To Time:*</td>
                            <td>
                             <input type="text" name="totime" id="datetimepicker2" value="<?=$rows['atimeto']?>" style="width:147px"/>
                               
                             </td>
                        </tr>
                </table>
             </td>
        </tr>
        
        <tr>
          <td  align="right">Person Name:*</td>
        <td>
             <input type="text" name="pname" id="pname"   style="width:147px" value="<?echo $pname?>"/> 		
                </td>
        </tr>
        <tr>
          <td  align="right">Contact No:*</td>
          <td colspan="2"><input value="<?echo $cnumber?>" type="text" name="cnumber"   style="width:147px" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/></td>
        </tr>
        
        <tr>
          <td  align="right">Required:</td>
        <td><input type="checkbox" name="required" id="required" value="urgent"  <?php if($required=='urgent') {?> checked="checked" <? }?>/> Urgent </td>
        </tr>

        <tr>  <td  align="right">Comment</td>
              <td> <textarea rows="5" cols="25"  type="text" name="TxtComment" id="TxtComment" ><?echo $comment?></textarea>
        	</td>
		</tr>

        <tr>
            <td  ><input type="submit" name="submit" value="submit" id="button1" align="right" />&nbsp;&nbsp;</td>
            <td colspan="2">&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onClick="window.location = 'services.php' " /></td>
        </tr>

</table>
</form>
 
<?
include("../include/footer.inc.php");

?>

<script>StatusBranch12("<?=$rows['branch_type'];?>");TillBetweenTime12("<?=$rows['atime_status'];?>");</script>
 