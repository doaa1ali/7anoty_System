<div class="sidebar">
     

        <div class="sidebar-main">
            <div class="sidebar-user">
                <img src="{{ asset('uploads/ImageWebsite/profile.jpg') }}" alt="User Profile">
                <div>
                    <h3>{{Auth::user()->name }}</h3>
                    <span>{{Auth::user()->email }}</span>
                </div>
            </div>
            <div class="sidebar-menu">
                <div class="menu-head"> إدارة المستخدمون</div>
                <ul>
                    <li><a href="{{route('auth.index')}}"><i class="fas fa-book"></i> المستخدمون</a></li>
                </ul>

                <div class="menu-head">إدارة الخدمات</div>
                <ul>
                    <li><a href="{{route('service.index')}}"><i class="fas fa-user-edit"></i> الخدمات</a></li>
                    <li><a href=""><i class="fas fa-tags"></i> العميل</a></li>
                </ul>

                <div class="menu-head">إدارة المقابر</div>
                <ul>
                    <li><a href=""><i class="fas fa-users"></i> المقابر</a></li>
                    <li><a href=""><i class="fas fa-exchange-alt"></i> حجوزات المقابر</a></li>
                    <li><a href=""><i class="fas fa-clock"></i> سجلات الدفن</a></li>
                </ul>

                <div class="menu-head">الإعدادات</div>
                <ul>
                    <li><a href=""><i class="fas fa-cogs"></i> الإعدادات</a></li>
                    <li><a href=""><i class="fas fa-shopping-bag"></i> المبيعات</a></li>
                </ul>
            </div>

        </div>
    </div>
