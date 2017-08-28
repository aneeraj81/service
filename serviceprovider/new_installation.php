<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');
$mode=$_GET['mode']; 
?> 
<div class="top-bar">
                  
                    <h1>Open Installation : <?=$mode; ?></h1>
					<div style="float:center">
					  <div align="center"><br/>
	 	                <a href="new_installation.php?mode=installation">Installation
	 	                <? $sql_pending = select_query("SELECT COUNT(*)  as total FROM installation where installation_status='1' and instal_reinstall='installation' and inter_branch=0 and branch_id=".$_SESSION['BranchId']);
        				?>
	 	                ( <?=$sql_pending[0]['total']?> )</a> 
                        
                        | <a href="new_installation.php?mode=re_addition">Re-Addition
	 	                <? $sql_pending2 = select_query("SELECT COUNT(*)  as total FROM installation WHERE  installation_status='1' and instal_reinstall='re_install' and inter_branch=0 and branch_id=".$_SESSION['BranchId']);
        				?>
	 	                ( <?=$sql_pending2[0]['total']?> )</a>
                        
                        | <a href="new_installation.php?mode=online_crack">Online-Crack
	 	                <? $sql_pending3 = select_query("SELECT COUNT(*)  as total FROM installation WHERE  installation_status='1' and instal_reinstall='online_crack' and inter_branch=0 and branch_id=".$_SESSION['BranchId']);
        				?>
	 	                ( <?=$sql_pending3[0]['total']?> )</a>
                        
                        | <a href="new_installation.php?mode=crack">Crack
	 	                <? $sql_pending4 = select_query("SELECT COUNT(*)  as total FROM installation WHERE  installation_status='1' and instal_reinstall='crack' and inter_branch=0 and branch_id=".$_SESSION['BranchId']);
        				?>
	 	                ( <?=$sql_pending4[0]['total']?> )</a>
                        
                        | <a href="new_installation.php?mode=inter_branch">Inter Branch
	 	                <? $sql_pending5 = select_query("SELECT COUNT(*)  as total FROM installation where installation_status='1' and inter_branch=".$_SESSION['BranchId']);
        					?>
	 	                ( <?=$sql_pending5[0]['total']?> )</a>
 					   </div>
  					</div>  	  
                	</div>
                   	<div class="top-bar">
	                  	<div style="float:right";><font style="color:#F6F;font-weight:bold;">Purple:</font> Urgent Installation</div>
              	</div>      
                
                <div class="table">
                <?php
 
$status=$_GET['status']	;
$day=$_GET['day'];
if($mode==''){ 

	$rs=select_query("SELECT * FROM installation WHERE installation_status='1' and ((inter_branch=0 and branch_id='".$_SESSION['BranchId']."') or (inter_branch='".$_SESSION['BranchId']."' and branch_id!='".$_SESSION['BranchId']."'))");
	
}
elseif($mode=='installation')
{
	if($day=='tomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='installation' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%' order by id desc");
	}
	else if($day=='aftertomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='installation' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%' order by id desc");
	}
	else
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='installation' and branch_id=".$_SESSION['BranchId']." and time <= '".date("Y-m-d 23:59")."' order by id desc");
	}

}

elseif($mode=='re_addition')
{
	if($day=='tomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='re_install' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%' order by id desc");
	}
	else if($day=='aftertomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='re_install' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%' order by id desc");
	}
	else
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='re_install' and branch_id=".$_SESSION['BranchId']." and time <= '".date("Y-m-d 23:59")."' order by id desc");
	}
}

elseif($mode=='online_crack')
{
	if($day=='tomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='online_crack' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%' order by id desc");
	}
	else if($day=='aftertomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='online_crack' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%' order by id desc");
	}
	else
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='online_crack' and branch_id=".$_SESSION['BranchId']." and time <= '".date("Y-m-d 23:59")."' order by id desc");
	}
}

elseif($mode=='crack')
{
	if($day=='tomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='crack' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%' order by id desc");
	}
	else if($day=='aftertomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='crack' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%' order by id desc");
	}
	else
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='crack' and branch_id=".$_SESSION['BranchId']." and time <= '".date("Y-m-d 23:59")."' order by id desc");
	}
}

elseif($mode=='inter_branch')
{
	
	if($day=='tomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%' order by id desc");
	}
	else if($day=='aftertomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%' order by id desc");
	}
	else
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=".$_SESSION['BranchId']."  and time <= '".date("Y-m-d 23:59")."' order by id desc");
	}

}
else
{

	if($day=='tomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='re_install' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%' order by id desc");
	}
	else if($day=='aftertomorrow')
	{
		$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='re_install' and branch_id=".$_SESSION['BranchId']."  and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%' order by id desc");
	}
	else
	{
	$rs = select_query("SELECT * FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='re_install' and branch_id=".$_SESSION['BranchId']."  and time <= '".date("Y-m-d 23:59")."' order by id desc");

	}
 
}

