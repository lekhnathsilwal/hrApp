<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">HrApp</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin')}}">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('show.departments')}}">Departments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('show.admins')}}">Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('show.employees')}}">Employee</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('show.roles')}}">Roles</a>
            </li>
            <div class=" nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Trash
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('show.department.trash')}}">Departments</a>
                    <a class="dropdown-item" href="{{route('show.section.trash')}}">Sections</a>
                    <a class="dropdown-item" href="{{route('show.admin.trash')}}">Admins</a>
                    <a class="dropdown-item" href="{{route('show.role.trash')}}">Roles</a>
                    <a class="dropdown-item" href="{{route('show.employee.trash')}}">Employee</a>
                    <a class="dropdown-item" href="{{route('show.employee.history.trash')}}">Employee History</a>
                </div>
            </div>
        </ul>
        <form class="form-inline my-2 my-lg-0" style="margin-right: 30px;">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <div class="nav-item dropdown" style="margin-right: 65px;">
            <a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{Auth::guard('admin')->user()->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Change password</a>
                <a class="dropdown-item" href="{{route('admin.logout')}}">Log-out</a>
            </div>
        </div>
    </div>
</nav>
