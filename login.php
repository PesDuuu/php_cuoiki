<?php 
	include 'inc/header.php';

?>
<?php
	$login_check = session::get('user_login');
	if ($login_check)
	{
	header('Location:order.php');
	}
	
?>
<?php
    // gọi class category
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $insert_customer = $cs->insert_customer($_POST); // hàm check catName khi submit lên
    }
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
        $login_customer = $cs->login_customer($_POST); // hàm check catName khi submit lên
    }
  ?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Đăng nhập</h3>
        	<?php
    		if(isset($login_customer)) 
    		{
    			echo $login_customer;
    		}
    		?>
        	<p>Đăng nhập bên dưới</p>
        	<form action="" method="post">
                	<input  type="text" name ="email" class="field"  placeholder="Nhập tài khoản">
                    <input  type="password" name="password" class="field" placeholder="Nhập mật khẩu">
                 	<p class="note">Click vào đây nếu bạn quên mật khẩu<a href="#">click</a></p>
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Đăng nhập"></div></div>
                </form>
                    </div>
    	<div class="register_account">
    		<h3>Đăng ký tài khoản mới</h3>
    		<?php
    		if(isset($insert_customer)) 
    		{
    			echo $insert_customer;
    		}
    		?>

    		<form action="" method="post">
				<table>
				<tbody>
				<tr>
				<td>
					<div>
						<input type="text" name ="user_name" placeholder="Nhập tên...">
					</div>
					<div>
						<input type="text" name="user_email" placeholder="Nhập email...">
					</div>
					<div>
						<input type="text" name="password" placeholder="Nhập mật khẩu">
					</div>
				</td>
				<td>
				<div>
					<input type="text" name="address" placeholder="Nhập địa chỉ...">
				</div>   
		        <div>
		          	<input type="text" name="phone" placeholder="Nhập số điện thoại">
		        </div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   	<div class="search"><div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div></div>
		    <p class="terms">Click vào để xem  <a href="#"> Nội quy &amp; điều khiện</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
	include 'inc/footer.php'; 
?>