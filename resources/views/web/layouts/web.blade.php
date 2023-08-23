@extends('web.layouts.app')
@section('page')
    <div id="app">
        <!-- Header -->
        @include('web.partials._header')
        <!-- /.Header -->
        <div class="content">
            @yield('content')
        </div>
        <!-- Main Footer -->
        @include('web.partials._footer')
        @include('web.partials._modal')
    </div>
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('/css/web/style.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="{{ asset('/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/web/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('/js/web/slick/slick-theme.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/web/main.js') }}" defer></script>
    <!-- Bootstrap -->
    <script src="{{ asset('/js/web/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('/js/web/slick/slick.js') }}"></script>
    <script>
        function showNotification(message) {
            var notification = document.getElementById("notification");
            notification.innerHTML = message;
            notification.classList.add("show");
            setTimeout(function(){
                notification.classList.remove("show");
            }, 5000);
        }
        function generateFakeNotification() {
            var messages = [
                @forelse($program_all as $k => $item)
                    {
                        text: "{{ $item->title }}",
                        notificationText: "{{ $item->total_day }}",
                        time: "{{ $item->total_time }}"
                    },
                @empty
                @endforelse
            ];

            var randomIndex = Math.floor(Math.random() * messages.length);
            var randomMessage = messages[randomIndex];

            var messageHTML = document.createElement("div");
            messageHTML.classList.add("message_ielts");

            var pulseHTML = document.createElement("div");
            pulseHTML.classList.add("pulse");

            var rightHTML = document.createElement("div");
            rightHTML.classList.add("message_ielts_right");

            var boldElement = document.createElement("b");
            boldElement.innerText = randomMessage.text;

            var paragraphElement = document.createElement("p");
            paragraphElement.innerText = randomMessage.notificationText;

            var spanElement = document.createElement("span");
            spanElement.innerText = randomMessage.time;

            messageHTML.appendChild(pulseHTML);
            messageHTML.appendChild(rightHTML);
            rightHTML.appendChild(boldElement);
            rightHTML.appendChild(paragraphElement);
            rightHTML.appendChild(spanElement);

            showNotification(messageHTML.outerHTML);
        }

        setInterval(generateFakeNotification, 10000);
    </script>
    <script>
        let toastrSuccsee = '{{ Session::get('success') }}';
        let toastrDanger = '{{ Session::get('danger') }}';
        if (toastrDanger.length > 0 || toastrSuccsee.length > 0) {
            if (toastrDanger.length > 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: toastrDanger,
                })
                toastr["error"](toastrDanger)
            } else {
                Swal.fire(
                    'Thành công!',
                    toastrSuccsee,
                    'success'
                )
            }
        }

        $('.list-social-mobile').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        arrows: false
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false,
                        arrows: false
                    }
                }
            ]
        });
    </script>
@endsection
