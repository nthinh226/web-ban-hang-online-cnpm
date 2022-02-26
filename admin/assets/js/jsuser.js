

/* ---- Hàm alert ---- */
function alert_success(mes) {
    Swal.fire(
      'Thành công!',
      mes,
      'success'
    )
  }
  
  function alert_error(mes) {
    Swal.fire({
      icon: 'error',
      title: 'Thất bại...',
      text: mes,
    })
  }
  
  function sweetalert_info(thongbao) {
    Swal.fire(thongbao)
  }
  
  function alert_info(mes) {
    let timerInterval
    Swal.fire({
      title: mes,
      html:
        '<br/><br/>I will close in <strong></strong> seconds.',
      timer: 4000,
      didOpen: () => {
        const content = Swal.getHtmlContainer()
        const $ = content.querySelector.bind(content)
        Swal.showLoading()
        timerInterval = setInterval(() => {
          Swal.getHtmlContainer().querySelector('strong')
            .textContent = (Swal.getTimerLeft() / 1000)
              .toFixed(0)
        }, 100)
      },
      willClose: () => {
        clearInterval(timerInterval)
      }
    })
  }
