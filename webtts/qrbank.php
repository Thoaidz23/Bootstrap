<?php
session_start();
include("./admin/connect.php");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Cổng Thanh Toán Ngân Hàng</title>
  <style>
    .header-bank {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: white;
    padding: 20px 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }
  
  .header-bank__logo {
    display: flex;
    left: 0;
    margin-left: 70px;
    gap: 10px;
    font-size: 24px;
    font-weight: bold;
  }
  
  .header-bank__logo img {
    width: 60px;
    height: 40px;
    object-fit: contain;
    border-radius: 50%;
  }
  
  .container-bank {
    width: 90%;
    margin: 0 auto;
    margin-top: -2%;
  
    .payment-bank-wrapper {
      display: flex;
      height: 550px;
      gap: 3%;
    }
  
    .payment-bank-box {
      margin-top: 120px;
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
    
      .order-info-bank {
        margin-top: 80px;
        .row-bank {
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
    
          &.price-row-bank {
            span {
              font-size: 18px;
              color: #00945b;
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
    
      .countdown-bank {
        margin-top: 24px;
        background-color: rgb(85, 149, 105,0.2);
        border-radius: 10px;
        padding: 16px;
        text-align: center;
    
        .label-bank {
          font-weight: 500;
          color: #2c6543;
          margin-bottom: 12px;
          display: block;
        }
    
        .time-box-bank {
          display: flex;
          justify-content: center;
          gap: 16px;
    
          .unit-bank {
            background-color: #fff;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 22px;
            font-weight: bold;
            color: #333;
          }
        }
      }
    
      .back-button-bank {
        margin-top: 24px;
        text-align: center;
    
        button {
          background: none;
          border: none;
          color: #2ebf93;
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
    
  
    .content-bank {
      width: 60%;
    }
  }
  /*qr*/
  .bank-qr-wrapper {
    margin-top: 139px;
    background: linear-gradient(to bottom, #186f48, #186f48);
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
  
    .bank-qr-box {
      background: white;
      border-radius: 16px;
      padding: 10px;
      display: inline-block;
  
      img {
        width: 330px;
        border-radius: 8px;
      }
    }
  
    .bank-instruction {
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
  </style>
</head>
<body>
  <div class="header-bank">
    <div class="header-bank__logo">
      <img 
        src="https://th.bing.com/th/id/OIP.6rGzO2j2Dy_7dotwoZCvPgHaHa?w=250&h=250&c=8&rs=1&qlt=90&o=6&dpr=1.6&pid=3.1&rm=2" 
        alt="logo"
      />
      <span>Cổng thanh toán ngân hàng</span>
    </div>
  </div>

  <div class="container-bank">
  <div class="payment-bank-wrapper">

<!-- Thông tin đơn hàng -->
<div class="payment-bank-box">
  <h3>Thông tin đơn hàng</h3>
  <div class="order-info-bank">
    <div class="row-bank">
      <strong>Nhà cung cấp: TTS Shop</strong> 
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
    <div class="row-bank">
      <strong>Mã đơn hàng:</strong> 
      <span><?php echo $code_order; ?></span>
    </div>
    <div class="row-bank price-row-bank">
      <strong>Số tiền:</strong> 
      <span class="price"><span class="price"><?php echo $total_price; ?> VND</span>
    </div>
  </div>

  <!-- Countdown -->
  <div class="countdown-bank">
    <div class="label-bank">Đơn hàng sẽ hết hạn sau:</div>
    <div class="time-box-bank">
      <div>
        <div id="minutes" class="unit-bank">59</div>
        <div>Phút</div>
      </div>
      <div>
        <div id="seconds" class="unit-bank">59</div>
        <div>Giây</div>
      </div>
    </div>
  </div>

  <a style="margin-top: 20px; margin-left: 103px" href="purchasehistory.php" class="btn btn-success d-inline-block">
    Đã thanh toán
</a>


  <!-- <div class="back-button-bank">
    <button onclick="window.history.back()">Quay về</button>
  </div> -->
</div>

      <!-- QR code -->
      <div class="content-bank">
        <div class="bank-qr-wrapper">
          <h4>Quét mã QR để thanh toán</h4>
          <div class="bank-qr-box">
            <img src="./assets/img/vietcombank.jpg" alt="QR VCB">
          </div>
          <div class="bank-instruction">
            <p>📱 Sử dụng <strong>App Vietcombank</strong> hoặc ứng dụng camera hỗ trợ QR code để quét mã</p>
            <p>Gặp khó khăn khi thanh toán? <a href="#">Xem Hướng dẫn</a></p>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    // Countdown JS giống logic useEffect React
    let minutes = 59;
    let seconds = 59;
    const minEl = document.getElementById('minutes');
    const secEl = document.getElementById('seconds');

    const timer = setInterval(() => {
      if (seconds > 0) {
        seconds--;
      } else {
        if (minutes === 0) {
          clearInterval(timer);
        } else {
          minutes--;
          seconds = 59;
        }
      }
      minEl.textContent = String(minutes).padStart(2, '0');
      secEl.textContent = String(seconds).padStart(2, '0');
    }, 1000);
  </script>
</body>
</html>