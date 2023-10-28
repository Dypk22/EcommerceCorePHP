<?php  
  $output = '';  
  $video_id = '';  
  sleep(1);  
  $type='';
  $status='';
  require 'connection.php'; 
  $sql="select type, id, added_on, status, amount from wallet where user_id =".$_POST['user_id']." and id < ".$_POST['last_video_id']." and type!='sign-up' order by id desc LIMIT ".per_row_records;
  $result = mysqli_query($con, $sql);  
  if(mysqli_num_rows($result) > 0)  
  {  
    while($row = mysqli_fetch_array($result))  
    {  
      if($row['type']=='paid-from-wallet'){
         $type='<a target="_blank()" class="paid-wallet"><i class="fas fa-minus-circle mr-1 text-primary"></i>paid to order</a>';
      }
      if($row['type']=='cashback-credited'){
         $type='<i class="fas fa-plus-circle text-danger mr-1" style="position:relative; top:6px;"></i> cashback credited';
      }
      if($row['type']=='add-money'){
         $type='<i class="fas fa-plus-circle text-danger mr-1" style="position:relative; top:6px;"></i>add Money';
      }
      $video_id = $row["id"];
      $output .='<tr><td class="align-middle">'.date('d M, Y', strtotime($row['added_on'])).'</td>';
      if($row['type']=='cashback-credited'){ 
      $output .='<td class="align-middle px-2 px-md-auto text-center text-capitalize"><span class="text-1 d-inline-flex">'.$type.'</span></td>';
      }elseif($row['type']=='add-money'){ 
      $output .='<td class="align-middle px-2 px-md-auto text-center text-capitalize"><span class="text-1 d-inline-flex">'.$type.'</span></td>';
      }else{ 
      $output .='<td class="align-middle px-2 px-md-auto text-center text-capitalize"><span class="text-1 d-inline-flex">'.$type.'</span></td>';
      } 
      if($row['status']=='success'){$status='<i class="fas fa-check-circle text-success mr-1" style="position:relative; top:1px;"></i>Success';}
      if($row['status']=='failed'){$status='<i class="fas fa-times-circle text-danger mr-1" style="position:relative; top:1px;"></i>Failed';}
      $output .='<td class="align-middle text-center text-1">'.$status.'</td><td class="align-middle text-right">₹'.$row['amount'].'.00</td></tr> ';  
      $video_id = $row["id"];
    }  
    $output .= '
    <tr id="LoadMoreBtnRow"><td></td><td class="text-center"><button class="btn btn-primary mx-auto my-2 py-2 text-1 px-3" data-vid="'.$video_id.'" id="CustomersWalletLoadMore" type="button">Load More</button></td><td></td></tr>';  
     echo $output;  
  }  
  ?>