if(($mode=='installation' && ($day=='today' || $day=='tomorrow' || $day=='aftertomorrow')) || ($mode=='installation' || $mode=='') )
{

	$today = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='installation' AND branch_id='".$_SESSION['BranchId']."' and time <= '".date("Y-m-d 23:59")."'"); 
	
	$tomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='installation' AND branch_id='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%'"); 
	
	$aftertomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='installation' AND branch_id='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%'");

}
	
if(($mode=='re_addition' && ($day=='today' || $day=='tomorrow' || $day=='aftertomorrow')) || ($mode=='re_addition' || $mode=='') )
{				
	$today = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='re_install' AND branch_id='".$_SESSION['BranchId']."' and time <= '".date("Y-m-d 23:59")."'"); 
	
	$tomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='re_install' AND branch_id='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%'"); 
	
	$aftertomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='re_install' AND branch_id='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%'");

}
	
if(($mode=='online_crack' && ($day=='today' || $day=='tomorrow' || $day=='aftertomorrow')) || ($mode=='online_crack'))
{
		
	$today = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='online_crack' AND branch_id='".$_SESSION['BranchId']."' and time <= '".date("Y-m-d 23:59")."'"); 
	
	$tomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='online_crack' AND branch_id='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%'"); 
	
	$aftertomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='online_crack' AND branch_id='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%'");

}
if(($mode=='crack' && ($day=='today' || $day=='tomorrow' || $day=='aftertomorrow')) || ($mode=='crack'))
{
		
	$today = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='crack' AND branch_id='".$_SESSION['BranchId']."' and time <= '".date("Y-m-d 23:59")."'"); 
	
	$tomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='crack' AND branch_id='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%'"); 
	
	$aftertomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch=0 and instal_reinstall='crack' AND branch_id='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%'");

}

if(($mode=='inter_branch' && ($day=='today' || $day=='tomorrow' || $day=='aftertomorrow')) || ($mode=='inter_branch'))
{
		
	$today = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch='".$_SESSION['BranchId']."' and time <= '".date("Y-m-d 23:59")."'");
	
	$tomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+1 days' ))."%'"); 
	
	$aftertomorrow = select_query("SELECT COUNT(*) AS total FROM installation WHERE  installation_status='1' AND inter_branch='".$_SESSION['BranchId']."' and time like '%".date("Y-m-d", strtotime( '+2 days' ))."%'");

}
	print_r($today);die();
?>

