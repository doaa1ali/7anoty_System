
<div class="container">

    <div class="filter-container">
        <h3>تصفية الخدمات</h3>
        <div class="filter-section">
            <label>القسم:</label>
            <div class="filter-item"><input type="checkbox"> دفن</div>
            <div class="filter-item"><input type="checkbox"> نقل الموتى</div>
            <div class="filter-item"><input type="checkbox"> غسل وتكفين</div>
            <div class="filter-item"><input type="checkbox"> مراسم الجنازة</div>
        </div><br><hr><br>


        <div class="filter-section">
            <label>المحافظة:</label>
            <div class="filter-item"><input type="checkbox"> القاهرة</div>
            <div class="filter-item"><input type="checkbox"> الإسكندرية</div>
            <div class="filter-item"><input type="checkbox"> أسيوط</div>
            <div class="filter-item"><input type="checkbox"> الجيزة</div>
            <div class="filter-item"><input type="checkbox"> القاهرة</div>
            <div class="filter-item"><input type="checkbox"> الإسكندرية</div>
            <div class="filter-item"><input type="checkbox"> أسيوط</div>
            <div class="filter-item"><input type="checkbox"> الجيزة</div>
        </div><br><hr><br>

        <div class="filter-section">
            <label>السعر:</label>
            <div class="filter-item"><input type="checkbox"> أقل من 500 جنيه</div>
            <div class="filter-item"><input type="checkbox"> من 500 - 1000 جنيه</div>
            <div class="filter-item"><input type="checkbox"> أكثر من 1000 جنيه</div>
        </div><br>

        <button class="filter-btn">تصفية <i class="fa fa-filter"></i></button>
    </div>

    <div class="service-container">
        @include('Layout_service.services')
    </div>

</div>