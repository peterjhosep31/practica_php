<?php
include('../templates/header.php');
include('../config/dataBase.php');

$btnForm = "";

if ($_POST) {
  $txtIdBoock = (isset($_POST['txtId'])) ? $_POST['txtId'] : "";
  $txtTitleBoock = (isset($_POST['txtTitle'])) ? $_POST['txtTitle'] : "";
  $txtAuthorBoock = (isset($_POST['txtAutor'])) ? $_POST['txtAutor'] : "";
  $image = (isset($_FILES['img']['name'])) ? $_FILES['img']['name'] :  "";
  $btnForm = (isset($_POST['btnForm'])) ? $_POST['btnForm'] : "";
};

if (isset($btnForm)) {
  switch ($btnForm) {
    case 'insertBoock':
      if ($txtIdBoock == null) {
        $txtIdBoock = null;
      }
      $insertSentencesBoock = $conection->prepare("INSERT INTO boock VALUES (:codeBoock, :nameBoock, :authorBoock, :imageBoock)");
      $insertSentencesBoock->bindParam(":codeBoock", $txtIdBoock);
      $insertSentencesBoock->bindParam(":nameBoock", $txtTitleBoock);
      $insertSentencesBoock->bindParam(":authorBoock", $txtAuthorBoock);

      $date = new DateTime();
      $nameImage = ($image != "") ? $date->getTimestamp() . "_" . $_FILES['img']['name'] : "default.pgn";
      $imageTemporary = $_FILES['img']['tmp_name'];

      if (isset($imageTemporary)) {
        move_uploaded_file($imageTemporary, "../../images/" . $nameImage);
      }

      $insertSentencesBoock->bindParam(":imageBoock", $nameImage);
      $insertSentencesBoock->execute();

      header('Location:product.php');
      break;
    case 'updateBoock':
      $updateSentenceBoock = $conection->prepare("UPDATE boock SET title_boock= :titleBoock, author_boock= :authorBoock WHERE id_boock = :idBoock");
      $updateSentenceBoock->bindParam(':titleBoock', $txtTitleBoock);
      $updateSentenceBoock->bindParam(':authorBoock', $txtAuthorBoock);
      $updateSentenceBoock->bindParam(':idBoock', $txtIdBoock);
      $updateSentenceBoock->execute();

      if ($image != "") {
        $selectImageBoock = $conection->prepare("SELECT image_boock FROM boock WHERE id_boock= :idBoock");
        $selectImageBoock->bindParam(':idBoock', $txtIdBoock);
        $selectImageBoock->execute();
        $boockImage = $selectImageBoock->fetch(PDO::FETCH_LAZY);

        if (isset($boockImage['image_boock']) && $boockImage['image_boock'] != 'default.pgn') {
          if (file_exists('../../images/' . $boockImage['image_boock'])) {
            unlink('../../images/' . $boockImage['image_boock']);
          }
        }

        $date = new DateTime();
        $nameImage = ($image != "") ? $date->getTimestamp() . "_" . $_FILES['img']['name'] : "default.pgn";
        $imageTemporary = $_FILES['img']['tmp_name'];
        move_uploaded_file($imageTemporary, '../../images/' . $nameImage);


        $updateSentenceBoock = $conection->prepare("UPDATE boock SET image_boock= :imageBoock WHERE id_boock = :idBoock");
        $updateSentenceBoock->bindParam(':imageBoock', $nameImage);
        $updateSentenceBoock->bindParam(':idBoock', $txtIdBoock);
        $updateSentenceBoock->execute();
      }

      header('Location:product.php');
      break;
    case 'cancel':
      header('Location:product.php');
      break;

    case 'select':
      if ($txtIdBoock != "<br /><b>Warning</b>:  Undefined variable $txtIdBoock in <b>C:\xampp\htdocs\practicas\admin\section\product.php</b> on line <b>78</b><br />") {
        $selectSentenceBoock = $conection->prepare("SELECT * FROM boock WHERE id_boock = :idBoock");
        $selectSentenceBoock->bindParam(":idBoock", $txtIdBoock);
        $selectSentenceBoock->execute();
        $boock = $selectSentenceBoock->fetch(PDO::FETCH_LAZY);
        $txtIdBoock = $boock['id_boock'];
        $txtTitleBoock = $boock['title_boock'];
        $txtAuthorBoock = $boock['author_boock'];
        $image = $boock['image_boock'];
      }
      break;

    case 'delete':
      $selectImageBoock = $conection->prepare("SELECT image_boock FROM boock WHERE id_boock= :idBoock");
      $selectImageBoock->bindParam(':idBoock', $txtIdBoock);
      $selectImageBoock->execute();
      $boockImage = $selectImageBoock->fetch(PDO::FETCH_LAZY);

      if (isset($boockImage['image_boock']) && $boockImage['image_boock'] != 'default.pgn') {
        if (file_exists('../../images/' . $boockImage['image_boock'])) {
          unlink('../../images/' . $boockImage['image_boock']);
          $deleteSentenceBoock = $conection->prepare("DELETE FROM boock WHERE id_boock = :idBoock");
          $deleteSentenceBoock->bindParam(":idBoock", $txtIdBoock);
          $deleteSentenceBoock->execute();
        }
      }

      header('Location:product.php');
      break;

    case "":
      break;

    default:
      print "De donde saco ese boton";
      break;
  };
}


