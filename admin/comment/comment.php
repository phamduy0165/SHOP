<?php
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $products=$connect->query("select*from comment where id=$id");
        if(mysqli_num_rows($products)!=0){
            $connect->query("update comment set status=0 where id=$id");
        }else{
            $connect->query("delete from comment where id=$id");
        }
    }
?>
<?php
    $query="select*from comment";
    $result=$connect->query($query);
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Bình luận</h1>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã Bình Luận</th>
            <th>Mã khách hàng</th>
            <th>Lời bình luận</th>
            <th>Trạng thái bình luận</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count=1;?>
        <?php foreach($result as $item): ?>
            <tr>
                <td><?=$count++?></td>
                <td><?=$item['id']?></td>
                <td><?=$item['memberid']?></td>
                <td><?=$item['content']?></td>
                <td><?=$item['status']==1?'Hoạt động':'Khóa'?></td>
                <td><a class="btn btn-sm btn-primary" href="?option=commentupdate&id=<?=$item['id']?>">Update</a>
                <a class="btn btn-sm btn-danger" href="?option=comment&id=<?=$item['id']?>" onclick="return confirm('Bạn có chắc chắn không?')">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>