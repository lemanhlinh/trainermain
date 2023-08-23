@extends('admin.layouts.admin')
@section('link')
    @parent
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
    <style>
        .dd-empty {
            display: none;
        }
        .dd-handle{
            background: #58cbbb;
            font-size: 15px;
            height: 40px;
            line-height: 28px;
            cursor: pointer;
        }
        .dd-remove{
            cursor: pointer;
            background: red;
            display: inline-block;
            color: #fff;
            padding: 2px 13px;
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
@endsection
@section('title_file', trans('form.menu.'))

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <ul id="item-list">
                <li>
                    <input type="checkbox" id="home" value="0" data-link="{{ route('home') }}" data-name="Trang chủ"><label for="home">Trang chủ</label>
                </li>
                <li>
                    <input type="checkbox" id="home_program" value="0" data-link="{{ route('homeCourse') }}" data-name="Trang chủ khóa học"><label for="home_program">Trang chủ khóa học</label>
                </li>
                <li>
                    <input type="checkbox" id="home_article" value="0" data-link="{{ route('homeArticle') }}" data-name="Trang chủ tin tức"><label for="home_article">Trang chủ tin tức</label>
                </li>
                <li>
                    <input type="checkbox" id="home_contact" value="0" data-link="{{ route('detailContact') }}" data-name="Liên hệ"><label for="home_contact">Liên hệ</label>
                </li>
                <li>
                    <input type="checkbox" id="home_advisory" value="0" data-link="{{ route('detailAdvisory') }}" data-name="Tư vấn"><label for="home_advisory">Tư vấn</label>
                </li>
                <li>
                    <input type="checkbox" id="home_document" value="0" data-link="{{ route('homeDocument') }}" data-name="Tài liệu"><label for="home_document">Tài liệu</label>
                </li>
                <li>
                    <input type="checkbox" id="menu_other" value="0" data-link="#" data-name="Link bên ngoài"><label for="menu_other">Link bên ngoài</label>
                </li>
{{--
                @if(!empty($articles))--}}
{{--                    @foreach($articles as $k => $article)--}}
{{--                        <li>--}}
{{--                            <input type="checkbox" id="article_{{ $article->id }}" value="{{ $article->id }}"  data-link="{{ route('detailArticle',[$article->slug,$article->id]) }}" data-name="{{ $article->title }}"><label for="article_{{ $article->id }}">{{ $article->title }}</label>--}}
{{--                        </li>--}}
{{--                    @endforeach--}}
{{--                @endif--}}

                @if(!empty($pages))
                    @foreach($pages as $k => $page)
                        <li>
                            <input type="checkbox" id="pgae_{{ $page->id }}" value="{{ $page->id }}"  data-link="{{ route('detailPage',[$page->slug]) }}" data-name="{{ $page->title }}"><label for="page_{{ $page->id }}">{{ $page->title }}</label>
                        </li>
                    @endforeach
                @endif

            </ul>
            <button id="add-btn" class="btn btn-primary" data-url="{{ route('admin.menu.store') }}">Thêm vào menu</button>
        </div>
        <div class="col-sm-6">
            <select name="category_id" id="category_id">
                @foreach($menu_categories as $menu_category)
                    <option value="{{ $menu_category->id }}" {{ (isset($category_id) && $category_id == $menu_category->id) ?'selected':'' }}>{{ $menu_category->name }}</option>
                @endforeach
            </select>
            <div class="dd" id="nestable" data-url="{{ route('admin.menu.updateTree') }}">
                <ol class="dd-list">
                    @foreach ($menu as $shop)
                        @include('admin.menu.item', ['item'=>$shop])
                    @endforeach
                </ol>
            </div>
{{--            <button type="submit" class="btn btn-primary">@lang('form.button.update')</button>--}}
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script src="{{ asset('js/admin/jquery.nestable.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Lấy phần tử HTML của button "Add"
        var addBtn = document.getElementById('add-btn');

        // Lấy phần tử HTML của danh sách checkbox và danh sách đa cấp
        var itemList = document.getElementById('item-list');
        var nestable = document.getElementById('nestable');

        // Thêm sự kiện click cho button "Add"
        addBtn.addEventListener('click', function() {
            // Lấy tất cả các checkbox được chọn từ danh sách checkbox
            var checkedItems = itemList.querySelectorAll('input[type="checkbox"]:checked');

            // Duyệt qua tất cả các checkbox được chọn
            checkedItems.forEach(function(item) {
               handleAddData(item);
            });
        });

        let dd = $('.dd')
        dd.nestable({  }).on('change', function(){
            let dataOutput = dd.nestable('serialize');
            $('.dd-item').each(function() {
                let id = $(this).data('id');
                let name = $(this).find('input[id="update-name-'+id+'"]').val();
                let link = $(this).find('input[id="update-link-'+id+'"]').val();
                updateNameInNestedArray(dataOutput, id, name, link);
            });
            try {
                $.ajax({
                    type: "post",
                    url: dd.data('url'),
                    data: {
                        data: dataOutput,
                        _token : $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        // console.log(response);
                    }
                });
            } catch (error) {
                console.log(error);
            }
        });

        dd.on('click', '.dd-remove', function() {
            $(this).closest('.dd-item').remove();
            try {
                $.ajax({
                    type: "post",
                    url: $(this).attr("data-url"),
                    data: {
                        category_id: $('#category_id').val(),
                        _token : $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        Swal.fire(
                            'Đã xóa!',
                            'Đã xóa menu này!',
                            'success'
                        )
                        return response.id;
                    }
                });
            } catch (error) {
                console.log(error);
                throw error;
            }
        });

        function updateNameInNestedArray(arr, id, newName, link) {
            for (let i = 0; i < arr.length; i++) {
                if (arr[i].id === id) {
                    arr[i].name = newName;
                    arr[i].link = link;
                    return true; // trả về true nếu cập nhật thành công
                }
                if (arr[i].children) {
                    if (updateNameInNestedArray(arr[i].children, id, newName, link)) {
                        return true; // trả về true nếu cập nhật thành công
                    }
                }
            }
            return false; // trả về false nếu không tìm thấy phần tử với id tương ứng
        }

        async function addData(item) {
            try {
                await $.ajax({
                    type: "post",
                    url: $('#add-btn').attr("data-url"),
                    data: {
                        name: item.getAttribute("data-name"),
                        link: item.getAttribute("data-link"),
                        category_id: $('#category_id').val(),
                        _token : $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        return response.id;
                    }
                });
            } catch (error) {
                console.log(error);
                throw error;
            }
        }

        async function handleAddData(item) {
            try {
                const data_id = await addData(item);
                // Tạo phần tử mới cho danh sách đa cấp
                let newItem = document.createElement('li');
                newItem.classList.add('dd-item');
                newItem.setAttribute('data-id', data_id);
                newItem.setAttribute("data-name", item.getAttribute("data-name"));
                newItem.setAttribute('data-link', item.getAttribute("data-link"));

                // Tạo phần tử cho tay cầm
                let handle = document.createElement('div');
                handle.classList.add('dd-handle');
                handle.textContent = item.getAttribute("data-name");

                let remove = document.createElement('div');
                remove.classList.add('dd-remove');
                remove.setAttribute('data-url', data_id);
                remove.textContent = 'Xóa';

                let handleInput = document.createElement('input');
                handleInput.classList.add('form-control');
                handleInput.setAttribute('value', item.getAttribute("data-name"));
                handleInput.id = 'update-name-'+data_id;

                let handleInputLink = document.createElement('input');
                handleInputLink.classList.add('form-control');
                handleInputLink.setAttribute('value', item.getAttribute("data-link"));
                handleInputLink.id = 'update-link-'+data_id;

                // Thêm tay cầm vào phần tử mới
                newItem.appendChild(handle);
                newItem.appendChild(remove);
                newItem.appendChild(handleInput);
                newItem.appendChild(handleInputLink);

                // Thêm phần tử mới vào danh sách đa cấp
                nestable.querySelector('.dd-list').appendChild(newItem);
                location.reload();
            } catch (error) {
                console.log(error);
            }
        }

        const selectElement = document.getElementById('category_id');
        let initialSelectedValue = selectElement.value;

        selectElement.addEventListener('change', (event) => {
            Swal.fire({
                title: 'Bạn có chắc chắn không?',
                text: "Thông tin chưa lưu sẽ mất",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const selectedRoute = event.target.value;
                    window.location.href = `{{ route('admin.menu.index') }}?category_id=${selectedRoute}`;
                }else {
                    // Gán giá trị ban đầu lại cho select option nếu nhấn "Cancel"
                    selectElement.value = initialSelectedValue;
                }
            })

        });
    </script>
@endsection
