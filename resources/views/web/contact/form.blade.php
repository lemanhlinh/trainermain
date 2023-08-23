<div class="row mb-3">
    <div class="col-md-6">
        <input type="text" class="form-control" name="full_name" placeholder="Họ và tên" value="{{ old('full_name') }}" required>
    </div>
    <div class="col-md-6">
        <input type="number" class="form-control" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}"  pattern="^0\d{9}$" required>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
    </div>
    <div class="col-md-6">
        <select type="text" class="form-control" name="title" required>
            <option value="" disabled selected>Bạn muốn liên hệ chúng tôi vì?</option>
            <option value="Tư vấn khóa học">Tư vấn khóa học</option>
            <option value="Đăng ký thi thử/học thử">Đăng ký thi thử/học thử</option>
            <option value="Khác">Khác</option>
        </select>
    </div>
</div>
<div class="content-form mb-3">
    <textarea cols="30" rows="5" name="content" placeholder="Nội dung" class="form-control" required>{{ old('content') }}</textarea>
</div>
