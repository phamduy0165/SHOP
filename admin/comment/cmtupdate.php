<?php 
    $cmt=mysqli_fetch_array($connect->query("select*from comment where id=".$_GET['id']));
?>
<?php
    if(isset($_POST['name'])){
        $name=$_POST['name'];
        $query="select*from comment where content='$name' and id!=".$cmt['id'];
            $status=$_POST['status'];
            $connect->query("update comment set content='$name',status='$status' where id=".$cmt['id']); 
            echo"<script>location='?option=comment';</script>";

    }
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=brand"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a> Update bình luận</h1>
</div>
<section style="color: red; text-align:center"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post">
        <section class="form-group">
            <label>Lời bình luận: </label><input value="<?=$cmt['content']?>" name="name" class="form-control" required>
        </section>
        <section class="form-group">
            <label>Trạng thái bình luận: </label><br><input type="radio" name="status" value="1" <?=$cmt['status']==1?'checked':''?>> 
            Hoạt động <input type="radio" name="status" value="0" <?=$cmt['status']==0?'checked':''?>> Khóa
        </section>
        <section>
            <input type="submit" value="Update" class="btn btn-success">
        </section>
    </form>   
</section>