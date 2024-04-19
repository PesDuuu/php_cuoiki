<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>
<?php
class customer
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function insert_customer($data)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['user_name']);
		$email = mysqli_real_escape_string($this->db->link, $data['user_email']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);

		if ($name == "" || $email == "" || $address == "" || $phone == "" || $password == "") {
			$alert = "<span class='error'>không được để trống</span>";
			return $alert;
		} else {
			$check_email = "SELECT * FROM user WHERE user_email='$email' LIMIT 1";
			$result_check = $this->db->select($check_email);
			if ($result_check) {
				$alert = "<span class='error'>email đã tồn tại </span>";
				return $alert;
			} else {
				$query = "INSERT INTO user(user_name, user_email, address, phone, password) VALUES ('$name', '$email', '$address', '$phone', '$password') ";
				$result = $this->db->insert($query);
				if ($result) {
					$alert = "<span class='success'>Tạo tài khoản thành công</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Tạo chưa thành công</span>";
					return $alert;
				}
			}
		}
	}
	public function login_customer($data)
	{
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
		if ($email == '' || $password == '') {
			$alert = "<span class='error'>không được để trống</span>";
			return $alert;
		} else {
			// $check_login = "SELECT * FROM customer WHERE email='$email' AND password='$password' ";
			$check_login = "SELECT * FROM user WHERE user_email = '$email' AND password = '$password' LIMIT 1 ";
			$result_check = $this->db->select($check_login);
			if ($result_check != false) {
				$value = $result_check->fetch_assoc();
				Session::set('user_login', true);
				Session::set('user_id', $value['user_id']);
				Session::set('user_name', $value['user_name']);
				header('Location:order.php');
			} else {
				$alert = "<span class='error'>Tài khoản hoặc mật khẩu không đúng</span>";
				return $alert;
			}
		}
	}
	public function show_customers($id)
	{
		$query = "SELECT * FROM user WHERE user_id ='$id' ";
		$result = $this->db->select($query);
		return $result;
	}
	public function update_customers($data, $id)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['user_name']);
		$email = mysqli_real_escape_string($this->db->link, $data['user_email']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);

		if ($name == "" || $email == "" || $address == "" || $phone == "") {
			$alert = "<span class='error'>Không được để trống</span>";
			return $alert;
		} else {
			$query = "UPDATE user SET user_name = '$name', user_email = '$email' , address = '$address', phone = '$phone' WHERE user_id ='$id'";
			$result = $this->db->update($query);
			if ($result) {
				$alert = "<span class='success'>Đã cập nhật thành công</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Cập nhật không thành công</span>";
				return $alert;
			}
		}
	}
}
?>