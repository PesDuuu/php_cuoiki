<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
 ?>

<?php 
	$login_check = Session::get('user_login');
	  if ($login_check==false) {
	  	header('Location:login.php');
	  }
 ?>
 <?php
	if(isset($_GET['confirmid'])){
     	$id = $_GET['confirmid'];
     	$time = $_GET['time'];
     	$price = $_GET['price'];
     	$shifted_confirm = $ct->shifted_confirm($id,$time,$price);
    }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Chi tiết đơn hàng</h2>

						<table class="tblone">
							<tr>
								<th width="0%">STT</th>
								<th width="18%">Tên sản phẩm</th>
								<th width="15%">Hình ảnh</th>
								<th width="10%">Giá</th>
								<th width="10%">Số lượng</th>
								<th width="14%">Ngày</th>
								<th width="10%">Trạng thái</th>
								<th width="14%">Xử lý</th>
							</tr>
							<?php
							$customer_id = Session::get('user_id');  
							$get_cart_ordered = $ct->get_cart_ordered($customer_id);
							if($get_cart_ordered){
								$i=0;
								$qty = 0;
								while ($result = $get_cart_ordered->fetch_assoc()) {
								$i++;
							 ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['product_name'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" width="100px"/></td>
								<td><?php echo $fm->format_currency($result['price']).' VND' ?></td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo $fm->formatDate($result['order_date'])  ?></td>
								<td>
								<?php 
									if ($result['order_status'] == '0') {
										echo "Đang chờ xử lý";
									}elseif($result['order_status'] == 1) {
								?>
								<span>Đã gửi hàng</span>
								
								<?php

									}elseif($result['order_status']==2){
										echo 'Đã nhận';
									}
								 ?>	

								</td>
								<?php 
								if ($result['order_status'] == '0') {
								 ?>

								<td><?php echo 'Chờ xác nhận'; ?></td>

								 <?php 
								 }elseif($result['order_status']==1) {
								 ?>	
								 <td>
								 	<a href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['order_date'] ?>">Đã được xác nhận(click vào đây nếu đã nhận hàng)</a>
								 </td>
								 <?php 
								}else{
								  ?>
								  
								<td><?php echo 'Đã nhận'; ?></td>
								<?php 
								}
								 ?>
							</tr>
							<?php 							
								}
							}
							 ?>
	
						</table>
						
					</div>
					
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php 
	include 'inc/footer.php';
 ?>
