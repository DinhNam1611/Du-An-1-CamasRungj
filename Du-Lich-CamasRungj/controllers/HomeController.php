<?php

class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }
    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $SanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);
        $listSize = $this->modelSanPham->getSizeSanPham();
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanhPhamFromDanhMuc($SanPham['danh_muc_id']);

        if ($SanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location:" . BASE_URL);
            exit();
        }
        //Xóa session sau khi load lại trang;
    }

    public function formLogin()
    {
        require_once './views/auth/formLogin.php';

        deleteSessionError();
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            // var_dump($_SESSION['user_admin']['anh_dai_dien']);
            // die;

            $user = $this->modelTaiKhoan->checkLogin($email, $password);
            if ($user['status'] === true) {
                $_SESSION['user'] = $user['user'];
                $_SESSION['user_info'] = [
                    'id' => $user['user']['id'],
                    'ho_ten' => $user['user']['ho_ten'],
                    'email' => $user['user']['email'],
                    'anh_dai_dien' => $user['user']['anh_dai_dien'] ?? 'https://www.transparentpng.com/thumb/user/gray-user-profile-icon-png-fP8Q1P.png',
                ];
                header('Location: ' . BASE_URL);
                exit();
            } else {
                $_SESSION['error'] = $user['message'];
                $_SESSION['old_email'] = $user['email']; // giữ email để hiển thị lại
                header('Location: ' . BASE_URL . '?act=login');
                exit();
            }
        }
    }
    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            unset($_SESSION['user_infor']);
            unset($_SESSION['old_email']);
            unset($_SESSION['error']);
        }
        header('Location: ' . BASE_URL . '?act=login');
    }

    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user'])) {

                $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user']['email']);

                //Lây dữ liệu giỏ hàng của người dùng
                $gioHang = $this->modelGioHang->getGioHangFromId($email['id']);
                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->getAddGioHang($email['id']);
                    $gioHang = ['id' => $gioHangId];
                } else {
                    $chiTietGioHang  = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }

                $san_pham_id = $_POST['san_pham_id'];
                $sanPham = $this->modelSanPham->getDetailSanPham($san_pham_id);
                $so_luong = $_POST['so_luong'];
                $size = $_POST['size'];
                $checkSanPham = false;

                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $newSoLuong =  $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $sanPham['danh_muc_id'], $san_pham_id, $size, $newSoLuong);
                        $checkSanPham = true;
                        break;
                    }
                }
                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $sanPham['danh_muc_id'], $san_pham_id, $size, $so_luong);
                }
                header("Location:" . BASE_URL . '?act=gio-hang');
            } else {
                var_dump('Lỗi Khi Thêm Giỏ Hàng');
                die;
            }
        }
    }

    public function gioHang()
    {
        if (isset($_SESSION['user'])) {
            $email = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user']['email']);
            //Lây dữ liệu giỏ hàng của người dùng
            $gioHang = $this->modelGioHang->getGioHangFromId($email['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->getAddGioHang($email['id']);
                $gioHang = ['id' => $gioHangId];

                $chiTietGioHang  = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang  = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            if (!$chiTietGioHang) {
                $chiTietGioHang = null;
            }
            require_once './views/gioHang.php';
        } else {
            header("Location:" . BASE_URL . '?act=login');
        }
    }

    public function thanhToan()
    {
        if (isset($_SESSION['user'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user']['email']);
            //Lây dữ liệu giỏ hàng của người dùng
            $gioHang = $this->modelGioHang->getGioHangFromId($user['id']);
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->getAddGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang  = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang  = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            require_once './views/thanhToan.php';
        } else {
            var_dump('Lỗi Khi Xem Giỏ Hàng');
            die;
        }
        require_once './views/thanhToan.php';
    }

    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan = $_POST['phuong_thuc_thanh_toan'];

            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1;

            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user']['email']);
            $tai_khoan_id = $user['id'];

            $ma_don_hang = 'HD-' . rand(1000, 9999);

            // thêm thông tin vào db
            $donHang = $this->modelDonHang->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ngay_dat,
                $tong_tien,
                $ghi_chu,
                $phuong_thuc_thanh_toan,
                $trang_thai_id,
                $ma_don_hang,
            );

            //lấy thông tin giỏ hàng của người dùng
            $gioHang = $this->modelGioHang->getGioHangFromId($user['id']);

            if ($donHang) {
                //lấy chi tiết giỏ hàng
                $chiTietGioHang  = $this->modelGioHang->getDetailGioHang($gioHang['id']);

                //thêm tường sản phẩm vào bảng chi tiết giỏ hàng
                foreach ($chiTietGioHang as $key => $addChiTietGioHang) {
                    $donGia = $addChiTietGioHang['gia_khuyen_mai'] ?? $addChiTietGioHang['gia_san_pham'];

                    $this->modelDonHang->addChiTietDonHang($donHang, $addChiTietGioHang['san_pham_id'], $donGia, $addChiTietGioHang['so_luong'], $donGia * $addChiTietGioHang['so_luong']);
                };
            }

            //Xóa sản phẩm trong giỏ hàng
            $this->modelGioHang->clearDetailGioHang($gioHang['id']);
            $this->modelGioHang->clearGioHang($tai_khoan_id);

            header("Location:" . BASE_URL);

            // header("Location:" . BASE_URL . '?act=lich-su-mua-hang');
        } else {
            var_dump('Lỗi đặt hàng');
            die;
        }
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            // var_dump($_SESSION['user_admin']['anh_dai_dien']);
            // die;

            $user = $this->modelTaiKhoan->checkLogin($email, $password);
            if ($user['status'] === true) {
                $_SESSION['user'] = $user['user'];
                $_SESSION['user_info'] = [
                    'id' => $user['user']['id'],
                    'ho_ten' => $user['user']['ho_ten'],
                    'email' => $user['user']['email'],
                    'anh_dai_dien' => $user['user']['anh_dai_dien'] ?? 'https://www.transparentpng.com/thumb/user/gray-user-profile-icon-png-fP8Q1P.png',
                ];
                header('Location: ' . BASE_URL);
                exit();
            } else {
                $_SESSION['error'] = $user['message'];
                $_SESSION['old_email'] = $user['email']; // giữ email để hiển thị lại
                header('Location: ' . BASE_URL . '?act=login');
                exit();
            }
        }

        if (isset($_SESSION['user'])) {
            //lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user']['email']);
            $tai_khoan_id = $user['id'];

            //lấy ra danh sách trạng thái đơn hàng
            $arrayTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrayTrangThaiDonHang, 'ten_trang_thai', 'id');

            //lấy ra danh sách trạng thái thanh toán
            $arrayPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan  = array_column($arrayPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            //lấy ra danh sách tất cả đơn hàng của tài khoản
            $donHang = $this->modelDonHang->getDonHangFromUser($tai_khoan_id);
            require_once './views/lichSuMuaHang.php';
        } else {
            header("Location:" . BASE_URL . '?act=login');
            exit();
        }
    }

    public function ChiTietDonHang()
    {
        if (isset($_SESSION['user'])) {
            //lấy htoong tin tài khoản
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user']['email']);
            $tai_khoan_id = $user['id'];

            $donHangId = $_GET['id'];
            //lấy thông tin đơn hàng qua id
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            //lấy danh sách trạng tahis đơn hàng
            $arrayTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrayTrangThaiDonHang, 'ten_trang_thai', 'id');

            //lấy ra danh sách trạng thái thanh toán
            $arrayPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan  = array_column($arrayPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            //lấy thông tin sản phẩm của đơn hàng trong bảng chi tiết đơn hàng
            $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);
            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo 'bạn không có quyền truy cập đơn hàng này';
                exit;
            }

            require_once './views/chiTietMuaHang.php';
        }
    }

    public function huyDonHang()
    {
        if (isset($_SESSION['user'])) {
            //lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user']['email']);
            $tai_khoan_id = $user['id'];

            $donHangId = $_GET['id'];

            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền hủy đơn hàng này";
                exit;
            }
            if ($donHang['trang_thai_id'] != 1) {
                echo "Chỉ có đơn hàng chưa xác nhận mới được hủy";
                exit;
            }
            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 11);
            header("Location:" . BASE_URL . '?act=lich-su-mua-hang');
        }
    }
}
