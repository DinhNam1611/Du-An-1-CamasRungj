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
                                <li class="breadcrumb-item active" aria-current="page">Thanh Toán</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Login Coupon Accordion Start -->
                    <div class="checkoutaccordion" id="checkOutAccordion">

                        <div class="card">
                            <h6>Thêm Mã Giảm Giá <span data-bs-toggle="collapse" data-bs-target="#couponaccordion">Click
                                    CLick Nhập Mã Giảm Giá</span></h6>
                            <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                <div class="card-body">
                                    <div class="cart-update-option">
                                        <div class="apply-coupon-wrapper">
                                            <form action="#" method="post" class=" d-block d-md-flex">
                                                <input type="text" placeholder="Enter Your Coupon Code" required />
                                                <button class="btn btn-sqr">Apply Coupon</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout Login Coupon Accordion End -->
                </div>
            </div>
            <form action="<?= BASE_URL . '?act=xu-ly-thanh-toan' ?>" method="post">
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Thông tin người nhận</h5>
                            <div class="billing-form-wrap">


                                <div class="col-md-12">
                                    <div class="single-input-item">
                                        <label for="ten_nguoi_nhan" class="required">Tên người nhận</label>
                                        <input type="text" id="f_name" name="ten_nguoi_nhan" value="<?= $user['ho_ten'] ?>" placeholder="Tên người nhận" required />
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="single-input-item">
                                        <label for="email_nguoi_nhan" class="required">Email</label>
                                        <input type="email" id="l_name" name="email_nguoi_nhan" value="<?= $user['email'] ?>" placeholder="Email" required />
                                    </div>
                                </div>

                                <div class="single-input-item">
                                    <label for="sdt_nguoi_nhan">Số điện thoại</label>
                                    <input type="text" id="com-name" name="sdt_nguoi_nhan" value="<?= $user['so_dien_thoai'] ?>" placeholder="Số điện thoại" />
                                </div>

                                <div class="single-input-item">
                                    <label for="dia_chi_nguoi_nhan" class="required">Địa chỉ người nhận</label>
                                    <input type="text" name="dia_chi_nguoi_nhan" placeholder="Địa chỉ người nhận" value="<?= $user['dia_chi'] ?>" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="ghi_chu">Ghi chú</label>
                                    <textarea id="ordernote" name="ghi_chu" cols="30" rows="3" placeholder="Ghi chú đơn hàng của bạn"></textarea>
                                </div>



                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Thông tin đơn hàng</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th> Sản Phẩm </th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tongTienSanPham = 0;
                                            $phiVanChuyen = 50000;
                                            foreach ($chiTietGioHang as $key => $thanhtoan):
                                            ?>
                                                <tr>
                                                    <td><a href="product-details.html"><?= $thanhtoan['ten_san_pham'] ?> <strong> × <?= $thanhtoan['so_luong'] ?></strong></a>
                                                    </td>
                                                    <?php if ($thanhtoan['gia_khuyen_mai']) {
                                                        $checkGia = $thanhtoan['gia_khuyen_mai'];
                                                    } else {
                                                        $giaSanPham = $thanhtoan['gia_san_pham'];
                                                    }
                                                    $giaSanPham = $checkGia * $thanhtoan['so_luong'];
                                                    $tongTienSanPham += $giaSanPham;
                                                    ?>
                                                    <td><?= formatPrice($giaSanPham) ?></td>
                                                </tr>
                                            <?php endforeach;
                                            $tongTienThanhToan = $tongTienSanPham + $phiVanChuyen;
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Tổng tiền</td>
                                                <td><strong><?= formatPrice($tongTienSanPham) ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Phí vận chuyển</td>
                                                <td class="d-flex justify-content-center">
                                                    <strong><?= formatPrice($phiVanChuyen) ?></strong>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Tổng thanh toán</td>
                                                <input type="hidden" name="tong_tien" value="<?= $tongTienThanhToan ?>">
                                                <td><strong><?= formatPrice($tongTienThanhToan) ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method show">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon" name="phuong_thuc_thanh_toan" value="1" class="custom-control-input" checked />
                                                <label class="custom-control-label" for="cashon">Thanh toán khi nhận hàng</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" data-method="cash">
                                            <p>Khách hàng có thể xem hàng nếu không có vẫn đề gì thì thanh toán cho người giao hàng</p>
                                        </div>
                                    </div>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="directbank" name="phuong_thuc_thanh_toan" value="2" class="custom-control-input" />
                                                <label class="custom-control-label" for="directbank">Chuyển Khoản</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" data-method="bank">
                                            <p>Chuyển chuyển khoản qua ngân hàng, khi chúng tôi nhận được tiền chúng tôi sẽ cập nhật lên trạng thái đơn hàng và giao hàng cho bạn</p>
                                        </div>
                                    </div>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="checkpayment" name="phuong_thuc_thanh_toan" value="3" class="custom-control-input" />
                                                <label class="custom-control-label" for="checkpayment">Thanh toán bằng thẻ ghi nợ</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" data-method="check">
                                            <p>Thanh toán qua thẻ ghi nợ của khách hàng</p>
                                        </div>
                                    </div>

                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required />
                                            <label class="custom-control-label" for="terms">Tôi đã đọc và chấp nhận các <a href="index.html">điều khoản dịch vụ</a></label>
                                        </div>
                                        <button type="submit" class="btn btn-sqr">Tiến Hành Đặt Hàng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout main wrapper end -->
</main>

<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>