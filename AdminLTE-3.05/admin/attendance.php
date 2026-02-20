<?php
 include('includes/config.php');
 include('includes/functions.php');
?> 
<?php include('header.php')?>
<?php include('sidebar.php')?>
 <?php
?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class= "d-flex">
            <h1 class="m-0 text-dark"> Manage Attendance :-</h1>
            <a href="attendance.php?&action=add-new"
   class="btn btn-primary btn-sm mx-4">Mark Attendance</a>
<a href="updateAttendance.php" class="btn btn-primary btn-sm mx-4">Update Attendance</a>
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
        <form action="attendance.php" method="get">
          <?php
          $class_id=$_GET['fil_class'] ?? '';
          $section_id=$_GET['fil_section'] ?? '';
          $subject_id=$_GET['fil_subject'] ?? '';
          $teacher_id=$_GET['fil_teacher'] ?? '';
          $date=$_GET['fil_dob'] ?? '';
          ?>
         <!-- <input type="hidden" name="action" value="add-new"> -->
          
          <div class="row">
            <div class="col-lg-2">
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
          <div class="col-lg-2">
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
         
           
         
          <div class="col-lg-2">
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
          <label for="fil_teacher">Select the teacher</label>
          <select name="fil_teacher" id="fil_teacher" class="form-control">
            <?php
            $select_query="SELECT * FROM `accounts` WHERE type='teacher'";

            $teacher=$con->prepare($select_query);
            $teacher->execute();
            $result=$teacher->get_result();
            while($row_fetch=$result->fetch_assoc()){
              echo '<option value="'.$row_fetch['id'].'">'.$row_fetch['Name'].'</option>';
            }
            ?>
          </select>
         </div> 
         <div class="col-lg-3">
          <label for="fil_dob">Select the date</label>
      <input type="date" class="form-control" id="fil_date" placeholder="date" name="fil_dob"/>
         </div>
           <div class="col-lg-1">
<div class="d-flex justify-content-end">
<button type="button" id="applyFilter" class="btn btn-info">Apply</button>

          </div>
           </div>
        </form>
     
      
<div class="table-responsive my-3">
        <table class="table table-bordered w-100" id="view_attendance">
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
    <?php } ?>
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'add-new') {?>

<div class="card">
  <div class="card-body">
    <form action="attendance.php" method="post" id="attendanceForm">

        <?php
  $class_id=$_GET['at_class'] ?? '';
 $section_id=$_GET['at_section']??'';
 $subject_id=$_GET['at_subject']??'';
 $teacher_id=$_GET['at_teacher']??'';
 $dob=$_GET['dob']??'';
  ?>
   <h4><u>Mark the Attendance:-</u></h4>
   <input type="hidden" name="action" value="add-new">
    <div class="row">
    <div class="col-lg-4">
      <div class="form-group">
        <label for="at_class">Select Class-></label>
          <select name="at_class" id="at_class" class="form-control">
            <?php
            $args=array(
              'type'=>'class',
              'status'=>'publish'
            );
            $att_classes=get_posts($args);
            foreach($att_classes as $key=>$att_class){
$selected=($class_id==$att_class->id)?'selected':'';
echo '<option value="'.$att_class->id.'" '.$selected.'>'. $att_class->title.'</option>';
            }

            ?>
         
           </select>
      
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="form-group">
  <label for="at_section">Select section-></label>
          <select name="at_section" id="at_section" class="form-control"> 
             <?php
            $args=array(
              'type'=>'section',
              'status'=>'publish'
            );
            $at_sections=get_posts($args);
            foreach($at_sections as $key=>$at_section){
$selected=($section_id==$at_section->id)?'selected':'';
echo '<option value="'.$at_section->id.'" '.$selected.'>'. $at_section->title.'</option>';
            }

            ?>
            </select>
      </div>
    </div>
<div class="col-lg-4">
  <div class="form-group">
    <label for="at_subject">Select Subject-></label>
  <select name="at_subject" id="at_subject" class="form-control">

  <?php
  $select_query=$con->prepare("SELECT * FROM `courses`");
  $select_query->execute();
  $result=$select_query->get_result();
  while($row_fetch=$result->fetch_assoc()){
  echo '<option value="'.$row_fetch['id'].'">'.$row_fetch['name'].'</option>';
  }
  ?>
  </select>
  </div>
</div>
 <div class="justify-content-end">
 <button type="button" id="applyBtn" class="btn btn-primary">
  Apply
</button>
      </div>
</div>     
<div class="row">        
     <div class="col-lg-6">
      <div class="form-group">
        <label for="at_teacher">Select the teacher-></label>
        <select name="at_teacher" id="at_teacher" class="form-control">
          <?php
          $select_query=$con->prepare("SELECT * FROM `accounts` WHERE type='teacher'");
          $select_query->execute();
          $result=$select_query->get_result();
          while($row_fetch=$result->fetch_assoc()){
            echo '<option value="'.$row_fetch['id'].'">'.$row_fetch['Name'].'</option>';
          }
          ?>
        </select>
      </div>
     </div>   
     
     <div class="col-lg-6">
      <div class="form-group">
        <label for="date">Select the date-></label>
   <input type="date" class="form-control" id="date" placeholder="date" name="dob"/>
      </div> 
     </div>
          </div>

  </div>
</div>
          <div class="table-responsive">
            <table class="table table-bordered w-100" id="attend">
              <thead>
              <tr>
                <th>SNo</th>
                <th>Enroll_ID</th>
                <th>Class</th>
                <th>Section</th>
                <th>Student_name</th>
                <th>Action</th>
              </tr>
        </thead>
            </table>
        
            <button type="submit" id="saveAttendance" class="btn btn-primary mt-3">
  Save Attendance
</button>

</form>
          </div>
                </div>
              </div>
            </div>

          <?php } ?>

          <?php 
