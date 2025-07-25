<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-heading">Pages</li>
        {{-- <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('user.index') }}">
                <i class="bi bi-person"></i>
                <span>Users</span>
            </a>
        </li><!-- End Profile Page Nav --> --}}
        @if (Auth::user()->employee->type == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('news.index') }}">
                    <i class="bi bi-person"></i>
                    <span>News</span>
                </a>
            </li><!-- End Profile Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('employee.index') }}">
                    <i class="bi bi-person"></i>
                    <span>Employees</span>
                </a>
            </li><!-- End Profile Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('department.index') }}">
                    <i class="bi bi-building"></i>
                    <span>Departments</span>
                </a>
            </li><!-- End Profile Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('feedback.index') }}">
                    <i class="bi bi-building"></i>
                    <span>Feedbacks</span>
                </a>
            </li><!-- End Profile Page Nav -->
        @endif
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('profile.edit') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li><!-- End Profile Page Nav -->
        <hr>
        <li class="nav-heading  ">Hiring process <span class="badge bg-danger float-end">Soon</span> </li>

        <li class="nav-item">
            <a class="nav-link collapsed">
                <i class="bi bi-person"></i>
                <span> Available jobs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed">
                <i class="bi bi-person"></i>
                <span> Applicants </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed">
                <i class="bi bi-person"></i>
                <span> Interviews </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed">
                <i class="bi bi-person"></i>
                <span> Final Stauts </span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
