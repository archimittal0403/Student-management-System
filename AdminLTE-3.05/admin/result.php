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
            <h1 class="m-0 text-dark"> Upload Marks :-</h1>
            <a href="result.php?&action=add-new"
   class="btn btn-primary btn-sm mx-4">Add new result</a>

</div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accounts</a></li>
              <li class="breadcrumb-item active">Result</li>

            </ol>
          </div><!-- /.col -->
           </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<?php
  if (isset($_GET['action']) && $_GET['action'] == 'add-new') {?>

<div class="card">
  <div class="card-body">
    <form action="result.php" method="get">
       <?php
  $class_id=$_GET['res_class'] ?? '';
  $section_id=$_GET['res_section']??'';
  $subject_id=$_GET['res_subject']??'';
  ?>
   <input type="hidden" name="action" value="add-new">
    <div class="row">
    <div class="col-lg-4">
      <div class="form-group">
        <label for="res_class">Select Class</label>
          <select name="res_class" id="res_class" class="form-control">
            <?php
            $args=array(
              'type'=>'class',
              'status'=>'publish'
            );
            $result_classes=get_posts($args);
            foreach($result_classes as $key=>$result_class){
$selected=($class_id==$result_class->id)?'selected':'';
echo '<option value="'.$result_class->id.'" '.$selected.'>'. $result_class->title.'</option>';
            }

            ?>
         
          </select>
      
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="form-group">
  <label for="res_section">Select section</label>
          <select name="res_section" id="res_section" class="form-control">
             <?php
            $args=array(
              'type'=>'section',
              'status'=>'publish'
            );
            $result_sections=get_posts($args);
            foreach($result_sections as $key=>$result_section){
$selected=($section_id==$result_section->id)?'selected':'';
echo '<option value="'.$result_section->id.'" '.$selected.'>'. $result_section->title.'</option>';
            }

            ?>
            </select>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group">
        <label for="res_subject">Select Subject</label>
        <select name="res_subject" id="res_subject" class="form-control">
          <?php
          $select=mysqli_query($con,"SELECT id,name FROM `courses`");
        
          while($row_fetch=mysqli_fetch_assoc($select)){
     echo '<option value="'.$row_fetch['id'].'">'.$row_fetch['name'].'</option>';
          }
          ?>
        </select>
      </div>
    </div>
   <div class="justify-content-end">
     <button type="submit" class="btn btn-info" >Apply</button>

      </div>
  </div>

    </form>
    <form id="uploadForm" method="post" enctype="multipart/form-data">
      <input type="hidden" name="action" value="upload_all_results">
      <div class="table-responsive">
      <table class="table table-bordered w-100" id="example1">
        <thead>
          <tr>
            <th>Sno</th>
            <th>Enroll_ID</th>
           
            <th>Student_Name</th>
            <th>upload Marks</th>
           
          </tr>
        </thead>
      </table>
      <div class="text-right mt-3">
<button type="submit" id="submitMarks" class="btn btn-success">
Submit Marks
          </button>
      </div>
      <a href="export_excel.php" class="btn btn-success">
   Download Excel
</a>
   </div>
    
    </form>
  </div>
</div>
   <?php } else { ?>
   
<div class="card">
<div class="card-body">
<form action="result.php" method="get">
  <?php
  $class_id=$_GET['res_class'] ?? '';
  $section_id=$_GET['res_section']??'';
  $subject_id=$_GET['res_subject']??'';
  ?>
 
  <div class="row">
    <div class="col-lg-4">
      <div class="form-group">
        <label for="res_class">Select Class</label>
          <select name="res_class" id="res_class" class="form-control">
            <?php
            $args=array(
              'type'=>'class',
              'status'=>'publish'
            );
            $result_classes=get_posts($args);
            foreach($result_classes as $key=>$result_class){
$selected=($class_id==$result_class->id)?'selected':'';
echo '<option value="'.$result_class->id.'" '.$selected.'>'. $result_class->title.'</option>';
            }

            ?>
         
          </select>
      
      </div>
    </div>

    <div class="col-lg-4">
      <div class="form-group">
  <label for="res_section">Select section</label>
          <select name="res_section" id="res_section" class="form-control">
             <?php
            $args=array(
              'type'=>'section',
              'status'=>'publish'
            );
            $result_sections=get_posts($args);
            foreach($result_sections as $key=>$result_section){
$selected=($section_id==$result_section->id)?'selected':'';
echo '<option value="'.$result_section->id.'" '.$selected.'>'. $result_section->title.'</option>';
            }

            ?>
            </select>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group">
        <label for="res_subject">Select Subject</label>
        <select name="res_subject" id="res_subject" class="form-control">
          <?php
          $subject=mysqli_query($con,"SELECT * FROM `courses`");
          while($row_fetch=mysqli_fetch_assoc($subject)){
              echo '<option value="'.$row_fetch['id'].'">'.$row_fetch['name'].'</option>'; 
          }
          ?>
        </select>
      </div>
    </div>
   <div class="justify-content-end">
     <button type="submit" class="btn btn-info" >Apply</button>

      </div>
  </div>
</form>
        <div classs="table-responsive">
            <table class="table table-bordered table-striped w-100" id="example">

<thead>
    <tr>
        <th>SNO</th>
        <th>Enroll_ID</th>
        <th>Student_Name</th>
        <th>Marks</th>
     
    </tr>
</thead>
   
<tbody>
 
</tbody>
            </table>
</div>
    </form>
    </div>
    </div>
    <?php } ?>
