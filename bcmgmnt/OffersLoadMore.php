<?php  
  $output = '';  
  $video_id = '';  
  sleep(1);  
  require '../connection.php'; 
  $sql = "SELECT * FROM offers WHERE id < ".$_POST['last_video_id']." order by id desc LIMIT ".per_row_records;  
  $result = mysqli_query($con, $sql);  
  if(mysqli_num_rows($result) > 0)  
  {  
       while($row = mysqli_fetch_array($result))  
       {  
          $video_id = $row["id"];  
          $output .= ' 
            <tr>
              <td></td>
              <td>'.$row['tagline'].'</td>
              <td>'.date('d/M/Y', strtotime($row['added_on'])).'</td>
              <td>';
              $status=($row['status']==1)?'active':'deactive';
          $output .= ' 
                 <span class="badge-item badge-status text-capitalize">'.$status.'</span>
              </td>
              <td>
                 <a href="offers/detail/'.$row['id'].'" target="_blank()" class="views-btn text-capitalize text-dark"><i class="fas fa-edit text-success mr-1"></i>detail</a>&nbsp;<span style="font-size: 1.1rem;">|</span>
                 <a href="?delete='.$row['id'].'" class="views-btn text-capitalize text-dark"> delete<i class="ml-1 fas fa-trash text-danger"></i></a>
              </td>
              <td></td>
           </tr>
          ';  
          $video_id = $row["id"];
       }  
       $output .= '
       <tr id="LoadMoreBtnRow">
          <td></td>
          <td></td>
          <td><button class="save-btn hover-btn mx-auto my-2" data-vid="'. $video_id .'" id="OffersLoadMore" type="button">Load More</button></td>
          <td></td>
          <td></td>
        </tr>
       ';  
       echo $output;  
  }  
  ?>