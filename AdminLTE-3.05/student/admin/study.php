<?php include('includes/config.php')?>
<?php include('./header.php')?>
<?php include('./sidebar.php')?>

<?php 
if(isset($_POST['submit'])){
  // echo '<pre>';
  // print_r($_FILES);
  // echo '</pre>';
 $title=$_POST['title'];
  $description=$_POST['description'];
  $classes=$_POST['class'];
  $subject=$_POST['subject'];
 // $duration=$_POST['duration'];
  $file=$_FILES["attachment"]["name"];
  $date=date('Y-m-d');
  $target_dir = "uploads/";
 // $_SESSION['success_msg']='courses has been sucessfully added';
  $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
 
//$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$uploadOk = 1;


// and this strtolower tell wheather our file is jpg,jpeg
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}
// Check file size
if ($_FILES["attachment"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//   $uploadOk = 0;
// }



// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
   // mysqli_query($con,"INSERT INTO courses (`name`,`category`,`duration`,`image`,`date`) VALUES('$name', '$category', '$duration', '$image', '$date')");
  $query= mysqli_query($con,"INSERT INTO `posts` (`title`,`description`,`type`,`status`,`parent`,`author`) VALUES ('$title','$description','study-material','publish','0','1') ");
   if($query){
    $item_id=mysqli_insert_id($con);
   }

   $metadata =array(
    'class' =>$classes,
    'subject' =>$subject,
    'file_attachment' =>$file
   );
   foreach($metadata as $key => $value){
    mysqli_query($con,"INSERT INTO `metadata` (`item_id`,`meta_key`,`meta_value`) VALUES ('$item_id','$key','$value')");
   }
   $_SESSION['success_msg'] = 'Material has been uploaded successfully';
    //header('Location: study.php');
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

}
?>

<?php include('includes/functions.php')?>


<?php

$classes = get_posts([
    'type' =>'class',
    'status' =>'publish'

]);

$subject =get_posts([
    'type' =>'subject',
'status' =>'publish'
]);

// echo '<pre>';
// print_r($subject);
// echo '</pre>';
?>

<?php 
if(isset($_GET['action']) && $_GET['action'] == 'add-new') {
 
  
$classes = get_posts([
    'type' =>'class',
    'status' =>'publish'

]);

$subject =get_posts([
    'type' =>'subject',
'status' =>'publish'
]);
?>

<?php } else {?>


<div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    Study Material
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
                   <th>Title</th>
                <th>Attachment</th>
                <th>Class</th>
            
                <th>Subject</th>
               
                <th>Date</th>
</tr>
</thread>
  <tbody>
    <?php
    // $user=get_user_metadata($std_id,);
    // $class=$user['class'];
    $count=1;
    //this query is for the teacher panel for all the classes 
    //$study_query=mysqli_query($con,'SELECT * FROM `posts` WHERE `type`="study-material" AND `author` =1');

    // now we will write the query where it will only show the data fir that student classs only not other classes
    $study_query=mysqli_query($con,"SELECT * FROM `posts` as p INNER JOIN `metadata` as m ON p.id=m.item_id WHERE p.`type`='study-material' AND m.meta_key='class' AND m.meta_value ='1'");
    while($study=mysqli_fetch_object($study_query)){

    $class_id=get_metadata($study->id, 'class')[0]->meta_value;
    $class=get_post(['id'=> $class_id]);

    

        $file_attachment=get_metadata($study->item_id,'file_attachment')[0]->meta_value;
   
// echo '<pre>';
// print_r($study);
// echo '</pre>';

    // $subject_id=get_metadata($study->id,'subject')[0]->meta_value;
    // $subject=get_post(['id'=>$subject_id]);

 $subject_id=get_metadata($study->item_id,'subject')[0]->meta_value;
     $subject=get_post(['id'=>$subject_id]);

    ?>
      <tr>
      <td><?=$count++?></td>
<td><?= $study->title ?></td>
<td><a href="<?= "uploads/".$file_attachment ?>" >Download files</a></td>
<td><?= $class->title?></td>
<td><?=$subject->title?></td>
<td><?=$study->publish_date?></td>
      <!-- <td><img src="uploads/<?//=$course->image?>" height="70" alt=""></td>
  <td><?//=$course->name?></td>
  <td><?//=$course->category?></td>

  <td><?//=$course->date?></td> -->
  
  </tr>
  <?php } ?>
    </tbody>
</table>
</div>
</div>     
        </div> 
        <!-- /.row -->
    <?php } ?>

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Manage Study Material :-</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Study Material</li>
            </ol>
          </div><!-- /.col -->
       
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="card">
        <div class="card-header">
            <h2 class="card-title">
                Add New Study-material
</h2>
</div>
<div class="card-body">
    <!-- Info boxes -->
     <form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
    <h5>Title</h5>
    <input type="text" name="title" placeholder="Enter your title" class="form-control">
</div>

<div class="form-group">
    <h5>Description</h5>
    <textarea name="description" id="description" cols="10" rows="10" placeholder="description" class="form-control"></textarea>
</div>

      <div class="form-group">
        <h5>Select Class</h5>
        <select name="class" id="class" class="form-control">
            <option value="class"> select the class </option>

            <?php
            foreach ($classes as $key=>$class) {
                echo '<option value=""> '.$class->title.' </option>';

            }
            ?>
        </select>
      </div>
      <div class="form-group mt-4">
        <h5>Select Subject</h5>
       <select name="subject" id="subject" class="form-control">
        <option value="subject">Select Subject</option>
      <?php
       foreach ($subject as $key=>$subject) {
                echo '<option value=""> '.$subject->title.' </option>';

            }
      ?>
       </select>
    
      </div>

      <div class="form-group mt-4">
      <h5>Duration</h5>
  <input type="text" name="duration" id="duration" class="form-control" placeholder="course duration">
      </div>

<div class="form-group mt-4">
  <input type="file" name="attachment" id="attachment" >
      </div>
      <button name="submit" class="btn btn-success">
        Submit
   </button>
      </form>

</div>     
    </div> 
      

    </section>

      