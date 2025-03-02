<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-center flex-grow-1">🛒 سلة المشتريات</h2>
            <button onclick="window.history.back();" class="btn btn-secondary">⬅️ رجوع</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center mt-3">{{ session('success') }}</div>
        @endif

        @if(!empty($cart) && count($cart) > 0)
            <table class="table table-bordered text-center mt-4">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>الاسم</th>
                        <th>السعر</th>
                        <th>إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $index => $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td><strong class="text-success">{{ number_format($item['price']) }} جنيه</strong></td>
                            <td>
                                <a href="{{ route('cart.remove', $index) }}" class="btn btn-danger">🗑️ حذف</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 class="text-center mt-3">💰 الإجمالي: <span class="text-primary">{{ number_format($totalPrice) }}</span> جنيه</h3>

            <div class="text-center mt-4">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning text-white px-4 py-2" style="font-size: 1.2rem; font-weight: bold;">
                        🛍️ إتمام الطلب
                    </button>
                </form>
            </div>
        @else
            <div class="alert alert-info text-center mt-4">سلة المشتريات فارغة! 🛒</div>
        @endif
    </div>
</div>
