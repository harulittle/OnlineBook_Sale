<?php
require_once("conn.php");
if(isset($_REQUEST['ebid']))
{
	$edit_bid=$_REQUEST['ebid'];
	$query=$conn->query("Select * From Book where bookid=".$edit_bid)or die ("Can't Select");
	$row= mysqli_fetch_array($query);

	$old_photo=$row["photo"];
	$old_bname=$row["bookname"];
	$old_subjectid=$row["subjectid"];
	$old_aname=$row["authorname"];
	$old_ino=$row["isbn_no"];
	$old_sp=$row["saleprice"];
}
?>

<?php
if(isset($_REQUEST['btnedit']))
{
	$bname=$_REQUEST['txtbookname'];
	$sname=$_REQUEST['cbosubject'];
	$aname=$_REQUEST['txtauthorname'];
	$ino=$_REQUEST['txtisbno'];
	$sp=$_REQUEST['txtsaleprice'];
	$photo=$_FILES['photo']['name'];

	if(empty($bname))
		$msg="Please Enter Book Name";
	else if($sname=="0")
		$msg="Please Choose Subject Name";
	else if (empty($aname))
		$msg="Please Enter Author Name";
	else if(empty ($ino))
		$msg="Please Enter Isbn No.";
	else if(empty($sp))
		$msg="Please Enter Sale Price";
	else
		{
			{
				if(empty($photo))
				{
					$query=$conn->query("Update book set bookname='$bname',subjectid='$sname', authorname='$aname', isbn_no='$ino',saleprice='$sp' where bookid=$edit_bid")or die ("Can't not update");
					if($query)
					{
						$msg="Update Successful Record";
					}
				}
				else
				{
					$query=$conn->query("Update book set bookname='$bname',subjectid='$sname', authorname='$aname', isbn_no='$ino',saleprice='$sp' ,photo='$photo' where bookid=$edit_bid")or die ("Can't not update");
					if(query)
					{
						move_uploaded_files($_FILES["photo"]["tmp_name"],"../photo/".$photo);
						$msg="Update Successful Record";
					}
				}
				echo '<script language="javascript">window.location.herf="booklist.php";</script>';
			}
		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book List</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
</head>
<body>
	<?php 
	  	require_once("header.php");
	  ?>
		<div id = "page">
		<div id = "content">
		<h3>Welcome to
			<?php
				if(!empty($_SESSION['uname']))
					echo "<font color = 'red'>".$_SESSION['uname']."</font>";
			?>
         </h3>
	  <?php
			if(!empty($msg))
				echo "<font color = 'red'>".$msg."</font>";
		?>
    
	<form action="#" method="post" enctype="multipart/form-data" name="BookEdit">
    <table width="60%" border="2" cellspacing="10" cellpadding="10">
  <tr>
    <td colspan="3" class="headerbg">BOOK EDIT</td>
    </tr>
  <tr>
    <td>Book Name</td>
    <td><input name="txtbookname" type="text" char width="30" value="<?php echo $old_bname; ?>" /></td>
    <td rowspan="3">Photo</td>
  </tr>
  <tr>
    <td>Subject Name</td>
    <td>
    <select name="cbosubject" id="cbosubject">
        <?php
		 echo '<option value="0">--Select--</option>';
		$query=$conn->query("Select * from subject")or die("Cann't select.");
		while($row=mysqli_fetch_array($query))
		{
			$sid=$row["subjectid"];
			$sname=$row["subjectname"];
			if($sid==$old_subjectid)
				echo '<option selected="selected" value="'.$sid.'">'.$sname.'</option>';
			else
				echo '<option value="'.$sid.'">'.$sname.'</option>';
		}
        ?>
      </select>
    </td>
    
  </tr>
  <tr>
    <td>Author Name</td>
    <td><input type="text" name="txtauthorname" value="<?php echo $old_aname; ?>" /></td>
    
  </tr>
  <tr>
    <td>ISBN No.</td>
    <td><input name="txtisbno" type="text" char width="30" value="<?php echo $old_ino; ?>" /></td>
    <td rowspan="3"><img src="../Photo/<?php echo $old_photo; ?>" width="80" height="74" ></td>
  </tr>
  <tr>
    <td>Sale Price</td>
    <td><input name="txtsaleprice" type="text" char width="30" value="<?php echo $old_sp; ?>" /></td>
    
  </tr>
  <tr>
    <td>Photo</td>
    <td><input type="file" name="photo" id="photo" /></td>
    
  </tr>
  <tr>
    <td colspan="3">
    <input name="btnedit" type="submit" value="Edit" class="box" /> 
      <input name="btncancel" type="reset" value="Cancel" class="box" />
    </td>
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