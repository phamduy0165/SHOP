<div class="container py-3">
        <div class="row">
        <div class="col-md-3">
            <a href="?option=home">
                <img src="images/logo1.jpg" width = " 55%" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="col-md-5">
            <form class="input-group mt-2" onsubmit="return validateSearch()">
                <input type="hidden" name="option" value="showproducts">
                <input type="search" name="keyword" class="form-control" placeholder="Bạn đang tìm?"
                    value="<?=isset($_GET['keyword'])?$_GET['keyword']:""?>">
                <button class="input-group-text" id="basic-addon2">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        <script>
        function validateSearch() {
            const keyword = document.querySelector('input[name="keyword"]').value;
            if (keyword.trim() === '') {
                alert('Vui lòng nhập từ khóa tìm kiếm');
                return false; // Ngăn chặn gửi form
            }
            return true; // Cho phép gửi form
        }
        </script>
            <div class="col-md-3">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-3">
                                <div class="fs-3 text-danger">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                Tư vấn<br>
                                <a href="tel:+84359176567" class="text-danger text-decoration-none"><strong>0359176567</strong></a>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                    <div class="row">
                            <div class="col-3">
                                <div class="fs-3 text-danger">
                                    <i class="fa-regular fa-circle-user"></i>
                                </div>
                            </div>
                            <div class="col-9" style="white-space: nowrap;">
                                Xin chào<br>
                                <?php if (isset($_SESSION['member']) && isset($_SESSION['member']['lastname'])) : ?>
                                    <section>
                                        <a href="?option=lich-su" style="color: red; text-decoration: none">
                                            <span><?php echo $_SESSION['member']['lastname']; ?></span>
                                        </a>
                                    </section>
                                <?php else : ?>
                                    <a href="?option=signin" class="text-danger text-decoration-none"><strong>Đăng nhập</strong></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 text-cart">
                    <div class="icon-cart">
                        <a href="?option=cart" class="position-relative">
                            <span class="fs-3"><i class="fa-solid fa-cart-shopping" style="color: #606060;"></i></span>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $_SESSION['total_items'] ?? 0; ?>
                            </span>
                        </a>
                    </div>
                    <div class="bbb">
                        Giỏ hàng
                    </div>
                </div>
            </div>
        </div>
    </div>
