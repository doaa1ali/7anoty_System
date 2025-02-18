<div class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-flex">
                <h3>Library System</h3>
                <div class="brand-icons">
                    <i class="fa-solid fa-bell"></i>
                    <i class="fa-solid fa-user-circle"></i>
                </div>
            </div>
        </div>

        <div class="sidebar-main">
            <div class="sidebar-user">
                <img src="{{ asset('uploads/ImageWebsite/profile.jpg') }}" alt="User Profile">
                <div>
                    <h3>{{Auth::user()->name }}</h3>
                    <span>{{Auth::user()->email }}</span>
                </div>
             </div>
             <div class="sidebar-menu">
                <div class="menu-head">users</div>
                <ul>
                    <li><a href=""><i class="fas fa-book"></i> admin</a></li>
                    <li><a href=""><i class="fas fa-user-edit"></i> creator</a></li>
                    <li><a href=""><i class="fas fa-tags"></i> customer</a></li>
                </ul>

                <div class="menu-head">tombs Management</div>
                <ul>
                    <li><a href=""><i class="fas fa-users"></i> tombs</a></li>
                    <li><a href=""><i class="fas fa-exchange-alt"></i> Borrowings</a></li>
                    <li><a href=""><i class="fas fa-clock"></i> Late Returns</a></li>
                </ul>

                <div class="menu-head">Settings</div>
                <ul>
                    <li><a href=""><i class="fas fa-cogs"></i> Settings</a></li>
                    <li><a href=""><i class="fas fa-shopping-bag"></i> Sales</a></li>
                </ul>
            </div>
        </div>
    </div>
