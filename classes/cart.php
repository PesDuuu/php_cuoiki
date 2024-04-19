<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>


 
<?php
/**
 * 
 */
class cart
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function add_to_cart($id, $quantity)
	{

		$quantity = $this->fm->validation($quantity);
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$id = mysqli_real_escape_string($this->db->link, $id);
		$SId = session_id();

		$query = "SELECT * FROM product WHERE product_id = '$id' ";
		$result = $this->db->select($query)->fetch_assoc();
		$product_name = $result["product_name"];
		$price = $result["price"];
		$image = $result["image"];
		$checkcart = "SELECT * FROM cart WHERE product_id = '$id' AND sid = '$SId' ";
		$check_cart = $this->db->select($checkcart);
		if ($check_cart) {
			$alert = "<span>product already added</span>";
			return $alert;
		} else {
			$query_insert = "INSERT INTO cart(product_id,sid,product_name,price,quantity,image) VALUES('$id','$SId','$product_name','$price','$quantity','$image' ) ";
			$insert_cart = $this->db->insert($query_insert);
			if ($result) {
				header('Location:cart.php');
			} else {
				header('Location:404.php');
			}
		}
	}
	public function get_product_cart()
	{
		$sId = session_id();
		$query = "SELECT * FROM cart WHERE sId = '$sId' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_quantity_Cart($cart_id, $quantity)
	{
		$quantity = mysqli_real_escape_string($this->db->link, $quantity);
		$cart_id = mysqli_real_escape_string($this->db->link, $cart_id);

		$query = "UPDATE cart SET

				quantity = '$quantity'

				WHERE cart_id = '$cart_id'";

		$result = $this->db->update($query);
		if ($result) {
			$msg = "<span class='success'> Đã cập nhật thành công</span> ";
			return $msg;
		} else {
			$msg = "<span class='erorr'> Cập nhật không thành công</span> ";
			return $msg;
		}
	}
	public function del_product_cart($cart_id)
	{
		$cart_id = mysqli_real_escape_string($this->db->link, $cart_id);
		$query = "DELETE FROM cart WHERE cart_id = '$cart_id'";
		$result = $this->db->delete($query);
		if ($result) {
			header('Location:cart.php');
		} else {
			$msg = "<span class='error'>Sản phẩm đã được xóa</span>";
			return $msg;
		}
	}

	public function check_cart()
	{
		$sId = session_id();
		$query = "SELECT * FROM cart WHERE sId = '$sId' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function check_order($user_id)
	{
		$sId = session_id();
		$query = "SELECT * FROM `order` WHERE user_id = '$user_id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function del_all_data_cart()
	{
		$sId = session_id();
		$query = "DELETE FROM cart WHERE sId = '$sId' ";
		$result = $this->db->select($query);
		return $result;
	}

	public function insertOrder($user_id)
	{
		$sId = session_id();
		$query = "SELECT * FROM cart WHERE sId = '$sId'";
		$get_product = $this->db->select($query);
		if ($get_product) {
			while ($result = $get_product->fetch_assoc()) {
				$product_id = $result['product_id'];
				$product_name = $result['product_name'];
				$quantity = $result['quantity'];
				$price = $result['price'] * $quantity;
				$image = $result['image'];
				$user_id = $user_id;
				$query_order = "INSERT INTO `order`(product_id,product_name,quantity,price,image,user_id) VALUES('$product_id','$product_name','$quantity','$price','$image','$user_id')";
				$insert_order = $this->db->insert($query_order);
			}
		}
	}
	public function getAmountPrice($user_id)
	{
		$query = "SELECT price FROM `order` WHERE user_id = '$user_id' ";
		$get_price = $this->db->select($query);
		return $get_price;
	}
	public function get_cart_ordered($user_id)
	{
		$query = "SELECT * FROM `order` WHERE user_id = '$user_id' ";
		$get_cart_ordered = $this->db->select($query);
		return $get_cart_ordered;
	}
	public function get_inbox_cart()
	{
		$query = "SELECT * FROM `order`";
		$get_inbox_cart = $this->db->select($query);
		return $get_inbox_cart;
	}

	public function shifted($shifid, $qty, $proid, $price, $time, $id)
	{
		$id = mysqli_real_escape_string($this->db->link, $id);
		$time = mysqli_real_escape_string($this->db->link, $time);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$query = "UPDATE `order` SET order_status = '1' WHERE user_id = '$id' AND order_date = '$time' AND price = '$price' ";
		$result = $this->db->update($query);
		if ($result) {
			$msg = "<span class='success'>xác nhận thành công</span> ";
			return $msg;
		} else {
			$msg = "<span class='error'> xác nhận thành công</span> ";
			return $msg;
		}
	}
	public function del_shifted($id, $time, $price)
	{
		$id = mysqli_real_escape_string($this->db->link, $id);
		$time = mysqli_real_escape_string($this->db->link, $time);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$query = "DELETE FROM `order` WHERE order_id = '$id' AND order_date = '$time' AND price = '$price' ";

		$result = $this->db->update($query);
		if ($result) {
			$msg = "<span class='success'> Xóa đơn thành công</span> ";
			return $msg;
		} else {
			$msg = "<span class='erorr'>chưa thành công</span> ";
			return $msg;
		}
	}
	public function shifted_confirm($id, $time, $price)
	{
		$id = mysqli_real_escape_string($this->db->link, $id);
		$time = mysqli_real_escape_string($this->db->link, $time);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$query = "UPDATE `order` SET order_status = '2' WHERE user_id = '$id' AND order_date = '$time' AND price = '$price' ";

		$result = $this->db->update($query);
		return $result;
	}

	public function update_product_soldout($proid, $qty)
	{
		$proid = mysqli_real_escape_string($this->db->link, $proid);
		$qty = mysqli_real_escape_string($this->db->link, $qty);

		$query_select = "SELECT * FROM product WHERE product_id='$proid'";
		$get_select = $this->db->select($query_select)->fetch_assoc();
		$qtyold = $get_select["product_soldout"];
		$qty_total = $qty + $qtyold;
		$product_remain = $qty - $qty_total;
		$query = "UPDATE product SET product_soldout = '$qty_total', product_remain = '$product_remain' WHERE product_id = '$proid' ";
		$result = $this->db->update($query);
		return $result;
	}
}
?>