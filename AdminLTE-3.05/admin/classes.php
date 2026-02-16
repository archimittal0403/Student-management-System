<?php include('includes/config.php')?>
<?php include('header.php')?>
<?php include('sidebar.php')?>
<?php include('includes/functions.php')?>

<?php 

if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $sections=$_POST['section'];
   // $sections=implode(',',$_POST['section']);
   // $added_date=date('Y-m-d');

    $query=$con->prepare(
      "INSERT INTO `posts`(`author`, `title`, `description`, `type`, `status`,`parent`) VALUES ('1',?,'description','class','publish',0)");
$query->bind_param("s",$title);
$query->execute();

if( $query){
  $post_id=mysqli_insert_id($con);
}


      $stmt=$con->prepare("INSERT INTO metadata (`item_id`, `meta_key`, `meta_value`) VALUES(?,'section',?)");
    foreach($sections as $key => $value){
      $stmt->bind_param("is",$post_id,$value);
      $stmt->execute();
    }
  }
?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Manage Classes :-</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">classes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">


      <?php
      if(isset($_REQUEST['action'])){ ?>

        <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                Add New Classes
</h2>
</div>
<div class="card-body">
    <!-- Info boxes -->
     <form action="" method="POST">
      <div class="form-group">
        <label for="title">Class</label>
        <input type="text" name="title" class="px-4 py-1" placeholder="Title" required-class="form-control">
    
      </div>

      <div class="form-group py-3">
      <h5>Section :-</h5>
       
        <?php
              $args = array(
                'type' => 'section',
                'status' => 'publish',
              );
              $sections = get_posts($args);
              foreach($sections as $key => $section){ ?>
                <div>
                  <label for="<?php echo $key ?>">
                    <input type="checkbox" name="section[]" id="<?php echo $key ?>" value="<?= $section->id ?>" placeholder="section">
                    <?php echo $section->title ?>
                  </label>
                </div>
              <?php
              } ?>
            </div>
      <button name="submit" class="btn btn-success">
        Submit
   </button>
      </form>

</div>     
    </div> 
      

  
<?php }else { ?>
    
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    Classes
</h2>
<div class="card-tools">
 <a href="?action=add-new" class="btn btn-success btn-sm"><i class="fa fa-plus mr-2"></i>Add New</a>
</div>
</div>
<div class="card-body">
        <!-- Info boxes -->
        
        <div class="table-responsive">
          <table class="table table-bordered">
            <thread>
              <tr>
                <th>S.No</th>
                <th>Name</th>
            
                <th>Section</th>
                <th>Date</th>
                <th>Action</th>
</tr>
</thread>
  <tbody>
    <?php
    $count=1;

          $args = array(
        'type' => 'class',
        'status' =>'publish',
      );
      $classes = get_posts($args);
      foreach($classes as $class){?>
    
      <tr>
      <td><?=$count++?></td>
      <td><?=$class->title?></td>
     
      
   <td>
    <pre>
  <?php
  $class_meta = get_metadata($class->id,'section');

  foreach($class_meta as $meta){
    $section=get_post(array('id' =>$meta->meta_value));

 echo $section->title;
  }
    ?>
    
    </pre>
  </td>
   
    <td><?=$class->publish_date?></td>
   <td>
       
          <a href="classes.php?edit_class=<?php echo $class->id ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil-alt"></i></a> 
          <a href="classes.php?delete_class=<?php echo $class->id?>" class="btn btn-sm btn-success"><i class="fa fa-trash"></i></a> 
         </td>
  </tr>
  <?php } ?>

     </tbody>
</table>
</div>
</div>     
        </div> 
<?php } ?>
        <!-- /.row -->

     <div class="container my-4">
    <?php
    if(isset($_GET['edit_class'])){
        include('edit_class.php');
    }
?>

   
      </div>
      </div><!--/. container-fluid -->
    </section>
<?php include('footer.php')?>

  
