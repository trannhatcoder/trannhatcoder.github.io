function confirmDelete() {
    if(confirm("Bạn có chắc chắn muốn xóa món ăn này?")){
        // Nếu người dùng chọn "OK", thực hiện xóa món ăn
        return true;
    } else {
        // Nếu người dùng chọn "Cancel", không thực hiện xóa món ăn
        return false;
    }
}
function confirmUpdate() {
    if(confirm("Bạn có chắc chắn muốn cập nhật món ăn(thức uống) này?")){
        // Nếu người dùng chọn "OK", thực hiện xóa món ăn
        return true;
    } else {
        // Nếu người dùng chọn "Cancel", không thực hiện xóa món ăn
        return false;
    }
}
function confirmDeleteEmployee() {
    if(confirm("Bạn có chắc chắn muốn xóa nhân viên này?")){
        // Nếu người dùng chọn "OK", thực hiện xóa món ăn
        return true;
    } else {
        // Nếu người dùng chọn "Cancel", không thực hiện xóa món ăn
        return false;
    }
}
function confirmUpdateEmployee() {
    if(confirm("Bạn có chắc chắn muốn cập nhật nhân viên này?")){
        // Nếu người dùng chọn "OK", thực hiện xóa món ăn
        return true;
    } else {
        // Nếu người dùng chọn "Cancel", không thực hiện xóa món ăn
        return false;
    }
}
// Gửi yêu cầu đến máy chủ để kiểm tra có đơn hàng mới hay không
function checkNewOrders() {
    $.ajax({
      url: "your-server-url",
      type: "GET",
      success: function(data) {
        // Nếu có đơn hàng mới, hiển thị thông báo
        if (data.newOrders > 0) {
          $("#notification").php("Có " + data.newOrders + " đơn hàng mới đang chờ xác nhận.");
        }
      }
    });
  }
  
  // Kiểm tra đơn hàng mới mỗi 5 giây
  setInterval(checkNewOrders, 5000);