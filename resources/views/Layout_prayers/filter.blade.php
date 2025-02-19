
<div class="container">

    <div class="filter-container">
        <h3>تصفية الادعية والاذكار</h3>
        <div class="filter-section">
            <label>نوع الدعاء:</label>
            <div class="filter-item"><input type="checkbox"> دعاء الميت</div>
            <div class="filter-item"><input type="checkbox"> دعاء الصباح</div>
            <div class="filter-item"><input type="checkbox"> دعاء السفر</div>
            <div class="filter-item"><input type="checkbox"> دعاء الاستخارة</div>
        </div><br><br>

        <button class="filter-btn">تصفية <i class="fa fa-filter"></i></button>
    </div>
    <div class="prayers-container">
        @include('Layout_prayers.prayers')
    </div>

</div>