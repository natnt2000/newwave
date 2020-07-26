<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ Route::currentRouteName() == 'faculties.index' || Route::currentRouteName() == 'faculties.create' ? 'active' : '' }}">
      <a class="nav-link {{ Route::currentRouteName() == 'faculties.index' || Route::currentRouteName() == 'faculties.create' ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#faculty" aria-expanded="true" aria-controls="faculty">
        <span>Faculty</span>
      </a>
      <div id="faculty" class="collapse {{ Route::currentRouteName() == 'faculties.index' || Route::currentRouteName() == 'faculties.create' ? 'show' : '' }}">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ Route::currentRouteName() == 'faculties.index' ? 'active' : '' }}" href="{{ route('faculties.index') }}">List</a>
          <a class="collapse-item {{ Route::currentRouteName() == 'faculties.create' ? 'active' : '' }}" href="{{ route('faculties.create') }}">Create</a>
        </div>
      </div>
    </li>
    

    <li class="nav-item {{ Route::currentRouteName() == 'students.index' || Route::currentRouteName() == 'students.edit' || Route::currentRouteName() == 'students.create' ? 'active' : '' }}">
      <a class="nav-link {{ Route::currentRouteName() == 'students.index' || Route::currentRouteName() == 'students.edit' || Route::currentRouteName() == 'students.create' ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#student" aria-expanded="true" aria-controls="student">
        <span>Student</span>
      </a>
      <div id="student" class="collapse {{ Route::currentRouteName() == 'students.index' || Route::currentRouteName() == 'students.create' || Route::currentRouteName() == 'students.edit' ? 'show' : '' }}">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ Route::currentRouteName() == 'students.index' || Route::currentRouteName() == 'students.edit' ? 'active' : '' }}" href="{{ route('students.index') }}">List</a>
          <a class="collapse-item {{ Route::currentRouteName() == 'students.create' ? 'active' : '' }}"  href="{{ route('students.create') }}">Create</a>
        </div>
      </div>
    </li>

    <li class="nav-item {{ Route::currentRouteName() == 'subjects.index' || Route::currentRouteName() == 'subjects.edit' || Route::currentRouteName() == 'subjects.create' ? 'active' : '' }}">
      <a class="nav-link {{ Route::currentRouteName() == 'subjects.index' || Route::currentRouteName() == 'subjects.edit' || Route::currentRouteName() == 'subjects.create' ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#subject" aria-expanded="true" aria-controls="subject">
        <span>Subject</span>
      </a>
      <div id="subject" class="collapse {{ Route::currentRouteName() == 'subjects.index' || Route::currentRouteName() == 'subjects.create' || Route::currentRouteName() == 'subjects.edit' ? 'show' : '' }}">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item {{ Route::currentRouteName() == 'subjects.index' || Route::currentRouteName() == 'subjects.edit' ? 'active' : '' }}" href="{{ route('subjects.index') }}">List</a>
          <a class="collapse-item {{ Route::currentRouteName() == 'subjects.create' ? 'active' : '' }}"  href="{{ route('subjects.create') }}">Create</a>
        </div>
      </div>
    </li>

    

  </ul>