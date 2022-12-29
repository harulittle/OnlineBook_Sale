<?php
 	require_once('conn.php');
	if(isset($_REQUEST['btnsave']))
	{
		
		$bname = $_REQUEST['txtbookname'];
		$sname = $_REQUEST['cbosubject'];
		$aname = $_REQUEST['txtauthorname'];
		$ino = $_REQUEST['txtisbnno'];
		$sp = $_REQUEST['txtsaleprice'];
		$photo = $_FILES['photo']['name'];
		
		if(empty($bname))
			$msg = "Please Enter Book Name";
		else if($sname == "0")
			$msg = "Please Choose Subject Name";
		else if(empty($aname))
			$msg = "Please Enter Author Name";
		else if(empty($ino))
			$msg = "Please Enter Isbn No.";
		else if(empty($sp))
			$msg = "Please Enter Sale Price.";
		else if(empty($photo))
			$msg = "Please Choose Photo";
		else
		{
			$query =$conn->query("Select * from book  where bookname='$bname' and subjectid='$sname' and authorname='$aname'")or die("Cann't Select");
			$num = mysqli_num_rows($query);
			if($num>0)
			{
				$msg = "This book is already exist!";
			}
			else
			{
				$query=$conn->query("Insert into book(bookname,subjectid,authorname,isbn_no,saleprice,photo)values('$bname','$sname','$aname','$ino','$sp','$photo')")or die("Can not insert");
				if($query)
				{
					move_uploaded_file($_FILES["photo"]["tmp_name"],"../photo/".$photo);
					$msg="Save Successful Record";
				}
			}
		}
	}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Online Book Sale</title>
<link rel="stylesheet" type="text/css" href="Style.css"/>
</head>

<body>
	
   <?php 
		require_once("header.php");
	?>
    <div id="page">
    <div id="content">
	<h3>Welcome to
	<?php
		if(!empty($_SESSION['uname']))
		echo "<font color = 'red'>".$_SESSION['uname']."</font>";
	?>
	</h3>
    <?php
	if(!empty($msg))
		echo "<font color='red'>".$msg."</font>";
	?>
	<form action="#" method="post" enctype="multipart/form-data" name="Book"><table width="60%" border="2" cellspacing="10" cellpadding="10">
  <tr>
    <td colspan="2" class="headerbg">New Book</td>
    </tr>
  <tr>
    <td>Book Name</td>
    <td><input name="txtbookname" type="text" char width="30" /></td>
  </tr>
  <tr>
    <td>Subject Name</td>
    <td>
      <select name="cbosubject" type="Menu">
      <option value="0">--Select One--</option>
        <?php
		
		$query = $conn->query("Select * from subject")or die("Cann't select.");
		while($row = mysqli_fetch_array($query))
		{
			$sid = $row["subjectid"];
			$sname = $row["subjectname"];
			echo '<option value = "'.$sid.'">'.$sname.'</option>';
		}
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Author Name</td>
    <td><input name="txtauthorname" type="text" char width="30" /></td>
  </tr>
  <tr>
    <td>ISBN No.</td>
    <td><input name="txtisbnno" type="text" char width="30" /></td>
  </tr>
  <tr>
    <td>Sale Price</td>
    <td><input name="txtsaleprice" type="text" char width="30" /></td>
  </tr>
  <tr>
    <td>Photo</td>
    <td><input type="file" name="photo" id="photo" /></td>
  </tr>
  <tr>
    <td colspan="2"><input name="btnsave" type="submit" value="Save" class="box"/> 
      <input name="btncancel" type="reset" value="Cancel" class="box"/></td>
    </tr>
</table>
</form>
	</div>
    </div>
    <div id = "footer">
    &copy;2016 YourSite.Design by YarZar Lin
    </div>
</body>
</html>