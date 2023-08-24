<aside id="pageAside">

    <h1>

        <a href="@can('create-user'){{ route('management.dashboard') }}@else{{ route('user.dashboard') }}@endcan">

            <img class="img-fluid" src="{{ asset('images/logo.png') }}" alt="Complaint Management System">

        </a>

    </h1>

    <div class="scroll-area">

        <div class="scrollbar-inner">
            
            @role(['super-admin','sse','user','helpdesk'])
            <a href="@can('create-user'){{ route('management.dashboard') }}@else{{ route('user.dashboard') }}@endcan" class="{{ Request::is('management/dashboard') || Request::is('user/dashboard') ? 'active' : '' }}">

                <i data-feather="grid"></i> Dashboard

            </a>
            @endrole
            
            @role(['sden','den','aden'])
            <a href="{{ route('management.dashboard') }}" class="{{ Request::is('management/dashboard') || Request::is('management/dashboard/*') ? 'active' : '' }}">

                <i data-feather="grid"></i> Dashboard

            </a>
            @endrole
            
            @role(['super-admin'])

                <div class="collapse-menu" id="masters">

                    <div class="card">

                        <div class="card-header" id="mastersHeading">

                            <a 

                                class="{{ Request::is('management/locations') || Request::is('management/locations/*') || Request::is('management/areas') || Request::is('management/areas/*') || Request::is('management/housetypes') || Request::is('management/housetypes/*') || Request::is('management/blocks') || Request::is('management/blocks/*') || Request::is('management/quarters') || Request::is('management/quarters/*') || Request::is('management/categories') || Request::is('management/categories/*') || Request::is('management/sub-categories') || Request::is('management/sub-categories/*') || Request::is('management/super-categories') || Request::is('management/super-categories/*') || Request::is('management/service-buildings') || Request::is('management/service-buildings/*') ? 'active' : '' }}" 

                                data-toggle="collapse" 

                                data-target="#masterCollapse" 

                                aria-expanded="{{ Request::is('management/locations') || Request::is('management/locations/*') || Request::is('management/areas') || Request::is('management/areas/*') || Request::is('management/housetypes') || Request::is('management/housetypes/*') || Request::is('management/blocks') || Request::is('management/blocks/*') || Request::is('management/quarters') || Request::is('management/quarters/*') || Request::is('management/categories') || Request::is('management/categories/*') || Request::is('management/sub-categories') || Request::is('management/sub-categories/*') || Request::is('management/super-categories') || Request::is('management/super-categories/*') || Request::is('management/service-buildings') || Request::is('management/service-buildings/*') ? 'true' : 'false' }}" 

                                aria-controls="masterCollapse" href="javascript:void(0);">

                                <i data-feather="tool"></i> 

                                Masters 

                                <i class="arrow" data-feather="chevron-down"></i> 

                            </a>

                        </div>

                

                        <div 

                            id="masterCollapse" 

                            class="collapse-sub-menu collapse{{ Request::is('management/locations') || Request::is('management/locations/*') || Request::is('management/areas') || Request::is('management/areas/*') || Request::is('management/housetypes') || Request::is('management/housetypes/*') || Request::is('management/blocks') || Request::is('management/blocks/*') || Request::is('management/quarters') || Request::is('management/quarters/*') || Request::is('management/categories') || Request::is('management/categories/*') || Request::is('management/sub-categories') || Request::is('management/sub-categories/*') || Request::is('management/super-categories') || Request::is('management/super-categories/*') || Request::is('management/service-buildings') || Request::is('management/service-buildings/*') ? ' show' : '' }}" 

                            aria-labelledby="mastersHeading" 

                            data-parent="#masters">

                            <div class="card-body">

                                <a href="{{ route('management.locations.index') }}" class="{{ Request::is('management/locations') || Request::is('management/locations/*') ? 'active' : '' }}">Locations</a>

                                <a href="{{ route('management.areas.index') }}" class="{{ Request::is('management/areas') || Request::is('management/areas/*') ? 'active' : '' }}">Areas</a>                          

                                <a href="{{ route('management.housetypes.index') }}" class="{{ Request::is('management/housetypes') || Request::is('management/housetypes/*') ? 'active' : '' }}">HouseTypes</a>

                                <a href="{{ route('management.blocks.index') }}" class="{{ Request::is('management/blocks') || Request::is('management/blocks/*') ? 'active' : '' }}">Blocks</a>

                                <a href="{{ route('management.quarters.index') }}" class="{{ Request::is('management/quarters') || Request::is('management/quarters/*') ? 'active' : ''  }}">Quarters</a>

                                <a href="{{ route('management.super-categories.index') }}" class="{{ Request::is('management/super-categories') || Request::is('management/super-categories/*') ? 'active' : ''  }}">Departments</a>

                                <a href="{{ route('management.categories.index') }}" class="{{ Request::is('management/categories') || Request::is('management/categories/*') ? 'active' : ''  }}">Categories</a>

                                <a href="{{ route('management.sub-categories.index') }}" class="{{ Request::is('management/sub-categories') || Request::is('management/sub-categories/*') ? 'active' : ''  }}">Sub Categories</a>

                                <a href="{{ route('management.service-buildings.index') }}" class="{{ Request::is('management/service-buildings') || Request::is('management/service-buildings/*') ? 'active' : ''  }}">Service Buildings</a>

                            </div>

                        </div>

                    </div>

                </div>



                <a href="{{ route('management.admins.index') }}" class="{{ Request::is('management/admins') || Request::is('management/admins/*') ? 'active' : '' }}">

                    <i data-feather="users"></i> Admins

                </a>
                
                <!--<a href="{{ route('management.escalations.index') }}" class="{{ Request::is('management/escalations') || Request::is('management/escalations/*') ? 'active' : '' }}">-->

                <!--    <i data-feather="trending-up"></i> Escalations-->

                <!--</a>-->

            @endrole
            
            
            
                    @role(['super-admin'])

                    <div class="collapse-menu" id="escalate">

                    <div class="card">

                        <div class="card-header" id="complaintsHeadings">

                            <a 

                                class="{{ Request::is('management/escalations') || Request::is('management/escalations/*') || Request::is('management/escalations') || Request::is('management/escalations') || Request::is('management/escalations') ? 'active' : '' }}" 

                                data-toggle="collapse" 

                                data-target="#complaintsCollapse" 

                                aria-expanded="{{ Request::is('management/escalations') || Request::is('management/escalations/*') || Request::is('management/escalations') || Request::is('management/escalations') || Request::is('management/escalations') ? 'true' : 'false' }}" 

                                aria-controls="complaintCollapse" href="javascript:void(0);">

                               <i data-feather="trending-up"></i> Escalations
                               
                                 <i class="arrow" data-feather="chevron-down"></i> 

                            </a>

                        </div>

                

                        <div 

                              id="complaintsCollapse" 

                            class="collapse-sub-menu collapse{{ Request::is('management/escalations') || Request::is('management/escalations/*') || Request::is('complaint/escalated')  || Request::is('management/escalations') || Request::is('management/escalations') ? ' show' : '' }}" 

                            aria-labelledby="complaintsHeadings" 

                            data-parent="#escalate">

                            <div class="card-body">
                              
                                <a href="{{ route('management.escalations.index') }}" class="{{ Request::is('management/escalations') ? 'active' : '' }}">Create Escalation</a>
                                
                                <a href="{{ route('complaint.escalated') }}" class="{{ Request::is('complaint/escalated') ? 'active' : '' }}">Escalated Complaints</a>
                             
                               

                            </div>

                        </div>

                    </div>

                </div>

            @endrole




            @role(['sse', 'helpdesk','super-admin'])

                <div class="collapse-menu" id="users">

                    <div class="card">

                        <div class="card-header" id="usersHeading">

                            <a 

                                class="{{ Request::is('management/users') || Request::is('management/users/*') || Request::is('management/verify-users') ? 'active' : '' }}" 

                                data-toggle="collapse" 

                                data-target="#userCollapse" 

                                aria-expanded="{{ Request::is('management/users') || Request::is('management/users/*') || Request::is('management/verify-users') ? 'true' : 'false' }}" 

                                aria-controls="userCollapse" href="javascript:void(0);">

                                <i data-feather="layers"></i> Manage Users
                                
                                  <i class="arrow" data-feather="chevron-down"></i> 
                                

                            </a>

                        </div>

                

                        <div 

                            id="userCollapse" 

                            class="collapse-sub-menu collapse{{ Request::is('management/users') || Request::is('management/users/*') || Request::is('management/verify-users') ? ' show' : '' }}" 

                            aria-labelledby="usersHeading" 

                            data-parent="#users">

                            <div class="card-body">

                                <a href="{{ route('management.users.create') }}" class="{{ Request::is('management/users/create') ? 'active' : '' }}">New User</a>

                                <a href="{{ route('management.users.index') }}" class="{{ Request::is('management/users') ? 'active' : '' }}">Verified Users</a>

                                @role(['sse','super-admin'])

                                    <a href="{{ route('management.verify-users') }}" class="{{ Request::is('management/verify-users') ? 'active' : '' }}">Unverified Users</a>

                                @endrole

                            </div>

                        </div>

                    </div>

                </div>

            @endrole



                    @role(['super-admin'])

                    <div class="collapse-menu" id="complaints">

                    <div class="card">

                        <div class="card-header" id="complaintsHeading">

                            <a 

                                class="{{ Request::is('complaint/initiated') || Request::is('complaints/*') || Request::is('complaint/allocated') || Request::is('complaint/resolved') || Request::is('all-complaints') ? 'active' : '' }}" 

                                data-toggle="collapse" 

                                data-target="#complaintCollapse" 

                                aria-expanded="{{ Request::is('complaint/initiated') || Request::is('complaints/*') || Request::is('complaint/allocated') || Request::is('complaint/resolved') || Request::is('all-complaints') ? 'true' : 'false' }}" 

                                aria-controls="complaintCollapse" href="javascript:void(0);">

                                <i data-feather="box"></i> Manage Complaints
                                
                                  <i class="arrow" data-feather="chevron-down"></i> 

                            </a>

                        </div>

                

                        <div 

                              id="complaintCollapse" 

                            class="collapse-sub-menu collapse{{ Request::is('complaint/initiated') || Request::is('complaints/*') || Request::is('complaint/allocated')  || Request::is('complaint/resolved') || Request::is('all-complaints') ? ' show' : '' }}" 

                            aria-labelledby="complaintsHeading" 

                            data-parent="#complaints">

                            <div class="card-body">
                                @mobile
                                @role(['sse', 'helpdesk'])
                                <a href="{{ route('complaints.create') }}" class="{{ Request::is('complaints/create') ? 'active' : '' }}">New Complaint</a>
                                @endrole
                                @role(['user'])
                                <a href="{{ route('complaint.complaint-type') }}" class="{{ Request::is('complaint/complaint-type') ? 'active' : '' }}">New Complaint</a>
                                @endrole
                                @elsemobile
                                <a href="{{ route('complaints.create') }}" class="{{ Request::is('complaints/create') ? 'active' : '' }}">New Complaint</a>
                                @endmobile
                                <a href="{{ route('all-complaints') }}" class="{{ Request::is('all-complaints') ? 'active' : '' }}">All Complaints</a>

                                <a href="{{ route('complaint.initiated') }}" class="{{ Request::is('complaint/initiated') ? 'active' : '' }}">Initiated Complaints</a>

                                <a href="{{ route('complaint.allocated') }}" class="{{ Request::is('complaint/allocated') ? 'active' : '' }}">Allocated Complaints</a>

                                <a href="{{ route('complaint.resolved') }}" class="{{ Request::is('complaint/resolved') ? 'active' : '' }}">Resolved Complaints</a>

                            </div>

                        </div>

                    </div>

                </div>

            @endrole



            @can('create-complaint')

                <div class="collapse-menu" id="complaints">

                    <div class="card">

                        <div class="card-header" id="complaintsHeading">

                            <a 

                                class="{{ Request::is('complaint/initiated') || Request::is('complaints/*') || Request::is('complaint/allocated') || Request::is('complaint/resolved') || Request::is('all-complaints') ? 'active' : '' }}" 

                                data-toggle="collapse" 

                                data-target="#complaintCollapse" 

                                aria-expanded="{{ Request::is('complaint/initiated') || Request::is('complaints/*') || Request::is('complaint/allocated') || Request::is('complaint/resolved') || Request::is('all-complaints') ? 'true' : 'false' }}" 

                                aria-controls="complaintCollapse" href="javascript:void(0);">

                                <i data-feather="layers"></i> Complaints

                            </a>

                        </div>

                

                        <div 

                            id="complaintCollapse" 

                            class="collapse-sub-menu collapse{{ Request::is('complaint/initiated') || Request::is('complaints/*') || Request::is('complaint/allocated')  || Request::is('complaint/resolved') || Request::is('all-complaints') ? ' show' : '' }}" 

                            aria-labelledby="complaintsHeading" 

                            data-parent="#complaints">

                            <div class="card-body">
                                @mobile
                                @role(['sse', 'helpdesk'])
                                <a href="{{ route('complaints.create') }}" class="{{ Request::is('complaints/create') ? 'active' : '' }}">New Complaint</a>
                                @endrole
                                @role(['user'])
                                <a href="{{ route('complaint.complaint-type') }}" class="{{ Request::is('complaint/complaint-type') ? 'active' : '' }}">New Complaint</a>
                                @endrole
                                @elsemobile
                                <a href="{{ route('complaints.create') }}" class="{{ Request::is('complaints/create') ? 'active' : '' }}">New Complaint</a>
                                @endmobile
                                <a href="{{ route('all-complaints') }}" class="{{ Request::is('all-complaints') ? 'active' : '' }}">All Complaints</a>

                                <a href="{{ route('complaint.initiated') }}" class="{{ Request::is('complaint/initiated') ? 'active' : '' }}">Initiated Complaints</a>

                                <a href="{{ route('complaint.allocated') }}" class="{{ Request::is('complaint/allocated') ? 'active' : '' }}">Allocated Complaints</a>

                                <a href="{{ route('complaint.resolved') }}" class="{{ Request::is('complaint/resolved') ? 'active' : '' }}">Resolved Complaints</a>

                            </div>

                        </div>

                    </div>

                </div>
            @endcan
            
            

            @role(['sse', 'helpdesk','den','aden','sden','super-admin'])
                <div class="collapse-menu" id="complaintsReport">

                    <div class="card">

                        <div class="card-header" id="complaintsReportHeading">

                            <a 

                                class="{{ Request::is('complaint/initiated') || Request::is('complaints/*') || Request::is('complaint/allocated') || Request::is('complaint/resolved') || Request::is('all-complaints') ? 'active' : '' }}" 

                                data-toggle="collapse" 

                                data-target="#complaintReportCollapse" 

                                aria-expanded="{{ Request::is('complaint/complaint-report') || Request::is('complaints/*')  ? 'true' : 'false' }}" 

                                aria-controls="complaintReportCollapse" href="javascript:void(0);">

                                <i data-feather="layers"></i> Reports
                                
                                  <i class="arrow" data-feather="chevron-down"></i> 

                            </a>

                        </div>



                        <div 

                            id="complaintReportCollapse" 

                            class="collapse-sub-menu collapse{{ Request::is('complaint/complaint-report')    ? ' show' : '' }}" 

                            aria-labelledby="complaintsReportHeading" 

                            data-parent="#complaintsReport">

                            <div class="card-body">
                                <a href="{{ route('complaint.complaint-report') }}" class="{{ Request::is('complaint/complaint-report') ? 'active' : '' }}">Date Wise Complaints</a>
                                <a href="{{ route('complaint.month-wise-complaint-report') }}" class="{{ Request::is('complaint/month-wise-complaint-report') || Request::is('complaint/month-wise-complaint-report/*') ? 'active' : '' }}">Month Wise Complaints</a>  
                                <!--Route For QuaterWiseConplaintReport By Shubham-->
                                <a href="{{ route('complaint.quarter-wise-complaint-report') }}" class="{{ Request::is('complaint/quarter-wise-complaint-report') || Request::is('complaint/quarter-wise-complaint-report/*') ? 'active' : '' }}">Quarter Wise Complaints</a>  
                                <!--Route For QuaterWiseConplaintReport By Shubham-->
                                <a href="{{ route('complaint.all-complaint-report') }}" class="{{ Request::is('complaint/all-complaint-report') || Request::is('complaint/all-complaint-report/*')? 'active' : '' }}">User Wise Complaints</a> 
                                <!--Route For LocationWiseConplaintReport By Saurabh-->
                                <a href="{{ route('location-wise-complaint') }}" class="{{ Request::is('location-wise-complaint') || Request::is('location-wise-complaint/*')? 'active' : '' }}">Location Wise Complaints</a> 
                            </div>

                        </div>

                    </div>

                </div>

            @endrole
      


  @role(['sden'])
                <div class="collapse-menu" id="complaintsReport">

                    <div class="card">

                        <div class="card-header" id="complaintsReportHeading">

                            <a 

                                class="{{ Request::is('complaint/initiated') || Request::is('complaints/*') || Request::is('complaint/allocated') || Request::is('complaint/resolved') || Request::is('all-complaints') ? 'active' : '' }}" 

                                data-toggle="collapse" 

                                data-target="#complaintReportCollapse" 

                                aria-expanded="{{ Request::is('complaint/complaint-report') || Request::is('complaints/*')  ? 'true' : 'false' }}" 

                                aria-controls="complaintReportCollapse" href="javascript:void(0);">

                                <i data-feather="layers"></i> Reports

                                 <i class="arrow" data-feather="chevron-down"></i> 
                            </a>

                        </div>



                        <div 

                            id="complaintReportCollapse" 

                            class="collapse-sub-menu collapse{{ Request::is('complaint/complaint-report')    ? ' show' : '' }}" 

                            aria-labelledby="complaintsReportHeading" 

                            data-parent="#complaintsReport">

                            <div class="card-body">
                                <a href="{{ route('complaint.complaint-report') }}" class="{{ Request::is('complaint/complaint-report') ? 'active' : '' }}">Date Wise Complaints</a>
                                <a href="{{ route('complaint.month-wise-complaint-report') }}" class="{{ Request::is('complaint/month-wise-complaint-report') || Request::is('complaint/month-wise-complaint-report/*') ? 'active' : '' }}">Month Wise Complaints</a>  
                                
                                <!--Route For QuaterWiseConplaintReport By Shubham-->
                                <a href="{{ route('complaint.all-complaint-report') }}" class="{{ Request::is('complaint/all-complaint-report') || Request::is('complaint/all-complaint-report/*')? 'active' : '' }}">User Wise Complaints</a>
                                <!--Route For LocationWiseConplaintReport By Saurabh-->
                                <!--<a href="{{ route('location-wise-complaint') }}" class="{{ Request::is('location-wise-complaint') || Request::is('location-wise-complaint/*')? 'active' : '' }}">Location Wise Complaints</a> -->
                            </div>

                        </div>

                    </div>

                </div>

            @endrole
          <!--Added by Saurabh Negi for Escalated Complaints-->
            @role(['aden','den','sden'])
             <a href="{{ route('complaint.escalated') }}" class="{{ Request::is('complaint/escalated') ? 'active' : '' }}"><i data-feather="trending-up"></i>Escalated Complaints</a>
            @endrole




            @can('edit-vendor')

                <div class="collapse-menu" id="resources">

                    <div class="card">

                        <div class="card-header" id="resourcesHeading">

                            <a 

                                class="{{ Request::is('sse/vendors') || Request::is('sse/vendors/*') || Request::is('sse/resources') || Request::is('sse/resources/*') ? 'active' : '' }}" 

                                data-toggle="collapse" 

                                data-target="#resourceCollapse" 

                                aria-expanded="{{ Request::is('sse/vendors') || Request::is('sse/vendors/*') || Request::is('sse/resources') || Request::is('sse/resources/*') ? 'true' : 'false' }}" 

                                aria-controls="resourceCollapse" href="javascript:void(0);">

                                <i data-feather="users"></i> Resources
                                 <i class="arrow" data-feather="chevron-down"></i> 

                            </a>

                        </div>

                        <div 

                            id="resourceCollapse" 

                            class="collapse-sub-menu collapse{{ Request::is('sse/vendors') || Request::is('sse/vendors/*') || Request::is('sse/resources') || Request::is('sse/resources/*') ? ' show' : '' }}" 

                            aria-labelledby="resourcesHeading" 

                            data-parent="#resources">

                            <div class="card-body">

                                <a href="{{ route('sse.vendors.index') }}" class="{{ Request::is('sse/vendors') || Request::is('sse/vendors/*') ? 'active' : '' }}">Vendors</a>

                                <a href="{{ route('sse.resources.index') }}" class="{{ Request::is('sse/resources') || Request::is('sse/resources/*') ? 'active' : '' }}">Resources</a>

                            </div>

                        </div>

                    </div>

                </div>

            @endcan



            <hr class="seperator">

            

            @can('feedback-complaint')

                <a href="{{ route('user.profile') }}" class="{{ Request::is('user/profile') ? 'active' : '' }}">

                    <i data-feather="user"></i> User Profile

                </a>

            @endcan



            <a href="{{ route('settings.change-password') }}" class="{{ Request::is('settings/change-password') ? 'active' : '' }}">

                <i data-feather="key"></i> Change Password

            </a>

            @mobile
            <a href="{{ route('m-logout') }}" onclick="event.preventDefault(); document.getElementById('mobilelogout').submit();">
                <i data-feather="power"></i> Logout
            </a>
            <form id="mobilelogout" action="{{ route('m-logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endmobile
            @desktop
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i data-feather="power"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @enddesktop
        </div>

    </div>

</aside>