<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <style>
        :root {
            --waba-primary-color: #1FC36C;
            --waba-secondary-color: #D6F5E5;
            --waba-third-color: #F9FAFB;
            /* --waba-secondary-color: #E1F8E8; */
        }

        .button-waba {
            background-color: var(--waba-primary-color);
            color: white;
            padding: 12px 20px;
            /* width: 200px; */
            border-radius: calc(infinity * 1px);
            cursor: pointer;
        }

        .button-waba-outline {
            background-color: transparent;
            color: var(--waba-primary-color);
            padding: 12px 20px;
            width: 200px;
            border: 1px solid var(--waba-primary-color);
            border-radius: calc(infinity * 1px);
            cursor: pointer;
        }

        .button-waba-outline:hover {
            background-color: var(--waba-primary-color);
            color: white;
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }

        .badge-waba {
            background-color: var(--waba-secondary-color);
            border-radius: calc(infinity * 1px);
            color: var(--waba-primary-color);
            font-size: 14px;
            font-weight: bold;
            padding: 7px 16px;
        }

        #navLinks a.mainmenu {
            padding: 0px 8px;
            font-weight: 500;
            font-size: 14px;
        }
    </style>

    @yield('css')
</head>
<body class="bg-gradient-to-b from-gray-200 to-gray-50">
    <div class="fixed top-5 w-full z-10">
    {{-- <div class="mt-5 w-full z-10"> --}}
        <header class="container mx-auto px-5">
            <nav class="relative flex justify-between items-center bg-white px-10 py-3 mx-auto rounded-full">
                <a href="{{ url('/')}}">
                    <img class="h-[20px]" src="{{ asset('landing-page/images/retentia.png') }}" />
                </a>

                <div id="navLinks" class="md:static absolute top-[-300px] md:w-auto w-full left-0 bg-white rounded-2xl font-bold z-[100]">
                    <div class="flex md:flex-row flex-col md:items-center md:gap-5 gap-2 md:p-0 p-4">
                        <a class="mainmenu" href="{{ url('#problem-n-solution') }}">Problem & Solution</a>
                        <a class="mainmenu" href="{{ url('#how-it-works') }}">How it work</a>
                        <a class="mainmenu" href="{{ url('#features') }}">Features</a>
                        <a class="mainmenu" href="{{ url('#benefits') }}">Benefits</a>
                        <a class="mainmenu" href="{{ url('#pricing') }}">Pricing</a>
                        <a class="md:hidden block bg-[#1FC36C] text-white px-5 py-1 w-full rounded-full cursor-pointer text-center" href="https://wa.me/6283199294607?text=Halo Retentia %F0%9F%91%8B" target="_blank">Get Started</a>
                    </div>
                </div>

                <div class="flex items-center">
                    <a class="bg-[#1FC36C] text-white px-5 py-2 rounded-full cursor-pointer md:block hidden text-center" href="https://wa.me/6283199294607?text=Halo Retentia %F0%9F%91%8B" target="_blank">Get Started</a>
                    <ion-icon id="btnDropDownMenu" onclick="onToggleMenu(this);" class="md:hidden text-3xl cursor-pointer" name="menu-outline"></ion-icon>
                </div>
            </nav>
        </header>
    </div>

    <div class="relative md:mt-40 mt-8">
        @yield('content')
    </div>

    <footer class="container mx-auto px-5">
        <div class="bg-white rounded-2xl md:p-10 p-5">
            <div class="grid md:grid-cols-12 grid-cols-1 md:grid-flow-col grid-flow-row md:gap-0 gap-5">
                <div class="md:col-span-4">
                    <a class="" href="{{ url('/')}}">
                        <img class="mb-2 h-[20px]" src="{{ asset('landing-page/images/retentia.png') }}" />
                    </a>
                    Build Loyalty. Effortlessly
                </div>
                <div class="md:col-span-8">
                    <div class="grid md:grid-cols-4 grid-cols-1 md:grid-flow-col grid-flow-row gap-5">
                        <div>
                            <p class="text-[20px] font-bold mb-3">Product</p>
                            <p><a href="#">Features</a></p>
                        </div>
                        <div>
                            <p class="text-[20px] font-bold mb-3">Company</p>
                            {{-- <a href="{{ url('about-us') }}">About Us</a><br /> --}}
                            <p class="mb-3"><a href="{{ url('faq') }}">FAQ</a></p>
                            <p><a href="#">Contact</a></p>
                        </div>
                        <div>
                            <p class="text-[20px] font-bold mb-3">Legal</p>
                            <p class="mb-3"><a href="{{ url('terms-n-conditions') }}">Terms and Conditions</a></p>
                            <p><a href="{{ url('privacy-policy') }}">Privacy Policy</a></p>
                        </div>
                        <div>
                            <p class="text-[20px] font-bold mb-3">Language</p>
                            <div class="flex items-center mb-3">
                                <img class="h-[16px] mr-3" src="{{ asset('landing-page/images/emojione_flag-for-indonesia (1).png') }}" />
                                <a href="#">Bahasa Indonesia</a>
                            </div>
                            <div class="flex items-center justify-between w-[200px]">
                                <div class="flex items-center">
                                    <img class="h-[16px] mr-3" src="{{ asset('landing-page/images/circle-flags_uk (1).png') }}" />
                                    <a href="#" class="text-[var(--waba-primary-color)]">English</a>
                                </div>
                                <ion-icon class="text-2xl text-green-500" name="checkmark-outline"></ion-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-10 p-5">&nbsp;</div>
            <hr class="mb-4">
            <p class="text-center md:text-[16px] text-[14px]">© 2025 Retentia | Crafted with passion and purpose by <a href="https://algostudio.net/" class="text-green-500 font-bold">AlgoStudio</a>.</p>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    @yield('script')

    <script>
        function onToggleMenu(e){
            const navLinks = document.getElementById('navLinks');
            e.name = e.name === 'menu-outline' ? 'close-outline' : 'menu-outline';
            navLinks.classList.toggle('top-[70px]')
        }

        document.addEventListener('click', function(event) {
            const dropdownButton = event.target.closest('#btnDropDownMenu');

            if(!dropdownButton){
                const navLinks = document.getElementById('navLinks');
                const dropdownButtonElement = document.getElementById('btnDropDownMenu');

                // console.log("Clicked outside the dropdown button");
                dropdownButtonElement.name = 'menu-outline';

                const hasShown = navLinks.classList.contains('top-[70px]');
                if(hasShown) {
                    navLinks.classList.toggle('top-[70px]')
                }
            }
        });

        // $(document).on('click', function(event) {
            // if (!$(event.target).closest('#dropdownMenuButton1').length) {
            //     // console.log("Clicked outside the dropdown button");
            //     $('#menuMobile').css('z-index', 0);
            //     $('#dropdownMenuButton1 i').replaceWith('<i class="fa-solid fa-bars"></i>');
            //     $('#overlay').removeClass("active-overlay");
            // } else {
            //     // console.log("Clicked inside the dropdown button");
            //     if($('#overlay').hasClass('active-overlay')){
            //         $('#menuMobile').css('z-index', 0);
            //         $('#dropdownMenuButton1 i').replaceWith('<i class="fa-solid fa-bars"></i>');
            //         $('#overlay').removeClass("active-overlay");
            //     }else{
            //         $('#menuMobile').css('z-index', 10000);
            //         $('#dropdownMenuButton1 i').replaceWith('<i class="fa-solid fa-xmark"></i>');
            //         $('#overlay').addClass('active-overlay')
            //     }
            // }
        // });
    </script>
</body>
</html>