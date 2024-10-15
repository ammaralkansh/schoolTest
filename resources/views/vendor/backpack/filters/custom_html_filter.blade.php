<form method="GET" action="" class="form-inline mb-3">
    <input type="text" name="specialization" placeholder="التخصص" class="form-control mr-2">
    <select name="day" class="form-control mr-2">
        <option value="">اختر اليوم</option>
        <option value="Sunday">الأحد</option>
        <option value="Monday">الإثنين</option>
        <option value="Tuesday">الثلاثاء</option>
        <option value="Wednesday">الأربعاء</option>
        <option value="Thursday">الخميس</option>
        <option value="Friday">الجمعة</option>
        <option value="Saturday">السبت</option>
    </select>
    <input type="number" name="rate_min" placeholder="الراتب الأدنى" class="form-control mr-2" step="0.01">
    <input type="number" name="rate_max" placeholder="الراتب الأعلى" class="form-control mr-2" step="0.01">
    <select name="subject_id" class="form-control mr-2">
        <option value="">اختر المادة الدراسية</option>
        @foreach(\App\Models\Subject::all() as $subject)
            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">بحث</button>
</form>
