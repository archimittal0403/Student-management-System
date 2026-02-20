<?php
 include('includes/config.php');
 include('includes/functions.php');
?> 
<?php include('header.php')?>
<?php include('sidebar.php')?>

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class= "d-flex">
            <h1 class="m-0 text-dark"> Update Attendance :-</h1>
           
<a href="attendance.php" class="btn btn-primary btn-sm mx-4">Go Back</a>
</div>
          </div> 
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accounts</a></li>
              <li class="breadcrumb-item active">Attendance</li>

            </ol>
          </div><!-- /.col -->
           </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<?php 
if(!isset($_GET['action'])){ ?>
    <div class="card">
      <div class="card-body">
        <form action="viewAttendance.php" method="get">
          <?php
          $class_id=$_GET['fil_class'] ?? '';
          $section_id=$_GET['fil_section'] ?? '';
          $subject_id=$_GET['fil_subject'] ?? '';
          $teacher_id=$_GET['fil_teacher'] ?? '';
          $date=$_GET['fil_dob'] ?? '';
          ?>
         <!-- <input type="hidden" name="action" value="add-new"> -->
          
          <div class="row">
            <div class="col-lg-3">
              <label for="fil_class">Select the class</label>
              <select name="fil_class" id="fil_class" class="form-control">
               <?php
$args=array(
  'type'=>'class',
  'status'=>'publish'
);
$att_classes=get_posts($args);
foreach($att_classes as $key=>$att_class){
  $selected=($att_class==$class_id)? 'selected':'';
  echo '<option value="'.$att_class->id.'" '.$selected.'>'.$att_class->title.'</option>';
}
               ?>
              </select>
            </div>
          <div class="col-lg-3">
            <label for="fil_section">Select Section</label>
            <select name="fil_section" id="fil_section" class="form-control">
              <?php

              $args=array(
                'type'=>'section',
                'status'=>'publish'
              );
              $att_sections=get_posts($args);
              foreach($att_sections as $key=>$att_section){
                $selected=($att_section==$section_id)?'selected':'';
                echo '<option value="'.$att_section->id.'"'.$selected.'>'.$att_section->title.'</option>';

              }
              ?>
            </select>
          </div>          
          <div class="col-lg-3">
            <label for="fil_subject">Select Subject</label>
            <select name="fil_subject" id="fil_subject" class="form-control">
<?php
$select_query="SELECT * FROM `courses`";
$subject=$con->prepare($select_query);
$subject->execute();
$result=$subject->get_result();
while($row_fetch=$result->fetch_assoc()){

  echo '<option value="'.$row_fetch['id'].'">'.$row_fetch['name'].'</option>';
  }?>
            </select>
          </div>
        
         <div class="col-lg-2">
          <label for="fil_dob">Select the date</label>
      <input type="date" class="form-control" id="fil_date" placeholder="date" name="fil_dob"/>
         </div>
         <div class="col-lg-1">
<div class="d-flex justify-content-end">
<button type="button" id="applyFilter" class="btn btn-info">Apply</button>

          </div>
         </div>
</div>
</form>

<!-- <div class="table-responsive my-3">
  <div class="form-group">
  <button type="submit" class="btn btn-sm btn-success" name="update" value="<?=$row['enroll_id']?>">Update</button>
</div> -->
    <table class="table table-bordered w-100" id="update_attendance">
        <thead>
        <tr>
  <th>Sno</th>
  <th>Enroll_ID</th>
  <th>Student_Name</th>
  <th>Status</th>
</tr>
        </thead>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<?php } ?>
<?php 
include('footer.php')?>
<script>
    $('#applyFilter').on('click',function(){
         var view_table=$('#update_attendance').DataTable({
            destroy:true,
            processing:true,
             dom:'<"row"<"col-md-6"l"><"col-md-6 text-right"B>>frtip',
             buttons:[
                {
                    extend:'excelHtml5',
                    text:'excel',
                    className:'btn btn-sm btn-success',
                    exportOptions:{
                        columns:':not(:last-child)'
                    }
                },
                {
                    extend:'print',
                    text:'print',
                    className:'btn btn-sm btn-primary',
                    exportOptions:{
                        columns:':not(:last-child)'
                    }
                },
                {
                    extend:'pdfHtml5',
                    text:'pdf',
                    ClassName:'btn btn-sm btn-danger',
                    exportOptions:{
                        columns:':not(:last-child)'
                    }
                }
             ],
             ajax:{
             'url':'ajax.php',
             'type':'POST',
             data:function(d){
                d.action='update_attend',
                d.fill_class=$('#fil_class').val(),
                d.fill_section=$('#fil_section').val(),
                d.fill_subject=$('#fil_subject').val(),
            d.fil_dob= $('input[name="fil_dob"]').val()
             }
},
             columns:[
                {'data':'Sno'},
                {'data':'Enroll_ID'},
      {'data':'Student_Name'},
      {'data':'Status'}
             ]
        })
    });
</script>
<script>
  $(document).on('click','.toggle-att',function(){
  let btn = $(this);
  let status = btn.attr('data-status');

  if(status === 'A'){
    btn.removeClass('btn-danger')
       .addClass('btn-success')
       .text('present')
       .attr('data-status','P');

    btn.next('input').val('P');
  } else {
    btn.removeClass('btn-success')
       .addClass('btn-danger')
       .text('Absent')
       .attr('data-status','A');

    btn.next('input').val('A');
  }
});

  </script>
  <script>
$(document).on('click','.upd-att',function(){
console.log('update button clicked');
  let enroll_id = $(this).data('id');
let status = $(this)
  .closest('td')
  .find('.toggle-att')
  .attr('data-status');

console.log('Enroll:', enroll_id, 'Status:', status);


  $.ajax({
    url: 'ajax.php',
    type: 'POST',
    data: {
      action: 'update_attendace',
      enroll_id: enroll_id,
      status: status
    },
    success:function(res){
      console.log(res);
      alert('Attendance Updated');
      header("attendance.php");
    }
  
  });
});
  </script>