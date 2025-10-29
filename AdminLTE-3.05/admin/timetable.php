<?php include('../includes/config.php')?>

<?php

if(isset($_POST['submit'])){
  $class_id=isset($_POST['class'])?$_POST['class']:'';
  $section_id=isset($_POST['section'])?$_POST['section']:'';
  $teacher_id=isset($_POST['teacher_id'])?$_POST['teacher_id']:'';
  $period_id=isset($_POST['period_id'])?$_POST['period_id']:'';
  $day_name=isset($_POST['day_name'])?$_POST['day_name']:'';
  $subject_id=isset($_POST['subject_id'])?$_POST['subject_id']:'';
  $date_add=('Y-m-d g:i:s');
  $status='publish';
  $author=1;
  $type='timetable';
  $query=mysqli_query($con,"INSERT INTO posts (`type`,`author`,`status`,`publish_date`) VALUES('$type','$author','$status','$date_add')");
  if($query){
    $item_id=mysqli_insert_id($con);
  }
  $metadata = array(
    'class'=>$class_id,
    'section'=>$section_id,
    'teacher_id'=>$teacher_id,
    'period_id'=>$period_id,
    'day_name'=>$day_name,
    'subject_id'=>$subject_id,
  );
  foreach($metadata as $key => $value){
    mysqli_query($con,"INSERT INTO metadata (`item_id`,`meta_key`,`meta_value`) VALUES ('$item_id','$key','$value')");
  }
  header('Location:timetable.php');
}

?>
<?php include('header.php')?>
<?php include('sidebar.php')?>
<?php include('../includes/functions.php')?>



<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex">
            <h1 class="m-0 text-dark"> Manage Time Table :-</h1>
            <a href="?action=add" class="btn btn-success mx-3 btn-sm">Add table</a>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Time table</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">

      <?php if(isset($_GET['action'])&& $_GET['action']=='add'){?>
<div class="card">
  <div class="card-body">
<form action="" method="post">
 <div class="row">
            <div class="col-lg">
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
          <div class="col-lg">
                 <div class="form-group" id="section-container" >
    <label for="section">Select Section:-</label>
    <select require name="section" id="section" class="form-control">
        <option value="">Select section</option>
    </select>
    </div>
            </div> 

                 <div class="col-lg">
                 <div class="form-group" id="section-container">
    <label for="teacher_id">Select Teacher:-</label>
    <select require name="teacher_id" id="teacher_id" class="form-control">
        <option value="">Select teacher</option>
        <option value="1">Teacher 1</option>
        <option value="2">Teacher 2</option>
    </select>
    </div>
            </div> 

                 <div class="col-lg">
                 <div class="form-group" id="section-container">
    <label for="period_id">Select period:-</label>
    <select require name="period_id" id="period_id" class="form-control">
        <option value="">Select period</option>
                  <?php
      $args = array(
        'type' => 'period',
        'status' =>'publish',
      );
 
        $periods=get_posts($args); 
        foreach($periods as $key => $period) { ?>
<option value="<?php echo $period->id ?>"><?php echo $period->title ?></option>
<?php } ?>
    </select>
    </div>
            </div> 
                 <div class="col-lg">
                 <div class="form-group" id="section-container">
    <label for="day_name">Select Day:-</label>
    <select require name="day_name" id="day_name" class="form-control">
        <option value="">Select section</option>
        <?php
       
        $days =['monday','tuesday','wednesday','thrusday','friday','saturday'];
  
foreach($days as $key => $day) { ?>
<option value="<?php echo $day?>"><?php echo $day ?></option>
<?php } ?>

     
    </select>
    </div>
        </div> 

     
                 <div class="col-lg">
                 <div class="form-group" id="section-container">
    <label for="subject_id">Select Subject:-</label>
    <select require name="subject_id" id="subject_id" class="form-control">
        <option value="">Select subject</option>
        <option value="9">English</option>
        <option value="10">Science</option>
    </select>
    </div>
            </div> 
           
            <div class="col-lg">
              <div class="form-group">
                <label for="">&nbsp;</label>
                 <!-- &nbsp is used to prevent the line break between the two element  -->
              <input type="submit" name="submit" value="submit" class="btn btn-primary form-control">
</div>
</div>
        </div>
      </form>
  </div>
</div>

      
      <?php } else { ?>
        <div class="card">
            <div class="card-body">
       <form action="">
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
          <div class="col-lg-6">
                 <div class="form-group" id="section-container">
    <label for="section">Select Section:-</label>
    <select require name="section" id="section" class="form-control">
        <option value="">Select section</option>
           <?php
                            $args = array(
                            'type' => 'section',
                            'status' => 'publish',
                            );
                              $sections = get_posts($args);
                            foreach ($sections as $section) {
                                $selected = ($section_id ==  $section->id)? 'selected': '';
                            echo '<option value="' . $section->id . '" '.$selected.'>' . $section->title . '</option>';
                            } ?>

    </select>
    </div>
            </div> 
           
        </div>
</form>
   </div>
</div>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
          
                <thread>
                    <tr>
                        <th>Timming</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thrusday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
</tr>

</thread>
<tbody>
    <?php
    $args =array(
        'type' =>'period',
        'status' =>'publish',

    );
    $periods = get_posts($args);
    foreach($periods as $period) {
 //print_r(get_metadata($period->id,'from')[0]->meta_value);
 $from=get_metadata($period->id,'from')[0]->meta_value;
 $to=get_metadata($period->id,'to')[0]->meta_value;
?>
    <tr>
        <td><?php echo date('h:i A',strtotime($from)) ?> - <?php echo date('h:I A',strtotime($to)) ?></td>
        <?php
        $days =['monday','tuesday','wednesday','thrusday','friday','saturday'];
    foreach($days as $day) {

 $query=mysqli_query($con ,"SELECT * FROM posts as p INNER JOIN metadata as md ON (md.item_id = p.id) INNER JOIN metadata as mp ON (mp.item_id = p.id) WHERE p.type='timetable' AND p.status='publish' AND md.meta_key='day_name' AND md.meta_value='$day' AND mp.meta_key='period_id' AND mp.meta_value=$period->id");
 if(mysqli_num_rows($query)>0){
 while($timetable=mysqli_fetch_object($query)){
 ?>       
 <td>

            <p>
                <b>Teacher: </b>

                <?php 
                $teacher_id=get_metadata($timetable->item_id,'teacher_id',)[0]->meta_value;
                echo get_user_data($teacher_id)[0]->Name;
                ?>
                <br>
                   <b>Class: </b> 
                   <?php
                   $class_id=get_metadata($timetable->item_id,'class',)[0]->meta_value;
                echo get_post(array('id'=>$class_id))->title;
                ?>
                    <br>
                      <b>Seaction:
                           <?php
                   $section_id=get_metadata($timetable->item_id,'section',)[0]->meta_value;
                echo get_post(array('id'=>$section_id))->title;
                ?>
                 </b> 
                       <br>
                         <b>Subject: </b> 
                            <?php
                   $subject_id=get_metadata($timetable->item_id,'subject_id',)[0]->meta_value;
                echo get_post(array('id'=>$subject_id))->title;
                ?>
                 <br>
</p>
        </td>

<?php } 
 } else { ?>
 <td>unsheduled</td>
    
    <?php } 
    }?>

</tr>
<?php } ?>
</tbody>
 
</table>
    </div>
</div>

<?php } ?>

    </section>
<?php include('footer.php')?>
