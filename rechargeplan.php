<?php require'connection.php'; $operator=''; $set_operator='no'; $type=''; if (isset($_GET['operator'])) { $set_operator=strip_tags(mysqli_real_escape_string($con,$_GET['operator'])); } else { $set_operator=strip_tags(mysqli_real_escape_string($con,$_POST['recharge_plan_operator'])); } if (isset($_POST['recharge_plan_operator'])) { $set_operator=strip_tags(mysqli_real_escape_string($con,$_POST['recharge_plan_operator'])); $type=strip_tags(mysqli_real_escape_string($con,$_POST['recharge_plan_type'])); } if ($set_operator=='bharti airtel ltd') { $operator='airtel_plan'; } else if($set_operator=='reliance jio infocomm ltd (rjil)') { $operator='jio_plan'; } else if($set_operator=='vodafone idea ltd (formerly idea cellular ltd)') { $operator='vi_plan'; } else { $operator='bsnl_plan'; } $query="select * from ".$operator; if (isset($type) && $type!='') { if ($type=='1.5gb/day') { $query.=" where data='$type'"; } else if ($type=='2gb/day') { $query.=" where data='$type'"; } else if ($type=='3gb/day') { $query.=" where data='$type'"; } else { $query.=" where type='$type'"; } $query.=" and status=1"; } else { $query.=" where status=1"; } $mainquery=strtolower($query); $result=mysqli_query($con, $query); if (mysqli_num_rows(mysqli_query($con, $query))>0) { while ($res=mysqli_fetch_assoc($result)) { $deli_data=(strpos($res['data'], '/day')!==false)?'<td class="text-3 text-center align-middle text-uppercase">'.trim($res['data'],'/day').'/ <span class="text-1 text-muted d-block">Day</span></td>':'<td class="text-3 text-center align-middle text-uppercase">'.$res['data'].'</td>'; echo'<tr class="prev_rows"><td class="text-5 text-primary text-center align-middle">₹'.$res['amount'].'<span class="text-1 text-muted d-block">Amount</span></td>'.$deli_data.'<td class="text-3 text-center align-middle">'.$res['validity'].' Days <span class="text-1 text-muted d-block">Validity</span></td><td class="text-1 text-muted align-middle d-none d-lg-block">'.$res['description'].'</td><td class="align-middle"><button class="btn btn-sm btn-outline-primary shadow-none text-nowrap" type="button" data-dismiss="modal" aria-label="Close" onclick="setRechargeValue(\''.$res['amount'].'\')">Recharge Now</button></td></tr>'; }  } else { echo '<tr class="prev_rows"><td class="text-5 text-primary text-center align-middle">No Plan Found</td></tr>'; } ?>