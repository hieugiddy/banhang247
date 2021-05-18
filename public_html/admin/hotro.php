<link rel="stylesheet" href="css/hienthi_sp.css">
<script type="text/javascript" src="js/checkbox.js"></script>
<?php
	include ('../include/connect.php');
	
    $select = "select * from hotro ";
    $query = mysqli_query($conn,$select);
    $dem = mysqli_num_rows($query);
?>
<div class="quanlysp">
	<h3>QUẢN LÝ HỖ TRỢ</h3>
	<p>Có tổng <font color=red><b><?php echo $dem ?></b></font> tin</p>
	<form action="admin.php?admin=xulyht" method="post">
		<div id="check">
			<p>
				<input type="submit" name="xoa" value="Xóa" />

			</p>
		</div>
</div>
<table>
    
    <tr class='tieude_hienthi_sp'>
		
		<td width="30"><input type="checkbox" name="check"  class="checkbox" onclick="checkall('item', this)"></td>
        <td>ID</td>
        <td>Chủ đề</td>
        <td>Nội dung</td>
        <td>Tên</td>
        <td>Email</td>
    </tr>

    <?php
	
	/*------------Phan trang------------- */
		// Nếu đã có sẵn số thứ tự của trang thì giữ nguyên (ở đây tôi dùng biến $page) 
		// nếu chưa có, đặt mặc định là 1!   

		if(!isset($_GET['page'])){  
		$page = 1;  
		} else {  
		$page = $_GET['page'];  
		}  

		// Chọn số kết quả trả về trong mỗi trang mặc định là 10 
		$max_results = 10;  

		// Tính số thứ tự giá trị trả về của đầu trang hiện tại 
		$from = (($page * $max_results) - $max_results);  

		// Chạy 1 MySQL query để hiện thị kết quả trên trang hiện tại  

		$sql = mysqli_query($conn,"SELECT * FROM hotro LIMIT $from, $max_results"); 



								
    if($dem > 0)
        while ($bien = mysqli_fetch_array($sql))
        {
?>
            <tr class='noidung_hienthi_sp'>
				<td class="masp_hienthi_sp"><input type="checkbox" name="id[]" class="item" class="checkbox" value="<?=$bien['idht']?>"/></td>
                <td class="masp_hienthi_sp"><?php  echo $bien['idht'] ?></td>
                <td class="stt_hienthi_sp"><?php echo $bien['chude'] ?></td>
                <td class="img_hienthi_sp"> <?php echo $bien['noidung'] ?>  </td>
				<td class="sl_hienthi_sp"><?php echo $bien['hoten'] ?></td>
				<td class="sl_hienthi_sp"><?php echo $bien['email'] ?></td>
			</tr>
<?php 
    }
	
    else echo "<tr><td colspan='6'>Không có tin nào</td></tr>";
	
?>
</table>
</form>
	
<script language="JavaScript">
    function checkdel(idht)
    {
        var	idht=idht;
        if(confirm("Bạn có chắc chắn muốn xóa tin này?")==true)
            window.open(link,"_self",1);
    }
</script>