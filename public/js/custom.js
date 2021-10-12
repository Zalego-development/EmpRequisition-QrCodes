$(document).ready(function() {
    $('#example').DataTable();
    });
    // Javascript to enable link to tab
    setTimeout(tab,1);
    function tab(){
      $(document).ready(function() {
      if (location.hash) {
          $("a[href='" + location.hash + "']").tab("show");
      }
      $(document.body).on("click", "a[data-toggle='tab']", function(event) {
          location.hash = this.getAttribute("href");
      });
    });
    $(window).on("popstate", function() {
      var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
      $("a[href='" + anchor + "']").tab("show");
    });
    
    $('#mydate').datepicker({
      container: ".bdc"
    });
      };
    
    
    // setInterval(notifications,1000);
    
    function notifications(){
    //get notifications
     $.ajax({
              url:"http://localhost/hr/public/getNotifications",
              type:'GET',
              data:'_token=<?php echo csrf_token() ;?>',
              success:function(data){
               if(data.success=='1'){
                 var output='';
                 var count=0;
                  for(var x=0;x<data.notifications.length;x++){
                    count+=data.notifications[x]['total'];
                      output+='<div class="dropdown-divider"></div><a href="http://localhost/hr/public'+data.notifications[x]['linkurl']+data.notifications[x]['linkindex']+'" class="dropdown-item"><span class="mr-2">'+data.notifications[x]['linkicon']+'</span>'+data.notifications[x]['total']+' '+data.notifications[x]['notification']+'<span class="float-right text-muted text-sm">Not read</span> </a>';
                  } 
                  document.getElementById('nHolder').innerHTML=output;  
                  document.getElementById('countNot').innerHTML=count;
                  document.getElementById('countNot1').innerHTML=count; 
              } else{
                 
              }    
              }
          });
    }
    
    // setInterval(notifications,1000);
    
    function notifications(){
    //get notifications
     $.ajax({
              url:"http://localhost/hr/public/getNotifications",
              type:'GET',
              data:'_token=<?php echo csrf_token() ;?>',
              success:function(data){
               if(data.success=='1'){
                if(data.notifications.length>0){
                    var output=' <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">';
                 var count=0;
                  for(var x=0;x<data.notifications.length;x++){
                    count++;
                      output+='<a href="#" class="dropdown-item"><!-- Message Start --><div class="media"><div  style="background: #ddd; border:1px solid #ddd; width:50px; height: 50px; border-radius:  50%;" title="From '+data.notifications[x]['byy']+'"><h3 style="margin-top: 7px;">'+data.notifications[x]['byy'].substring(0,3)+'</h3></div><divclass="media-body"><h3 class="dropdown-item-title">'+data.notifications[x]['byy']+'<span class="float-right text-sm text-danger"><i class="fas fa-user"></i> Admin</span></h3><p class="text-sm">'+data.notifications[x]['action']+'</p><p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> '+data.notifications[x]['created_at']+'</p></div></div> <!-- Message End --></a><div class="dropdown-divider"></div>';
                  } 
                  output+='</div>'
                  document.getElementById('nHolder2').innerHTML=output;  
                  document.getElementById('countNot2').innerHTML=count;
                }else{
    
                  output='<div class="py-3"><center style="color:  #b3cccc !important;"><i class="fas fa-file fa-5x"></i><i class="fas fa-times fa-2x" style="z-index: 9999; color: #fff; margin-left: -25px;"></i><br><h6>No notifications available</h6></center></div>';
                  document.getElementById('nHolder2').innerHTML=output;
                  document.getElementById('countNot2').innerHTML=0;
                }
    
    
                  
              } else{
                 
              }    
              }
          });
}
    