$selectSentencesBoocks = $conection->prepare("SELECT * FROM boock");
$selectSentencesBoocks->execute();
$boocksDataBase = $selectSentencesBoocks->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="col-md-5">

  <div class="card">
    <div class="card-header">
      Datos de libro
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data">

        <div class="form-group">
          <label for="txtId">Id libro:</label>
          <input type="text" class="form-control" name="txtId" <?php if ($btnForm != 'delete') { ?> <?php if (isset($txtIdBoock)) { ?> readonly value="<?php echo $txtIdBoock; ?>" <?php } else { ?> value="" <?php } ?> <?php } ?> id=" txtId" aria-describedby="emailHelp" required placeholder="ID">
        </div>

        <div class="form-group">
          <label for="txtTitle">Titulo:</label>
          <input type="text" class="form-control" name="txtTitle" <?php if (isset($txtTitleBoock)) { ?> value="<?php echo $txtTitleBoock; ?>" <?php } else { ?> value="" <?php } ?> id="txtTitle" aria-describedby="emailHelp" required placeholder="Titulo">
        </div>

        <div class="form-group">
          <label for="txtAutor">Autor:</label>
          <input type="text" class="form-control" name="txtAutor" <?php if (isset($txtAuthorBoock)) { ?> value="<?php echo $txtAuthorBoock; ?>" <?php } else { ?> value="" <?php } ?> id="txtAutor" aria-describedby="emailHelp" required placeholder="Autor">
        </div>

        <div class="form-group">
          <label for="img">Imgen: </label>
          <?php if (isset($image)) { ?>
            <br />
            <img class="img-thumbnail rounded" src="../../images/<?php echo $image ?>" width="50">
          <?php } else {
            print("");
          } ?>
          <input type="file" class="form-control" name="img" id="img" aria-describedby="emailHelp" placeholder="Editorial">
        </div>

        <div class="btn-group" role="group" aria-label="">
          <button type="submit" name="btnForm" value="insertBoock" <?php if (isset($btnForm)) {
                                                                      if ($btnForm == "select") {
                                                                        echo "disabled";
                                                                      }
                                                                    } ?> class="btn btn-success">Agregar</button>
          <button type="submit" name="btnForm" value="updateBoock" <?php if (isset($btnForm)) {
                                                                      if ($btnForm != "select") {
                                                                        echo "disabled";
                                                                      }
                                                                    } ?> class="btn btn-warning">Modificar</button>
          <button type="submit" name="btnForm" value="cancel" class="btn btn-info">Cancelar</button>
        </div>

      </form>
    </div>
  </div>


</div>

<div class="col-md-7">

  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Autor</th>
        <th>Imagen</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($boocksDataBase as $boock) { ?>
        <tr>
          <td><?php print($boock['id_boock']) ?></td>
          <td><?php print($boock['title_boock']) ?></td>
          <td><?php print($boock['author_boock']) ?></td>
          <td>
            <img class="img-thumbnail rounded" src="<?php print('../../images/' . $boock['image_boock']) ?>" width="50">

          </td>
          <td class="row">
            <form method="post">
              <input type="hidden" name="txtId" id="txtId" value="<?php echo $boock['id_boock'] ?>" />
              <button type="submit" name="btnForm" value="select" class="btn btn-primary">Seleccionar</button>
              <button type="submit" name="btnForm" value="delete" class="btn btn-danger">Borrar</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

</div>

<?php
include('../templates/footer.php');
?>