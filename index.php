
<html>
<head>
<link rel="stylesheet" href="css/zan.css" />
</head>

<?php
include_once("includes/c.php");
$id = 1;  //这里设置要传入的文章id号
$st = $db->prepare('select * from pic where id = :vid ');
$st->bindParam(':vid',$id);
$st->execute();
$row = $st->fetch();

//echo  "123".$row['pic_name'];
?>
<div class="ding-cai">
        <span  id="zan" >
        <a id="ding" class="ding"  name="<?php  echo $id; ?>" title ="ding" ><?php echo  $row['ding'];   ?></a>
        <a id="cai"  class="cai"   name="<?php  echo $id; ?>" title ="cai"  href="#"><?php echo  $row['cai'];   ?></a>
        </span>
</div>

<script src="js/ding.js" type="text/javascript"></script>
</html>