<?php  
  $output = '';  
  $video_id = '';  
  sleep(1);  
  require 'connection.php'; 
  $sql="select id, date, transaction_id, dth_operator, amount from dth_recharge_orders where user_id =".$_POST['user_id']." and id < ".$_POST['dth_last_video_id']." order by id desc LIMIT ".per_row_records;
  $result = mysqli_query($con, $sql);  
  if(mysqli_num_rows($result) > 0)  
  {  
     while($row = mysqli_fetch_array($result))  
     {  
        $dth_video_id = $row["id"];  
        $output .= '<tr><td class="align-middle">'.date('d M, Y', strtotime($row['date'])).'</td><td class="align-middle text-center"><img src="images/brands/operator/mobile.png" style="height: 40px;" class="img-thumbnail ordersImg d-inline-flex mr-1"><span class="text-1 d-inline-flex"><span class="text-capitalize mx-1"><a href="receipt/dth/'.$row['transaction_id'].'"  target="_blank()">DTH Recharge for '.$row['dth_operator'].'</a></span></td><td class="align-middle text-right">₹'.$row['amount'].'.00</td></tr>';  
        $dth_video_id = $row["id"];
     }  
     $output .= '<tr id="DTHLoadMoreBtnRow"><td></td><td class="text-center"><button class="btn btn-primary mx-auto my-2 py-2 text-1 px-3" data-dth="'.$dth_video_id.'" id="CustomersDthOrdersLoadMore" type="button">Load More</button></td><td></td></tr>';  
     echo $output;  
  }  
  ?>