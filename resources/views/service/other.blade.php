
<x-auth_layout word=" اضافه خدمه اخري">

<div class="container">
    <div class="register-box">

        <a href="/"><button class="close-btn" >x</button></a>
        <h2> اضافه خدمه اخري</h2>
        <form action="{{ route('addotherservice') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
    <label for="name">الاسم:</label>
    <select id="name" name="name" required>
        <option value="" disabled selected>اختر الخدمة</option>
        <option value="تغسيل وتجهيز الموتى">تغسيل وتجهيز الموتى</option>
        <option value="خدمات نقل الجثمان">خدمات نقل الجثمان</option>
        <option value="إجراءات تصريح الدفن">إجراءات تصريح الدفن</option>
        <option value="توفير الأئمة والمشايخ للجنائز">توفير الأئمة والمشايخ للجنائز</option>
        <option value="توفير حانوتي للدفن">توفير عمال للدفن</option>
        <option value="إعداد وإرسال النعي">إعداد وإرسال النعي</option>
    </select>
    @error('name') <p class="error">{{ $message }}</p> @enderror
    </div>

            <div class="input-group">
                <label for="description">الوصف:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="input-group">
                <label for="price">السعر:</label>
                <input type="text" id="price" name="price" value="{{ old('price') }}">
            </div>


            <div class="input-group">
                <label for="location">الموقع:</label>
                <input type="text" id="location" name="location" value="{{ old('location') }}">
            </div>

           <!--  -->
           <div class="input-group">
            <label for="mapSearch">ابحث عن موقع:</label>
            <input type="text" id="mapSearch" placeholder="ابحث عن الموقع">
            <button type="button" onclick="searchInMap()">بحث</button>

                <div id="map-container">
                    <iframe
                        id="mapFrame"
                        width="100%"
                        height="300"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        src="https://www.google.com/maps?q=30.0444,31.2357&z=15&output=embed">
                    </iframe>
                </div>

                <input type="hidden" id="lat" name="lat">
                <input type="hidden" id="long" name="long">
            </div>
            <!--  -->

            <div class="input-group">
                <label for="is_discount">هل هناك خصم؟</label>
                <select id="is_discount" name="is_discount">
                    <option value="0">لا</option>
                    <option value="1">نعم</option>
                </select>
            </div>

            <div class="input-group">
                <label for="discount">قيمة الخصم:</label>
                <input type="text" id="discount" name="discount" value="{{ old('discount') }}" placeholder="ادخل نسبه مئويه من 0:100">
            </div>

            <div class="input-group">
                    <label for="start_time">وقت البداية:</label>
                    <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                </div>

                <div class="input-group">
                    <label for="end_time">وقت النهاية:</label>
                    <input type="time" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                </div>


            <div class="input-group">
                <label for="image">صورة الخدمه:</label>
                <input type="file" id="image" name="image">
            </div>

            <button type="submit" class="btn">اضافه</button><br><br>
        </form>
    </div>
</div>




</x-auth_layout>
