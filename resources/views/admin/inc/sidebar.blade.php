<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      
           
      <li class="nav-item">
        <a href="{{route('admin.dashboard')}}" class="nav-link  {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('alladmin')}}" class="nav-link {{ (request()->is('admin/new-admin*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Admin
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route('allUser')}}" class="nav-link {{ (request()->is('admin/new-user*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            All User
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('allStaff')}}" class="nav-link {{ (request()->is('admin/staff*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            All Staff
          </p>
        </a>
      </li>

      <li class="nav-item dropdown {{ (request()->is('admin/get-new*') || request()->is('admin/get-processing*') || request()->is('admin/job*') || request()->is('admin/get-complete*') || request()->is('admin/get-cancel*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link dropdown-toggle {{ (request()->is('admin/get-new*') || request()->is('admin/get-processing*') || request()->is('admin/get-complete*') || request()->is('admin/get-cancel*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Jobs
                  <i class="fas fa-angle-left right"></i>
              </p>
          </a>
          <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="{{ route('admin.job') }}" class="nav-link {{ (request()->is('admin/job*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Create</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.new') }}" class="nav-link {{ (request()->is('admin/get-new*')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>New Job</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.processing') }}" class="nav-link {{ (request()->is('admin/get-processing*')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>In Progress</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.complete') }}" class="nav-link {{ (request()->is('admin/get-complete*')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Completed</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('admin.cancel') }}" class="nav-link {{ (request()->is('admin/get-cancel*')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Cancelled</p>
                  </a>
              </li>
          </ul>
      </li>

      <li class="nav-item">
        <a href="{{route('allTransactions')}}" class="nav-link {{ (request()->is('admin/all-transaction*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            All Transaction
          </p>
        </a>
      </li>

     

      <li class="nav-item">
        <a href="{{route('allUserDeleteReq')}}" class="nav-link {{ (request()->is('admin/user-delete-request*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Account Delete Request
          </p>
        </a>
      </li>
      
      <li class="nav-item">
        <a href="{{route('allcategory')}}" class="nav-link {{ (request()->is('admin/category*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Work Categories
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('admin.companyDetail')}}" class="nav-link {{ (request()->is('admin/company-details*')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Company Details
          </p>
        </a>
      </li>

      <li class="nav-item dropdown {{ (request()->is('admin/reviews*') || request()->is('admin/quotes*')) ? 'menu-open' : '' }}">
          <a href="#" class="nav-link dropdown-toggle {{ (request()->is('admin/reviews*') || request()->is('admin/quotes*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                  Feedbacks
                  <i class="fas fa-angle-left right"></i>
              </p>
          </a>
          <ul class="nav nav-treeview"> 
              <li class="nav-item">
                <a href="{{ route('allReviews') }}" class="nav-link {{ (request()->is('admin/reviews*')) ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Reviews</p>
                </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('allQuotes') }}" class="nav-link {{ (request()->is('admin/quotes*')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Quotes</p>
                  </a>
              </li>
          </ul>
      </li>
  
    </ul>
  </nav>