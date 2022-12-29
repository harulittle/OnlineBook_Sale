<?php 
    require_once("conn.php");
    if(isset($_REQUEST["dbid"]))
    {
      $delete_bid = $_REQUEST["dbid"];
    
      $query =$conn->query("Delete from Book where bookid = ".$delete_bid)or die("Can not delete");
      if($query)
      {
        $msg="Delete successfully";
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
	<table width="100%" border="2" cellspacing="5" cellpadding="10">
  <tr>
    <td colspan="7" class = "headerbg">BOOK LIST</td>
    </tr>
  <tr>
    <td>Photo</td>
    <td>Book Name </td>
    <td>Subject Name</td>
    <td>Author Name</td>
    <td>ISBN NO</td>
    <td>Sale Price</td>
    <td>Action</td>
  </tr>
  <?php
  	
	$query = $conn->query("Select * From book ,subject where book.subjectid=subject.subjectid");
	while($row = mysqli_fetch_array($query))
	{
		$photo = $row["photo"];
		$bname = $row["bookname"];
		$sname = $row["subjectname"];
		$aname = $row["authorname"];
		$ino = $row["isbn_no"];
		$sp = $row["saleprice"];
		$bid = $row["bookid"];
  ?>
  <tr>
    <td>
    <img src="../photo/<?php echo $photo; ?>" width="100" height="100" />
    </td>
    <td><?php echo $bname; ?></td>
    <td><?php echo $sname; ?></td>
    <td><?php echo $aname; ?></td>
    <td><?php echo $ino; ?></td>
    <td><?php echo $sp; ?></td>
    <td width=>
      <a href="bookedit.php?ebid=<?php echo $bid; ?>">Edit</a>
      <a href="bookedit.php?ebid=<?php echo $bid; ?>"><img src="images/_DIT2.PNG" width="16" height="16" /></a>
      <a href="booklist.php?dbid=<?php echo $bid; ?>">Delete</a>
      <a href="booklist.php?dbid=<?php echo $bid; ?>"><img src="images/_EL.PNG" width="18" height="19" /></a>
    </td>
  </tr>
  <?php 
	}
  ?>
</table> 
	</div>
    </div>
    <div id = "footer">
    &copy;2016 YourSite.Design by PHP Developers
    </div>                                            
</body>
</html>