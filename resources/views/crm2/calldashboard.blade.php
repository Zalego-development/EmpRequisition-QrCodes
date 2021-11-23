@extends('crm2.crm_layout')
@section('content')
<style type="text/css">
.w3-input{
background-color:white;
}

.card{
  background: #fff !important;
  border-radius: 0px !important;
  box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
}

 .form2{
      padding: 20px;
    }

@media screen and (max-width: 480px) {
    
    #actionBarHolder {
        display: none;
    }

     .modaledd{
      bottom: 20px;
      z-index:9999 !important;
       position: fixed;
       right: 0px;
          top: 5px;
          width:100%;
    }
}

@media screen and (min-width: 480px) {
    .mobileMenu{
        display: none;
    }

     .modaledd{
      bottom: 20px;
      z-index:9999 !important;
       position: fixed;
       right: 0px;
          top: 5px;
          width: 57%;
    }
}
</style>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
        crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-muted ml-2 mt-4"><strong>CRM </strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active"><a href="#">HR</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
  </div>
<div class="col-sm-6">
   <ol class="breadcrumb float-sm-right ml-2">
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>


    

    <div class="container-fluid">
      <!-- Info boxes -->
     
        <div class="row">
          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-double"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Calls</span>
                <span class="info-box-number">
                 10
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Successful Calls</span>
                <span class="info-box-number">6</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Failed Calls</span>
                <span class="info-box-number">3</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Lead Called</span>
                <span class="info-box-number">3</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class=" col-sm-6 col-md-3 col-6" id="refresh_me">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-single"></i></span>
           
              <div class="info-box-content" >
                <span class="info-box-text">Hours of Call Today</span>
              <div id="div">
                <span class="info-box-number" id="hoursworked">
               3
                 
                </span>
               </div>
              </div>
 

              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class=" col-sm-6 col-md-3 col-6" id="refresh_me1">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Time between calls</span>
                <div id="div1" >
                <span class="info-box-number" id="agentsum">
              3
              
                </span>                   
                </div>               
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <div class=" col-sm-6 col-md-3 col-6" id="refresh_me2">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Agents complete Shift Today</span>
                <div>
                <span class="info-box-number" >
               3
                </span>   
               </div>                
                                       
                 
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-2"><i class="fas fa-check-double"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Break(s) Taken Today</span>
                <div id="">
                <span class="info-box-number" >
              3
                </span>                   
              </div>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- /.row -->
        <br>
       
      </div>
    
    <section class="container px-3 py-3">
       
       <div class="row">
          <div class="col-sm-12">
        <a href="{{url('/leads/waiting')}}"><span class="ml-5  float-right bg-info px-3 rounded shadow-lg"  title=" You have 4 leads in the waiting bay"  style="margin-top: -8px; cursor:pointer;">
      <h6 class="text-white"><i class="fas fa-users"></i> 3 leads in waiting bay</h6>
    </span></a>


   
<div class="card py-4 px-2" id="occupancy1">
<span class="mb-1 text-muted">Occupancy Rate<strong class="float-right">40%</strong></span>
 <div class="progress" style="height:4px;">
<div class="progress-bar bg-danger" role="progressbar" style="width:40%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
weak
</div>



         



       </div>
      






       <div class="conatiner mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <input class="form-control" type="file" id="input" accept=".xls,.xlsx,.csv,"  >
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary" id="button" onclick="jsonReturn()">Convert</button>
            </div>
<div class="col-md-12">
    <pre id="jsondata"></pre>
</div>
        </div>
    </div>
    <?php
header('Content-type: application/json');

$url = "https://zalego.elastix.com/management/Reports/CallReports_2707_sQPzJKPnq5pq0njjNXWY.csv";
$csv2= file_get_contents($url);
$data2 = str_getcsv($csv2);
//var_dump($data);


//$csv = [];

//var_dump($csv2);
?>
<script>
  var data=[{}];
var input = document.getElementById('input');
var file_path = "https://zalego.elastix.com/management/Reports/CallReports_2707_sQPzJKPnq5pq0njjNXWY.csv";
var a = document.createElement('A');
a.href = file_path.files[0];
var bc=a;
 bc = event.target.files;

function jsonReturn () {
  selectedFile = input.files[0];
   
  
        var myjsonobj = [];
        let fileReader = new FileReader();
        fileReader.readAsBinaryString(selectedFile);
        fileReader.onload = (event)=>{
         let data = <?php echo $csv2;?>;
         let workbook = XLSX.read(data,{type:"binary"});
         console.log(workbook);
         alert(workbook);
         workbook.SheetNames.forEach(sheet => {
              let rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
              var mydata1=JSON.stringify(rowObject);
               console.log(rowObject);
              //document.getElementById("jsondata").innerHTML = JSON.stringify(rowObject,undefined,4)
            myjsonobj.push(rowObject);
         });
          var mydata12=JSON.stringify(myjsonobj);
    }
};
</script>




    </section>
  </div>

