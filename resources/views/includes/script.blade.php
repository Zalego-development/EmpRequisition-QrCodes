 <!-- jQuery UI 1.11.4 -->
   
 <script type="text/javascript">
    
 </script>
   <script src="{{asset('assets/dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
   
   <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
   <script>

        function onChangee() {

        // var x = document.getElementById('jobCategoryId').value
        // console.log(x)
        // body...
      console.log('changed')
        // if ($('#jobCategoryId').val() == 'New') {
        //     console.log('value is new')
        // }
    }
     $(function () {
     $('[data-toggle="tooltip"]').tooltip()
   });
   
     // $.widget.bridge('uibutton', $.ui.button)
   </script>
   
   <!-- ChartJS -->
   <script src="{{asset('assets/dashboard/plugins/chart.js/Chart.min.js')}}"></script>
   <!-- Sparkline -->
   <!-- <script src="{{asset('assets/dashboard/plugins/sparklines/sparkline.js')}}"></script> -->
   <!-- JQVMap -->
 <!--   <script src="{{asset('assets/dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
   <script src="{{asset('assets/dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> -->
   <!-- jQuery Knob Chart -->
   <script src="{{asset('assets/dashboard/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
   <!-- daterangepicker -->
   <script src="{{asset('assets/dashboard/plugins/moment/moment.min.js')}}"></script>
   <script src="{{asset('assets/dashboard/plugins/daterangepicker/daterangepicker.js')}}"></script>
   <!-- Tempusdominus Bootstrap 4 -->
   <!-- <script src="{{asset('assets/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script> -->
   <!-- Summernote -->
   <script src="{{asset('assets/dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
   <!-- overlayScrollbars -->
   <script src="{{asset('assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
   
   <!-- AdminLTE App -->
   <script src="{{asset('assets/dashboard/dist/js/adminlte.js')}}"></script>
   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script src="{{asset('assets/dashboard/dist/js/pages/dashboard.js')}}"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="{{asset('assets/dashboard/dist/js/demo.js')}}"></script>
     <script>


   function getUser(){
           var name=$("#firstname").val();
         document.getElementById("empName").innerHTML=name;
       }
   
           function getImage(input) {
           if (input.files && input.files[0]) {
               var reader = new FileReader();
   
               reader.onload = function (e) {
                   $('#default')
                       .attr('src', e.target.result)
                       .width(90)
                       .height(90);
               };
   
               reader.readAsDataURL(input.files[0]);
           }
       }
   
      </script>
   
      <script>
     var editor_config = {
       path_absolute : "",
       selector: "textarea.my-editor",
       setup : function(ed){
         ed.on('init',function(){
           this.getDoc().body.style.fontFamily='Tw Cen MT';
           this.getDoc().body.style.fontSize='44';
         });
       },
       plugins: [
         "advlist autolink lists link image charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen",
         "insertdatetime media nonbreaking save table contextmenu directionality",
         "emoticons template paste textcolor colorpicker textpattern"
       ],
       toolbar: "insertfile undo redo | styleselect fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolot",
       relative_urls: false,
       file_browser_callback : function(field_name, url, type, win) {
         var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
         var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
   
         var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
         if (type == 'image') {
           cmsURL = cmsURL + "&type=Images";
         } else {
           cmsURL = cmsURL + "&type=Files";
         }
   
         tinyMCE.activeEditor.windowManager.open({
           file : cmsURL,
           title : 'Filemanager',
           width : x * 0.8,
           height : y * 0.8,
           resizable : "yes",
           close_previous : "no"
         });
       }
     };
   
     tinymce.init(editor_config);
   </script>
   
   
      
   <!-- DataTables -->
   <script src="{{asset('assets/dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
   <script src="{{asset('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
   
   <script>
   
     $(function () {
       // $("#employees").DataTable();
       // $("#departments").DataTable();
       // $("#companies").DataTable();
       // $("#designations").DataTable();
       // $('#employeesalarys').DataTable();
       // $('#loanedd').DataTable();
       //  $('#perfomanceTracker').DataTable();
       //  $('#advancePay').DataTable();
       //  $('#approvedExpense').DataTable();
       //  $('#pendingExpense').DataTable();
       //  $('#disExpense').DataTable();
       //  $('#contract').DataTable();
       //  $('#contracts').DataTable();
       //  $('#leaves').DataTable();
       //  $('#leaves2').DataTable();
       //  $('#confirmations').DataTable();
       //  $('#pyrolls').DataTable();
       //  $('#bftt').DataTable();
       //  $('.musters').DataTable();
       //  $('#pyreports').DataTable();
       //  $('#perfomancess').DataTable();
       //  $('#mail_body').DataTable();
       //  $('#customTemps').DataTable();
     });
   
     function pint(){
       document.getElementById('footer').style.display='none';
       document.getElementById('address').style.display='block';
       window.print();
     }
   
   
     function reloaderr(){
       var pathh=window.location.href;
               window.location.assign(pathh);
     }
   
   
     //time renderer
     function renderTimeDesktop() {
   
                         var currentTime= new Date();
                         var diem = "AM"
                         var h = currentTime.getHours();
                         var m = currentTime.getMinutes();
                         var s = currentTime.getSeconds();
   
   
                         if (h ==0){
                             h = 12
                         }   else if (h>12) {
                             h = h - 12;
                             diem = "PM";
   
                         }
   
                         if (h<10){
                             h = "0" + h;
   
                         }
   
                         if (m<10){
                             m = "0" + m;
   
                         }
   
                         if (s<10){
                             s = "0" + s;
   
                         }
   
   
                         var myClock = document.getElementById('clockdisplayDesktop')
                         //myClock.textContent = h + ":" + m + ":" + s + " " +diem;
                         myClock.innerHTML = h + ":" + m + ":" + s + " " + "<sup style='font-size:12px;'>"+diem+"</sup>";
                         setTimeout(renderTimeDesktop,1000);
                         }
   
   
                         renderTimeDesktop();
   
   
     function makeEaseOut(timing) {
         return function(timeFraction) {
           return 1 - timing(1 - timeFraction);
         }
       }
   
       function bounce(timeFraction) {
         for (let a = 0, b = 1, result; 1; a += b, b /= 2) {
           if (timeFraction >= (7 - 4 * a) / 11) {
             return -Math.pow((11 - 6 * a - 11 * timeFraction) / 4, 2) + Math.pow(b, 2)
           }
         }
       }
   
       let bounceEaseOut = makeEaseOut(bounce);
   
       window.onload = function() {
     //     $("#brick").fadeIn(3500);
     //     animate({
     //       duration: 3000,
     //       timing: bounceEaseOut,
     //       draw: function(progress) {
     //         brick.style.left = progress * 50 + '%';
     //       }
     //     });
   
     // setInterval(Incrementerr,20);
     //      var x=0;
     //   function Incrementerr(){
     //       x=x+1;
     //       if(x<=document.getElementById('incrementHolder').value){
     //       document.getElementById('increment').innerHTML=x;
     //   }
   
   
     //   }
       };
   </script>
   