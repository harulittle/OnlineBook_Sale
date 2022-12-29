<!DOCTYPE html>
<html>
<head>
	<title>Book</title>
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
	<form>
		<table width="50%" border="2" cellspacing="10" cellpadding="10">
			<tr>
				<td colspan="2" style="text-align: center; background-color: green"> <h3>New Book</h3></td>
			</tr>
			<tr>
				<td>Book Name</td>
				<td><input type="" name="bname"></td>
			</tr>
			<tr>
				<td>Subject Name</td>
				<td>
					<select name="cboselect" type="Menu">
						<option>--Select One--</option>
						<?php

$query = $conn->query("Select * from subject")or die("Cann't select.");
while($row = mysqli_fetch_array($query))
{​​​​
$sid = $row["subjectid"];
$sname = $row["subjectname"];
echo '<option value = "'.$sid.'">'.$sname.'</option>';
}​​​​
?>


					</select>
				</td>
				<tr>
					<td>Author Name</td>
					<td><input type="text" name="aname"></td>
				</tr>
				<tr>
				<td>ISBN No.</td>
				<td><input type="text" name="isbn"></td>
				</tr>

				<tr>
					<td>Sale Price</td>
					<td><input type="text" name="price"></td>
				</tr>
				<tr>
					<td>Photo</td>
					<td><input type="file" name="photo"></td>
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