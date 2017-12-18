<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <center><h1>00도서관</h1>
    	<table width = 100%>
    		<tr  height = '20'>
    			<td align = 'center' ><b> 책검색 </b></td>
    			<td align = 'center' ><b> 리뷰 </b></td>
    			<td align = 'center' ><b> 공지사항 </b></td>
    			<td align = 'center' ><b> 관리자 </b></td>
    		</tr>
    	</table>
    </center>
  </head>
  <body>
    <br><br>
    <table border = '0' width = '1000' align = 'center'>
      <tr>
        <td align = 'center'><font face = '나눔고딕' color = '555555'>
          <h3> 관리자 메뉴 </h3>
        </td>
      </tr>
    </table>

    <table border = '0' width = '1000' align = 'center'>
      <tr>
        <td align = 'center'>
          <form method = '' action = ''>
            <input type = 'text' name = 'title' value = 'booktitle' size = '50'>
            <input type = 'text' name = 'publisher' value = 'publisher' size = '50'>
            <input type = 'text' name = 'author' value = 'author' size = '50'>
            <input type = 'text' name = 'byear' value = 'byear' size = '50'>
            <input type = 'text' name = 'num' value = 'num' size = '50'>
            <input type = 'text' name = 'price' value = 'price' size = '50'>
            <textarea name = 'content' rows="15" cols="70"></textarea>
            <input type = 'text' name = 'imgpath' value = 'imgpath(EX : .\image\신경끄기의기술.JPG)' size = '50'>
            <input type = 'submit' value = '새 책 등록하기'>
        </form>
        </td>
        <td align = 'center'>
          <form method = '' action = ''>
              <input type = 'text' name = 'ntitle' value = 'notice title' size = '50'>
              <input type = 'text' name = 'importance' value = 'importance (EX : 0, 1)' size = '50'>
              <input type = 'text' name = 'ncontent' value = 'notice content' size = '50'>
              <input type = 'submit' value = '새 공지 등록하기' size = '50'>
          </form>
        </td>
      </tr>
    </table>
  </body>
</html>
