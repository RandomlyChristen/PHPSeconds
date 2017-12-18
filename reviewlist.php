<html>
<?
include ("./banner.h");
include ("./table.css");
$con = mysql_connect("localhost","comma","comma");
mysql_select_db("commadb", $con);

$key = $_POST['key'];
if (empty($key)) {
	$key = "";
}
if (($page == '') || ($page < 0)) {
  $page = 0;
}
function showReviewList($_data, $_size, $_page) {
  $row = mysql_num_rows($_data);
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
			<tr height = '30' align=center><td width=5%>번호</td><td width=24%>도서명</td><td width =42%>제목</td><td width =15%>글쓴이</td><td width=7%>추천수</td><td width=7%>조회수</td></tr>
    ";
    $counter = $_size * $_page;
    while ($counter < ($_size * ($_page + 1))) {
			$id = mysql_result($_data, $counter, "id");
      $bookname = mysql_result($_data, $counter, "bookname");
      $rtitle = mysql_result($_data, $counter, "rtitle");
			$writer = mysql_result($_data, $counter, "writer");
      $vote = mysql_result($_data, $counter, "vote");
      $hit = mysql_result($_data, $counter, "hit");
      echo "
			<tr height = '30'>
			<td align=center>$id</td>
			<td><a herf = '/bookinf.php?title=$bookname'> $bookname </a></td>
// rtitle 확인할 것
			<td><a herf = '/reviewshow.php?rtitle=$rtitle'> $rtitle </a></td>
			<td align=center>$writer</td>
			<td align=center>$vote</td>
			<td align=center>$hit</td>
			</tr>
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
        [<a herf = '/reviewlist.php?page=$i'> $i </a>]
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
	<table width='1000' align=center><tr><td align=right>
		<form method = 'post' action = '/reviewlist.php'>
			<select name = 'field'>
				<option value = 'title'><font face = '나눔고딕' color = '555555'>
					제목
				</font></option>
				<option value = 'writer'><font face = '나눔고딕' color = '555555'>
					글쓴이
				</font></option>
			</select>
			<input type = 'text' value = '검색어를 입력하세요' name = 'key' size = '13' style = 'width:200; height:25;'>
			<input type = 'submit' value = '검색' style = 'width:80; height:25;'>
		</form>
	</td></tr></table>
	<br>
	<?
	$query = "SELECT * FROM review WHERE $field LIKE '%$key%' ORDER BY num DESC";
	$result = mysql_query($query, $con);
	showReviewList($result, 10, $page);
	?>
	<br>
	<table width = '1000' align=center><tr align=right><td>
		<form method = 'post' action = '/booksearch.php'>
			<input type = 'submit' value='쓰기' style = 'width:80; height:25;'>
		</form>
	</td></tr></table>
	</table>
	<? mysql_close($con); ?>
</body>
</html>
