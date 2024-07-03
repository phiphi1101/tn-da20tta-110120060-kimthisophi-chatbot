<html>
    <body>
        <script type="module">
            import Chatbot from "https://cdn.jsdelivr.net/npm/flowise-embed/dist/web.js"
            Chatbot.init({
                chatflowid: "2732fe41-3e2b-4268-8b12-877f56482e87",
               // headers = {"Authorization": "Bearer paBA5MWZBBQ99GMJaMUCqtb6BCmbMmO+pAz4Vag8Gsg="}
                apiHost: "http://localhost:3000",
                theme: {
                button: {
                    backgroundColor: "#3B81F6",
                    right: 20,
                    bottom: 20,
                    size: "medium",
                    iconColor: "blue",
                    customIconSrc:"{{ asset('UserLTE/assets/images/banner_NTL/chatmess.png') }}",
                },
                chatWindow: {
                    showTitle: true,
                    title: 'Chatbot Manis Stylish Fashion',
                    titleAvatarSrc: "{{ asset('UserLTE/assets/images/banner_NTL/logo.png') }}",
                    welcomeMessage: "Mani's Stylish Fashion xin chào!. Tôi có thể giúp gì cho bạn?",
                    backgroundColor: "#ffffff",
                    height: 600,
                    width: 400,
                    fontSize: 16,
                    poweredByTextColor: "#303235",
                    botMessage: {
                        backgroundColor: "#f7f8ff",
                        textColor: "#303235",
                        showAvatar: true,
                        avatarSrc: "{{ asset('UserLTE/assets/images/banner_NTL/chatbot.png') }}",
                    },
                    userMessage: {
                        backgroundColor: "#FF66FF",
                        textColor: "#ffffff",
                        showAvatar: true,
                        avatarSrc: "{{ asset('UserLTE/assets/images/banner_NTL/user.png') }}",
                    },
                    textInput: {
                        placeholder: "Hãy nhập câu hỏi của bạn ",
                        backgroundColor: "#FF99F",
                        textColor: "#303235",
                        sendButtonColor: "#3B81F6",
                    }
                }
            }
            })
        </script>
    </body>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- @yield('title') --}}
    <title>Mani's Stylish Fashion</title>
    <meta name="keywords" content="HTML5">
    <meta name="description" content="">
    <meta name="author" content="p-themes">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('UserLTE/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('UserLTE/assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('UserLTE/assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('UserLTE/assets/css/plugins/jquery.countdown.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('UserLTE/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('UserLTE/assets/css/skins/skin-demo-3.css') }}">
    <link rel="stylesheet" href="{{ asset('UserLTE/assets/css/demos/demo-3.css') }}">
    <link rel="stylesheet" href="{{ asset('UserLTE/assets/css/plugins/nouislider/nouislider.css') }}">
    @yield('css')
</head>

<body>
    <div class="page-wrapper">
        @include('components.header')

        @yield('content')

        @include('components.footer')
    </div>

    <!-- Plugins JS File -->
    <script src="{{ asset('UserLTE/assets/js//jquery.min.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//superfish.min.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//owl.carousel.min.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//jquery.elevateZoom.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('UserLTE/assets/js//main.js') }}"></script>
    <script src="{{ asset('UserLTE/assets/js//demos/demo-3.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @yield('js')

</body>

</html>
