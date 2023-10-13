function confirmReservationAndShowMessage(success) {
  if (confirm("Bạn có chắc chắn muốn đặt bàn không?")) {
      // Nếu người dùng click OK, submit form
      document.querySelector(".reservation").submit();
      // Hiển thị thông báo thành công
      showMessage(success);
  } else {
      // Nếu người dùng click Cancel, không làm gì cả
  }
}

function showMessage(success) {
  if (success) {
    Swal.fire({
      icon: 'success',
      title: 'Thêm dữ liệu thành công!',
      showConfirmButton: false,
      timer: 1500
    });
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Thêm dữ liệu không thành công!',
      text: 'Vui lòng thử lại sau.',
    });
  }
}


const menuButtons = document.querySelectorAll('.menu-button');
const menuContents = document.querySelectorAll('menu-content');

menuButtons.forEach(button =>{
  button.addEventListener('click', ()=>{
    menuContents.forEach(content =>{
      content.style.display = 'none';
    });
    const targetContent = document.querySelector(button.dataset.title);
    targetContent.style.display = 'block';
    menuButtons.forEach(btn =>{
      btn.classList.remove('active');
    });
    button.classList.add('active');
  });
});