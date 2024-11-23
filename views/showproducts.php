<?php
if(isset($_GET['brandid'])){
    $query="select*from products where status=1 and brandid=".$_GET['brandid'];    
    $result=$connect->query($query);    
}
else if(isset($_GET['keyword'])){
    $query="select*from products where status=1 and name like'%".$_GET['keyword']."%'";
    $result=$connect->query($query);            
}
else if(isset($_GET['fromprice'])){
    $query="select*from products where status=1 and discount >= ".$_GET['fromprice']." and discount < ".$_GET['toprice'];
    $result=$connect->query($query);            
}
else if(isset($_GET['range'])){
    $query="select*from products where status=1 and discount <= ".$_GET['range'];
    $result=$connect->query($query);            
}
?>
<?php
if(isset($_GET['brandid'])){
    $query="select*from brands where id=".$_GET['brandid'];
    $result_brand=$connect->query($query);
    $brandname=mysqli_fetch_array($result_brand);
}
?>
<?php
    $brands=$connect->query("select*from brands");
?>
<section class="product-gallery-one py-3">
    <div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="?option=home" style="text-decoration: none; color: black"><i class="fas fa-home" style="color: gray;"></i> Trang chủ</a></li>               
                <?php if (isset($_GET['brandid'])) { ?>
                    <li class="breadcrumb-item"><a href="?option=mobile" style="text-decoration: none; color: black">Điện thoại</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=$brandname['name']?></li>
                <?php } elseif (isset($_GET['keyword'])) { ?>
                    <li class="breadcrumb-item active" aria-current="page">Kết quả tìm kiếm cho "<?=$_GET['keyword']?>" </li>
                <?php } else { ?>
                    <li class="breadcrumb-item active" aria-current="page">Điện thoại</li>
                <?php } ?>
            </ol>
        </nav>
        <div class="cate-list-filter mb-3">
            <div class="row">
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme filter">
                    <div class="item">
                        <div class="category-icon">
                            <img src="images/banner1.jpg" alt="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-icon">
                            <img src="images/banner2.png" alt="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-icon">
                            <img src="images/banner3.png" alt="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-icon">
                            <img src="images/banner4.jpg" alt="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-icon">
                            <img src="images/banner5.png" alt="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-icon">
                            <img src="images/banner6.png" alt="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-icon">
                            <img src="images/banner7.png" alt="img-fluid">
                        </div>
                    </div>
                    <div class="item">
                        <div class="category-icon">
                            <img src="images/banner8.jpg" alt="img-fluid">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Lọc sản phẩm -->
        <h6>Lọc sản phẩm</h6>
        <div class="filter-button-group">
            <div class="brandFilter">
            <button class="filter-button" data-filter="brand">Hãng <i class="fas fa-angle-down ms-1"></i></button>
            <div class="filter-options" id="brandOptions">
            <?php foreach($brands as $item):?>
                <p>
                    <a href="?option=showproducts&brandid=<?=$item['id']?>"><?=$item['name']?></a>
                </p>
                <?php endforeach;?>   
            </div>
            </div>
            <div class="priceFilter">
                <button class="filter-button" data-filter="discount">Giá <i class="fas fa-angle-down ms-1"></i></button>
                <div class="filter-options" id="priceOptions">
                    <section>
                        <form>
                            <input type="hidden" name="option" value="showproducts">
                            <span>0đ</span>
                            <input type="range" name="range" min="500000" max="100000000" step="500000" oninput="document.getElementById('max').innerHTML = formatNumber(this.value);" value="<?=isset($_GET['range'])?$_GET['range']: ""?>">
                            <span id="max"><?=isset($_GET['range'])?$_GET['range']:""?></span><br>
                            <input type="submit" value="Search">
                        </form>
                    </section>
                </div>
            </div>
            <script>
            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + "đ";
            }
            </script>
            <div class="memoryFilter">
            <button class="filter-button" data-filter="ram">Bộ nhớ trong <i class="fas fa-angle-down ms-1"></i></button>
            <div class="filter-options" id="ramOptions">
                <p>2GB</p>
                <p>4GB</p>
                <p>6GB</p>
                <p>8GB</p>
            </div>
            </div>   
        </div>
        <h6 class="mt-2">Sắp xếp theo</h6>
        <div class="arrange mb-3">
            <a href="">Giá cao - Thấp</a>
            <a href="">Giá thấp - Cao</a>
            <a href="">Giảm giá</a>
            <a href="">Bán chạy</a>
            <a href="">Mới nhất</a>
        </div>
        <!-- end -->
        <div class="product-gallery-one-content"> 
            <div class="product-gallery-one-content-product">
                <?php foreach($result as $item):?>
                <div class="product-gallery-one-content-product-item">
                    <a href="?option=productdetail&id=<?=$item['id']?>">
                        <img class="product-image" src="images/<?=$item['image']?>" alt="">
                        <span class="discount-badge">Giảm <?=number_format(($item['price'] - $item['discount']) / $item['price'] * 100, 0)?>%</span>
                    </a>
                    <div class="product-gallery-one-content-product-item-text">
                        <li><?=$item['name']?></li>
                        <li><?=number_format($item['discount'],0,',','.')?>đ</li>
                        <li><?=number_format($item['price'],0,',','.')?>đ</li>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<script>
    const filterButtons = document.querySelectorAll('.filter-button');
    // Tạo một object để lưu trữ trạng thái của các tùy chọn
    const optionStates = {};
    filterButtons.forEach(button => {
    const filterId = button.dataset.filter;
    optionStates[filterId] = false; // Khởi tạo trạng thái đóng cho tất cả các tùy chọn
    button.addEventListener('click', () => {
    const options = document.getElementById(`${filterId}Options`);

    // Đảo ngược trạng thái của tùy chọn
    optionStates[filterId] = !optionStates[filterId];

    // Đóng tất cả các tùy chọn khác
    const allOptions = document.querySelectorAll('.filter-options');
    allOptions.forEach(option => {
      option.classList.remove('show');
    });

    // Mở tùy chọn hiện tại nếu trạng thái là mở
    if (optionStates[filterId]) {
      options.classList.add('show');
    }
  });
});
</script>