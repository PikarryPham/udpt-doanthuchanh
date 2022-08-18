<link rel="stylesheet" href="<?= $host_name ?>/public/css/insertDocument.css">

<div>
  <form action="http://127.0.0.1:5000/insert-document" method="POST" id="form" target='_blank'>
    Title : <input type="text" name="title"><br>
    Category : <input type="text" name="categories"><br>
    Content : <input type="text" name="content"><br>
    Manager ID : <input type="text" name="managerid" value=1 readonly><br>
    <input type="submit" value="submit">
  </form>
</div>


<!-- <!-- <?php 
  if (isset($_POST['title'])) {
    header("Location: http://localhost/quan-ly-nhan-vien/uc016/document");
  }
?> -->
<script type="text/javascript">
    document.getElementById("form").addEventListener("submit",(e) => {
        //e.preventDefault()
        window.location = "http://localhost/quan-ly-nhan-vien/uc016/document";
});
</script> -->
