<link rel="stylesheet" href="<?= $host_name ?>/public/css/insertDocument.css">

<div>
  <form action="https://whispering-wave-23569.herokuapp.com/insert-document" method="POST" id="form" target='_blank'>
    Title : <input type="text" name="title"><br>
    Category : <input type="text" name="categories"><br>
    Content : <h4>Please input valid link</h4><input type="text" name="content"><br>
    Manager ID : <input type="text" name="managerid" value=1 readonly><br>
    <input type="submit" value="submit">
  </form>
</div>
