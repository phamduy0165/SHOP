<?php
    if(isset($_POST['content'])): 
        $content=$_POST['content'];
        if(isset($_SESSION['member']) && isset($_SESSION['member']['username'])):
            $productid=$_GET['id'];
            $username = $_SESSION['member']['username'];
            $memberid=mysqli_fetch_array($connect->query("select*from member where username='$username'"));
            $memberid=$memberid['id'];
            $connect->query("insert comment(memberid,productid,date,content) values($memberid,$productid,now(),'$content')");
            echo"<script>alert('Cảm ơn bạn đã bình luận sản phẩm!')</script>";
        endif;
    endif;
?>
<?php
    $id=$_GET['id'];
    $query="select*from products where id=$id";
    $result=$connect->query($query);
    $item=mysqli_fetch_array($result);
?>

<?php
    if(isset($_GET['id'])){
        $query="SELECT p.id, p.brandid, b.id, b.name FROM products p
            JOIN brands b ON p.brandid = b.id
              WHERE p.id=".$_GET['id'];
        $result=$connect->query($query);
        $brand_name=mysqli_fetch_array($result);      
    }
?>
<?php
	$id=$_GET['id'];
	$imagepath=$connect->query("select * from imageproduct where productid=$id");
?>
<div class="container py-3">
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="?option=home" style="text-decoration: none; color: black"><i class="fas fa-home" style="color: gray;"></i> Trang chủ</a></li>               
        <li class="breadcrumb-item"><a href="?option=mobile" style="text-decoration: none; color: black">Điện thoại</a></li>
        <li class="breadcrumb-item"><a href="?option=showproducts&brandid=<?=$item['brandid']?>" style="text-decoration: none; color: black"><?=$brand_name['name']?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?=$item['name']?></li>
    </ol>
</nav>
<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						<button class="arrow arrow-left" onclick="prevImage()">&#8249;</button> 
						<button class="arrow arrow-right" onclick="nextImage()">&#8250;</button>
						<div class="preview-pic tab-content"> 
							<div class="tab-pane active" id="pic-1"><img src="images/<?=$item['image']?>" id="main-image" onclick="showModal(this.src)"></div>
							<?php foreach($imagepath as $path): ?> 
							<div class="tab-pane" id="pic-<?=$path['id']?>"><img src="images/<?=$path['path']?>" onclick="showModal(this.src)" /></div>
							<?php endforeach; ?> 
						</div> 
						<ul class="preview-thumbnail nav nav-tabs"> 
							<li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="images/<?=$item['image']?>" onclick="changeImage('images/<?=$item['image']?>')"></a></li> 
							<?php foreach($imagepath as $path): ?> 
							<li><a data-target="#pic-<?=$path['id']?>" data-toggle="tab"><img src="images/<?=$path['path']?>" onclick="changeImage('images/<?=$path['path']?>')"></a></li> 
							<?php endforeach; ?> 
						</ul>
					</div>

					<div class="details col-md-6">	
						<h3 class="product-title"><?=$item['name'] ?></h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<p class="product-description" ><?=$item['description'] ?></p>
						<h4 class="price"><?=$item['price']?>đ</h4>
						<p class="vote"><strong>91%</strong> người mua thích sản phẩm này <strong>(87 votes)</strong></p>
						<!-- <h5 class="sizes">sizes:
							<span class="size" data-toggle="tooltip" title="small">s</span>
							<span class="size" data-toggle="tooltip" title="medium">m</span>
							<span class="size" data-toggle="tooltip" title="large">l</span>
							<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
						</h5> -->
						<!-- <h5 class="colors">colors:
							<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
							<span class="color green"></span>
							<span class="color blue"></span>
						</h5> -->
						<div class="action">
							<section><input type="button" value="Thêm vào giỏ hàng" onclick="location='?option=cart&action=add&id=<?=$item['id']?>';"></section>
						</div>
						<section class="comment">
    <h2>Bình luận</h2>
    <form method="post">
        <section>
            <textarea name="content" rows="5" class="form-control" placeholder="Hãy để lại bình luận cho chúng tôi..."></textarea>
            <button type="button" id="checkLoginButton" style="display: none;"></button> </section>
        <section><input type="submit" value="Gửi" class="btn btn-danger"></section>
    </form>
    <?php
        $comments=$connect->query("select*from member a join comment b on a.id=b.memberid join products c on b.productid=c.id where b.status and productid=".$_GET['id']);
        if(mysqli_num_rows($comments)==0):
            echo"<section style='color:green'>No comments!</section>";
        else:
            foreach($comments as $comment):
    ?>
    <?php
        endforeach;
        endif;
    ?>
</section>
</div>

<script>
    document.querySelector('textarea[name="content"]').addEventListener('click', function() {
        document.getElementById('checkLoginButton').click();
    });
    document.getElementById('checkLoginButton').addEventListener('click', function() {
    if (!<?php echo json_encode(isset($_SESSION['member'])); ?>) {
        alert('Vui lòng đăng nhập để bình luận.');
        window.location.href = '?option=signin&productid=<?php echo $_GET['id']; ?>';
    }
});
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal to show full-screen image --> 
 <div class="modal fade" id="main-image-modal" tabindex="-1" role="dialog" aria-hidden="true"> 
	<div class="modal-dialog modal-lg"> 
		<div class="modal-content"> 
		<div class="modal-header">
        <h5 class="modal-title">Zoomed Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
			<div class="modal-body"> 
				<img src="" id="main-image-modal-src"> 
			</div> 
		</div> 
	</div> 
</div>
<script> 
	let currentImageIndex = 0; 
	const images = ["images/<?=$item['image']?>", <?php foreach($imagepath as $path) echo "'images/".$path['path']."',"; ?>]; 
	
	function changeImage(src) { 
		document.getElementById('main-image').src = src; 
		currentImageIndex = images.indexOf(src); 
	} 
	
	function prevImage() { 
		if (currentImageIndex > 0) { 
			currentImageIndex--; 
			document.getElementById('main-image').src = images[currentImageIndex]; 
		} 
	} 
	function nextImage() { 
		if (currentImageIndex < images.length - 1) { 
			currentImageIndex++; document.getElementById('main-image').src = images[currentImageIndex]; 
		} 
	} 
	function showModal(src) { 
		document.getElementById('main-image-modal-src').src = src; 
		$('#main-image-modal').modal('show'); 
	} 
</script>
