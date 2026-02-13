
<?php
session_start();
 include('includes/config.php');
 include('includes/functions.php');


?> 

<?php include('header.php')?>
<?php include('sidebar.php')?>

<?php

$logopath = $_SERVER['DOCUMENT_ROOT'] . '/student management/AdminLTE-3.05/admin/uploads/akglogo.png';
// echo $logopath;
if(file_exists($logopath)){
    $type=pathinfo($logopath,PATHINFO_EXTENSION);
    $data=file_get_contents($logopath);
$base64_logo='data:image/' . $type . ';base64,' . base64_encode($data);
}
else{
    $base64_logo='';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parent</title>

</head>
<body>
  
</body>
</html>
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.js"></script> -->

<!-- OPTIONAL SCRIPTS -->
<!-- <script src="dist/js/demo.js"></script> -->

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class= "d-flex">
            <h1 class="m-0 text-dark">Parent Detail</h1>
</div>
</div>

</div>
</div>
<div class="card">
    <div class="card-body">
        <form action="" method="get">
            <?php

             $class_id=$_GET['class'] ?? '';
  $section_id=$_GET['section']??'';
            ?>
            <div class="row">
                <div class="col-lg-3">
<div class="form-group">
    <label for="enroll_id">Enroll ID:-</label>
    <input type="text" id="enroll_id" name="enroll_id" placeholder="Enter your Enroll ID" class="form-control">
</div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="name">Student Name :-</label>
                        <input type="text" id="name" name="name" placeholder="Enter Student Name" class="form-control">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="class">Select Class:-</label>
    <select name="class" id="filter_class" class="form-control">
        <option value="">Select Class</option>
        <?php
        $args=array(
          'type'=>'class',
          'status'=>'publish'
        );
        $s_class_id=get_posts($args);
        foreach($s_class_id as $key => $s_class){
$selected=($class_id==$s_class->id)?'selected':'';
 echo '<option value="' . $s_class->id . '" '.$selected.'>' . $s_class->title . '</option>';

        }
        ?>
</select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="section">Select Section</label>
                        <select name="section" id="filter_section" class="form-control">
<option value="">Select Section</option>
<?php
$args=array(
    'type'=>'section',
    'status'=>'publish'
);
$s_section_id=get_posts($args);
foreach($s_section_id as $key=>$s_section){
    $selected=($section_id==$s_section->id)?'selected':'';
 echo '<option value="' . $s_section->id . '" '.$selected.'>' . $s_section->title . '</option>';

}
?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Apply</button>
            </div>
        </form>
<div class="table-responsive">
        <table class="table table-bordered w-100" id="example">
            <thead>
            <tr>
                <th>SNO</th>
                <th>Father Name</th>
                <th>Father Mobile</th>
                <th>Mother Name</th>
                <th>Mother Mobile</th>
                <th>Address</th>
                <th>Email Address</th>
                <th>Action</th>
            </tr>
</thead>
        </table>
</div>
    </div>
</div>

<div class="container my-4">
    <?php
    if(isset($_GET['edit_parent'])){
        include('edit_parent.php');
    }
    ?>
</div>
<?php 
include('footer.php')?>
<script>
    var table=$('#example').DataTable({
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
        title:'Parent Details',
        className:'btn btn-sm btn-warning',
        exportOptions:{
          columns:':not(:last-child)'
        },
        customize:function (doc){
            doc.content.splice(0,0,{
                margin:[0,0,0,12],
                alignment:'center',
                stack:[
                    {
                        text:'AJAY KUMAR GARG ENGINEERING COLLEGE',
                        fontSize:16,
                        bold:true
                    },
                    {
                        text:'27th Km Milestone, Adhyatmik Nagar, Delhi-Meerut Expressway, Ghaziabad - 201015, Uttar Pradesh, India',
                        fontSize:8,
                        margin:[0,5,0,0]
                    },
                    {
                        text:'91-8744052891, +91-8744052893, +91-7290034978.',
                        fontSize:6,
                        margin:[0,5,0,0]
                      
                    }
                ]
            });
            <?php if(!empty($base64_logo)){?>
            doc.content.splice(1,0,{
                image:'<?=$base64_logo ?>',
            width:50,
            alignment:'left',
            margin:[0,-60,0,12]
            });
            <?php } ?>
        }
      }
    ],
    ajax :{
        url:"ajax.php",
        'type':"POST",
        data:function (d){
            d.action="get_parent";
         d.class_id = $('#filter_class').val();
  d.section_id = $('#filter_section').val();
  d.name = $('#name').val();
  d.enroll_id = $('#enroll_id').val();
        }

    },
    columns:[
        {'data':'SNO'},
        {'data':'Father Name'},
        {'data':'Father Mobile'},
        {'data':'Mother Name'},
        {'data':'Mother Mobile'},
        {'data':'Address'},
        {'data':'Email Address'},
        {'data':'Action'}
    ]
    });
</script>