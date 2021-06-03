<aside id="menu">
    <div id="navigation">
        <div class="profile-picture">
            @if((new \Jenssegers\Agent\Agent())->isDesktop())
                <div class="img-circle m-b pp" ><a href="{{route('show.admin.details',['id'=>Auth::guard('admin')->user()->id])}}"><div style="height: 70px;width: 100px;"></div></a>
                    <a href="#"><div class="updatePp" id="updatePp" data-toggle="modal" data-target="#ppUpdate{{Auth::guard('admin')->user()->id}}"><i class="fa fa-camera"></i><br>Update</div></a>
                </div>
            @else
               <a href="#" data-toggle="modal" data-target="#ppUpdate{{Auth::guard('admin')->user()->id}}">
                   <div class="img-circle m-b pp" >
                       <div class="updatePp" id="updatePp"><i class="fa fa-camera"></i><br>Update</div>
                   </div>
               </a>
            @endif
            <div class="modal fade" id="ppUpdate{{Auth::guard('admin')->user()->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <span class="pull-right" style="margin: 5px 10px 0 0; opacity: 0.2;"><a data-dismiss="modal"><i class="fa fa-close"></i></a></span>
                        <div class="modal-header">
                            @if((new \Jenssegers\Agent\Agent())->isDesktop())
                                <h6>Take Photo</h6>
                                <button class="btn btn-warning2" id="cam" data-toggle="modal" data-target="#takePhoto{{Auth::guard('admin')->user()->id}}" type="button" style="width: 100%;"><i class="fa fa-camera"></i> <span class="bold">Take Photo</span></button>
                            @endif
                            <h6>Upload Image</h6>
                            <button class="btn btn-success" data-toggle="modal" data-target="#uploadPp{{Auth::guard('admin')->user()->id}}" type="button" style="width: 100%;"><i class="fa fa-upload"></i> <span class="bold">Upload Image</span></button>
                            <h6>Remove Photo</h6>
                            <a class="btn btn-danger" href="{{route('remove.pp',['id'=>Auth::guard('admin')->user()->id])}}" type="button" style="width: 100%;"><i class="fa fa-trash-o"></i> <span class="bold">Remove Profile Picture</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="uploadPp{{Auth::guard('admin')->user()->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="color-line"></div>
                        <span class="pull-right" style="margin: 5px 10px 0 0; opacity: 0.2;"><a data-dismiss="modal"><i class="fa fa-close"></i></a></span>
                        <div class="modal-header">
                            <h3>Upload Image Form Your Device</h3>
                            <form action="{{route('upload.pp',['id'=>Auth::guard('admin')->user()->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input style="margin-top: 30px;" type="file" name="profile_picture">
                                <button style="margin-top: 30px;width: 100%" class="btn btn-success" type="submit" style="width: 100%;"><i class="fa fa-upload"></i> <span class="bold">Upload</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="takePhoto{{Auth::guard('admin')->user()->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <span class="pull-right" style="margin: 5px 10px 0 0; opacity: 0.2;"><a data-dismiss="modal"><i class="fa fa-close"></i></a></span>
                        <div class="color-line"></div>
                        <div class="modal-header text-center">
                            <h3><span style="margin-right: 200px;">Camera</span><span style="margin-right: 200px;">Image</span></h3>
                            <!-- Stream video via webcam -->
                                <div class="video-wrap">
                                    <video style="width: 250px; float: left" id="video" playsinline autoplay></video>
                                    <canvas id="canvas" width="250" height="188"  style="margin-left:30px; float: left;"></canvas>
                                </div>
                            <!-- Trigger canvas web API -->
                            <!-- Video Snapshot -->
                            <div class="controller">
                                <button style="margin:20px 0 20px 0;" class="btn btn-primary" id="snap"><i class="fa fa-camera"></i></button>
                                <form method="POST" action="{{route('upload.snap',['id'=>Auth::guard('admin')->user()->id])}}" enctype="multipart/form-data">
                                    @csrf
                                    <input id="image_URI" hidden name="image_URI" type="text">
                                    <input id="image_name" hidden name="image_name" type="text" value="imageX">
                                    <button type="submit" id="save_image" name="save_image" style="width: 100%" class="btn btn-success" value="Submit"><i class="fa fa-upload"></i> <span class="bold">Upload</span></button>
                                </form>
                            </div>
                            <!-- Save Captured Image -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="stats-label text-color">
                <span class="font-extra-bold font-uppercase">{{Auth::guard('admin')->user()->name}}</span>
                <div class="dropdown">
                    @if(!Auth::guard('admin')->user()->type==0)
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <small
                                class="text-muted">{{Auth::guard('admin')->user()->position.' at '.Auth::guard('admin')->user()->company->name}}
                                <b class="caret"></b></small>
                        </a>
                    @else
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <small class="text-muted">{{Auth::guard('admin')->user()->email}} <b
                                    class="caret"></b></small>
                        </a>
                    @endif
                    <ul class="dropdown-menu animated flipInX m-t-xs">
                        <li>
                            <a href="{{route('show.admin.details',['id'=>Auth::guard('admin')->user()->id])}}">Profile</a>
                        </li>
                        <li><a href="{{route('change.password')}}">Change Password</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('admin.logout')}}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav" id="side-menu">
            <li class="{{(Route::current()->getName()=='dashboard')?'active':''}}">
                <a href="{{route('dashboard')}}"> <span class="nav-label">Dashboard</span></a>
            </li>
            @if(Auth::guard('admin')->user()->type==0)
                <li class="{{(Route::current()->getName()=='show.companies')?'active':''}}">
                    <a href="{{route('show.companies')}}"> <span class="nav-label">Companies</span></a>
                </li>
            @endif
            @if((array_key_exists('department',$permission))?(($permission['department']['r']==1)?1:0):0)
                <li class="{{(Route::current()->getName()=='show.departments')?'active':''}}">
                    <a href="{{route('show.departments')}}"> <span class="nav-label">Departments</span></a>
                </li>
            @endif
            @if((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0)
                <li class="{{(Route::current()->getName()=='show.admins')?'active':''}}">
                    <a href="{{route('show.admins')}}"> <span class="nav-label">Admins</span></a>
                </li>
            @endif
            @if((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0)
                @if(Auth::guard('admin')->user()->type==0)
                    <li class="{{(Route::current()->getName()=='show.employees')?'active':''}}">
                        <a href="{{route('show.employees')}}"> <span class="nav-label">All Employees</span></a>
                    </li>
                @else
                    <li class="{{(Route::current()->getName()=='show.employees'||Route::current()->getName()=='show.company.past.employees'||Route::current()->getName()=='show.company.present.employees')?'active':''}}">
                        <a href="#"><span class="nav-label">Employees</span><span class="fa arrow"></span> </a>
                        <ul class="nav nav-second-level">
                            <li class="{{(Route::current()->getName()=='show.employees')?'active':''}}"><a
                                    href="{{route('show.employees')}}">All Employees</a></li>
                            <li class="{{(Route::current()->getName()=='show.company.present.employees')?'active':''}}"><a
                                    href="{{route('show.company.present.employees')}}">Your Employees</a></li>
                            <li class="{{(Route::current()->getName()=='show.company.past.employees')?'active':''}}"><a
                                    href="{{route('show.company.past.employees')}}">Your Past Employees</a></li>
                        </ul>
                    </li>
                @endif
            @endif
            @if((array_key_exists('role',$permission))?(($permission['role']['r']==1)?1:0):0)
                <li class="{{(Route::current()->getName()=='show.roles')?'active':''}}">
                    <a href="{{route('show.roles')}}"> <span class="nav-label">Roles</span></a>
                </li>
            @endif
            @if((array_key_exists('trash',$permission))?(($permission['trash']['r']==1)?1:0):0)
                    <li class="{{(Route::current()->getName()=='show.department.trash'||Route::current()->getName()=='show.section.trash'||Route::current()->getName()=='show.admin.trash'||Route::current()->getName()=='show.role.trash'||Route::current()->getName()=='show.employee.trash'||Route::current()->getName()=='show.employee.history.trash')?'active':''}}">
                        <a href="#"><span class="nav-label">Trash</span><span class="fa arrow"></span> </a>
                        <ul class="nav nav-second-level">
                            @if(Auth::guard('admin')->user()->type==0)
                                <li class="{{(Route::current()->getName()=='show.department.trash')?'active':''}}"><a
                                        href="{{route('show.department.trash')}}">Departments</a></li>
                                <li class="{{(Route::current()->getName()=='show.section.trash')?'active':''}}"><a
                                        href="{{route('show.section.trash')}}">Sections</a></li>
                            @endif
                            @if((array_key_exists('admin',$permission))?(($permission['admin']['r']==1)?1:0):0)
                                <li class="{{(Route::current()->getName()=='show.admin.trash')?'active':''}}"><a
                                        href="{{route('show.admin.trash')}}">Admins</a></li>
                            @endif
                            @if((array_key_exists('role',$permission))?(($permission['role']['r']==1)?1:0):0)
                                <li class="{{(Route::current()->getName()=='show.role.trash')?'active':''}}"><a
                                        href="{{route('show.role.trash')}}">Roles</a></li>
                            @endif
                            @if((array_key_exists('employee',$permission))?(($permission['employee']['r']==1)?1:0):0)
                                <li class="{{(Route::current()->getName()=='show.employee.trash')?'active':''}}"><a
                                        href="{{route('show.employee.trash')}}">Employee</a></li>
                            @endif
                            @if(Auth::guard('admin')->user()->type!=0)
                                @if((array_key_exists('employee_experience',$permission))?(($permission['employee_experience']['r']==1)?1:0):0)
                                    <li class="{{(Route::current()->getName()=='show.employee.history.trash')?'active':''}}">
                                        <a href="{{route('show.employee.history.trash')}}">Employee History</a></li>
                                @endif
                            @endif
                            <li>&nbsp;</li>
                        </ul>
                    </li>
            @endif
        </ul>
    </div>
</aside>
