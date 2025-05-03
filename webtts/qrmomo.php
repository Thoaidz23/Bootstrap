<?php
  session_start();
  include("./admin/connect.php");
  // Thiết lập thời gian ban đầu
  $minutes = 59;
  $seconds = 59;
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Thanh toán Momo</title>
  <style>
    .header-momo {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: white;
  padding: 20px 0;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  z-index: 1000;
}

.header-momo__logo {
  display: flex;
  left: 0;
  margin-left: 70px;
  gap: 10px;
  font-size: 24px;
  font-weight: bold;
}

.header-momo__logo img {
  width: 60px;
  height: 40px;
  object-fit: contain;
  border-radius: 50%;
}

.container-momo {
  width: 90%;
  margin: 0 auto;
  margin-top: -2%;

  .payment-momo-wrapper {
    display: flex;
    height: 550px;
    gap: 3%;
  }

  .payment-momo-box {
    width: 30%;
    background-color: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    font-family: sans-serif;
    color: #333;
  
    h3 {
      margin: 0 0 20px;
      font-size: 20px;
      font-weight: 600;
      text-align: center;
    }
  
    .order-info-momo {
        margin-top: 80px;
      .row-momo {
       
        position: relative;
        padding: 12px 0;
        font-size: 16px;
        line-height: 1.4;
  
        strong {
          display: block;
          font-size: 14px;
          font-weight: 400;
          color: #888;
          margin-bottom: 4px;
        }
  
        span {
          font-weight: 600;
          color: #222;
        }
  
        &.price-row {
          span {
            font-size: 18px;
            color: #00d885;
          }
        }
  
        /* kẻ ngang ngăn cách giữa các mục, trừ mục cuối */
        &:not(:last-child)::after {
          content: "";
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0;
          height: 1px;
          background-color: #eee;
        }
      }
    }
  
    .countdown {
      margin-top: 24px;
      background-color: #ffe6eb;
      border-radius: 10px;
      padding: 16px;
      text-align: center;
  
      .label-momo {
        font-weight: 500;
        color: #d8007f;
        margin-bottom: 12px;
        display: block;
      }
  
      .time-box-momo {
        display: flex;
        justify-content: center;
        gap: 16px;
  
        .unit-mm {
          background-color: #fff;
          border-radius: 8px;
          padding: 8px 16px;
          font-size: 22px;
          font-weight: bold;
          color: #333;
        }
      }
    }
  
    .back-button-mm {
      margin-top: 24px;
      text-align: center;
  
      button {
        background: none;
        border: none;
        color: #d8007f;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: underline;
  
        &:hover {
          opacity: 0.8;
        }
      }
    }
  }
  

  .content-momo {
    width: 60%;
  }
}
/*qr*/
.momo-qr-wrapper {
    margin-top: 139px;
  background: linear-gradient(to bottom, #d8007f, #ec268f);
  border-radius: 12px;
  padding: 30px 20px;
  height: 550px;
  text-align: center;
  color: white;
  box-shadow: 0 8px 16px rgba(216, 0, 127, 0.3);

  h4 {
    font-size: 20px;
    margin-bottom: 20px;
    font-weight: bold;
  }

  .momo-qr-box {
    background: white;
    border-radius: 16px;
    padding: 10px;
    display: inline-block;

    img {
      width: 330px;
      border-radius: 8px;
    }
  }

  .momo-instruction {
    margin-top: 20px;
    font-size: 14px;

    p {
      margin: 6px 0;
    }

    a {
      color: #ffeb3b;
      text-decoration: underline;
      font-weight: 500;

      &:hover {
        color: #fff;
      }
    }
  }
}
@media screen and (max-width: 768px) {
  /* Điều chỉnh header */
  .header-momo {
    padding: 10px 0;
  }

  .header-momo__logo {
    margin-left: 20px;
  }

  .header-momo__logo img {
    width: 50px;
    height: 30px;
  }

  /* Điều chỉnh bố cục thanh toán */
  .container-momo {
    width: 100%;
    margin-top: 0;
  }

  .payment-momo-wrapper {
    flex-direction: column;
    height: auto;
    gap: 20px;
  }

  .payment-momo-box {
    width: 100%;
    padding: 16px;
  }

  .content-momo {
    width: 100%;
  }

  /* Điều chỉnh QR */
  .momo-qr-wrapper {
    height: auto;
    padding: 20px;
  }cc 
.momo-qr-wrapper {
    padding: 20px;
    height: auto;
  }

  .momo-qr-box {
    width: 100%;
  }
  
}

  </style>
  <script>
    let minutes = <?php echo $minutes; ?>;
    let seconds = <?php echo $seconds; ?>;

    function startCountdown() {
      const minuteElem = document.getElementById("minutes");
      const secondElem = document.getElementById("seconds");

      const timer = setInterval(() => {
        if (seconds > 0) {
          seconds--;
        } else {
          if (minutes === 0) {
            clearInterval(timer);
            return;
          } else {
            minutes--;
            seconds = 59;
          }
        }

        minuteElem.textContent = String(minutes).padStart(2, '0');
        secondElem.textContent = String(seconds).padStart(2, '0');
      }, 1000);
    }

    window.onload = startCountdown;
  </script>
</head>
<body>
  <div class="header-momo">
    <div class="header-momo__logo">
      <img 
        src="https://th.bing.com/th/id/OIP.-DhgkiQDEdoru7CJdZrwEAHaHa?w=250&h=250&c=8&rs=1&qlt=90&o=6&dpr=1.6&pid=3.1&rm=2" 
        alt="logo"
      />
      <span>Cổng thanh toán Momo</span>
    </div>
  </div>

  <div class="container-momo">
    <div class="payment-momo-wrapper">

      <!-- Thông tin đơn hàng -->
      <div class="payment-momo-box">
        <h3>Thông tin đơn hàng</h3>
        <div class="order-info-momo">
          <div class="row-momo">
            <strong>Nhà cung cấp:</strong> <span>TTS SHOP</span>
          </div>
          <?php
        // Lấy đơn hàng mới nhất
        $sql = "SELECT code_order, total_price FROM tbl_order ORDER BY id_order DESC LIMIT 1";
        $result = mysqli_query($mysqli, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $code_order = $row['code_order'];
            $total_price = number_format($row['total_price'], 0, ',', '.'); // định dạng tiền tệ
        } else {
            $code_order = "Không tìm thấy";
            $total_price = "0";
        }
        ?>
          <div class="row-momo">
            <strong>Mã đơn hàng:</strong> <span><?php echo $code_order; ?></span>
          </div>
          <div class="row-momo price-row">
            <strong>Số tiền:</strong> <span class="price"><?php echo $total_price; ?>đ</span>
          </div>
        </div>

        <div class="countdown">
          <div class="label-momo">Đơn hàng sẽ hết hạn sau:</div>
          <div class="time-box-momo">
            <div>
              <div class="unit-mm" id="minutes"><?php echo str_pad($minutes, 2, '0', STR_PAD_LEFT); ?></div>
              <div>Phút</div>
            </div>
            <div>
              <div class="unit-mm" id="seconds"><?php echo str_pad($seconds, 2, '0', STR_PAD_LEFT); ?></div>
              <div>Giây</div>
            </div>
          </div>
        </div>
        <a style="margin-top: 20px; margin-left: 103px" href="purchasehistory.php" class="btn btn-success d-inline-block">
    Đã thanh toán
</a>
        <!-- <div class="back-button-mm">
          <button onclick="history.back();">Quay về</button>
        </div> -->
      </div>

      <!-- QR code -->
      <div class="content-momo">
        <div class="momo-qr-wrapper">
          <h4>Quét mã QR để thanh toán</h4>
          <div class="momo-qr-box">
            <img src="./assets/img/momo.jpg" alt="QR MoMo" />
          </div>
          <div class="momo-instruction">
            <p>
              📱 Sử dụng <strong>App MoMo</strong> hoặc ứng dụng camera hỗ trợ QR code để quét mã
            </p>
            <p>
              Gặp khó khăn khi thanh toán? <a href="#">Xem Hướng dẫn</a>
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>
</html>
