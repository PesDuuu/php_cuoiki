<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');
include_once($filepath . '/../classes/product.php');
?>

<div class="grid_8">
	<div class="box round first grid">
		<h2>Đơn hàng</h2>
		<div class="block">

			<?php
			if (isset($shifted)) {
				echo $shifted;
			}
			?>

			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Ngày đặt</th>
						<th>Sản phẩm</th>
						<th>Số lượng</th>
						<th>Giá</th>
						<th>Khách hàng</th>
						<th>Địa chỉ</th>
						<th>Xử lý</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$ct = new cart();
					$fm = new Format();
					$get_inbox_cart = $ct->get_inbox_cart();
					if ($get_inbox_cart) {
						$i = 0;
						while ($result = $get_inbox_cart->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $fm->FormatDate($result['order_date']); ?></td>
								<td><?php echo $result['product_name'] ?> </td>
								<td><?php echo $result['quantity'] ?></td>
								<td><?php echo $fm->format_currency($result['price']) . ' VNĐ' ?></td>
								<td><?php echo $result['user_id'] ?></td>
								<td><a href="customer.php?id=<?php echo $result['user_id'] ?>">Xem khách hàng</a></td>

								<td>
									<?php
									if ($result['order_status'] == 0) {
									?>
										<a href="?shifid=<?php echo $result['order_id']; ?>&qty=<?php echo $result['quantity']; ?>&proid=<?php echo $result['product_id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['order_date']; ?>&cusid=<?php echo $result['user_id']; ?>">Xác nhận đơn hàng</a>


									<?php
									} elseif ($result['status'] == 1) {

									?>
										<a href="?confirmid=<?php echo $result['user_id'] ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['order_date'] ?>">Gửi hàng</a>
									<?php
									} elseif ($result['order_status'] == 2) {
									?>
										<!-- <a href="?delid=<?php echo $result['id']; ?>&price=<?php echo $result['price']; ?>&time=<?php echo $result['order_date']; ?>">Xóa đơn</a> -->
										<a>Hoàn thành</a>


								</td>
							</tr>
				<?php
									}
								}
							}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>