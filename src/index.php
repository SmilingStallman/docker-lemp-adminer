<?php
  require_once('db.php');
  require_once('TableBuilder.php');

  $result = $conn->query('SELECT * FROM classics');
  !$result && die("Query failed.");

  $fetch_head = array_keys($result->fetch_assoc());
  $fetch_rows = $result->fetch_all();
 ?>

<!DOCTYPE html>

<html lang="en-US">

<head>
  <meta charset="utf-8">
  <meta name="author" content="KMiskell">
  <meta name="description" content="Docker-Compose LEMP + Adminer Demo">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./assets/images/docker-icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="./css/header.css">
  <link rel="stylesheet" href="./css/datatable-demo.css">
  <title>LEMP + Adminer Demo</title>
</head>

<body>

  <header class="header-v2">
    <h1>LEMP + Adminer Docker Demo</h1>
  </header>

  <main>

    <section id="demo-table">
      <h2>Oh look, some books</h2>
      <div class="table-container">
        <table id="practice_table" class="display">
            <thead style="font-weight: bold;">
                <?php add_head_row($fetch_head); ?>
            </thead>
            <tbody>
                <?php get_row_group($fetch_rows); ?>
            </tbody>
        </table>
      </div>
    </section>

    <br /><hr />

    <section id="demo-video">
      <h2>2020</h2>
      <video controls>
        <source src="assets/videos/clowntown.wemb" type="video/webm" />
        <source src="assets/videos/clowntown.mp4" type="video/mp4" />
      </video>
    </section>

  </main>

</body>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/hide-option.js"></script>    <!---requires jQuery-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

</html>


<script>
$(document).ready( function () {
  $('#practice_table').DataTable();
} );
</script>

<?php
  $conn->close;
  $result->close;
?>