<div style="float:right"><a href="new_installation.php?day=today&mode=<?= $_GET['mode']?>">Today(<?php echo $today[0]["total"];?>)</a> | <a href="new_installation.php?day=tomorrow&mode=<?= $_GET['mode']?>"> Tomorrow(<?php echo $tomorrow[0]["total"];?>)</a>| <a href="new_installation.php?day=aftertomorrow&mode=<?= $_GET['mode']?>">Day After Tomorrow(<?php echo $aftertomorrow[0]["total"];?>)</a></div>
<p>&nbsp;</p>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
	<thead>
		<tr>
        <th>Job Type</th>
        <th>Request By </th>
         <th>Request Date </th>
      	<th><font color="#0E2C3C"><b>Client Name </b></font></th>
		<th><font color="#0E2C3C"><b>Number of Installation <br/>(IP Box/ Required)</b></font></th>
		<th><font color="#0E2C3C"><b>Branch Location</b></font></th>
		<th><font color="#0E2C3C"><b>Landmark</b></font></th>
		<th><font color="#0E2C3C"><b>Device Type</b></font></th>
        <th><font color="#0E2C3C"><b>Accessories</b></font></th>
        <th><font color="#0E2C3C"><b>Available Time<b></font></th>
		<th><font color="#0E2C3C"><b>Contact Details</b></font></th>
		<th>View Detail</th>
    	<th><b>Edit</b></font></th>
        <th><b>Back to service</b></font></th>
		</tr>
	</thead>
	<tbody>

  
	<?php 
	
    for($i=0;$i<count($rs);$i++)
	{
		if($rs[$i][IP_Box]=="") $ip_box="Not Required";  else $ip_box="$rs[$i][IP_Box]"; 
	
    ?>  

	<tr align="Center" <?  if($rs[$i]['required']=='urgent'){ ?>style="background:#F6F" <? }?>>
	<td><?php 
			
			$sql1 = select_query("select instal_reinstall from installation WHERE id='".$rs[$i]['id']."'");
      
            if($sql1[0]['instal_reinstall'] == "installation"){ echo "I";} 
            elseif($sql1[0]['instal_reinstall'] == "re_install"){ echo "Re-Add";}
            elseif($sql1[0]['instal_reinstall'] == "online_crack"){ echo "o_crack";}
            elseif($sql1[0]['instal_reinstall'] == "crack"){ echo "crack";}
          
          ?>
        </td></td>
 
  
        
        <td>&nbsp;<?php echo $rs[$i]['request_by'];?></td><td>&nbsp;<?php echo $rs[$i]['req_date'];?></td>
		 <? $sql="SELECT Userid AS id,UserName AS sys_username FROM addclient  WHERE Userid=".$rs[$i]["user_id"];
	$rowuser=select_query($sql);
	?>
 		<td><?php echo $rowuser[0]["sys_username"];?></td> 
        
		<?php if($_SESSION['BranchId']==1 && $rs[$i]['instal_reinstall']=='installation'){?>
        
        <td >&nbsp;<?php $no_of_inst = $rs[$i]['installation_approve'] - $rs[$i]['installation_made']; echo $no_of_inst." <br/><br/>".($ip_box)?></span></td>
        
		 <?php } else {?>
         
        <td >&nbsp;<?php $no_of_inst = $rs[$i]['no_of_vehicals'] - $rs[$i]['installation_made']; echo $no_of_inst." <br/><br/>".($ip_box)?></span></td>
        
		<?php } ?>
        
        
        
		<td>
        <?php 
       
          $sql1 = select_query("select Zone_area from installation WHERE id='".$rs[$i]['id']."'");
		  $sql2 = select_query("SELECT name FROM re_city_spr_1 WHERE id='".$sql1[0]['Zone_area']."'");

          echo $sql2[0]['name'];
          
         ?>
        </td>
        <td>
        	<?php 

        	//echo "select inst_req_id from installation WHERE id='".$rs[$i]['id']."'";die;
        	$sql_InstRqst2 = select_query("select inst_req_id from installation WHERE id='".$rs[$i]['id']."'");
            $sql_Inst2 = select_query("select landmark from installation_request WHERE id='".$sql_InstRqst2[0]['inst_req_id']."'");
              	
              	echo $sql_Inst2[0]['landmark']."<br>";
            ?>  	
        </td>
        <td>
        	<?php
        		echo $rs[$i]['imei_device_type'];
        	?>	
        </td>
        <td>
        	<?php
        		echo $rs[$i]['acess_selection'];
        	?>
        </td>
        <td>
			<?php 
				echo date("Y-m-d",strtotime($rs[$i]['time']))."<br>";
	           	echo date("G:i",strtotime($rs[$i]['time']))."<br>";
            	echo $rs[$i]['atime_status'];
			?>
		</td>		
        <td>
			<?php
		
				$sql_InstRqst = select_query("select inst_req_id from installation WHERE id='".$rs[$i]['id']."'");
              	$sql_Inst = select_query("select contact_person,contact_number,designation from installation_request WHERE id='".$sql_InstRqst[0]['inst_req_id']."'");
              	
              	echo $sql_Inst[0]['contact_person']."<br>";
              	echo $sql_Inst[0]['contact_number']."<br>";
              	echo $sql_Inst[0]['designation']."<br>";
          	?>
		</td>
		<td><a href="#" onclick="Show_record(<?php echo $rs[$i]["id"];?>,'installation','popup1'); " class="topopup">View Detail</a></td>	
		<?php 

			//$send_RD = select_query("SELECT instal_reinstall FROM installation WHERE installation_status='1' and inter_branch=0 and instal_reinstall='online_crack' and branch_id=".$_SESSION['BranchId']." and id=".$rs[$i]['id']."");
			//if($send_RD[0]['instal_reinstall'] == 'online_crack') { 

		?>
		<!-- <td>&nbsp;
			<a href="#" onclick="send_rd('<?php echo $rs[$i]['id'] ?>')">Send R&#38;D</a>
			<script type="text/javascript">
				function send_rd(id){
					var Path="http://localhost/service/";
					$.ajax({
                		type: 'GET',
                		url: Path+"userInfo.php?action=sendRD",
                		data:"RowId="+id,
                		success: function(data) {
                    		location.reload();
                    	}
        			});
	            }
	    </script>
		</td> -->
		<?php //}else { ?>
		<td>&nbsp;<a href="edit_installation.php?id=<?=$rs[$i]['id'];?>&action=edit&show=edit">Edit</a></td>
		<?php //} ?>
      	<td><a href="edit_installation.php?id=<?=$rs[$i]['id'];?>&action=edit&show=backtoservice">Back to service</a></td>
    </tr>
		<?php  
   // $i++;
	}
	 
    ?>
</table>
     
   <div id="toPopup"> 
    	
        <div class="close">close</div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup1" style ="height:100%;width:100%"> <!--your content start-->
            

 
        </div> <!--your content end-->
    
    </div> <!--toPopup end-->
    
	<div class="loader"></div>
   	<div id="backgroundPopup"></div>
</div>
 
 
 
<?
include("../include/footer.inc.php");

?>



 