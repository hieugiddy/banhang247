<link rel="stylesheet" href="css/hienthi_sp.css">
<?php
	include ('../include/connect.php');
	
    $select = "select * from nguoidung ";
    $query = mysqli_query($conn,$select);
    $dem = mysqli_num_rows($query);
?>
<div class="quanlysp">
	<h3>QUẢN LÝ NGƯỜI DÙNG</h3>
	
	<p>Có tổng <font color=red><b><?php echo $dem ?></b></font> người dùng</p>
</div>
<table>
    
    <tr class='tieude_hienthi_sp'>
        <td>ID</td>
        <td>Tên ND</td>
        <td>Username</td>
        <td>Email</td>
        <td>Điện thoại</td>
        <td>Quyền</td>
        <td style="width:80px;">Active</td>
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

		$sql = mysqli_query($conn,"SELECT * FROM nguoidung LIMIT $from, $max_results"); 



								
    if($dem > 0)
        while ($bien = mysqli_fetch_array($sql))
        {
?>
            <tr class='noidung_hienthi_sp'>
                <td class="masp_hienthi_sp"><?php  echo $bien['idnd'] ?></td>
                <td class="stt_hienthi_sp"><?php echo $bien['tennd'] ?></td>
                <td class="img_hienthi_sp"> <?php echo $bien['username'] ?>  </td>
				<td class="sl_hienthi_sp"><?php echo $bien['email'] ?></td>
				<td class="sl_hienthi_sp">0<?php echo $bien['dienthoai'] ?></td>
				<td class="sl_hienthi_sp"><?php 
					if($bien['phanquyen']==0)
						echo "Administrator";
					else 
						echo "Người dùng";
					
				?></td>
                <td class="active_hienthi_sp">
                    <a href='?admin=suand&idnd=<?php echo $bien['idnd'] ?>'><img src="img/sua.png" title="Sửa"></a>
					<?php echo "<p onclick = 'checkdel({$bien['idnd'] })' ><img src='img/xoa.png' title='Xóa' class='delete'></p>" ?>
                </td>
            </tr>
<?php 
    }
	
    else echo "<tr><td colspan='6'>Không có khách hàng</td></tr>";
	
?>
</table>


<script language="JavaScript">
    function checkdel(idnd)
    {
        var	idnd=idnd;
        var link="xoa_nguoidung.php?idnd="+idnd;
        if(confirm("Bạn có chắc chắn muốn xóa người dùng này?")==true)
            window.open(link,"_self",1);
    }
</script>