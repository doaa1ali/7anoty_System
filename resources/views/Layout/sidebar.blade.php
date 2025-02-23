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
                <div class="menu-head">المستخدمون</div>
                <ul>
                    <li><a href="{{route('auth.index')}}"><i class="fas fa-book"></i> المشرف</a></li>
                    <li><a href=""><i class="fas fa-user-edit"></i> منشئ المحتوى</a></li>
                    <li><a href=""><i class="fas fa-tags"></i> العميل</a></li>
                </ul>

                <div class="menu-head">إدارة المقابر</div>
                <ul>
                    <li><a href=""><i class="fas fa-users"></i> المقابر</a></li>
                    <li><a href=""><i class="fas fa-exchange-alt"></i> حجوزات المقابر</a></li>
                    <li><a href=""><i class="fas fa-clock"></i> سجلات الدفن</a></li>
                    <li><a href="/hall/index"><i class="fas fa-clock"></i>دار مناسبات</a></li>

                </ul>

                <div class="menu-head">الإعدادات</div>
                <ul>
                    <li><a href=""><i class="fas fa-cogs"></i> الإعدادات</a></li>
                    <li><a href=""><i class="fas fa-shopping-bag"></i> المبيعات</a></li>
                </ul>
            </div>

        </div>
    </div>
