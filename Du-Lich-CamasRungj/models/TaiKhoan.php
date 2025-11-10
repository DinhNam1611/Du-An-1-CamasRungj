<?php

class TaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }


    public function checkLogin($email, $mat_khau)
    {
        $result = [
            'status' => false, // Mặc định là thất bại
            'message' => '',
            'email' => $email, // Lưu email để trả lại form
            'user' => null
        ];

        try {
            // 1. Tìm user theo email
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();




            // Nếu email không tồn tại
            if (!$user) {
                $result['message'] = 'Email không tồn tại';
                return $result;
            }

            // Nếu mật khẩu sai
            if (!password_verify($mat_khau, $user['mat_khau'])) {
                $result['message'] = 'Mật khẩu không chính xác';
                return $result;
            }

            // Nếu không phải admin
            if ($user['chuc_vu_id'] != 2) {
                $result['message'] = 'Tài khoản không có quyền truy cập';
                return $result;
            }

            // Nếu tài khoản bị khóa
            if ($user['trang_thai'] != 1) {
                if ($user['trang_thai'] == 2) {
                    $result['message'] = 'Tài khoản chưa được kích hoạt';
                    return $result;
                }
                if ($user['trang_thai'] == 3) {
                    $result['message'] = 'Tài khoản bị khóa tạm thời';
                    return $result;
                }
                if ($user['trang_thai'] == 4) {
                    $result['message'] = 'Tài khoản bị vô hiệu hóa';
                    return $result;
                }
                if ($user['trang_thai'] == 5) {
                    $result['message'] = 'Tài khoản đang chờ duyệt';
                    return $result;
                }
            }

            // Thành công
            $result['status'] = true;
            $result['message'] = 'Đăng nhập thành công';
            $result['user'] = $user;
            return $result;
        } catch (Exception $e) {
            $result['message'] = 'Lỗi hệ thống: ' . $e->getMessage();
            return $result;
        }
    }

    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $email,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
}
