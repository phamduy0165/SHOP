<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $products=$connect->query("select*from products where brandid=$id");
        if(mysqli_num_rows($products)!=0){
            $connect->query("update brands set status=0 where id=$id");
        }else{
            $connect->query("delete from brands where id=$id");
        }
    }
?>
<?php
    $query="select*from brands";
    $result=$connect->query($query);
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Hãng sản xuất</h1>
</div>
<div class="col-4" style="padding-left: 70px;"><a href="?option=brandadd" class="btn btn-success">Thêm hãng</a></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã hãng</th>
            <th>Tên hãng</th>
            <th>Trạng thái hãng</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['name']?></td>
                <td><?=$item['status']==1?'Hoạt động':'Khóa'?></td>
                <td><a class="btn btn-sm btn-primary" href="?option=brandupdate&id=<?=$item['id']?>">Update</a>
                <a class="btn btn-sm btn-danger" href="?option=brand&id=<?=$item['id']?>" onclick="return confirm('Bạn có chắc chắn không?')">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>