<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
  Image Preview
  </title>
  <style>
  .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  margin-top: 20px;
  margin-bottom: auto;
  width: 50%;
}
</style>
</head>

<body style="background-color:black ">
<div class="row no-print">
      <div class="col-xs-12">
        <button class="btn btn-default" onclick="window.print();" style=" font-size: 16px;margin-left: 45px;"><i class="fa fa-print bg-xs"></i> Print</button>
      </div>
    </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
      <!-- style="width: 30%; margin-left:25%" -->
        <section class="content invoice">
        
<?php if($page=='civilid'){ ?>
        <img class="center" src="<?php echo  url('uploads/chalet_uploads/civilid/') . '/' . $filename;?>" alt="files" >
      <?php } elseif($page=='chalet_ownership'){ ?>
       <img class="center" src="<?php echo  url('uploads/chalet_uploads/ownership/') . '/' . $filename;?>" alt="files" >
      <?php }else{ ?>
      <img class="center" src="<?php echo  url('uploads/chalet_uploads/agreement/') . '/' . $filename;?>" alt="files" >
      <?php } ?>
        </section>
      </div>
    </div>
  
  </div>
</body>

</html>