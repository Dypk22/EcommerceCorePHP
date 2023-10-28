<?php  
  $output = '';  
  $video_id = '';  
  sleep(1);  
  require '../connection.php'; 
  $sql = "SELECT * FROM users WHERE id > ".$_POST['last_video_id']." LIMIT ".per_row_records;  
  $result = mysqli_query($con, $sql);  
  if(mysqli_num_rows($result) > 0)  
  {  
       while($row = mysqli_fetch_array($result))  
       {  
          $video_id = $row["id"];  
          $output .= ' 
            <tr>
              <td>'.$row['id'].'</td>
              <td class="text-capitalize">'.$row['name'].'</td>
              <td class="text-capitalize">'.$row['email'].'</td>
              <td>+91'.$row['mobile'].'</td>
              <td>';
                if ($row['status']==1) { 
                  $output.='<span class="badge-item badge-status text-capitalize"><a class="text-light" href="?status=0&user='.$row['id'].'">Active</a></span>';
                }else{ 
                  $output.='<span class="badge-item badge-status text-capitalize"><a class="text-light" href="?status=1&user='.$row['id'].'">Deactive</a></span>';
                }
                  $output.='
              </td>
              <td class="text-center">
                 <a href="customer/'.$row['id'].'" target="_blank()" class="views-btn text-capitalize text-dark"><i class="fas fa-edit text-success mr-1"></i>Detail</a>&nbsp;<span style="font-size: 1.1rem;">|</span>
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
          <td class="text-right"><button class="save-btn hover-btn mx-auto my-2" data-vid="'. $video_id .'" id="CustomersLoadMore" type="button">Load More</button></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
       ';  
       echo $output;  
  }  
  ?>