<?php  
  $output = '';  
  $video_id = '';  
  sleep(1);  
  require '../connection.php'; 
  $sql="select * from coupons where id < ".$_POST['last_video_id']." order by id desc LIMIT ".per_row_records;
  $result = mysqli_query($con, $sql);  
  if(mysqli_num_rows($result) > 0)  
  {  
       while($row = mysqli_fetch_array($result))  
       {  
          $video_id = $row["id"];  
          $output .= ' 
            <tr>
              <td>'.$row['id'].'</td>
              <td class="text-capitalize">'.$row['code'].'</td>
              <td class="text-capitalize">'.$row['type1'].'</td>
              <td class="text-capitalize">'.$row['type2'].'</td>';
              $tmp_value=($row['type2']=='percentage')?$row['value'].'<small class="rupeeIcon">%</small>':'<small class="rupeeIcon">₹</small>'.$row['value'];
          $output .= ' 
              <td>'.$tmp_value.'</td>
              <td>';
              $status=($row['status']==1)?'active':'deactive';
       $output .= '
                 <span class="badge-item badge-status text-capitalize">'.$status.'</span>
              </td>
              <td>
                 <a href="coupon-manage/'.$row['id'].'" class="views-btn text-capitalize text-dark"><i class="fas fa-edit text-success mr-1"></i>detail</a>&nbsp;<span style="font-size: 1.1rem;">|</span>
                 <a href="?delete='.$row['id'].'" class="views-btn text-capitalize text-dark"> delete<i class="ml-1 fas fa-trash text-danger"></i></a>
              </td>
           </tr>
          ';  
          $video_id = $row["id"];
       }  
       $output .= '
       <tr id="LoadMoreBtnRow">
                              <td></td>
                              <td></td>
                              <td></td>
                               <td class="text-center">
                                <button class="save-btn hover-btn mx-auto my-2" data-vid="'.$video_id.'" id="CouponsLoadMore" type="button">Load More</button>
                               </td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
       ';  
       echo $output;  
  }  
  ?>