<?php 
		require_once('conn.php');
		
		if(isset($_REQUEST['btnlogin']))
		{
			$username = $_REQUEST['txtusername'];
			$userpassword = $_REQUEST['txtpassword'];
			$usertype = $_REQUEST['cbousertype'];
			
			if(empty($username))
				$msg = "Please Enter User Name";
			elseif(empty($userpassword))
				$msg = "Please Enter User Password";
			elseif($usertype=="0")
				$msg = "Please choose user type";
			else
			{ 
				$query = $conn->query("SELECT * FROM user WHERE userName='$username' AND Password='$userpassword'") or die("Cann't Select");
				$num = mysqli_num_rows($query);
				if($num>0)
				{
					$_SESSION['uname']=$username;
					echo '<script language="javascript">window.location.href = "User.php"</script>';
				}
				else
				{
					$msg="Username and password is invalid,please try again";
					
				}
			}
		}
	?>



<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div id="page">
		<div id="content">
			
			<?php
				if(!empty($msg))
					echo "<font color='red'>".$msg."</font>";
			?>
	
			<form name="user" action="#" method="post">
				<table width="50%" border="2" id="content" cellpadding="10" cellspacing="10">
					<tr>
						<th colspan="2" style="background-color: #0F0">LOGIN</th>				
					</tr>
					<tr>
						<td>User Name</td>
						<td><input type="text" name="txtusername" width="30"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="Password" name="txtpassword" width="30"></td>
					</tr>
					<tr>
						<td>User Type</td>
						<td>
							<select name="cbousertype">
								<option value="0">---Select---</option>
								<option value="admin">Adminstrator</option>
								<option value="user">User</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right" >
							<input type="submit" name="btnlogin" value="Login" class="box"><input type="reset" name="reset" value="Cancel" class="box"></td>
						
					</tr>
				</table>
			</form>
		</div>
	</div>

</body>
</html>