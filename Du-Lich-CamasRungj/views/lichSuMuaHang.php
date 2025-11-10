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
                                <li class="breadcrumb-item active" aria-current="page">bill</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

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
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng Tiền</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái đơn hàng</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>fr
                                <tbody>
                                    <?php foreach ($donHang as $key => $donHang): ?>
                                        <tr>
                                            <td class="text-center"><strong><?= $donHang['ma_don_hang'] ?></strong></td>
                                            <td><?= formatDate($donHang['ngay_dat']) ?></td>
                                            <td><?= formatPrice($donHang['tong_tien']) ?></td>
                                            <td><?= $phuongThucThanhToan[$donHang['phuong_thuc_thanh_toan_id']] ?></td>
                                            <td><?= $trangThaiDonHang[$donHang['trang_thai_id']] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL . '?act=chi-tiet-mua-hang&id=' . $donHang['id'] ?>" class="btn btn-sqr">Chi tiết </a>
                                                <?php if ($donHang['trang_thai_id'] == 1): ?>
                                                    <a href="<?= BASE_URL . '?act=huy-don-hang&id=' . $donHang['id'] ?>" class="btn btn-sqr" onclick="return confirm('Xác Nhận Hủy Đơn Hàng')">Hủy Đơn </a>
                                                <?php endif ?>
                                            </td>
                                        </tr>

                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
</main>



<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>