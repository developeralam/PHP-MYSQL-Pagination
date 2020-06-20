<?php
  include_once 'Database.php';
  $db = new Database();
  $limits = isset($_POST['limit'])? $_POST['limit']: 10;
  $page = isset($_GET['page'])? $_GET['page'] :1 ;
  $start = ($page -1) * $limits;
  $result = $db->link->query("SELECT * FROM tbl_user LIMIT $start, $limits");
  $users = $result->fetch_all(MYSQLI_ASSOC);

  $result2 = $db->link->query("SELECT * FROM tbl_user");
  $totalRows = $result2->num_rows;
  $pages = ceil($totalRows/$limits);
  $previous = $page==1?1:$page-1;
  $next = $page+1;



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body class="bg-light">
    <div class="container card">
      <div class="limit w-75 m-auto">
        <form action="" method="post" id="form">
          <div class="form-group">
            <label for="limit" class="h2 font-weight-bold font-italic">Limit</label>

            <select name="limit" id="limit" class="form-control">
              <option value="">Select One</option>
              <?php foreach([5,10, 15,20,30] as $limit): ?>
                  <option value="<?= $limit;?>" <?php if(isset($_POST['limit']) && $_POST['limit'] == $limit){echo "selected";} ?> ><?= $limit;?></option>
              <?php endforeach; ?>

            </select>
          </div>
        </form>
      </div>

      <table class="table table-striped card-body w-75 m-auto">
        <thead class="bg-info">
          <tr>
            <td>No</td>
            <td>Name</td>
            <td>Email</td>
          </tr>
        </thead>
        <tbody>
          <?php 
            foreach ($users as $user):
          ?>
          <tr>
            <td><?= $user['id'];?></td>
            <td><?= $user['name'];?></td>
            <td><?= $user['email'];?></td>
          </tr>
          <?php
            endforeach;
          ?>
        </tbody>
      </table>
      
      <div class="pagination w-75 m-auto">
        <nav aria-label="Page navigation example">
          <ul class="pagination mt-4">
            <li class="page-item"><a class="page-link" href="?page=<?= $previous; ?>">Previous</a></li>
            <?php
              for($i=1; $i<= $pages; $i++):
            ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
            <?php
              endfor;
            ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $next; ?>">Next</a></li>
          </ul>
        </nav>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){
        $("#limit").change(function(){
            $("#form").submit();
        });
      });
    </script>
  </body>
</html>