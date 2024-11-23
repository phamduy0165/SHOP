<?php
    //$option='home';
    $query="select*from products where status=1";
    // Determine total number of products 
    // $query = "SELECT COUNT(*) as total FROM products where status=1"; 
    // $result = $connect->query($query); 
    // $row = $result->fetch_assoc(); 
    // $total_products = $row['total'];

 
    // $products_per_page = 10;
    // $total_pages = ceil($total_products / $products_per_page);


    // $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    //  if ($current_page < 1) $current_page = 1;
    //  if ($current_page > $total_pages) $current_page = $total_pages;

    
    //  $start_limit = ($current_page - 1) * $products_per_page;

   
    //  while ($row = $result->fetch_assoc()) { 
    //     echo "<div class='product'>"; 
    //     echo "<h3>{$row['name']}</h3>"; 
    //     echo "<p>Price: " . number_format($row['price'], 2) . "</p>"; 
    //     echo "</div>"; }

    //     echo "<div class='pagination'>"; 
    //     for ($page = 1; $page <= $total_pages; $page++) 
    //     { if ($page == $current_page) { 
    //         echo "<span>$page</span>"; 
    //         } 
    //         else { echo "<a href='#'>$page</a>"; } 
    //     } 
    //         echo "</div>";
    // if(isset($_GET['brandid'])){
    //     $query.=" and brandid=".$_GET['brandid'];    
    //     $option='showproducts&brandid='.$_GET['brandid'];    
    // }
    // // elseif(isset($_GET['keyword'])){
    //     $query.=" and name like'%".$_GET['keyword']."%'";
    //     $option='showproducts&keyword='.$_GET['keyword'];           
    // }
    // elseif(isset($_GET['range'])){
    //     $query.=" and price<=".$_GET['range'];       
    //     $option='showproducts&range='.$_GET['range'];    
    // }
    // //$page: xem các sản phẩm ở trang số bnhieu
    // $page=1;
    // if(isset($_GET['page'])){
    //     $page=$_GET['page'];       
    // }
    // //số lượng sản phẩm muốn để mỗi trang
    // $productsperpage=2;
    // //lấy các sản phẩm bắt đầu từ chỉ số bn trong bảng(0 là bắt đầu từ bản ghi đầu tiên)
    // $from=($page-1)*$productsperpage;
    // //lấy tổng số sản phẩm
    // $totalProducts=$connect->query($query);
    // //tính tổng số trang có được
    // $totalPages=ceil(mysqli_num_rows($totalProducts)/$productsperpage);
    // //lấy các sản phẩm ở trang hiện thời
    // $query.= " limit $from,$productsperpage";
    $result=$connect->query($query);
?>

<!-- <section class="pages">
    <?php for($i=1; $i<=$totalPages;$i++):?>
        <a class="<?=(empty($_GET['page'])&&$i==1)||(isset($_GET['page'])&&$_GET['page']==$i)?'highlight':''?>" 
        href="?option=<?=$option?>&page=<?=$i?>"><?=$i?></a>
    <?php endfor;?>
</section> -->



<section class="mymaincontent">
    <div class="btn-zalo-chat id__ZL">
        <a id="btnZaloChat" target="_blank" rel="noopener nofollow" href="https://zalo.me/0359176567"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Icon_of_Zalo.svg/2048px-Icon_of_Zalo.svg.png "width="45" height="45"></a>              
    </div>
</section>

<section class="mymaincontent">
    <div class="btn-facebook-chat id__FB" >
        <a id="btnFacebookChat" target="_blank" rel="noopener nofollow" href="https://www.facebook.com/phamvan.duy.92102"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/2023_Facebook_icon.svg/1024px-2023_Facebook_icon.svg.png "width="45" height="45"></a>              
    </div>
</section>
    <div class="container">
        <div class="slider mb-3">
            
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="images/slider1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="images/slider1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                    <img src="images/slider1.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!--end slide-->
        <div class="cate-list mb-3">
            <div class="row">
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme">
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
        <!--end cate-list-->
        
    </div>
</section>
<!-- end content -->
<section class="product-gallery-one py-3">
    <div class="container">
        <div class="product-gallery-one-content">
            <div class="row product-gallery-one-content-title">
                <div class="col-md-4">
                    <h4>ĐIỆN THOẠI NỔI BẬT</h4>
                </div>
                <div class="title-menu col-md-8 text-end">
                    <a href="?option=showproducts&brandid=1">Iphone</a>
                    <a href="?option=showproducts&brandid=2">Samsung</a>
                    <a href="?option=showproducts&brandid=3">Xiaomi</a>
                    <a href="?option=showproducts&brandid=4">OPPO</a>
                    <a href="?option=mobile">Xem tất cả</a>
                </div>
            </div>
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