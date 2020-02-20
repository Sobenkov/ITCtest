<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ITCtest</title>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   <link rel="stylesheet" href="assets/css/style.css">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-primary bg-primary fixed-top">

  <a href="#" class="navbar nav-link" data-toggle="modal" data-target="#exampleModal"><h4> Форма </h4></a>

</nav>

<main role="main" class="container">

  <div class="row">
    
    <div class="col-4"> <!-- запрос на каталог -->

        <?php
          $mysqli = new mysqli("localhost", "host1809744", "f535e322", "host1809744");
          $result_set = $mysqli->query("SELECT * FROM `menu`");
          $items = array();
          while (($row = $result_set->fetch_assoc()) != false) $items[$row["id"]] = $row;
          $childrens = array();
          foreach ($items as $item) {
            if ($item["parent_id"]) $childrens[$item["id"]] = $item["parent_id"];
          }
          function printItem($item, $items, $childrens) {
            echo "<li>";
            echo "<a href='".$item["link"]."'>".$item["title"]."</a>";
            $ul = false; 
            while (true) {
              $key = array_search($item["id"], $childrens);
              if (!$key) {
                if ($ul) echo "</ul>"; 
                break; 
              }
              unset($childrens[$key]);
              if (!$ul) {
                echo "<ul>";
                $ul = true; 
              }
              echo printItem($items[$key], $items, $childrens); 
            }
            echo "</li>";
          }
        ?>
        <div id="menu">
          <h2>Меню</h2> <!-- вывод меню из бд -->
          <ul>
            <?php
              foreach ($items as $item) {
                if (!$item["parent_id"]) echo printItem($item, $items, $childrens);
              }
            ?>
          </ul>
        </div> 
      </div> <!-- /.col-4 -->

    <div class="col-8"> <!-- запрос на таблицу -->
      <?php
        $str= mysqli_connect('localhost', 'host1809744', 'f535e322', 'host1809744');
        $select= mysqli_query($str, "SELECT id, name, tel, email FROM `users`;");

        echo  '<table class="table table-bordered">';
        echo'<tr>
          <th scope="col">№</th>
          <th scope="col">ФИО</th>
          <th scope="col">Телефон</th>
          <th scope="col">E-mail</th>
        </tr>';
        while ($r= mysqli_fetch_array($select)) {
        echo '<tr>
                <td>'.$r['id'].'</td>
                <td>'.$r['name'].'</td>
                <td>'.$r['tel'].'</td>
                <td>'.$r['email'].'</td>
              </tr>';
        }
        echo '</table>';
        mysqli_close($str);
      ?>
    </div><!-- /.col-8 -->
  </div> <!-- row -->
  
  <!-- модальное окно -->

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelleddy="exampleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="#exampleModalLable">Заполните форму</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> 
        <div class="modal-body">
          <div class="container-fluid">

            <form method="POST" action="check.php" name="form">

              <label for="name">ФИО:</label>
              <input class="form-control" id="name" type="name" name="name" aria-describdby="textHelp" required>

              <label for="tel">Телефон:</label>
              <input class="form-control" id="tel" type="tel" name="tel" aria-describdby="telHelp" required>

              <label for="email">E-mail:</label>
              <input class="form-control" id="email" type="email" name="email" aria-describdby="emailHelp" required>

              <button class="btn btn-primary" type="submit"> Отправить </button>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div> <!-- /.modal fade -->

</main><!-- /.container -->

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="assets/js/script.js"></script>
  <script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script></body>
</body>
</html>