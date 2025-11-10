<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/navbar.php'; ?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">

                                    <div class="pro-large-img img-zoom">
                                        <img src="<?= BASE_URL . $SanPham['hinh_anh'] ?>" alt="product-details" />
                                    </div>


                                </div>
                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <?php
                                    foreach ($listAnhSanPham as $key => $anhSanPham):
                                    ?>
                                        <div class="pro-nav-thumb">
                                            <img src="<?= BASE_URL . $anhSanPham['link_hinh_anh'] ?? '' ?>" alt="product-details" />
                                        </div>

                                    <?php endforeach ?>

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="#"> <?= $SanPham['ten_danh_muc'] ?> </a>
                                    </div>
                                    <h3 class="product-name"><?= $SanPham['ten_san_pham'] ?></h3>
                                    <div class=" d-flex">
                                        <?php $countComment = count($listBinhLuan); ?>
                                        <span><?= $countComment . ' Bình Luận' ?></span>
                                    </div>
                                    <div class="price-box">
                                        <span class="price-regular"><?= formatPrice($SanPham['gia_san_pham']) ?></span>
                                        <?php
                                        $giaKhuyenMai = $SanPham['gia_khuyen_mai'];
                                        if ($giaKhuyenMai !== null) {
                                            $giaKhuyenMai = formatPrice($SanPham['gia_khuyen_mai']);
                                        ?>
                                            <span class="price-old"><?= $giaKhuyenMai ?></span>

                                        <?php } ?>
                                    </div>
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span><?= $SanPham['so_luong'] . ' Suất' ?></span>
                                    </div>
                                    <p class="pro-desc"> <?= $SanPham['mo_ta'] ?></p>
                                    <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="post">

                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">Số Lượng</h6>
                                            <div class="quantity">
                                                <input type="hidden" name="san_pham_id" value="<?= $SanPham['id_san_pham'] ?>">
                                                <div class="pro-qty"><input type="text" name="so_luong" value="1"></div>
                                            </div>
                                            <div class="action_link">
                                                <button class="btn btn-cart2" type="submit">Thêm vào giỏ hàng</button>
                                            </div>
                                        </div>
                                        <?php if ($SanPham['danh_muc_id'] == 2) { ?>
                                            <div class="pro-size">
                                                <h6 class="option-title">Size :</h6>
                                                <select class="nice-select" name="size">
                                                    <?php foreach ($listSize as $key => $sizeSanPham): ?>
                                                        <option value="<?= $sizeSanPham['id'] ?>"><?= $sizeSanPham['ten_size'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        <?php }  ?>
                                    </form>

                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->

                    <!-- product details reviews start -->
                    <div class="product-details-reviews section-padding pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="product-review-info">
                                    <ul class="nav review-tab">
                                        <li>
                                            <a class="active" data-bs-toggle="tab" href="#tab_three">Bình luận : <?= $countComment ?></a>
                                        </li>
                                    </ul>
                                    <div class="tab-content reviews-tab">
                                        <div class="tab-pane fade show active" id="tab_three">
                                            <?php foreach ($listBinhLuan as $key => $binhLuan): ?>
                                                <div class="total-reviews">
                                                    <div class="rev-avatar">
                                                        <img src="<?= $binhLuan['anh_dai_dien'] ?>" alt="">
                                                    </div>
                                                    <div class="review-box">
                                                        <div class="post-author">
                                                            <p><span></span><?= $binhLuan['ho_ten'] ?> - Ngày đăng : <?= formatDate($binhLuan['ngay_dang']) ?></p>
                                                        </div>
                                                        <p><?= $binhLuan['noi_dung'] ?></p>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                            <form action="#" class="review-form">
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            *Bình Luận</label>
                                                        <textarea class="form-control" required></textarea>
                                                        <div class="help-block pt-10"><span
                                                                class="text-danger">Note:</span>
                                                            HTML is not translated!
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <button class="btn btn-sqr" type="submit">Gửi Bình Luận</button>
                                                </div>
                                            </form> <!-- end of review-form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <section class="related-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản Phẩm Liên Quan</h2>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                        <?php if (!empty($listSanPhamCungDanhMuc)): ?>
                            <?php foreach ($listSanPhamCungDanhMuc as $key => $sanPham): ?>
                                <!-- product item start -->
                                <div class="product-item">
                                    <figure class="product-thumb">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id_san_pham'] ?>">
                                            <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                            <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                        </a>
                                        <div class="product-badge">
                                            <?php
                                            $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                            $ngayHienTai = new DateTime();
                                            $tinhNgay = $ngayHienTai->diff($ngayNhap);
                                            if ($tinhNgay->days <= 7) {
                                            ?>
                                                <div class="product-label new">
                                                    <span>Mới</span>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            $giaKhuyenMai = $sanPham['gia_khuyen_mai'];
                                            if ($giaKhuyenMai !== null) {
                                            ?>
                                                <div class="product-label discount">
                                                    <span>Giảm Giá</span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="cart-hover">
                                            <button class="btn btn-cart">Xem Chi Tiết</button>
                                        </div>
                                    </figure>
                                    <div class="product-caption text-center">
                                        <h6 class="product-name">
                                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id_san_pham'] ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                        </h6>
                                        <div class="price-box">
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) ?></span>
                                            <?php
                                            $giaKhuyenMai = $sanPham['gia_khuyen_mai'];
                                            if ($giaKhuyenMai !== null) {
                                            ?>
                                                <span class="price-old"><del><?= formatPrice($sanPham['gia_khuyen_mai']) ?></del></span>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                                <!-- product item end -->
                            <?php endforeach ?>
                        <?php else: ?>
                            <p class="text-center">Không có sản phẩm liên quan.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- related products area end -->
</main>

<?php require_once 'layout/miniCart.php'; ?>


<?php require_once 'layout/footer.php'; ?>