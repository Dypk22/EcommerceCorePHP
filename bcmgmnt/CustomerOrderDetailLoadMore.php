<?php  
  $output = '';  
  $video_id = '';  
  sleep(1);  
  require '../connection.php'; 
  $sql="select * from mobile_recharge_orders where user_id =".$_POST['user_id']." and id < ".$_POST['last_video_id']." order by id desc LIMIT ".per_row_records;
  $result = mysqli_query($con, $sql);  
  if(mysqli_num_rows($result) > 0)  
  {  
       while($row = mysqli_fetch_array($result))  
       {  
          $video_id = $row["id"];  
          $output .= ' 
            <tr>
                              <td class="text-center">'.$row['transaction_id'].'</td>
                              <td class="text-center">+91'.$row['mobile'].'</td>
                              <td class="text-center"><span class="delivery-time">'.date('d/M/Y', strtotime($row['date'])).'</span></td>
                              <td class="text-center"><small class="rupeeIcon">₹</small>'.$row['amount'].'</td>
                              <td class="text-center">
                                 <span class="badge-item badge-status text-capitalize">'.$row['status'].'</span>
                              </td>
                              <td class="text-center">
                                 <a href="recharge-detail/'.$row['transaction_id'].'" target="_blank()" class="views-btn text-capitalize text-dark"><i class="fas fa-edit text-success mr-1"></i>detail</a>&nbsp;<span style="font-size: 1.1rem;">|</span>
                                 <a href="?delete='.$row['transaction_id'].'" class="views-btn text-capitalize text-dark"> delete<i class="ml-1 fas fa-trash text-danger"></i></a>
                              </td>
                           </tr>
          ';  
          $video_id = $row["id"];
       }  
       $output .= '
       <tr id="LoadMoreBtnRow">
                              <td></td>
                              <td></td>
                               <td class="text-center">
                                <button class="save-btn hover-btn mx-auto my-2" data-vid="'.$video_id.'" id="CustomerOrderDetailLoadMore" type="button">Load More</button>
                               </td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
       ';  
       echo $output;  
  }  
  ?>