<!-- header  -->
<?php require_once './views/layout/header.php'; ?>
<!-- Navbar -->
<?php require_once './views/layout/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php require_once './views/layout/sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1> Quản lý Danh Sách Booking</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="<?= BASE_URL_ADMIN . "?act=form-them-booking" ?>">
                <button class="btn btn-success">Thêm Booking</button>
              </a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã Booking</th>
                    <th>Tên Người Đặt</th>
                    <th>Ngày Đặt</th>
                    <th>Số Người</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($listBooking as $key => $booking): ?>
                    <tr>
                      <td class="text-center"><?= $key + 1 ?></td>
                      <td><?= $booking['booking_id '] ?></td>
                      <td><?= $booking['user_name'] ?></td>
                      <td><?= formatDate($booking['booking_date']) ?></td>
                      <td><?= $booking['total_guests'] ?></td>
                      <td><?= number_format($booking['total_price'], 0, '.', ',') . ' vnđ' ?></td>
                      <td><?= $booking['status'] ?></td>
                      <td class="text-center">
                        <div class="btn-group">
                          <a href="<?= BASE_URL_ADMIN . "?act=chi-tiet-booking&id=" . $booking['booking_id']; ?>">
                            <button class="btn btn-primary"><i class="far fa-eye"></i></button>
                          </a>
                          <a href="<?= BASE_URL_ADMIN . "?act=form-sua-booking&id=" . $booking['booking_id']; ?>">
                            <button class="btn btn-warning"><i class="fas fa-cogs"></i></button>
                          </a>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Mã Booking</th>
                    <th>Tên Người Đặt</th>
                    <th>Ngày Đặt</th>
                    <th>Số Người</th>
                    <th>Tổng Tiền</th>
                    <th>Trạng Thái</th>
                    <th>Thao Tác</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Footer -->
<?php require_once './views/layout/footer.php'; ?>
<!-- End Footer  -->
<!-- Page specific script -->

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->
</body>

</html>