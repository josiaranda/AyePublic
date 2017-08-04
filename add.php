<?php 

	include_once 'lib/fonoApi/fonoApi.php';
	include_once 'lib/phoneClass.php';
	require_once 'AHP.php';
$hierarki1=new Kriteria(json_decode(file_get_contents('lib/kriteria/kriteria.json'),true));
	$token='d0275c61dc28964d454ba894f521d8815d5d612c779195c0';
	
	$fonoApi=fonoApi::debug($token);
	try {
		if (!empty($_GET['name'])) {
			$result=$fonoApi::getDevice($_GET['name'],0);
			$device=new phoneClass($result[0]);
			
			
		}
		
	} catch (Exception $e) {
		print_r($e);
	}

	foreach ($hierarki1->child as $key => $value) {
      		foreach ($value['name'] as $key1 => $value1) {
      			$choice[$key][]=$value1;
      		}
      	}
      	array_pop($choice);
require_once 'header.php';
 ?>
 <body>

   

   <div id="wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="adjust-nav">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>


        </div>

        <span class="logout-spn" >
          <a href="#" style="color:#fff;">LOGOUT</a>  

        </span>
      </div>
    </div>
    <!-- /. NAV TOP  -->
    <?php require_once 'sidebar.php'; ?>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
      <div id="page-inner">
      <div class="row">
          <div class="col-lg-4">
      <div class="panel panel-primary">
      <div class="panel-heading"><?php echo "$device->Brand | $device->DeviceName"; ?></div>
      <div class="panel-body">

      <?php 
      	$specs=$device->specs;
      	foreach ($specs as $name => $value) {
      		echo "<h3>$name</h3>";
      		echo "<table class='table table-striped'>";
      		foreach ($value as $valname => $val) {
      			echo "<tr>";
      			echo "<td style='width:100px'>$valname</td>";
      			echo "<td>$val</td>";
      			echo "</tr>";
      		}
      		echo "</table>";
      	}

       ?>

      
      </div>
    </div>
        </div>
<div class="col-lg-8">
<form action="insert.php" method="post">
<input type="hidden" name="Brand" value=<?php echo "'$device->Brand'"; ?>>
<input type="hidden" name="Name" value=<?php echo "'$device->DeviceName'"; ?>>
<?php foreach ($choice as $key => $value) {
	
 ?>
	<div class="form-group">
		<label><?php echo "$key :"; ?></label>
		<select name=<?php echo "'rule"."[$key]'"; ?> class="form-control">
		<?php foreach ($value as $key1 => $value1) {
			# code...
		 ?>
			<option value=<?php echo "'$value1'"; ?>><?php echo "$value1"; ?></option>
			<?php  }?>
		</select>
	</div>


<?php 
	
	}
 ?>
 <button type="Submit" class="btn btn-success">Submit</button>
 </form>
</div>
        </div>
    </div>
    <!-- /. PAGE INNER  -->
  </div>
  <!-- /. PAGE WRAPPER  -->
</div>
<div class="footer">


  <div class="row">
    <div class="col-lg-12" >
      &copy;  2014 yourdomain.com | Design by: <a href="http://binarytheme.com" style="color:#fff;" target="_blank">www.binarytheme.com</a>
    </div>
  </div>
</div>


<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="assets/js/custom.js"></script>
<!-- js SCRIPTS -->
<script src="assets/js/js.js"></script>


</body>
</html>