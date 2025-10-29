<?php include('./includes/config.php')?>
<?php include('header.php')?>
<?php include('sidebar.php')?>
<?php include('./includes/functions.php')?>



<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 d-flex">
            <h1 class="m-0 text-dark"> Time Table :-</h1>
        
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Student</a></li>
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

 $query=mysqli_query($con ,"SELECT * FROM posts as p INNER JOIN metadata as mc ON (mc.item_id = p.id) INNER JOIN metadata as md ON(md.item_id=p.id) INNER JOIN metadata as mp ON (mp.item_id = p.id) WHERE p.type='timetable' AND p.status='publish' AND md.meta_key='day_name' AND md.meta_value='$day' AND mp.meta_key='period_id' AND mp.meta_value=$period->id AND mc.meta_key='class' AND mc.meta_value=1");
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


    </section>
<?php include('footer.php')?>
