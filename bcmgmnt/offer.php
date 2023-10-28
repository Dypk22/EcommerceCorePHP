<?php 
	require '../connection.php'; 
   $OffersActive="yes";
	require 'header.php'; 
	$all_orders=mysqli_query($con,'select * from offers order by id desc LIMIT '.per_row_records);
   if (isset($_GET['delete'])) {
      mysqli_query($con, "delete from offers where id='".$_GET['delete']."'");
      header('Location:'.ADMIN_SITE_PATH.'offer');
   }
	?>
<main>
   <div class="container-fluid">
   	<h2 class="mt-30 page-title">All Orders</h2>
      <ol class="breadcrumb mb-30">
         <li class="breadcrumb-item active">All Orders</li>
      </ol>
      <div class="row">
      	<div class="col-xl-12 col-md-12">
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th></th>
                              <th>Tagline</th>
                              <th>Date</th>
                              <th>Status</th>
                              <th>Action</th>
                              <th></th>
                           </tr>
                        </thead>
                        <tbody id="load_data_table">
                           <?php while ($row=mysqli_fetch_assoc($all_orders)) { ?>
                           <tr>
                              <td></td>
                              <td><?php echo $row['tagline']; ?></td>
                              <td><?php echo date('d/M/Y', strtotime($row['added_on'])); ?></td>
                              <td>
                                 <?php $status=($row['status']==1)?'active':'deactive'; ?>
                                 <span class="badge-item badge-status text-capitalize"><?php echo $status; ?></span>
                              </td>
                              <td>
                                 <a href="offers/detail/<?php echo $row['id']; ?>" target="_blank()" class="views-btn text-capitalize text-dark"><i class="fas fa-edit text-success mr-1"></i>detail</a>&nbsp;<span style="font-size: 1.1rem;">|</span>
                                 <a href="?delete=<?php echo $row['id']; ?>" class="views-btn text-capitalize text-dark"> delete<i class="ml-1 fas fa-trash text-danger"></i></a>
                              </td>
                              <td></td>
                           </tr>
                           <?php
                           $video_id = $row["id"];
                            } ?>
                            <tr id="LoadMoreBtnRow">
                              <td></td>
                              <td></td>
                               <td>
                                <button class="save-btn hover-btn mx-auto my-2" data-vid="<?php echo $video_id; ?>" id="OffersLoadMore" type="button">Load More</button>
                               </td>
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
   $(document).on('click', '#OffersLoadMore', function(){  
        var last_video_id = $(this).data("vid");  
        $('#OffersLoadMore').html('Loading <span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span>');  
        $.ajax({  
             url:"OffersLoadMore",  
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
                       $('#OffersLoadMore').html("No Data");  
                  }  
             }  
        });  
   });  
 });  
</script>