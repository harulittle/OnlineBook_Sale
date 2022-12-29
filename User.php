<?php 
		require_once('conn.php');
		
		if(isset($_REQUEST['btnsave']))
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
				$query = $conn->query("SELECT * FROM user WHERE UserName='$username' AND Password='$userpassword'") or die("Cann't Select");
				$num = mysqli_num_rows($query);
				if($num>0)
				{
					$msg="This record is already exist!";
				}
				else
				{
					$query = $conn->query("INSERT INTO user(UserName,Password,UserType)VALUES('$username','$userpassword','$usertype')");
					if($query)
					{
						$msg = "Save successful Record";
					}
				}
			}
		}
	?>


<!DOCTYPE html>
<html>
<head>
	<title>User</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
		require_once('header.php');
	?>
	<div id="page">
		<div id="content">
			<h3>
				Welcome to NOVEM DREAM
				<?php
				if(!empty($_SESSION['uname']))
					echo "<font color='red'>".$_SESSION['uname']."</font>";
				?>
			</h3>
			<?php
				if(!empty($msg))
					echo "<font color='red'>".$msg."</font>";
			?>
	
			<form name="user" action="#" method="post">
				<table  id="content" width="40%" border="2" cellpadding="10" cellspacing="10" >
					<tr>
						<th colspan="2" style="background-color: #0F0">New User</th>				
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
								<option value="Adminstrator">Adminstrator</option>
								<option value="user">User</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right" >
							<input type="submit" name="btnsave" value="Save" class="box"><input type="reset" name="reset" value="Cancel" class="box"></td>
						
					</tr>
				</table>
			</form>
		</div>
	</div>
	<div id="footer">
		&copy;2020 YourSite. Design by Laravel Development Member.
	</div>
</body>
</html>