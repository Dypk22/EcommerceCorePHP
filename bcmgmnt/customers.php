<?php 
   require '../connection.php'; 
	require 'header.php'; 
	$all_orders=mysqli_query($con,'select * from users limit '.per_row_records);
   if (isset($_GET['delete'])) {
      mysqli_query($con, "delete from users where id='".$_GET['delete']."'");
      header('Location:'.ADMIN_SITE_PATH.'customers');
   }
   if (isset($_GET['status'])) {
      mysqli_query($con, "UPDATE `users` SET `status` = '".$_GET['status']."' WHERE `users`.`id` = '".$_GET['user']."'");
      header('Location:'.ADMIN_SITE_PATH.'customers');
   }
	?>
<main>
   <div class="container-fluid">
   	<h2 class="mt-30 page-title">All Customer</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
         <li class="breadcrumb-item active">All Customer</li>
      </ol>
      <div class="row">
      	<div class="col-xl-12 col-md-12">
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th>S No</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Mobile</th>
                              <th>Status</th>
                              <th class="text-center">Action</th>
                           </tr>
                        </thead>
                        <tbody id="load_data_table">
                           <?php while ($row=mysqli_fetch_assoc($all_orders)) { ?>
                           <tr>
                              <td><?php echo $row['id']; ?></td>
                              <td class="text-capitalize"><?php echo $row['name']; ?></td>
                              <td class="text-capitalize"><?php echo $row['email']; ?></td>
                              <td>+91<?php echo $row['mobile']; ?></td>
                              <td>
                                <?php if ($row['status']==1) { ?>
                                 <span class="badge-item badge-status text-capitalize"><a class="text-light" href="?status=0&user=<?php echo $row['id']; ?>">Active</a></span>
                                <?php }else{ ?>
                                 <span class="badge-item badge-status text-capitalize"><a class="text-light" href="?status=1&user=<?php echo $row['id']; ?>">Deactive</a></span>
                                <?php } ?>
                              </td>
                              <td class="text-center">
                                 <a href="customer/<?php echo $row['id']; ?>" class="views-btn text-capitalize text-dark"><i class="fas fa-edit text-success mr-1"></i>Detail</a>&nbsp;<span style="font-size: 1.1rem;">|</span>
                                 <a href="?delete=<?php echo $row['id']; ?>" class="views-btn text-capitalize text-dark"> delete<i class="ml-1 fas fa-trash text-danger"></i></a>
                              </td>
                           </tr>
                           <?php
                           $video_id = $row["id"];
                            } ?>
                            <tr id="LoadMoreBtnRow">
                              <td></td>
                              <td></td>
                               <td class="text-right">
                                <button class="save-btn hover-btn mx-auto my-2" data-vid="<?php echo $video_id; ?>" id="CustomersLoadMore" type="button">Load More</button>
                               </td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
        </div>
      </div>
   	</div>
</main>
<?php require 'footer.php'; ?>
<script type="text/javascript">
 $(document).ready(function(){  
   $(document).on('click', '#CustomersLoadMore', function(){  
        var last_video_id = $(this).data("vid");  
        $('#CustomersLoadMore').html('Loading <span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span>');  
        $.ajax({  
             url:"CustomersLoadMore",  
             method:"POST",  
             data:{last_video_id:last_video_id},  
             dataType:"text",  
             success:function(data)  
             {  
                  $('#LoadMoreBtnRow').remove();  
                  if(data != '')  
                  {  
                       // $('#LoadMoreBtnRow').remove();  
                       $('#load_data_table').append(data);  
                  }  
                  else  
                  {  
                       $('#CustomersLoadMore').html("No Data");  
                  }  
             }  
        });  
   });  
 });  
</script>