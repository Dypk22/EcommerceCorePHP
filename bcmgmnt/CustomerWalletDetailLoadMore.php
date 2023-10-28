<?php  
  $output = '';  
  $video_id = '';  
  sleep(1);  
  require '../connection.php'; 
  $sql="select * from wallet where user_id ='".$_POST['user_id']."' and id < ".$_POST['last_video_id']." and type!='sign-up' order by id desc LIMIT ".per_row_records;
  $result = mysqli_query($con, $sql);  
  if(mysqli_num_rows($result) > 0)  
  {  
       while($row = mysqli_fetch_array($result))  
       {  
          $video_id = $row["id"];  
          $tmp_type=($row['type']=='cashback-credited')? '<i class="fas fa-plus-circle mt-1"></i>' : '<a href="recharge-detail/'.$row['transaction_id'].'" style="color: inherit;text-decoration: underline;" target="_blank()">'.$row['transaction_id'];
          $output .= ' 
            <tr>
              <td class="text-center">'.$tmp_type.'</a></td>';
              $transaction_type=($row['type']=='cashback-credited')? 'cashback given' : 'payment';
              $output.='
              <td class="text-capitalize text-center">'.$transaction_type.'</td>
              <td class="text-center">'.date('d/M/Y', strtotime($row['added_on'])).'</td>
              <td class="text-center"><small class="rupeeIcon">₹</small>'.$row['amount'].'.00</td>
              <td class="text-center">'.$row['payment_id'].'</td>
              <td class="text-capitalize text-center">'.$row['status'].'</td>
              <td class="text-center"><small class="rupeeIcon">₹</small>'.$row['updated_balance'].'.00</td>
              <td class="text-center"><small class="ruppeeIcon">₹</small>'.$row['updated_cashback'].'.00</td>
              <td class="text-uppercase text-center">'.$row['coupon_code'].'</td>
           </tr>
          ';  
          $video_id = $row["id"];
       }  
       $output .= '
       <tr id="LoadMoreBtnRow">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
         <td class="text-center">
          <button class="save-btn hover-btn mx-auto my-2" data-vid="'.$video_id.'" id="CustomerWalletDetailLoadMore" type="button">Load More</button>
         </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
       ';  
       echo $output;  
  }  
  ?>