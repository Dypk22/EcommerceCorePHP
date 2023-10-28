<?php  
  $output = '';  
  $video_id = '';  
  sleep(1);  
  require '../connection.php'; 
  $sql = "SELECT * FROM add_money_direct WHERE id < ".$_POST['last_video_id']." order by id desc LIMIT ".per_row_records;  
  $result = mysqli_query($con, $sql);  
  if(mysqli_num_rows($result) > 0)  
  {  
       while($row = mysqli_fetch_array($result))  
       {  
          $video_id = $row["id"];  
          $output .= ' 
           <tr>
              <td>'.$row['id'].'</td>
              <td class="text-capitalize">'.$row['user_id'].'</td>
              <td class="text-capitalize">₹'.$row['amount'].'</td>
              <td class="text-capitalize">'.$row['reference_id'].'</td>
              <td>'.date('d M, Y - h:i a', strtotime($row['added_on'])).'</td>
              <td> ';
              $tmp_status=($row['status']==1)?'disabled':'';
              $output.='
                 <select id="'.$row['id'].'status" '.$tmp_status.' class="form-control bglight text-capitalize mb-2">';
                     if ($row['status']==1) { 
              $output.='
                    <option value="1" selected="">Approved</option>
                    <option value="0">Pending</option>
                    <option value="2">Declined</option>';
                    }else if ($row['status']==0) { 
              $output.='
                    <option value="0" selected="">Pending</option>
                    <option value="1">Approved</option>
                    <option value="2">Declined</option>';
                     }else{ 
              $output.='
                    <option value="2" selected="">Declined</option>
                    <option value="0">Pending</option>
                    <option value="1">Approved</option>';
                    } 
              $output.='
                 </select>
              </td>
              <td>
                 <select id="'.$row['id'].'remarks" '.$tmp_status.' class="bglight form-control text-capitalize mb-2">
                    <option value="" selected="">'.$row['remarks'].'</option>
                    <option value="approved">approved</option>
                    <option value="verification pending">verification pending</option>
                    <option value="invalid details">invalid details</option>
                    <option value="verification pending">verification pending</option>
                 </select>
              </td>';
              if($row['status']!=1){ 
              $output.='
              <td class="action-btns">
                 <button class="badge-item border-0 badge-status text-capitalize px-3 py-2" onclick="updateAddMoneyStatus(\''.$row['id'].'\',\''.$row['user_id'].'\',\''.$row['amount'].'\',\''.$row['reference_id'].'\')">Update</button>
              </td>';
              }
              $output.="
              <script type=\"text/javascript\">
                 function updateAddMoneyStatus(id,user,amount,reference_id) {
                    var status=jQuery('#'+id+'status').val();
                    var remarks=jQuery('#'+id+'remarks').val();
                    window.location.href='direct-add-money?id='+id+'&status='+status+'&remarks='+remarks+'&amount='+amount+'&user='+user+'&reference_id='+reference_id;
                 }
              </script>
           </tr>
          ";  
          $video_id = $row["id"];
       }  
       $output .= '
       <tr id="LoadMoreBtnRow">
          <td></td>
          <td></td>
          <td></td>
          <td></td>
           <td>
            <button class="save-btn hover-btn mx-auto my-2" data-vid="'.$video_id.'" id="DirectAddMoneyLoadMore" type="button">Load More</button>
           </td>
          <td></td>
          <td></td>
        </tr>
       ';  
       echo $output;  
  }  
  ?>