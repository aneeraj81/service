<?php
include("../connection.php");
include_once(__DOCUMENT_ROOT.'/include/header.inc.php');
include_once(__DOCUMENT_ROOT.'/include/leftmenu.php');
include_once(__DOCUMENT_ROOT.'/sqlconnection.php');

/*include($_SERVER['DOCUMENT_ROOT']."/service/include/header.inc.php");
include($_SERVER['DOCUMENT_ROOT']."/service/include/leftmenu.php");
include($_SERVER["DOCUMENT_ROOT"]."/service/sqlconnection.php");*/

?>
<div class="top-bar">

<h1>Device At Branch</h1>

</div>
<div style="float:right"><br/><?
$branch = mysql_query("select * from gtrac_branch");
while ($branch_row = mysql_fetch_array($branch))
{
   if($branch_row["id"]==1)
   {
       $Numberofdevice = select_query_inventory("select device_id from inventory.device left join inventory.item_master on 
                   device.device_type=item_master.item_id left join inventory.device_status on device_status.status_sno=device.device_status 
                where  device_status in(57,62,63,64,69,82,84,85,86,98,99) and dispatch_branch =".$branch_row["id"]);
   }
   else
   {
       $Numberofdevice = select_query_inventory("select device_id from inventory.device left join inventory.item_master on 
                   device.device_type=item_master.item_id left join inventory.device_status on device_status.status_sno=device.device_status 
                where  device_status in(57,63,64,82) and dispatch_branch =".$branch_row["id"]);
   }
   
   $total=count($Numberofdevice);
   ?>
   <a href="stock_branch.php?branch_id=<?= $branch_row["id"];?>">
   <? echo $branch_row["branch_name"]."(".$total.")";?>
   </a>&nbsp;&nbsp;  || &nbsp;&nbsp;&nbsp;

<? } ?>


<br/>
</div>

<br/>
   <?
   $mode=$_GET['branch_id'];
if($mode=='') { $mode="1"; }

  if($mode== 1 || $mode=='')
  {
       /*$rs = mssql_query("select itgc_id ,device_imei ,recd_date ,dispatch_date ,dispatch_recd_date  from device where device_status in (63,64,57) and dispatch_branch = ".$mode);*/

       $rs = select_query_inventory("select itgc_id ,device_imei ,recd_date,device_status.status ,dispatch_date ,dispatch_recd_date,item_name 
                   from inventory.device left join inventory.item_master on device.device_type=item_master.item_id left join inventory.device_status 
                on device_status.status_sno=device.device_status where device_status in(57,62,63,64,69,82,84,85,86,98,99) and 
                dispatch_branch =".$mode);

  }
   else
   {
       /*$rs = mssql_query("select itgc_id ,device_imei ,recd_date ,dispatch_date ,dispatch_recd_date  from device where device_status in (63,64,57) and dispatch_branch = ".$mode);*/

       $rs = select_query_inventory("select itgc_id ,device_imei ,recd_date,device_status.status ,dispatch_date ,dispatch_recd_date,item_name 
                   from inventory.device left join inventory.item_master on device.device_type=item_master.item_id left join inventory.device_status 
                on device_status.status_sno=device.device_status where device_status in(57,63,64,82) and dispatch_branch =".$mode);

   }
?>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
   <thead>
       <tr>
           <th>Sl. No</th>
           <th>Device Id </th>
           <th>Device IMEI </th>
           <th><font color="#0E2C3C"><b>Recieved Date </b></font></th>
           <th><font color="#0E2C3C"><b>Dispatch Date</b></font></th>
           <th><font color="#0E2C3C"><b>Dispatch Recieve Date  </b></font></th>
           <th>Device Model </th>
           <th>Device Status </th>
       </tr>
   </thead>
   <tbody>


   <?php
   for($i=0;$i<count($rs);$i++) {

   ?>

   <!-- <tr align="Center" <? if(($rs[$i]['reason'] && $rs[$i]['time']) ||  $rs[$i]['back_reason']) { ?> style="background:#CCCCCC" <? }?>> -->
   <tr align="Center"    >
       <td><?php echo $i+1;?></td>
       <td>&nbsp;<?php echo $rs[$i]['itgc_id'];?></td>
       <td>&nbsp;<?php echo $rs[$i]['device_imei'];?></td>
       <td>&nbsp;<?php echo $rs[$i]['recd_date'];?></td>
       <td>&nbsp;<?php echo $rs[$i]['dispatch_date'];?></td>
       <td>&nbsp;<?php echo $rs[$i]['dispatch_recd_date'] ?></td>
       <td>&nbsp;<?php echo $rs[$i]['item_name'] ?></td>
       <td>&nbsp;<?php echo $rs[$i]['status'] ?></td>
   </tr>
    <?php
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