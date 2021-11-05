<aside class="main-sidebar" style="background-image:url('../images/shots/10.jpg'); background-repeat: repeat-y;">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link" style=" padding-top: 1.4rem !important; padding-bottom: 1.25rem !important; background-color:rgb(75, 71, 109) !important;">
        <span><center><img src="{{asset('images/logo.png')}}" width="33px" height="33px" alt="Zalego Smart Hr Logo" 
           class="imgWrapper"></center>
        </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" style=" background-color:rgb(75, 71, 109) !important; ">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <br><br>
        <li class="nav-header btn btn-primary btn-header"><a href="{{url('/home')}}">Dashboard</a></li><br>
          
<!--           <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-users"></i>
              <p>
               HR
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="{{url('hr/employees')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Employees</p>
                </a>
              </li>
                 <li class="ml-3 nav-item">
                <a href="{{url('/applicants')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Appllicants</p>
                </a>
              </li>
              <li class="ml-3 nav-item">
                <a href="{{url('hr/contracts')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Manage contracts</p>
                </a>
              </li>

               <li class="ml-3 nav-item">
                <a href="{{url('hr/terminateEmployment')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Terminate employment</p>
                </a>
              </li>

            </ul>
          </li> -->
                    <li class="nav-item has-treeview">
            <a href="{{url('/employeerequisitionsettings')}}" class="nav-link nav-link2">
              <i class="nav-icon fas fa fa-cog"></i>
              <p>
              Employee Requisitions Settings
               <!--  <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>
          </li>
<!--               <li class="nav-item has-treeview">
            <a href="{{url('/employeerequisitions')}}" class="nav-link nav-link2">
              <i class="nav-icon fas fa fa-paper-plane"></i>
              <p>
              Employee Request 
               
              </p>
            </a>
          </li> -->
<!-- 
           <li class="nav-item has-treeview">
            <a href="{{url('/approvedrequisitions')}}" class="nav-link nav-link2">
              <i class="nav-icon fas fa fa-check"></i>
              <p>
              Approved Requisitions
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>
            <li class="nav-item has-treeview">
            <a href="{{url('/declinedrequisitions')}}" class="nav-link nav-link2">
              <i class="nav-icon fas fa fa-ban"></i>
              <p>
              Declined Requisitions
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li> -->
              <li class="nav-item has-treeview">
            <a href="{{url('/employeerequest')}}" class="nav-link nav-link2">
              <i class="fa fa-file" aria-hidden="true"></i>
              <p>
              Employee Requisitions 
               <!--  <i class="fas fa-angle-left right"></i> -->
              </p>
            </a>
          </li>
            <li class="nav-item has-treeview">
            <a href="{{url('/employeesqrcodes')}}" class="nav-link nav-link2">
              <i class="nav-icon fas fa-eye"></i>
              <p>
               Employee QR Codes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>
            <!-- <li class="nav-item has-treeview">
            <a href="" class="nav-link nav-link2">
              <i class="nav-icon fas fa-cog"></i>
              <p>
              crm
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"> -->
              
              
<!--             <li class="ml-3 nav-item">
                <a href="" target="_blank" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>CRM</p>
                </a>
              </li> -->
<!--                 <li class="ml-3 nav-item">
                <a href="{{url('/crm')}}" target="_blank" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Applicants</p>
                </a>
              </li> -->
<!-- 
              <li class="ml-3 nav-item">
                <a href="{{url('hr/designations')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Designations</p>
                </a>
              </li> -->
<!-- 
               <li class="ml-3 nav-item">
                <a href="{{url('hr/regions')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Work regions</p>
                </a>
              </li> -->
<!-- 
               <li class="ml-3 nav-item">
                <a href="{{url('hr/empCategories')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Employment categories</p>
                </a>
              </li>
 -->
<!--             </ul>
          </li> -->
           
          

<!--            <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-donate"></i>
              <p>
               Payroll
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="{{url('hr/advancePay')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Advance Pay</p>
                </a>
              </li>
              <li class="ml-3 nav-item">
                <a href="{{url('hr/expenseClaims')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Expense Claims</p>
                </a>
              </li>
              <li class="ml-3 nav-item">
                <a href="{{url('hr/processPayroll')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Process Payroll</p>
                </a>
              </li>
              <li class="ml-3 nav-item">
                <a href="{{url('hr/employeessalary')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Employees salary</p>
                </a>
              </li>

              <li class="ml-3 nav-item">
                <a href="{{url('hr/loansettings')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Loan settings</p>
                </a>
              </li>

              
            </ul>
          </li> -->

<!--               <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-percent"></i>
              <p>
               Perfomance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="{{url('hr/perfomanceTracker')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Perfomance tracker</p>
                </a>
              </li>

               <li class="ml-3 nav-item">
                <a href="{{url('hr/perfomanceIndicator')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                   <p>Perfomance indicator</p>
                </a>
              </li>

              <li class="ml-3 nav-item">
                <a href="{{url('hr/tbp')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                   <p>Target based perfomance</p>
                </a>
              </li>
            </ul>
            </li> -->
<!--            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
              Leaves
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="{{url('hr/leaveApplications')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>View applications</p>
                </a>
              </li>
               <li class="ml-3 nav-item">
                <a href="{{url('hr/applyLeave')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Apply for leave</p>
                </a>
              </li>
              <li class="ml-3 nav-item">
                <a href="{{url('hr/leaveCategories')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Leave categories</p>
                </a>
              </li>
            </ul>
          </li> -->
<!--            <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="#" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Overtime</p>
                </a>
              </li>
               <li class="ml-3 nav-item">
                <a href="#" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Absenteeism</p>
                </a>
              </li>              
            </ul>
          </li>
           -->
        </ul>
      </nav>
    </div>
</aside>