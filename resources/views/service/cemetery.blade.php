
<x-auth_layout word="اضافه مقبره">

<div class="container">
    <div class="register-box">

        <a href="/"><button class="close-btn" >x</button></a>
        <h2> اضافه مقبره</h2>
        <form action="{{ route('addcemetery') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="input-group">
                <label for="name">الاسم:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="input-group">
                <label for="description">الوصف:</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
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
                <label for="size">المساحة (م²):</label>
                <input type="text" id="size" name="size" value="{{ old('size') }}">
            </div>

            <div class="input-group">
                <label for="image">صورة المقبرة:</label>
                <input type="file" id="image" name="image">
            </div>


            <div class="input-group">
                <label for="price">السعر:</label>
                <input type="text" id="price" name="price" value="{{ old('price') }}">
            </div>

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

            <button type="submit" class="btn">اضافه</button><br><br>
        </form>
    </div>
</div>




</x-auth_layout>
