
<x-auth_layout word="تقديم الخدمات">

    <div class="register-container">
        <div class="register-box">

            <a href="/"><button class="close-btn" >x</button></a>
            <h2>نوع الخدمه</h2>
            <form action="{{route('service.handle')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="input-group">
                    <select name="type" id="type">
                        <option value="cemetery">مقبرة</option>
                        <option value="hall">دار مناسبات</option>
                        <option value="other">  خدمه اخري</option>
                    </select>
                </div>

                <button type="submit" class="btn"> اضافه</button><br>
            </form>
        </div>
    </div>
</x-auth_layout>
