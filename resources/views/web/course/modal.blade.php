<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content px-5 pt-3 pb-5">
            <div class="title-register">Đăng ký khóa học</div>
            <button type="button" class="btn-close position-absolute" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="content-order-course">
                <div class="row">
                    <div class="col-md-6 pe-md-5">
                        <div class="title-left-popup">Khóa học</div>
                        <div class="box-list-course">
                            @foreach($courses as $item)
                                <div class="item-course {{ (!empty($data) && $item->id == $data->id)?'active':'' }}">
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <input class="course-select" value="{{ $item->id }}" data-price="{{ number_format($item->price_new, 0, ',', '.') }}đ" type="radio" name="course-check" id="course-{{ $item->id }}" {{ (!empty($data) && $item->id == $data->id)?'checked':'' }}>
                                            <label for="course-{{ $item->id }}">
                                                @include('web.components.image', ['src' => $item->image_resize['resize'], 'title' => $item->title])
                                            </label>
                                        </div>
                                        <div class="col-md-7">
                                            <label for="course-{{ $item->id }}">
                                                <div class="title-course-re">{{ $item->title }}</div>
                                                <p class="price-course-popup">{{ number_format($item->price_new, 0, ',', '.') }}đ</p>
                                                @if($item->price)
                                                <p class="price-old-course-popup">{{ number_format($item->price, 0, ',', '.') }}đ</p>
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="total-payment">
                            <span class="title-total">Tổng thanh toán:</span>
                            <span class="total-price-order" id="total-price-order">
                            {{ !empty($data) ? number_format($data->price_new, 0, ',', '.') : 0  }}đ
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 border-start ps-md-5">
                        <div class="title-left-popup">Thông tin khách hàng</div>
                        <p class="summary-for-popup">
                            Để đăng ký khóa học, Quý khách vui lòng điền đầy đủ các thông tin dưới đây. IELTS Trainer sẽ liên hệ xác nhận trong vòng 15 phút
                        </p>
                        <form action="{{ route('detailCourseStore') }}" class="form-in-detail-course" name="form-in-detail-course" id="form-in-detail-course" method="post">
                            @csrf
                            <div class="top-form">
                                <div class="form-group d-flex align-items-center">
                                    <div class="custom-control custom-radio me-5">
                                        <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" value="0" id="gender1" name="gender" checked>
                                        <label for="gender1" class="custom-control-label">Anh</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" value="1" id="gender2" name="gender">
                                        <label for="gender2" class="custom-control-label">Chị</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" value="{{ old('full_name') }}" class="form-control" name="full_name" placeholder="Họ và tên (bắt buộc)" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" value="{{ old('phone') }}" class="form-control" name="phone" placeholder="Số điện thoại (bắt buộc)" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" value="{{ old('email') }}" class="form-control" name="email" placeholder="Email (bắt buộc)" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" value="{{ old('address') }}" class="form-control" name="address" placeholder="Địa chỉ (không bắt buộc)">
                                    </div>
                                </div>
                                <textarea name="note" id="note" cols="30" rows="1" class="form-control" placeholder="Ghi chú thêm (Ví dụ: Giao hàng trong giờ hành chính)">{{ old('note') }}</textarea>
                                <hr>
                                <div class="form-group d-flex align-items-center">
                                    <div class="custom-control custom-radio me-5">
                                        <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" value="0" id="where_learn1" name="where_learn" checked>
                                        <label for="where_learn1" class="custom-control-label">Học online</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="radio" value="1" id="where_learn2" name="where_learn">
                                        <label for="where_learn2" class="custom-control-label">Học tại trung tâm</label>
                                    </div>
                                </div>
                                <input type="text" class="form-control" {{ old('voucher_course') }} name="voucher_course" placeholder="Mã giảm giá (Nếu có)">
                                <input type="hidden" name="product_id" id="product_id" min="0" value="{{ !empty($data) ? $data->id : '' }}">
                            </div>
                            <div class="title-left-popup">Thông tin thanh toán</div>
                            <div class="box-payment">
                                {!! $setting['info_payment'] !!}
                            </div>
                            <div class="d-none justify-content-between align-items-center box-payment">
                                <input class="form-check-input check-box-payment me-3" type="radio" value="1" id="method_pay" name="method_pay" checked>
                                <label class="d-flex justify-content-between align-items-center" for="method_pay">
                                    @include('web.components.image', ['src' => 'images/vnpay.png'])
                                    <span class="text-for-payment">
                                    <b>VNPay</b><br>
                                    Thẻ ATM / Internet Banking / Visa/ Master / American Express / JCB / VNPay QR
                                    </span>
                                </label>
                            </div>
                            <button class="form-control submit-form-popup" type="submit">Thanh toán ngay</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
