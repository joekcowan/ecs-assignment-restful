<?php
include '../src/functions.php';

session_start();
// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

$orders = getOrders($_SESSION["userid"]);

// check for order no.
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $orderNo = $_GET['order_no'];
  $order_details = getOrderDetails($orderNo);
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.104.2">
  <title>Assignment | Order Details</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/offcanvas-navbar/">

  <!-- Bootstrap CSS v5.2.1 -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous" />

  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

  <!-- default css-->
  <link rel="stylesheet" href="assets/css/default.css" />

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="/docs/5.2/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
  <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  <link rel="manifest" href="/docs/5.2/assets/img/favicons/manifest.json">
  <link rel="mask-icon" href="/docs/5.2/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
  <link rel="icon" href="/docs/5.2/assets/img/favicons/favicon.ico">
  <meta name="theme-color" content="#712cf9">


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="assets/css/console.css" rel="stylesheet">
</head>

<body class="bg-light">

  <?php include 'nav_content.php'; ?>

  <main class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
      <div class="lh-1">
        <h1 class="h6 mb-0 text-white lh-1"><a class="nav-item text-white" href="index.php">Console</a> | Order Details</h1>

      </div>
    </div>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <h6 class="pb-1 mb-0"><strong><?php echo $order_details[0]['cust_name'] . ' (' . $order_details[0]['cust_abbr'] . ')'; ?></strong></h6>
      <h6 class="border-bottom pb-2 mb-0">Order #<?php echo $order_details[0]['order_no']; ?></h6>

      <div class="table-responsive">
      <table class="table table-sm table-striped table-auto">
        <thead class="table-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Qty</th>
            <th scope="col">SKU - DESCRIPTION</th>
          </tr>
        </thead>
        <tbody>

          <?php for($i = 0; $i<count($order_details); $i++) { ?>
            <tr>
              <th scope="row"><?php echo $i+1; ?></td>
              <td><?php echo $order_details[$i]['qty']; ?></td>
              <td><?php echo $order_details[$i]['sku'].' - '.$order_details[$i]['item_name']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      </div>

      <small class="d-block text-end mt-3">
        <a href="index.php">All orders</a>
      </small>
    </div>
  </main>


  <script src="/docs/5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <script src="offcanvas.js"></script>

</body>

</html>