<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $products=$connect->query("select*from orderdetail where productid=$id");
        if(mysqli_num_rows($products)!=0){
            $connect->query("update products set status=0 where id=$id");
        }else{
            $connect->query("delete from products where id=$id");
            unlink("../images/".$_GET['image']);
        }
    }
?>
<?php
    $query="select*from products";
    $result=$connect->query($query);
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Sản phẩm</h1>
</div>
<div class="col-4" style="padding-left: 80px;"><a href="?option=productadd" class="btn btn-success">Thêm sản phẩm</a></div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá gốc</th>
            <th>Giá sau giảm</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
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
                <td><?=number_format($item['price'],0,',','.')?></td>
                <td><?=number_format($item['discount'],0,',','.')?></td>
                <td width="20%"><img src="../images/<?=$item['image']?>" width="50%"></td>
                <td><?=$item['status']==1?'Hoạt động':'Khóa'?></td>
                <td><a class="btn btn-sm btn-primary" href="?option=productupdate&id=<?=$item['id']?>">Update</a>
                <a class="btn btn-sm btn-danger" href="?option=product&id=<?=$item['id']?>&image=<?=$item['image']?>" onclick="return confirm('Bạn có chắc chắn không?')">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>