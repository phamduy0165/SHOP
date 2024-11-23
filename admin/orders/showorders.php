<?php
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    $connect->query("delete from orderdetail where orderid=$id");
    $connect->query("delete from orders where id=$id");
    echo"<script>location='?option=comment&status=4';</script>";
    }
?>
<?php
    $status=$_GET['status'];
    $query="SELECT o.*, m.username FROM orders o JOIN member m ON o.memberid = m.id WHERE o.status=$status";
    $result=$connect->query($query);
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Đơn hàng <?=$status==1?'chưa xử lý':($status==2?'đang xử lý':($status==3?'đã xử lý':'hủy'))?></h1>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt</th>
            <th>Tên người dùng</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['orderdate']?></td>
                <td><?=$item['username']?></td>
                <td><a class="btn btn-sm btn-primary" href="?option=comment&id=<?=$item['id']?>">Detail</a>
                <a style="display: <?=$status==4?'':'none'?>" class="btn btn-sm btn-danger" href="?option=comment&id=<?=$item['id']?>" onclick="return confirm('Bạn có chắc chắn không?')">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>