include('footer.php')?>

<script>
  let applybtn=document.getElementById('applyBtn');
  if(applybtn){
applybtn.addEventListener('click', function () {
  let c = at_class.value;
  let s =at_section.value;
  let sub=at_subject.value;
  if(!c||!s||!sub){
     alert('Class, Section, Subject select karo');
    return;
  }
  window.location.href='attendance.php?action=add-new'+'&at_class='+c+'&at_section='+s+'&at_subject='+sub;
 });
  }
</script>

<script>
  $('#applyFilter').on('click',function(){
  var view_table=$('#view_attendance').DataTable({
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
        className:'btn btn-sm btn-danger',
        exportOptions:{
          columns:':not(:last-child)'
        }
      },
      {
        extend:'pdfHtml5',
        text:'pdf',
        className:'btn btn-sm btn-warning',
        exportOptions:{
          columns:':not(:last-child)'
        }
      }
    ],
    ajax:{
'url':'ajax.php',
'type':'POST',
data:function (d){
  d.action = "view_attend";
  d.fil_class   = $('#fil_class').val();
  d.fil_section = $('#fil_section').val();
  d.fil_subject = $('#fil_subject').val();
  d.fil_teacher = $('#fil_teacher').val();
  d.fil_dob        = $('input[name="fil_dob"]').val();
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
  var table=$('#attend').DataTable({
     processing:true,
     dom:'<"row"<"col-md-6"l"><"col-md-6 text-right"B>>frtip',
      buttons:[
      {
        extend:'excelHtml5',
        text:'excel',
        className:'btn btn-sm btn-success',
        exportOption:{
          columns:':not(:last-child)'
        }
      },
      {
        extend:'print',
        text:'print',
        className:'btn btn-sm btn-danger',
        exportOption:{
          columns:':not(:last-child)'
        }
      },
      {
        extend:'pdfHtml5',
        text:'pdf',
        className:'btn btn-sm btn-warning',
        exportOption:{
          columns:':not(:last-child)'
        }
      }
    ],
    ajax:{
      'url':'ajax.php',
      'type':'POST',
data:function (d){
  d.action="mark_attendance";
d.at_class='<?=$class_id?>';
d.at_section='<?=$section_id?>';
  d.at_subject = '<?=$subject_id?>';
}
    },
    columns:[
      {'data':'SNo'},
      {'data':'Enroll_ID'},
      {'data':'Class'},
        {'data':'Section'},
        {'data':'Student_name'},
        {'data':'Action'}
    ]
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
 $('#attendanceForm').on('submit', function(e){
  e.preventDefault();

  let attendance = {};

  $('.toggle-att').each(function(){
      let id = $(this).data('id');
      let status = $(this).attr('data-status');
      attendance[id] = status;
  });

  $.ajax({
    url: 'ajax.php',
    type: 'POST',
    data: {
      action: 'saveAttendance',
      att: attendance,
      at_class: $('#at_class').val(),
      at_section: $('#at_section').val(),
      at_subject: $('#at_subject').val(),
      at_teacher: $('#at_teacher').val(),
      dob: $('#date').val()
    },
    dataType: 'json',
    success: function(res){
      if(res.status){
        alert(res.message);
      } else {
        alert('Save failed');
      }
    }
  });
});

</script>
