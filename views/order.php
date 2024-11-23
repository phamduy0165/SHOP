<?php
    if (isset($_SESSION['member']) && isset($_SESSION['member']['username'])) {
        // Lấy thông tin từ mảng $_SESSION['member']
        $username = $_SESSION['member']['username'];
        $query = "SELECT * FROM member WHERE username = '$username'";
        $member = mysqli_fetch_array($connect->query($query));
    }
?>
<?php
    if(isset($_POST['name'])){
        $name=$_POST['name'];
        $mobile=$_POST['mobile'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $note=$_POST['note'];
        $ordermethodid=$_POST['ordermethodid'];
        $memberid=$member['id'];
        $query="insert orders( ordermethodid, memberid, name, address, mobile, email, note) values( $ordermethodid, $memberid, '$name', '$address', '$mobile', '$email', '$note')";
        $connect->query($query);
        $query="select id from orders order by id desc limit 1";
        $orderid=mysqli_fetch_array($connect->query($query))['id'];
        foreach($_SESSION['cart'] as $key=>$value) {
        $productid=$key;
        $number=$value;
        $query="select discount from products where id=$key";
        $discount=mysqli_fetch_array($connect->query($query))['discount'];
        $query="insert orderdetail values ($productid, $orderid, $number, $discount)";
        $connect->query($query);
        }
        unset($_SESSION['cart']);
        unset($_SESSION['total_items']);
        echo"<script>location='?option=ordersuccess';</script>";
    }
?>
<div class="container1 mb-5">
<form method="post" class="row">
<div class=" col-md-6">
<h2 class = "mt-5">THÔNG TIN NGƯỜI NHẬN HÀNG</h2>
  <div class="col-md-10">
    <label for="inputName" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="inputName4" placeholder="Họ Tên" value="<?=$member['username']?>">
  </div>
  <div class="col-md-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" name="address" class="form-control" id="inputAddress"  placeholder="Địa chỉ">
  </div>
  <div class="col-md-12">
    <label for="inputEmail" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="email" value="<?=$member['email']?>">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Phone</label>
    <input type="tel" name="mobile" class="form-control" id="inputCity" placeholder="Số điện thoại" value="<?=$member['mobile']?>">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Note</label>
    <input type="text" name="note" class="form-control" id="inputCity" placeholder="Ghi chú" rows="3">
  </div>
  </section>
</div>
        
    

<div class="row col-md-6 mt-4 pt-4" method="post" >
    <div class="pttt">
        <div class="checkout__order mt-4" >
        <h2>Chọn phương thức thanh toán</h2>
    <?php
        $query="select*from ordermethod where status";
        $result=$connect->query($query);
    ?>
        <select name="ordermethodid">
            <?php foreach($result as $item):?>
                <option value="<?=$item['id']?>"><?=$item['name']?></option>
            <?php endforeach;?>
        </select>
    
        <section>
            <input class="btn-order" type="submit" value="Đặt hàng" class="button-submit fw-bold">
        </section>
<?php
    $totalItem = isset($_SESSION['total_items']) ? $_SESSION['total_items'] : 0;
    echo "<span style='color: red; font-weight: bold;'>Tổng đơn :" . $totalItem;
?>
<br>
<?php
    $toTal = isset($_SESSION['toTal']) ? $_SESSION['toTal'] : 0;
    echo "<span style='color: red; font-weight: bold;'>Tổng tiền :" . $toTal ;
?>
    <span>đ</span> 
                </div>
            </div>
        </div>
    </form>
</div>
