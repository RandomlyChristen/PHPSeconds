<!DOCTYPE html>
<?
$con = mysql_connect("localhost","comma","comma");
mysql_select_db("commadb", $con);

$title = $_GET['title'];
$query = "SELECT * FROM book WHERE title = $title";
$result = mysql_query($query, $con);

$publisher = mysql_result($result, 0, "publisher");
$author = mysql_result($result, 0, "author");
$byear = mysql_result($result, 0, "byear");
$num = mysql_result($result, 0, "num");
$price = mysql_result($result, 0, "price");
$content = mysql_result($result, 0, "content");
// 이미지 파일경로 양식 : .\image\신경끄기의기술.JPG
$imgpath = mysql_result($result, 0, "imgpath");
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
          <h3> 도서 정보 </h3>
        </td>
      </tr>
    </table>

    <table border = '1' width = '1000' align = 'center'>
      <tr>
        <td align = 'center' width = '380'>
          <!-- 도서 사진 불러오기 -->
          <? echo "
          <img src=$imgpath width="380" height="560" border="0">
          "; ?>
        </td>
        <td align = 'center' width = '620'>
          <table border = '0' width = '600' align = 'center'>
            <!-- 도서 이름 불러오기 -->
            <? echo "
            <tr>
              <td align = 'center'><font face = '나눔고딕' color = '555555'>
                <h3> $title </h3>
              </td>
            </tr>
            "; ?>
          </table>

          <table border = '1' width = '600' align = 'center'>
            <tr height = '30' bgcolor = 'FFFFEFD5'>
              <td align = 'center' width = '150'><font face = '나눔고딕' color = '555555'>
                <b><center> 저자 </center></b>
              </font></td>
              <td align = 'center' width = '150'><font face = '나눔고딕' color = '555555'>
                <b><center> 출판사 </center></b>
              </font></td>
              <td align = 'center' width = '150'><font face = '나눔고딕' color = '555555'>
                <b><center> 소장정보 </center></b>
              </font></td>
              <td align = 'center' width = '150'><font face = '나눔고딕' color = '555555'>
                <b><center> 출판일 </center></b>
              </font></td>
            </tr>
            <!-- 도서 정보 불러오기 -->
            <? echo "
            <tr height = '30'>
              <td align = 'center'><font face = '나눔고딕' color = '555555'>
                $author
              </font></td>
              <td align = 'center'><font face = '나눔고딕' color = '555555'>
                $publisher
              </font></td>
              <td align = 'center'><font face = '나눔고딕' color = '555555'>
                $num
              </font></td>
              <td align = 'center'><font face = '나눔고딕' color = '555555'>
                $byear
              </font></td>
            </tr>
            "; ?>

            <tr height = '30' bgcolor = 'FFFFEFD5'>
              <td colspan = '4' align = 'center' width = '600'><font face = '나눔고딕' color = '555555'>
                <b><center> 도서 소개 </center></b>
              </font></td>
            </tr>
            <!-- 도서 줄거리 불러오기 -->
            <? echo "
            <tr height = '100'>
              <td colspan = '4' align = 'left' width = '600'><font face = '나눔고딕' color = '555555'>
                $content
              </font></td>
            </tr>
          </table>
            "; ?>
          <!-- 뒤로 가기와 리뷰 쓰기 -->
          <table border = '0' align = 'right'>
            <tr height = '25'>
              <td align = 'center'>
                <font face = '나눔고딕' color = '555555'>
                  [<a href = '#' onclick = 'history.back()'>뒤로가기</a>]
                </font>
                <? echo "
                <font face = '나눔고딕' color = '555555'>
// bookname 확인할 것
                  [<a href = '/reviewwrite.php?bookname=$title'>리뷰쓰기</a>]
                </font>
                "; ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <? mysql_close($con); ?>
  </body>
</html>
