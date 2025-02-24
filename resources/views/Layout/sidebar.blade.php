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
            @if (auth()->check() && auth()->user()->type != 'creator')

                <div class="menu-head"> إدارة المستخدمون</div>
                <ul>
                    <li><a href="{{route('auth.index')}}"><i class="fas fa-book"></i> المستخدمون</a></li>
                </ul>
                @endif
                

                <div class="menu-head">إدارة الخدمات</div>
                <ul>
                    <li><a href="{{route('service.index')}}"><i class="fas fa-user-edit"></i> الخدمات</a></li>
                    <li><a href="/hall/index"><i class="fas fa-clock"></i>دار مناسبات</a></li>
                </ul>
               
                <div class="menu-head">إدارة المقابر</div>
                <ul>
                    <li><a href="{{route('cemetry.index')}}"><i class="fas fa-users"></i> المقابر</a></li>
                    @if (auth()->check() && auth()->user()->type != 'creator')
                    <li><a href="{{route('cemetry.index')}}"><i class="fas fa-exchange-alt"></i> حجوزات المقابر</a></li>
                    <li><a href=""><i class="fas fa-clock"></i> سجلات الدفن</a></li>
                    

                </ul>
              
                <ul>
                    <li><a href=""><i class="fas fa-cogs"></i> الإعدادات</a></li>
                    <li><a href=""><i class="fas fa-shopping-bag"></i> المبيعات</a></li>
                </ul>
                @endif
            </div>

        </div>
    </div>
