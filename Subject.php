<?php 
		require_once('conn.php');
		
		if(isset($_REQUEST['btnsave']))
		{
			$sname = $_REQUEST['subname'];
			
			
			if(empty($sname))
				$msg = "Please Enter Subject Name";
			
			else
			{ 
				$query = $conn->query("Select * from subject where SubjectName='$sname'") or die("Can't Select");
				$num = mysqli_num_rows($query);
				if($num>0)
				{
					$msg="This record is already exist!";
				}
				else
				{
					$query = $conn->query("Insert into subject(SubjectName)values('$sname')");
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
	<title>Subject</title>
	<link rel="stylesheet" type="text/css" href="Style.css"/>
</head>
<body>
	<?php
		require_once('header.php');
	?>
	<div id="page">
		<div id="content">
			<h3>
				Welcome to
				<?php
				if(!empty($_SESSION['uname']))
					echo "<font color='red'>".$_SESSION['uname']."</font>";
				?>
			</h3>
			<?php
				if(!empty($msg))
					echo "<font color='red'>".$msg."</font>";
			?>
	<form action="#" method="Post">
		<table width="50%" border="2" cellspacing="10" cellpadding="10">
			<tr>
				<td colspan="2" style="text-align: center; background-color: green"><h3>New Subject</h3></td>
			</tr>
			<tr>
				<td>Subject Name</td>
				<td><input type="text" name="subname"></td>
			</tr>
			<tr>
				<td colspan="2">
					
					<input type="submit" name="btnsave" value="Save" class="box">
					<input type="reset" name="btncancel" value="Cancel" class="box">
				</td>
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