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
                                <li class="breadcrumb-item active" aria-current="page">bill detail</li>
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
                    <div class="col-lg-7">
                        <!-- Thông tin sản phẩm -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="5">Thông tin sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <th style="width: 30%;">Hình ảnh</th>
                                        <th style="width: 20%;">Tên sản phẩm</th>
                                        <th style="width: 10%;">Đơn giá</th>
                                        <th style="width: 15%;">Số lượng</th>
                                        <th style="width: 10%;">Thành tiền</th>
                                    </tr>
                                    <?php foreach ($chiTietDonHang as $ỉtem => $listSanPham): ?>
                                        <tr>
                                            <td min-width="100px"><img class="img-fluid" src="<?= BASE_URL . $listSanPham['hinh_anh'] ?>" alt="Product" width="100px"></td>
                                            <td class="text-break" style="white-space: normal;"><?= $listSanPham['ten_san_pham'] ?></td>
                                            <td><?= formatPrice($listSanPham['don_gia']) ?></td>
                                            <td><?= $listSanPham['so_luong'] ?></td>
                                            <td><?= formatPrice($listSanPham['thanh_tien']) ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Thông tin đơn hàng -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Thông tin sản phẩm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mã đơn hàng</td>
                                        <td><?= $donHang['ma_don_hang'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Người Nhận</td>
                                        <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?= $donHang['email_nguoi_nhan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Số Điện Thoại</td>
                                        <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%">Địa Chỉ</td>
                                        <td class="text-break" style="white-space: normal;"><?= $donHang['dia_chi_nguoi_nhan'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ngày Đặt</td>
                                        <td><?= $donHang['ngay_dat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ghi Chú </td>
                                        <td><?= $donHang['ghi_chu'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tổng Tiền</td>
                                        <td><?= formatPrice($donHang['tong_tien']) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phương thức thanh toán</td>
                                        <td><?= $phuongThucThanhToan[$donHang['phuong_thuc_thanh_toan_id']] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Trạng Thái đơn hàng</td>
                                        <td><?= $trangThaiDonHang[$donHang['trang_thai_id']] ?></td>
                                    </tr>

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