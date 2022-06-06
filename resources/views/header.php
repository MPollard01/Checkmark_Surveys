<!DOCTYPE html>
<html>
<head>
  <title>Check Mark Surveys</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href=<?php echo "{$_ENV['APP_URL']}/resources/assets/css/style.css" ?> >
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand " href="#">Check Mark Surveys &#10003;</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ps-5" id="navbarSupportedContent">
                <?php
                if(isset($_SESSION['username'])) {
                    echo
                    
                    '<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active '.(($_SERVER['REQUEST_URI'] === $_ENV['BASE_URL'].'/surveys') ? 'active' : '').'" aria-current="page" href="'.$_ENV['BASE_URL'].'/surveys'.'">Surveys</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="responses.php">Responses</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" aria-current="page" href="#">Analyse</a>
                    </li>
                  </ul>
                  <ul class="navbar-nav me-3">
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      '.$_SESSION['username'].'
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="account.php">Account</a></li>
                        <li><a class="dropdown-item" href="'.$_ENV['BASE_URL'].'/logout'.'">Sign Out</a></li>
                      </ul>
                    </li>
                  </ul>';
                  
                } else {
                    echo 
      
                    '<ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link '.(($_SERVER['REQUEST_URI'] === $_ENV['BASE_URL'].'/') ? 'active' : '').'" aria-current="page" href="'.$_ENV['BASE_URL'].'/'.'">About</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link '.(($_SERVER['REQUEST_URI'] === $_ENV['BASE_URL'].'/register') ? 'active' : '').'" href="'.$_ENV['BASE_URL'].'/register'.'">Sign Up</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link '.(($_SERVER['REQUEST_URI'] === $_ENV['BASE_URL'].'/login') ? 'active' : '').'" href="'.$_ENV['BASE_URL'].'/login'.'">Sign In</a>
                    </li>
                    </ul>';
                }
                
                ?>
            </div>
        </div>
    </nav>
        <div class="container mt-5">