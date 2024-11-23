<?php
    if(empty($_SESSION['cart'])){
        $_SESSION['cart']=array();
    }
    if(isset($_GET['action'])){
        $id=isset($_GET['id'])?$_GET['id']:'';
        switch($_GET['action']) {
            case'add':
                $id = $_GET['id'];
                if (array_key_exists($id, $_SESSION['cart'])) {
                    // Sản phẩm đã tồn tại, tăng số lượng
                    $_SESSION['cart'][$id]++;
                } else {
                    // Sản phẩm chưa tồn tại, thêm vào giỏ hàng
                    $_SESSION['cart'][$id] = 1;
                }
                echo"<script>location='?option=cart';</script>"; 
                break;
            case'delete':
                unset($_SESSION['cart'][$id]);
                $_SESSION['total_items'] = 0;
                echo"<script>location='?option=cart';</script>";
                break;
            case'deleteall':
                unset($_SESSION['cart']);
                $_SESSION['total_items'] = 0;
                echo"<script>location='?option=cart';</script>";
                break;
            case'update':
                if($_GET['type']=='asc')
                    $_SESSION['cart'][$id]++;
                else
                    if($_SESSION['cart'][$id]>1)
                    $_SESSION['cart'][$id]--;
                echo"<script>location='?option=cart';</script>"; 
                break;
            case'order':
                if(isset($_SESSION['member'])){
                    echo"<script>location='?option=order';</script>"; 
                }else{
                    echo"<script>location='?option=signin&order=1';</script>"; 
                }
                break;
        }
    }
?>
<section class="cart">
    <div class="container">
<?php
if(!empty($_SESSION['cart'])):
    $ids=implode(',', array_keys($_SESSION['cart']));
    $query="select*from products where id in($ids)";
    $result=$connect->query($query);
?>
    <table class="table-cart">
        <thead>
            <tr>
                <td></td>
                <td>Tên sản phẩm</td>
                <td>Giá tiền</td>
                <td>Số lượng</td>
                <td>Thành tiền</td>
            </tr>
        </thead>
        <tbody>
<?php
    $totalItem=0;
    $toTal=0;
    foreach($result as $item):  
?>
        <tr class="cart-body">
            <td  width="20%"><img width="50%" src="images/<?=$item['image']?>"></td>
            <td><?=$item['name']?></td>
            <td><?=number_format($item['discount'],0,',','.')?></td>
            <td><?=$_SESSION['cart'][$item['id']]?>
            <button class="quantity-button" data-type="asc" onclick="location='?option=cart&action=update&type=asc&id=<?=$item['id']?>';"><i class="fa fa-plus" aria-hidden="true" style="font-size:15px"></i></button>
            <button class="quantity-button" data-type="desc" onclick="location='?option=cart&action=update&type=desc&id=<?=$item['id']?>';"><i class="fa fa-minus" aria-hidden="true" style="font-size:15px"></i></button>
            </td>
            <td><?=number_format($subTotal=$item['discount']*$_SESSION['cart'][$item['id']],0,',','.')?></td>
            <td><i class="far fa-trash-alt" style="font-size:20px" onclick=
            "location='?option=cart&action=delete&id=<?=$item['id']?>';" ></i></td>
        </tr>

        <?php $toTal+=$subTotal;?>
        <?php 
        $totalItem+=$_SESSION['cart'][$item['id']];      
        ?>
<?php
    endforeach;
?>   
    
    <tr>
        <td colspan="5">
            <section><input type="button" class="btn-remove-checked" style="border-radius: 6px;background-color:#33FF99; "  value="Xoá tất cả sản phẩm" onclick="if(confirm('Bạn có chắc chắn không!')) location='?option=cart&action=deleteall';">
            <input  style="border-radius: 6px;background-color:#FFFF66;" type="button" value="Đặt hàng" onclick="location='?option=cart&action=order';"></section>  
            <section  class="text-end mb-3">Tổng tiền: <?=number_format($toTal,0,',','.')?>đ</section>
        </td>
    </tr>
    </tbody>
    </table>
<?php
    $_SESSION['total_items'] = $totalItem;
    $_SESSION['toTal'] = $toTal;
?>
<?php
else:
?>
    <section style="text-align:center; color:red; font-weight: bold; font-size: 25px; margin: 20px 0 500px">Giỏ hàng trống</section>
<?php
endif;
?>
</div>
</section>