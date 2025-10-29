<?php include('header.php')?>
<?php include('sidebar.php')?>

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">  Manage Attendance:-</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
      
       
<div class="card">
  <div class="card-header">
    <div class="row">
   <div class="col-lg-6">
                <div class="form-group">
 <label for="class">Select Class:-</label>
    <select require name="class" id="class" class="form-control">
        <option value="">select class</option>

             <?php
      $args = array(
        'type' => 'class',
        'status' =>'publish',
      );
 
        $classes=get_posts($args); 
        foreach($classes as $key => $class) { ?>
<option value="<?php echo $class->id ?>"><?php echo $class->title ?></option>
<?php } ?>
    </select>
     

        </div>
            </div> 
  </div>
</div>
<div class="card-body">
 
        </div>
        <div class="card-header">
          
        </div>
 <div class="card-body">
  <table class="table table-bordered">
    <thead>
      
        <tr>
          
          <th>Date</th>
        <th>Status</th>
        <th>Signed in Time</th>
        <th>Signed Out Time</th>
</tr>

      
    </thead>
    <tbody>
      
</tbody>
  </table>
</div>
        </div>
  
       
   </div>    
    </section>











<?php include('footer.php')?>