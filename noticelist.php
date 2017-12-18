<html>
<?
include ("./banner.h");
include ("./table.css");
$con = mysql_connect("localhost","comma","comma");
mysql_select_db("commadb", $con);

function showNoticeList($_data, $_size, $_page, $_importance) {
  $row = mysql_num_rows($_data);
	$imp = "";
	if ($_importance == 1) {
		$imp = "*필독*";
	}
  $size = $_size;
  if ($row < $_size) {
    $size = $row;
  }
  if (!$row) {
    echo "
    <tr>
		  <td align = 'center'> 아직 등록된 자료가 없습니다. </td>
		</tr>
    ";
  } else {
    echo "
		<table width='1000' border =1 align = center>
			<tr height = '30' align=center><td width=15%></td><td width=70%>공지제목</td><td width =15%>관리자</td></tr>
    ";
    $counter = $_size * $_page;
    while ($counter < ($_size * ($_page + 1))) {
      $ntitle = mysql_result($_data, $counter, "ntitle");
      echo "
      <tr height = '30' align=center><td width=15%>$imp</td>
			<td width=70%><a herf = '/noticeshow.php?ntitle=$ntitle'> $ntitle </a></td>
			<td width =15%>관리자</td></tr>
      ";
      $counter ++;
    }
    echo "
    </table>
    <table border = '0' width = '500' align = 'center'>
      <tr height = '20'>
    ";
    $pageSize = (int) ($row / $_size);
    for ($i = 0; $i < $pageSize; $i ++) {
      echo "
      <td align = 'center'><font face = '나눔고딕' color = '555555'>
        [<a herf = '/booksearch.php?page=$i'> $i </a>]
      </font></td>
      ";
    }
    echo "
			</tr>
		</table>
		";
  }
}
?>
<body>
	<br><br>

	<?
	$query = "SELECT * FROM book WHERE importance = 1";
	$result = mysql_query($query, $con);
	showNoticeList($result, 10, $page, 1);
	$query = "SELECT * FROM book WHERE importance = 0";
	$result = mysql_query($query, $con);
	showNoticeList($result, 10, $page, 1);
	?>

	<? mysql_close($con); ?>
</body>
</html>
