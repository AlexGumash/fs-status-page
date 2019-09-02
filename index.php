<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/fsr_2019_logo.png">
    <title>FSR 2019</title>
    <link rel="stylesheet" href="styles/main.css">
    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <script type="text/javascript" src='scripts/ajax.js'></script>
  </head>
  <body>
    <div class="container">
      <div class="header">

        <div class="header-top">
          <div class="header-top-container">
            <span style="margin-right: 20px">Formula Student Russia 2019</span>
            <span>
              <a id="profile" data_target="pages/profile.php">
                <img class="profile-icon" src="images/user.png" alt="profile icon">
              </a>
            </span>
          </div>
        </div>

        <div class="header-menu">
          <ul class="menu-list" id="menu-list">
            <li class="menu-list-item">
              <a data_target="pages/news.php">
                <div class="menu-link-block">
                  <span>News</span>
                </div>
              </a>
            </li>
            <li class="menu-list-item">
              <a data_target="pages/status.php">
                <div class="menu-link-block">
                  <span>Status</span>
                </div>
              </a>
            </li>
            <li class="menu-list-item" style="margin-right: 0">
              <a data_target="pages/results.php">
                <div class="menu-link-block">
                  <span>Results</span>
                </div>
              </a>
            </li>
          </ul>
        </div>

        </div>
      <div id="content" style="width: 100%">

      </div>
    </div>
  </body>
</html>
