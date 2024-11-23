<?php
    if(isset($_POST['name'])){
        $name=$_POST['name'];
        $query="select*from products where name='$name'";
        if(mysqli_num_rows($connect->query($query))!=0){
            $alert="Tên sản phẩm đã tồn tại!";
        }else{
            $brandid=$_POST['brandid'];
            $price=$_POST['price'];
            $discount=$_POST['discount'];
            $description=$_POST['description'];
            $status=$_POST['status'];
            $imageproduct=$_POST['imageproduct'];
            //Xử lý ảnh
            $store="../images/";
            $imageName=$_FILES['image']['name'];
            $imageTemp=$_FILES['image']['tmp_name'];
            $exp3=substr($imageName, strlen($imageName)-3); #aocd.jpg, ABCD1234.JPG
            $exp4=substr($imageName, strlen($imageName)-4); #jpeg, webp
            if($exp3=='jpg'||$exp3=='png'||$exp3=='bmp'||$exp3=='gif'||$exp3=='JPG'||$exp3==
                'PNG'||$exp3=='BMP'||$exp3=='GIF'||$exp4=='jpeg'||$exp4=='JPEG'||$exp4=='webp'
                ||$exp4=='WEBP') {
                $imageName=time().'_'.$imageName;
                move_uploaded_file($imageTemp, $store.$imageName);
                $connect->query("insert products(brandid, name, price, discount, image, description, status)
                values('$brandid', '$name', '$price', '$discount', '$imageName', '$description', '$status')"); 
                $product_id = $connect->insert_id; // Lấy ID của sản phẩm vừa thêm 
                // Xử lý các ảnh con 
                foreach($_FILES['imageproduct']['name'] as $key => $value) { 
                    $subImageName = time().'_'.$value; 
                    $subImageTemp = $_FILES['imageproduct']['tmp_name'][$key]; 
                    move_uploaded_file($subImageTemp, $store.$subImageName); 
                    $connect->query("insert into imageproduct(productid, path) values('$product_id', '$subImageName')"); 
                }
                echo"<script>location='?option=product';</script>";
                unset($_SESSION['alert']);
            } else {
                $alert = "Định dạng file không hợp lệ. Vui lòng chọn file ảnh.";
            }
        }
    }
?>
<?php
    $brands=$connect->query("select*from brands");
?>
<div class="col-8 d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><a href="?option=product"><i class="fas fa-arrow-left" style="font-size: 20px;"></i></a> Thêm sản phẩm</h1>
</div>
<section style="color: red; text-align:center"><?=isset($alert)?$alert:''?></section>
<section class="container col-md-6">
    <form method="post" enctype="multipart/form-data">
        <section class="form-group">
            <label>Hãng: </label>
            <select name="brandid" class="form-control">
                <option hidden>--Chọn hãng--</option>
                <?php foreach($brands as $item):?>
                    <option value="<?=$item['id']?>"><?=$item['name']?></option>
                <?php endforeach;?>
            </select>
        </section>
        <section class="form-group">
            <label>Tên:</label><input name="name" class="form-control" required>
        </section>
        <section class="form-group">
            <label>Giá gốc:</label><input type="number" min="100000" name="price" class="form-control" required>
        </section>
        <section class="form-group">
            <label>Giá sau giảm:</label><input type="number" min="100000" name="discount" class="form-control" required>
        </section>
        <section class="form-group">
            <label>Ảnh:</label><input type="file" name="image" class="form-control" required>
        </section>
        <section class="form-group">
            <label>Các ảnh con:</label>
            <input type="file" name="imageproduct[]" multiple class="form-control">
        </section>
        <section class="form-group">
            <label>Mô tả:</label>
            <textarea name="description" id="description"></textarea>
            <script>CKEDITOR.replace('description');</script>
        </section>
        <section class="form-group">
            <label>Trạng thái: </label><br><input type="radio" name="status" value="1" checked> 
            Hoạt động <input type="radio" name="status" value="0"> Khóa
        </section>
        <section>
            <input type="submit" value="Thêm" class="btn btn-success">
        </section>
    </form>   
</section>