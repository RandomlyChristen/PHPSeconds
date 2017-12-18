<!DOCTYPE html>
<?
$con = mysql_connect("localhost","comma","comma");
mysql_select_db("commadb", $con);

function showReviewList($_data, $_num, $_width) {
  $row = mysql_num_rows($_data);
  $num = $_num;
  if ($row < $_num) {
    $num = $row;
  }
  if (!$row) {
    echo "
    <tr>
		  <td align = 'center'> 아직 등록된 자료가 없습니다. </td>
		</tr>
    ";
  } else {
    echo "
    <table border = '1' width = '$_width' align = 'center'>
      <tr height = '30' bgcolor = 'FFFFEFD5'>
        <td align = 'left' width = '250'><font face = '나눔고딕' color = '555555'>
          <b><center> 도서명 </center></b>
        </font></td>
        <td align = 'center' width = '150'><font face = '나눔고딕' color = '555555'>
          <b><center> 글쓴이 </center></b>
        </font></td>
        <td align = 'center' width = '500'><font face = '나눔고딕' color = '555555'>
          <b><center> 제목 </center></b>
        </font></td>
        <td align = 'center' width = '50'><font face = '나눔고딕' color = '555555'>
          <b><center> 추천 </center></b>
        </font></td>
        <td align = 'center' width = '50'><font face = '나눔고딕' color = '555555'>
          <b><center> 조회 </center></b>
        </font></td>
      </tr>
    ";
    $counter = 0;
    while ($counter < $num) {
      $id = mysql_result($_data, $counter, "id");
      $bookname = mysql_result($_data, $counter, "bookname");
      $writer = mysql_result($_data, $counter, "writer");
      $rtitle = mysql_result($_data, $counter, "rtitle");
      $vote = mysql_result($_data, $counter, "vote");
      $hit = mysql_result($_data, $counter, "hit");
      echo "
      <tr height = '30'>
        <td align = 'left'><font face = '나눔고딕' color = '555555'>
          <a herf = '/bookinf.php?title=$bookname'> $bookname </a>
        </font></td>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          $writer
        </font></td>
        <td align = 'left'><font face = '나눔고딕' color = '555555'>
          <a herf = '/reviewshow.php?id=$id'> $rtitle </a>
        </font></td>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          $vote
        </font></td>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          $hit
        </font></td>
      </tr>
      ";
      $counter ++;
    }
    echo "
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
          <h3> 최신 리뷰 </h3>
        </td>
      </tr>
    </table>
    <?
    $query = "SELECT * FROM book ORDER BY id DESC";
		$result = mysql_query($query, $con);
    showReviewList($result, 3, 1000);
    ?>


    <br><br>
    <table border = '0' width = '1300' align = 'center'>
      <tr>
        <td align = 'center' width = '650'><font face = '나눔고딕' color = '555555'>
          <h3> 추천 리뷰 </h3>
        </td>
        <td align = 'center' width = '650'><font face = '나눔고딕' color = '555555'>
          <h3> 인기 리뷰 </h3>
        </td>
      </tr>
    </table>
    <table border = '0' width = '1300' align = 'center'>
      <tr>
        <td>
          <?
          $query = "SELECT * FROM book ORDER BY vote DESC";
      		$result = mysql_query($query, $con);
          showReviewList($result, 3, 650);
          ?>
        </td>
        <td>
          <?
          $query = "SELECT * FROM book ORDER BY hit DESC";
      		$result = mysql_query($query, $con);
          showReviewList($result, 3, 650);
          ?>
        </td>
      </tr>
    </table>
    <? mysql_close($con); ?>
  </body>
</html>