<?php 
include('footer.php')?>

<script>
if($('#example1').length){
var table=$('#example1').DataTable({
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
    ajax :{
        url:"ajax.php",
        type:"POST",
        dataType:"json",
        data:function (d){
          d.action="get_result_details";
          d.class_id=$('#res_class').val();
          d.section_id=$('#res_section').val();
          d.subject_id=$('#res_subject').val();
        }
    },
    columns:[
        {'data': 'Sno'},
        {'data':'Enroll_ID'},   
        {'data':'Student_Name'},
        {
          data:null,
          render:function(data,type,row){
            return `<input type="number"
            class="form-control"
            name="marks[${row.Enroll_ID}]"
            min="0"
            max="100"
            required >`;
          }
        }
        
    ]
});
}
    </script>
    <script>
   $('#uploadForm').on('submit', function(e){
    e.preventDefault();

    let marksObject = {};
//

    $("input[name^='marks']").each(function () {//<input name="marks[101]" value=78
                                                 // input name="marks[102]" value=98
        let name = $(this).attr("name"); // marks[101]
        let enrollId = name.match(/\d+/)[0];//101
        marksObject[enrollId] = $(this).val();//101->78,102->98
    });

    $.ajax({
        url: "ajax.php",
        type: "POST",
        dataType: "json",
        data: {
            action: "save_marks",
            marks: marksObject,
          res_class:$('#res_class').val(),
                    res_section:$('#res_section').val(),
          res_subject:$('#res_subject').val(),
        },
        success: function(res){
            if(res.status){
                alert("marks will be succesfully uploaded");
                window.location.href="result.php";
            } else {
                alert("marks are not succesfully uploaded");
            }
        },
        error:function(err){
            console.log(err.responseText);
        }
    });
});

</script>


<script>

$('#res_class').on('change', function () {
    let class_id = $(this).val();

    $('#res_section').html('<option>Loading...</option>');

    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'get_sections',
            class_id: class_id
        },
      success: function (res) {
    if(res.status){
        $('#res_section').html(res.options);
    } else {
        $('#res_section').html('<option value="">No sections found</option>');
    }
},
error: function () {
    $('#res_section').html('<option value="">Error loading sections</option>');
}

    });
});

   </script>