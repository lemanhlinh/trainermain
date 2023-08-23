function renderLabelActive(data) {
    var mapStatus = {
        1: {text: 'Hoạt động', class: 'success'},
        0: {text: 'Khóa', class: 'danger'},
    };
    return '<span class="badge badge-' + mapStatus[data]['class'] + '">'
        + mapStatus[data]['text'] +
        '</span>';
}

function renderLabelGender(data) {
    if (data == null) return '';
    var mapStatus = {
        2: {text: 'Khác', class: 'info'},
        1: {text: 'Nữ', class: 'success'},
        0: {text: 'Nam', class: 'primary'},
    };
    return '<span class="badge badge-' + mapStatus[data]['class'] + '">'
        + mapStatus[data]['text'] +
        '</span>';
}

function renderAvatar(data) {
    var host = window.location.origin;
    return '<img src="' + host + data + '" width="200px" >';
}

function renderLabelTypeOrder(data) {
    var mapStatus = {
        1: {text: 'Bảo mật', class: 'danger'},
        0: {text: 'Công khai', class: 'success'},
    };
    return '<span class="badge badge-' + mapStatus[data]['class'] + '">'
        + mapStatus[data]['text'] +
        '</span>';
}

function renderLabelStatus(data) {
    var mapStatus = {
        1: {text: 'Công khai', class: 'success'},
        0: {text: 'Bảo mật', class: 'danger'},
    };
    return '<span class="badge badge-' + mapStatus[data]['class'] + '">'
        + mapStatus[data]['text'] +
        '</span>';
}

function renderLabelShowHomeOrder(data) {
    var mapStatus = {
        1: {text: 'Hiện', class: 'success'},
        0: {text: 'Ẩn', class: 'danger'},
    };
    return '<span class="badge badge-' + mapStatus[data]['class'] + '">'
        + mapStatus[data]['text'] +
        '</span>';
}


function renderPageViewValue(data) {
    var mapStatus = {
        1: {text: 'Trang khóa học', class: 'danger'},
        0: {text: 'Trang chủ', class: 'success'},
    };
    return '<span class="badge badge-' + mapStatus[data]['class'] + '">'
        + mapStatus[data]['text'] +
        '</span>';
}

function renderLabelOrderStatus(data) {
    var mapStatus = {
        0: {text: 'Đang xử lý', class: 'dark'},
        1: {text: 'Đã hoàn tất', class: 'primary'},
        2: {text: 'Đã hủy', class: 'danger'},
    };
    return '<span class="badge badge-' + mapStatus[data]['class'] + '">'
        + mapStatus[data]['text'] +
        '</span>';
}

function renderLabelOrderTraineeStatus(data) {
    let mapStatus = {
        0: {text: 'Sơ loại', class: 'dark'},
        1: {text: 'Phỏng vấn', class: 'primary'},
        2: {text: 'Đỗ', class: 'success'},
        3: {text: 'DS Chờ', class: 'danger'},
    };
    return '<span class="badge badge-' + mapStatus[data]['class'] + '">'
        + mapStatus[data]['text'] +
        '</span>';
}

function renderDataAsBadge(data) {
    var html = '';
    data.map(function (item) {
        html += '<span class="badge badge-success">' + item + '</span> ';
    })
    return html;
}

function renderImage(data) {
    if (data == null) return ''
    var host = window.location.origin;
    return '<img src="' + host + data + '" width="200px" >';
}

function renderFileSoundQuestion(data) {
    if (data == null) return ''
    var host = window.location.origin;
    return '<audio src="' + host + data + '" controls="controls"></audio>';
}

function renderLinkUpdateQuestion(data) {
    if (data) return '<a href="' + data.link + '" target="_blank" >' + data.value + '</a>';
    return '';
}

function renderQuestionsChildren(data) {
    if (data == null || data == '') return ''
    var html = '';
    data.map(function (item) {
        html += '- <a href="' + item.link + '" target="_blank" >' + item.value + '</a> <br>';
    })
    return html;
}

function renderLink(data) {
    if (data) return '<a href="' + data + '" target="_blank" > Click để xem chi tiết </a>';
    return '';
}

function renderIsTestLesson(data) {
    var mapStatus = {
        1: {text: 'Mở kiểm tra bài học', class: 'success'},
        0: {text: 'Khóa kiểm tra bài học', class: 'danger'},
    };
    return '<span class="badge badge-' + mapStatus[data]['class'] + '">'
        + mapStatus[data]['text'] +
        '</span>';
}
