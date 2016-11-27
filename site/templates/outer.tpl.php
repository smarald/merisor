<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php echo  $title ?></title>



<?php foreach ($cssFiles as $css)  { ?>
<link href="<?php echo  $css ?>" rel="stylesheet" type="text/css">
<?php }  ?>


</head>

<body>
<?php echo  $body ?>
</body>

</html>
