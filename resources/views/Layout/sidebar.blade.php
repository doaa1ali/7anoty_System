<div class="sidebar">


        <div class="sidebar-main">
            <div class="sidebar-user">
                @if(Auth::user()->image)
                    <img src="{{ asset('uploads/userimages/' . Auth::user()->image) }}" alt="User Profile">
                @else                   
                    <p><img src="{{ asset('uploads/userimages/1.png') }}" width="80" height="80" style="border-radius: 50%;"></p>
                @endif
                
                <div>
                    <h3>{{ Auth::user()->name }}</h3>
                    <span>{{ Auth::user()->email }}</span>
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
                    <li><a href="{{route('cemetery.index')}}"><i class="fas fa-users"></i> المقابر</a></li>
                    @if (auth()->check() && auth()->user()->type != 'creator')
                    
                    <div class="menu-head">إدارة الحجوزات</div>
                    <li><a href="{{route('order.index')}}"><i class="fas fa-exchange-alt"></i>سجلات الحجز</a></li>
                
                </ul>
                <ul>
                    <li><a href=""><i class="fas fa-cogs"></i> الإعدادات</a></li>
                    <li><a href=""><i class="fas fa-shopping-bag"></i> المبيعات</a></li>
                </ul>
                @endif
            </div>

        </div>
    </div>
