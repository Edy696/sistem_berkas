<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$conn = mysql_connect('127.0.0.1','root','admin');
	mysql_select_db('sistem_berkas',$conn);
	
	$rs = mysql_query("select count(*) from agenda");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysql_query("select * from agenda limit $offset,$rows");
	
	$rows = array();
	while($row = mysql_fetch_object($rs)){
		array_push($rows, $row);
	}
	$result["rows"] = $rows;
	
	echo json_encode($result);
?>