<div class="test-online">


    <!-- Modal -->
    <div class="modal fade" id="downloadDocument" tabindex="-1" aria-labelledby="downloadDocumentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="downloadDocumentLabel">Tải tài liệu tham khảo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('detailDocumentStore') }}" method="post" name="test-online" id="test-online">
                    @csrf
                    <div class="modal-body">
                        <p>Để tải tài liệu IELTS, Quý khách vui lòng điền đầy đủ các thông tin dưới đây để tiến hành tải tài liệu.</p>
                        <input type="text" class="form-control mb-3" value="{{ old('full_name')?old('full_name'):'' }}" placeholder="Họ và tên" name="full_name" required>
                        <input type="number" class="form-control mb-3" value="{{ old('phone')?old('phone'):'' }}" placeholder="Số điện thoại" name="phone" required>
                        <input type="email" class="form-control mb-3" value="{{ old('email')?old('email'):'' }}" placeholder="Email" name="email" required>
                        <input type="hidden" name="file" value="{{ asset($document->file) }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger text-center w-100">Tải ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