<script src="{{asset('assets/libs/js/Chart.js')}}"></script>

   <script type="text/javascript">


var ctx = document.getElementById("myChart");
var ctx2 = document.getElementById("myChart2");
var ctx3 = document.getElementById("myChart3");

var myChart = new Chart(ctx, {
    type: 'doughnut',//specify the type of graph you want to deal with
    data: {
        labels: ["Success ", "Failed "],//the labels of your graphs
        datasets: [{
            label: '# Leads',//what the user sees when he/she overs a given label
            data:[4,4], //The data set of your graph
            backgroundColor: [
                'rgba(45, 185, 77, 0.2)', //the colors of your labels
                'rgba(249, 111, 52, 0.2)', 
            ],
            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)',
            ],
            borderWidth: 1
        }]
    },
   
}); 

var myChart2 = new Chart(ctx2, {
    type: 'bar',//specify the type of graph you want to deal with
    data: {
        labels: ["Ambassador","Website","CSV", "Job Portal"],//the labels of your graphs
        datasets: [{
            label: '# Leads',//what the user sees when he/she overs a given label
            data:[5,4,3,2], //The data set of your graph
            backgroundColor: [
                'rgba(45, 185, 77, 0.4)', //the colors of your labels
                 'rgba(249, 111, 52, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                'rgba(220, 53, 69, 0.2)',  
                
            ],

            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)',
                 //the color of the label borders 
                'rgba(75, 192, 192, 1)', //the color of the label borders 
                'rgba(220, 53, 69, 1)', //the color of the label borders 
            ],
          
            borderWidth: 1
        }]
    },
    
});

var myChart3 = new Chart(ctx3, {
    type: 'pie',//specify the type of graph you want to deal with
    data: {
        labels: ["Ambassador","Website","CSV", "Job Portal"],//the labels of your graphs
        datasets: [{
            label: '# Leads',//what the user sees when he/she overs a given label
            data:[5,4,3,3], //The data set of your graph
            backgroundColor: [
                'rgba(45, 185, 77, 0.4)', //the colors of your labels
                 'rgba(249, 111, 52, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                'rgba(220, 53, 69, 0.2)',  
                
            ],

            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)',
                 //the color of the label borders 
                'rgba(75, 192, 192, 1)', //the color of the label borders 
                'rgba(220, 53, 69, 1)', //the color of the label borders 
            ],
          
            borderWidth: 1
        }]
    },
    
});
</script>






<!--add modal-->
<div class="modal" id="addModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong></i> Available Agents Now</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
          <div class="modal-body">
            
          <div class="table-responsive">
        
          <table class="table">
            <thead>
              <tr>
                <th>Agent Name</th>
                <th>Machine loged on</th>
                <th>Hours Spent</th>
                <th></th>
              </tr>
            </thead>
          
          
          </table>
        </form>
      </div>
          </div>
        </div>
      </div>
    </div>
  <!--add modal-->
  <!--add modal-->
<div class="modal" id="addModal1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong> Agents Shift Today</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
          <div class="modal-body">
            
          <div class="table-responsive">
        
          <table class="table">
            <thead>
              <tr>
                <th>Agent Name</th>
                <th>Login at</th>
                <th>Last Logout</th>
                <th>Hours in Shift </th>
                <th>Machine </th>
              </tr>
            </thead>
           
          </table>
        </form>
      </div>
          </div>
        </div>
      </div>
    </div>
  <!--add modal-->
  <div class="modal" id="addModal2">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong><i class="fas fa-plus"></i> take a break</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
          <div class="modal-body">
            
          <div class="table-responsive">
        
          <form  method="POST" action="{{url('takeBreak')}}">
                  @csrf        
                   <div class="form-group col-sm-12">
                    <label>Form</label>
                     <select class="form-control" name="break" id="break" required="">
                     <option >select duration</option>
                      <option value='0.25'>15 minutes</option>
                      <option value='0.5'>30 minutes</option>
                       <option value='1'>one hour</option>
                      <option value='2'>2 hours</option>
                      <option value='3'>3 hours</option>
                      <option value='4'>4 hours</option>
                      <option value='5'>5 hours</option>
                    </select>
                  </div> 
                  </div>
                  <button class="btn btn-success" type="submit" id="btnsave"><i class="fas fa-save"></i> Logout</button>
         </form>
      </div>
          </div>
        </div>
      </div>
    </div>

@endsection