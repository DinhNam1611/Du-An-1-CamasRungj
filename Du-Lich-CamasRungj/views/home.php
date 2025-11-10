<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/navbar.php'; ?>

<main>
  <!-- hero slider area start -->
  <section class="slider-area">
    <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
      <!-- single slider item start -->
      <div class="hero-single-slide hero-overlay">
        <div class="hero-slider-item bg-img" data-bg="assets/img/slider/banner1.jpg">
          <div class="container">
            <div class="row">
            </div>
          </div>
        </div>
      </div>
      <div class="hero-single-slide hero-overlay">
        <div class="hero-slider-item bg-img" data-bg="assets/img/slider/banner2.jpg">
          <div class="container">
            <div class="row">
            </div>
          </div>
        </div>
      </div>
      <div class="hero-single-slide hero-overlay">
        <div class="hero-slider-item bg-img" data-bg="assets/img/slider/banner3.jpg">
          <div class="container">
            <div class="row">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- hero slider area end -->

  <!-- service policy area start -->
  <div class="service-policy section-padding">
    <div class="container">
      <div class="row mtn-30">
        <div class="col-sm-6 col-lg-3">
          <div class="policy-item">
            <div class="policy-icon">
              <i class="pe-7s-plane"></i>
            </div>
            <div class="policy-content">
              <h6>Giao Hàng</h6>
              <p>Miễn Phí Giao Hàng</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="policy-item">
            <div class="policy-icon">
              <i class="pe-7s-help2"></i>
            </div>
            <div class="policy-content">
              <h6>Hỗ Trợ</h6>
              <p>Hỗ Trợ 24/7</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="policy-item">
            <div class="policy-icon">
              <i class="pe-7s-back"></i>
            </div>
            <div class="policy-content">
              <h6>Hoàn Tiền</h6>
              <p>Hoàn Tiền Trong 30 Ngày</p>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="policy-item">
            <div class="policy-icon">
              <i class="pe-7s-credit"></i>
            </div>
            <div class="policy-content">
              <h6>Thanh Toán</h6>
              <p>Bảo Mật Thanh Toán</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- service policy area end -->

  <!-- banner statistics area start -->
  <!-- <div class="banner-statistics-area">
    <div class="container">
      <div class="row row-20 mtn-20">
        <div class="col-sm-6">
          <figure class="banner-statistics mt-20">
            <a href="#">
              <img src="assets/img/banner/img1-top.jpg" alt="product banner">
            </a>
            <div class="banner-content text-right">
              <h5 class="banner-text1">BEAUTIFUL</h5>
              <h2 class="banner-text2">Wedding<span>Rings</span></h2>
              <a href="shop.html" class="btn btn-text">Shop Now</a>
            </div>
          </figure>
        </div>
        <div class="col-sm-6">
          <figure class="banner-statistics mt-20">
            <a href="#">
              <img src="assets/img/banner/img2-top.jpg" alt="product banner">
            </a>
            <div class="banner-content text-center">
              <h5 class="banner-text1">EARRINGS</h5>
              <h2 class="banner-text2">Tangerine Floral <span>Earring</span></h2>
              <a href="shop.html" class="btn btn-text">Shop Now</a>
            </div>
          </figure>
        </div>
      </div>
    </div>
  </div>  -->
  <!-- banner statistics area end -->

  <!-- product area start -->
  <section class="product-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- section title start -->
          <div class="section-title text-center">
            <h2 class="title">Thực Đơn </h2>
            <p class="sub-title">Sản Phẩm Được Thêm Mới Liên Tục</p>
          </div>
          <!-- section title start -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="product-container">

            <!-- product tab content start -->
            <div class="tab-content">
              <div class="tab-pane fade show active" id="tab1">
                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                  <?php foreach ($listSanPham as $key => $sanPham): ?>
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

                </div>
              </div>
            </div>
            <!-- product tab content end -->
            <!-- product tab content start -->
            <div class="tab-content">
              <div class="tab-pane fade show active" id="tab1">
                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                  <?php foreach ($listSanPham as $key => $sanPham): ?>
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

                </div>
              </div>
            </div>
            <!-- product tab content end -->
            <!-- product tab content start -->
            <div class="tab-content">
              <div class="tab-pane fade show active" id="tab1">
                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                  <?php foreach ($listSanPham as $key => $sanPham): ?>
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

                </div>
              </div>
            </div>
            <!-- product tab content end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- product area end -->


</main>



<?php require_once 'layout/miniCart.php'; ?>


<?php require_once 'layout/footer.php'; ?>