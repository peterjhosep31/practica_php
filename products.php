<?php
include("templates/header.php");
include("admin/config/dataBase.php");

$query = $conection->prepare("SELECT * FROM boock");
$query->execute();
$dataBoocks = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($dataBoocks as $boock) { ?>
  <div class="col-md-3">
    <div class="card">
      <img class="card-img-top" src="<?php echo "images/" . $boock['image_boock'] ?>" height="350">
      <div class="card-body">
        <h4 class="card-title"><?php echo $boock['title_boock'] ?></h4>
        <a name="" id="" class="btn btn-primary bder-rd-" href="#" role="button">Ver mas</a>
      </div>
    </div>
  </div>
<?php } ?>

<?php include("templates/footer.php"); ?>