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
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <?php if ($chiTietGioHang != null) { ?>
        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">Ảnh Sản Phẩm</th>
                                            <th class="pro-title">Tên Sản Phẩm</th>
                                            <th class="pro-price">Giá Tiền</th>
                                            <th class="pro-quantity">Số Lượng</th>
                                            <th class="pro-subtotal">Tổng Tiền</th>
                                            <th class="pro-remove">Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $tongTienSanPham = 0;
                                        foreach ($chiTietGioHang as $key => $gioHang):
                                        ?>
                                            <tr>
                                                <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="<?= BASE_URL . $gioHang['hinh_anh'] ?>" alt="Product" /></a></td>
                                                <td class="pro-title"><a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $gioHang['id_san_pham'] ?>"><?= $gioHang['ten_san_pham'] ?></a></td>
                                                <td class="pro-price"><span>
                                                        <?php if ($gioHang['gia_khuyen_mai']) { ?>
                                                            <?= formatPrice($gioHang['gia_khuyen_mai']) ?>
                                                        <?php } else { ?>
                                                            <?= formatPrice($gioHang['gia_san_pham']) ?>
                                                        <?php } ?>
                                                    </span></td>
                                                <td class="pro-quantity">
                                                    <div class="pro-qty"><input type="text" value="<?= $gioHang['so_luong'] ?>"></div>
                                                </td>
                                                <td class="pro-subtotal"><span>

                                                        <?php
                                                        $tongTien = 0;
                                                        $phiVanChuyen = 50000;
                                                        if ($gioHang['gia_khuyen_mai']) {
                                                            $tongTien = $gioHang['gia_khuyen_mai'] *  $gioHang['so_luong'];
                                                        ?>
                                                            <?= formatPrice($tongTien) ?>
                                                        <?php } else {
                                                            $tongTien = $gioHang['gia_khuyen_mai'] *  $gioHang['so_luong'];
                                                        ?>
                                                            <?= formatPrice($tongTien) ?>
                                                        <?php }
                                                        $tongTienSanPham += $tongTien
                                                        ?>
                                                    </span></td>
                                                <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        $tongTienThanhToan = $tongTienSanPham + $phiVanChuyen;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="apply-coupon-wrapper">
                                    <form action="#" method="post" class=" d-block d-md-flex">
                                        <input type="text" placeholder="Enter Your Coupon Code" required />
                                        <button class="btn btn-sqr">Apply Coupon</button>
                                    </form>
                                </div>
                                <div class="cart-update">
                                    <a href="#" class="btn btn-sqr">Update Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h6>Tổng Tiền Thanh Toán</h6>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Tổng tiền sản phẩm</td>
                                                <td><?= formatPrice($tongTienSanPham) ?? '' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phí vận chuyển</td>
                                                <td><?= formatPrice($phiVanChuyen) ?? '' ?></td>
                                            </tr>
                                            <tr class="total">
                                                <td>Giá Thanh Toán</td>
                                                <td class="total-amount"><?= formatPrice($tongTienThanhToan) ?? '' ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn btn-sqr d-block">Proceed Checkout</a>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="text-center ">
                        <h3>Bạn Chưa có sản Phẩm Nào</h3>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
</main>



<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>