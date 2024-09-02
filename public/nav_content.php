
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container">
      <a class="navbar-brand" href="index.php">Assignment</a>
      <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Console</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="nav-scroller bg-body shadow-sm">
    <nav class="nav container" aria-label="Secondary navigation">
      <a class="nav-link disabled text-dark" href="index.php"><strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong></a>
      <a class="nav-link" href="index.php">
        Orders
        <?php if( isset($orders) && count($orders) > 0){ ?>
        <span class="badge text-bg-danger rounded-pill align-text-bottom"><?php echo count($orders);?></span>
        <?php } ?>

      </a>
    </nav>
  </div>