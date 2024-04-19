<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
/**
 * 
 */
class product
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	public function insert_product($data, $files)
	{

		$product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
		$product_code = mysqli_real_escape_string($this->db->link, $data['product_code']);
		$product_quantity = mysqli_real_escape_string($this->db->link, $data['product_quantity']);
		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		//mysqli gọi 2 biến. (catName and link) biến link -> gọi conect db từ file db

		// kiểm tra hình ảnh và lấy hình ảnh cho vào folder upload
		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "uploads/" . $unique_image;

		if ($product_code == '' || $product_name == "" || $product_quantity == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == "") {
			$alert = "<span class='error'>không được để trống</span>";
			return $alert;
		} else {
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO product(product_name,product_code,image,product_quantity,price,product_desc,type) VALUES('$product_name','$product_code','$unique_image','$product_quantity','$price','$product_desc','$type') ";
			$result = $this->db->insert($query);
			if ($result) {
				$alert = "<span class='success'>Thêm thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Thêm không thành công</span>";
				return $alert;
			}
		}
	}
	public function show_product()
	{
		$query =
			"SELECT * FROM product order by product.product_id desc ";

		// $query = "SELECT * FROM product order by product_id desc ";
		$result = $this->db->select($query);
		return $result;
	}

	public function update_quantity_product($data, $files, $id)
	{
		$product_more_quantity = mysqli_real_escape_string($this->db->link, $data['product_more_quantity']);
		$product_quantity = mysqli_real_escape_string($this->db->link, $data['product_quantity']);

		if ($product_more_quantity == "") {

			$alert = "<span class='error'>Không được để trống</span>";
			return $alert;
		} else {
			$qty_total = $product_more_quantity + $product_quantity;
			//Nếu người dùng không chọn ảnh
			$query = "UPDATE product SET
					
					product_quantity = '$qty_total'

					WHERE product_id = '$id'";
		}
		$query_warehouse = "INSERT INTO warehouse(id_sanpham,sl_nhap) VALUES('$id','$product_more_quantity') ";
		$result_insert = $this->db->insert($query_warehouse);
		$result = $this->db->update($query);

		if ($result) {
			$alert = "<span class='success'>Thêm số lượng thành công</span>";
			return $alert;
		} else {
			$alert = "<span class='error'>Thêm số lượng không thành công</span>";
			return $alert;
		}
	}
	public function update_product($data, $files, $id)
	{

		$product_name = mysqli_real_escape_string($this->db->link, $data['product_name']);
		$product_code = mysqli_real_escape_string($this->db->link, $data['product_code']);
		$product_quantity = mysqli_real_escape_string($this->db->link, $data['product_quantity']);

		$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
		$price = mysqli_real_escape_string($this->db->link, $data['price']);
		$type = mysqli_real_escape_string($this->db->link, $data['type']);
		$permited  = array('jpg', 'jpeg', 'png', 'gif');

		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_temp = $_FILES['image']['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		// $file_current = strtolower(current($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
		$uploaded_image = "uploads/" . $unique_image;


		if ($product_code == "" || $product_name == "" || $product_quantity == ""  || $product_desc == "" || $price == "" || $type == "") {
			$alert = "<span class='error'>Fields must be not empty</span>";
			return $alert;
		} else {

			if (!empty($file_name)) {
				//Nếu người dùng chọn ảnh
				if (in_array($file_ext, $permited) === false) {
					// echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
					$alert = "<span class='success'>You can upload only:-" . implode(', ', $permited) . "</span>";
					return $alert;
				}
				move_uploaded_file($file_temp, $uploaded_image);
				//Nếu người dùng không chọn ảnh
				$query = "UPDATE product SET 
					product_name ='$product_name',
					product_code = '$product_code',
					product_quantity = '$product_quantity',
					price = '$price',
					product_desc = '$product_desc',
					image = '$unique_image',
					type = '$type'

					 WHERE product_id = '$id' ";
			} else {
				$query = "UPDATE product SET 
					product_name ='$product_name',
					product_code = '$product_code',
					product_quantity = '$product_quantity',
					price = '$price',
					product_desc = '$product_desc',
					type = '$type'

					 WHERE product_id = '$id' ";
			}
			$result = $this->db->update($query);
			if ($result) {
				$alert = "<span class='success'>Cập nhật thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Chưa được cập nhật </span>";
				return $alert;
			}
		}
	}
	public function del_product($id)
	{
		$query = "DELETE FROM product where product_id = '$id' ";
		$result = $this->db->delete($query);
		if ($result) {
			$alert = "<span class='success'>Product Deleted Successfully</span>";
			return $alert;
		} else {
			$alert = "<span class='success'>Product Deleted Not Success</span>";
			return $alert;
		}
	}
	public function getproductbyId($id)
	{
		$query = "SELECT * FROM product where product_id = '$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	//Kết thúc Backend

	public function getproduct_featheread()
	{
		$query = "SELECT * FROM product where type = '1' order by product_id desc LIMIT 4 ";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproduct_new()
	{
		$query = "SELECT * FROM product order by product_id desc LIMIT 100 ";
		$result = $this->db->select($query);
		return $result;
	}
	public function get_details($id)
	{
		$query =
			"SELECT * FROM product WHERE product.product_id = '$id'";

		$result = $this->db->select($query);
		return $result;
	}

	public function update_product_remain($id)
	{
		$query = "SELECT * FROM product WHERE product_id = '$id'";
		$result = $this->db->select($query)->fetch_assoc();
		$qty = $result["product_quantity"];
		$sold = $result["product_soldout"];
		$product_remain = $qty - $sold;
		$query_update = "UPDATE product
			 SET product_remain='$product_remain' 
			 WHERE product_id ='$id' ";
		$result_update = $this->db->update($query_update);
	}
	public function show_product_remain($id)
	{
		$query_show = "SELECT * FROM product WHERE product_id = '$id'";
		$result_show = $this->db->select($query_show);
		return $result_show;
	}
	public function search_product($str)
	{
		$query = "SELECT * FROM product WHERE LOWER (product_name) LIKE '%$str%'";
		$result = $this->db->select($query);
		return $result;
	}
	public function getproduct_soldout_best()
	{
		$query = "SELECT * FROM product order by product_soldout desc LIMIT 4 ";
		$result = $this->db->select($query);
		return $result;
	}
}
?>