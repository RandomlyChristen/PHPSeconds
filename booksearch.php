<!DOCTYPE html>
<?
$con = mysql_connect("localhost","comma","comma");
mysql_select_db("commadb", $con);

$field = $_POST['field'];
$key = $_POST['key'];
$page = $_GET['page'];
if (empty($key)) {
  $key = "";
}
if (empty($field)) {
  $field = "title";
}
if (($page == '') || ($page < 0)) {
  $page = 0;
}
function showBookList($_data, $_size, $_page) {
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
    <table border = '1' width = '1000' align = 'center'>
      <tr height = '30' bgcolor = 'FFFFEFD5'>
        <td align = 'center' width = '100'><font face = '나눔고딕' color = '555555'>
          <b><center> 출판 </center></b>
        </font></td>
        <td align = 'center' width = '450'><font face = '나눔고딕' color = '555555'>
          <b><center> 도서명 </center></b>
        </font></td>
        <td align = 'center' width = '150'><font face = '나눔고딕' color = '555555'>
          <b><center> 저자 </center></b>
        </font></td>
        <td align = 'center' width = '150'><font face = '나눔고딕' color = '555555'>
          <b><center> 출판사 </center></b>
        </font></td>
        <td align = 'center' width = '150'><font face = '나눔고딕' color = '555555'>
          <b><center> 소장정보 </center></b>
        </font></td>
      </tr>
    ";
    $counter = $_size * $_page;
    while ($counter < ($_size * ($_page + 1))) {
      $byear = mysql_result($_data, $counter, "byear");
      $title = mysql_result($_data, $counter, "title");
      $author = mysql_result($_data, $counter, "author");
      $publisher = mysql_result($_data, $counter, "publisher");
      $num = mysql_result($_data, $counter, "num");
      echo "
      <tr height = '30'>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          $byear
        </font></td>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          <a herf = '/bookinf.php?title=$title'> $title </a>
        </font></td>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          $author
        </font></td>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          $publisher
        </font></td>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          $num
        </font></td>
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
<html>
  <?
  include ("./banner.h");
  include ("./table.css");
  ?>
  <body>
    <br><br>
    <table border = '0' width = '1000' align = 'center'>
      <tr>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          <h3> 도서 검색 </h3>
        </td>
      </tr>
    </table>

    <table border = '0' width = '500' align = 'center'>
      <tr height = '25'>
        <td align = 'center' width = '500'>
          <form method = 'post' action = '/booksearch.php'>
            <select name = 'field'>
              <option value = 'title'><font face = '나눔고딕' color = '555555'>
                도서명
              </font></option>
              <option value = 'author'><font face = '나눔고딕' color = '555555'>
                저자
              </font></option>
            </select>
            <input type = 'text' value = '검색어를 입력하세요' name = 'key' size = '50'>
            <input type = 'submit' value = '검색'>
          </form>
        </td>
      </tr>
    </table>

    <br>
    <?
    $query = "SELECT * FROM book WHERE $field LIKE '%$key%' ORDER BY num DESC";
		$result = mysql_query($query, $con);
    showBookList($result, 10, $page);
    ?>
    <? mysql_close($con); ?>
  </body>
</html>
