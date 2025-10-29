</div>
<!-- Main Footer -->
<footer class="main-footer">
    <strong>Copyright &copy; 2023-2024 <a href="http://adminlte.io">Shool Management System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- datatable -->
<!-- <script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> -->
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<!-- <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script> -->
<!-- ChartJS -->
<!-- <script src="plugins/chart.js/Chart.min.js"></script> -->

<!-- PAGE SCRIPTS -->
<!-- <script src="dist/js/pages/dashboard2.js"></script> -->
<script>

(function(){
  var path = window.location.href;
  //console.log(path);
  $(".nav-link").each(function () {
var href= $(this).attr('href');
//console.log(href);
 if(path === decodeURIComponent(href))
 {
   $(this).addClass('active');
   var parent = $(this).closest('.has-treeview');
   parent.addClass('menu-open');
    $(parent).find('.nav-link').first().addClass('active');

 };
  });
}());


  </script>

  <script>
    jQuery(document).ready(function(){
jQuery('#class').change(function(){
 // alert(jQuery(this).val());
  jQuery.ajax({
    url:'ajax.php',
    type:'POST',
    data: {'class_id':jQuery(this).val()},
    dataType :'json',
    success:function(response){
      
 if(response.count > 0){
   jQuery('#section-container').show();
 
 }
  

 else{
  jQuery('#section-container').hide();
 }

  jQuery('#section').html(response.options);
    }
  });
});
    })
    </script>
</body>
</html>
