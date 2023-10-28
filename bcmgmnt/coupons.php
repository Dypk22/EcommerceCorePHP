<?php 
   require '../connection.php'; 
   $CouponActive="yes";
	require 'header.php'; 
	$all_orders=mysqli_query($con,'select * from coupons order by id desc LIMIT '.per_row_records);
   if (isset($_GET['delete'])) {
      mysqli_query($con, "delete from coupons where id='".$_GET['delete']."'");
      header('Location:'.ADMIN_SITE_PATH.'coupons');
   }
	?>
<main>
   <div class="container-fluid">
    <h2 class="mt-30 page-title">All Coupon</h2>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?php echo ADMIN_SITE_PATH; ?>">Dashboard</a></li>
         <li class="breadcrumb-item active"> Coupon</li>
      </ol>
      <div class="row">
      	<div class="col-xl-12 col-md-12">
            <button class="save-btn hover-btn mb-3" onclick="window.location.href='<?php echo ADMIN_SITE_PATH.'add-coupons'; ?>'";> <i class="fas fa-plus-circle"></i> Add New Coupon</button>
            <div class="card card-static-2 mb-30">
               <div class="card-body-table">
                  <div class="table-responsive">
                     <table class="table ucp-table table-hover">
                        <thead>
                           <tr>
                              <th>S No</th>
                              <th>Coupon</th>
                              <th>Type 1</th>
                              <th>Type 2</th>
                              <th>Value</th>
                              <th>Status</th>
                              <th>Detail</th>
                           </tr>
                        </thead>
                        <tbody id="load_data_table">
                           <?php while ($row=mysqli_fetch_assoc($all_orders)) { ?>
                           <tr>
                              <td><?php echo $row['id']; ?></td>
                              <td class="text-capitalize"><?php echo $row['code']; ?></td>
                              <td class="text-capitalize"><?php echo $row['type1']; ?></td>
                              <td class="text-capitalize"><?php echo $row['type2']; ?></td>
                              <td><?php echo ($row['type2']=='percentage')?$row['value'].'<small class="rupeeIcon">%</small>':'<small class="rupeeIcon">₹</small>'.$row['value']; ?></td>
                              <td>
                              	<?php $status=($row['status']==1)?'active':'deactive'; ?>
                                 <span class="badge-item badge-status text-capitalize"><?php echo $status; ?></span>
                              </td>
                              <td>
                                 <a href="coupon-manage/<?php echo $row['id']; ?>" class="views-btn text-capitalize text-dark"><i class="fas fa-edit text-success mr-1"></i>detail</a>&nbsp;<span style="font-size: 1.1rem;">|</span>
                                 <a href="?delete=<?php echo $row['id']; ?>" class="views-btn text-capitalize text-dark"> delete<i class="ml-1 fas fa-trash text-danger"></i></a>
                              </td>
                           </tr>
                            <?php
                           $video_id = $row["id"];
                            } ?>
                            <tr id="LoadMoreBtnRow">
                              <td></td>
                              <td></td>
                              <td></td>
                               <td>
                                <button class="save-btn hover-btn mx-auto my-2" data-vid="<?php echo $video_id; ?>" id="CouponsLoadMore" type="button">Load More</button>
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
   $(document).on('click', '#CouponsLoadMore', function(){  
        var last_video_id = $(this).data("vid");  
        $('#CouponsLoadMore').html('Loading <span class="spinner-border wait spinner-border-sm" role="status" aria-hidden="true"></span>');  
        $.ajax({  
             url:"CouponsLoadMore",  
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
                       $('#CouponsLoadMore').html("No Data");  
                  }  
             }  
        });  
   });  
 });  
</script>