<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/controllers/Main.php';
?>
<style>
.progress-bar-vertical {
  width: 100px;
  min-height: 95%;
  text-align: center;
  margin-top: 10%;
  float: left;
  display: -webkit-box;  /* OLD - iOS 6-, Safari 3.1-6, BB7 */
  display: -ms-flexbox;  /* TWEENER - IE 10 */
  display: -webkit-flex; /* NEW - Safari 6.1+. iOS 7.1+, BB10 */
  display: flex;         /* NEW, Spec - Firefox, Chrome, Opera */
  align-items: flex-end;
  -webkit-align-items: flex-end; /* Safari 7.0+ */
}

.progress-bar-vertical .progress-bar {
  width: 100%;
  height: 0;
  -webkit-transition: height 0.6s ease;
  -o-transition: height 0.6s ease;
  transition: height 0.6s ease;
}
</style>
<!-- First Panel -->
<?php
    generateFirstPanel();
?>
<!-- Secound Panel -->
<?php
    generateSecoundPanel();
  ?>
<!-- Third Panel -->
<div class="col-md-auto m-1 rounded shadow-lg text-center d-none d-lg-block">
    <div class="progress progress-bar-vertical">
        <?php
            generateProgressBar();
        ?>
    </div>
    <section class="float-bottom">Szafki</section>
</div> 

