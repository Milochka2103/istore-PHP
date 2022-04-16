<?php
  require "../includes/config.php";

  if(isset($_POST['search_btn']))
  {
    $search = $_POST['search'];
    $query = mysqli_query($connection, "SELECT * FROM `card_product` WHERE `title` = '$search'");
  } else 
  {
    $query = mysqli_query($connection, "SELECT * FROM `card_product`");
  }
?>

  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <title><?php echo $config['title'] ?></title>
</head>
<body style="background-color: rgb(235, 238, 247);">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"><?php echo $config['title'] ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about_us.php">О нас</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="delivery_payment.php">Доставка/Оплата</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Каталог товаров
          </a>
          <?php
        $categories_q = mysqli_query($connection, "SELECT * FROM `categories`");
        $categories = array();
        while( $cat = mysqli_fetch_assoc($categories_q) )
        {
          $categories[] = $cat;
        }
      ?>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
                foreach( $categories as $cat )
              {
              ?>
                <a class="dropdown-item" href="../pages/categorie_products.php?categorie=<?php echo $cat['id']; ?>"><?php echo $cat['title']; ?></a>
              <?php
              }
              ?>

          </div>

        </li>
      </ul>

      <nav class="navbar navbar-light bg-light">
        <form class="form-inline" action="search.php" method="POST">
          <input class="form-control mr-sm-2" type="search" name="search" placeholder="Поиск" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg></button>
        </form>
      </nav>
      
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../pages/my_account.php">Личный кабинет <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/korzina.php">Корзина <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket3-fill" viewBox="0 0 16 16">
  <path d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1A.5.5 0 0 1 .5 6h1.717L5.07 1.243a.5.5 0 0 1 .686-.172zM2.468 15.426.943 9h14.114l-1.525 6.426a.75.75 0 0 1-.729.574H3.197a.75.75 0 0 1-.73-.574z"/>
</svg></a>
        </li>
      </ul>
    </div>
  </div>
  </nav>


  <div class="container">
    <div class="row">

  <?php
     $query;
      while ($pr = mysqli_fetch_assoc($query))
      {
        ?>
        <div class="col-md-3">
        <div class="card">
          <img src="../img/<?php echo $pr['image']?>" class="card-img-top" alt="...">
          <div class="card-body">
            <a href="info_product.php?id=<?php echo $pr['id']; ?>"><?php echo $pr['title'] ?></a>
            <p class="card-text" style="color: black;"><?php echo $pr['weight']?></p>
            <p class="card-price"  style="color: black;"><?php echo $product['price']?></p>

            <a href="korzina.php" data-art="<?php echo $pr['id'] ?>" class="btn btn-primary btn-buy" id="1">Купить</a>
          </div>
        </div>
      </div>
    <?php
      }

    ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
  integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  </body>
</html>