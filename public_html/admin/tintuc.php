<link rel="stylesheet" href="css/hienthi_sp.css">
<script type="text/javascript" src="js/checkbox.js"></script>
<?php
	include ('../include/connect.php');
	
    $select = "select * from tintuc ";
    $query = mysqli_query($conn,$select);
    $dem = mysqli_num_rows($query);
?>
<div class="quanlysp">
	<h3>QUẢN LÝ TIN TỨC</h3>
	<a href='?admin=themtt' >Thêm tin tức</a><br>
	<p>Có tổng <font color=red><b><?php echo $dem ?></b></font> tin tức</p>
	<form action="admin.php?admin=xulytt" method="post">
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
        <td>Tiêu đề</td>
        <td>Nội dung ngắn</td>
        <td>Hình ảnh</td>
        <td>Tác giả</td>
        <td>Active</td>
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

		$sql = mysqli_query($conn,"SELECT * FROM tintuc order by matt DESC LIMIT $from, $max_results"); 



								
    if($dem > 0)
        while ($bien = mysqli_fetch_array($sql))
        {
?>
            <tr class='noidung_hienthi_sp'>
				<td class="masp_hienthi_sp"><input type="checkbox" name="id[]" class="item" class="checkbox" value="<?=$bien['matt']?>"/></td>
                <td class="masp_hienthi_sp" width="30"><?php  echo $bien['matt'] ?></td>
                <td class="stt_hienthi_sp"><?php echo $bien['tieude'] ?></td>
                <td class="img_hienthi_sp" width="300"> <?php echo $bien['ndngan'] ?>  </td>
				<td class="sl_hienthi_sp"><img src="../img/tintuc/<?php echo $bien['hinhanh'] ?>" width="80" height="60"/></td>
				<td class="sl_hienthi_sp"><?php echo $bien['tacgia'] ?></td>
                <td class="active_hienthi_sp">
                    <a href='?admin=suatt&matt=<?php echo $bien['matt'] ?>'><img src="img/sua.png" title="Sửa"></a>
				 </td>
            </tr>
<?php 
    }
	
    else echo "<tr><td colspan='6'>Không có khách hàng</td></tr>";
	
?>
</table>
</form>