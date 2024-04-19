<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin(); // gọi hàm check login để ktra session
	include_once($filepath.'/../lib/database.php');
	include_once($filepath.'/../helpers/format.php');
?>



<?php
/**
 * 
 */
class adminlogin
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}
	public function login_admin($adminUser, $adminPass)
	{
		$adminUser = $this->fm->validation($adminUser); //gọi ham validation từ file Format để ktra
		$adminPass = $this->fm->validation($adminPass);

		$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
		$adminPass = mysqli_real_escape_string($this->db->link, $adminPass); //mysqli gọi 2 biến. (adminUser and link) biến link -> gọi conect db từ file db

		if (empty($adminUser) || empty($adminPass)) {
			$alert = "User và Pass không được rỗng";
			return $alert;
		} else {
			$query = "SELECT * FROM `admin` WHERE admin_user = '$adminUser' AND admin_pass = '$adminPass' LIMIT 1 ";
			$result = $this->db->select($query);

			if ($result != false) {
				//session_start();
				// $_SESSION['login'] = 1;
				//$_SESSION['user'] = $user;
				$value = $result->fetch_assoc();
				Session::set('adminlogin', true); // set adminlogin đã tồn tại
				// gọi function Checklogin để kiểm tra true.
				Session::set('admin_id', $value['admin_id']);
				Session::set('admin_user', $value['admin_user']);
				Session::set('admin_name', $value['admin_name']);
				header("Location:index.php");
			} else {
				$alert = "Tài khoản hoặc mật khẩu không đúng";
				return $alert;
			}
		}
	}
}
?>