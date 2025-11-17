@extends('landing-page.layout')

@section('title', 'Blog')
@section('css')
    <style>
    </style>
@endsection
@section('content')
    <section class="bg-gradient-to-b from-transparent to-white md:mt-[-20px] mt-[100px]">
        <div class="container px-5 mx-auto pb-20">
            <div class="grid md:grid-cols-12 grid-cols-1 md:grid-flow-col grid-flow-row gap-5 items-start md:px-10">
                <div class="md:col-span-9">
                    <div class="grid gap-2">
                        <div class="flex justify-center md:max-h-[495px] max-h-[204px] rounded-xl overflow-auto bg-black">
                            <img class="max-h-[100%] max-w-[100%]" src="{{ asset('landing-page/images/blog/IMG_20150328_074937.jpg') }}" />
                        </div>
                        <a href="#">
                            <p class="font-bold md:text-[24px] text-[18px]">Smart, Scalable, Secure: What Sets Modern Domain Platforms Apart in 2025</p>
                            <p class="text-[14px]">May 30, 2025</p>
                        </a>
                    </div>
                </div>
                <div class="md:col-span-6">
                    <div class="grid md:grid-flow-row grid-flow-col gap-5">
                        @php
                            $items = [
                                ['link' => '#', 'images' => asset('landing-page/images/blog/image 42.png'), 'title' => 'Inside Market: Building Asia’s #1 Domain Marketplace for Investors...', 'date' => 'May 30, 2025'],
                                ['link' => '#', 'images' => asset('landing-page/images/blog/image 42 (1).png'), 'title' => 'Inside Market: Building Asia’s #1 Domain Marketplace for Investors...', 'date' => 'May 30, 2025'],
                            ];
                        @endphp

                        @forEach($items as $item)
                            <div class="grid gap-2">
                                <div class="flex justify-center max-h-[204px] rounded-xl overflow-auto bg-black">
                                    <img class="max-h-[100%] max-w-[100%]" src="{{ $item['images'] }}" />
                                </div>
                                <a href="{{ $item['link'] }}">
                                    <p class="font-bold">{{ $item['title'] }}</p>
                                    <p class="text-[14px]">{{ $item['date'] }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-[-20px]">
        <div class="container px-5 mx-auto py-20">
            <div class="md:px-10">
                <div class="flex justify-between items-center mb-5">
                    <div class="md:text-[24px] text-[18px] font-bold">Latest News</div>
                    <button onclick="window.location.href = '{{ url('blog?category=latest-news') }}'" class="button-waba-outline md:text-[16px] text-[14px] text-center !w-auto !pt-[10px] !pb-[9px]">View All</button>
                </div>
                <div class="flex md:grid md:grid-cols-4 gap-5 items-start overflow-x-auto">
                    @php
                        $latestItems = [
                            ['link' => '#', 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => 'The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                            ['link' => '#', 'images' => asset('landing-page/images/blog/image 43.png'), 'title' => 'How to Turn Idle Domains into Steady Revenue Streams', 'date' => 'May 30, 2025'],
                            ['link' => '#', 'images' => asset('landing-page/images/blog/image 42 (3).png'), 'title' => 'Inside Market: Building Asia’s #1 Domain Marketplace for Investors...', 'date' => 'May 30, 2025'],
                            ['link' => '#', 'images' => asset('landing-page/images/blog/image 42 (4).png'), 'title' => 'Inside Market: Building Asia’s #1 Domain Marketplace for Investors...', 'date' => 'May 30, 2025'],
                        ];
                    @endphp

                    @forEach($latestItems as $item)
                        <div class="md:w-auto w-[250px]">
                            <div class="grid gap-3">
                                <div class="flex justify-center md:w-auto w-[250px] md:h-auto h-[150px] max-h-[204px] rounded-xl overflow-auto bg-black">
                                    <img class="max-h-[100%] max-w-[100%]" src="{{ $item['images'] }}" />
                                </div>
                                <a href="{{ $item['link'] }}">
                                    <p class="font-bold mb-1">{{ $item['title'] }}</p>
                                    <p class="text-[14px]">{{ $item['date'] }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gradient-to-b from-white to-transparent mt-[-20px] mb-[60px]">
        <div class="container px-5 mx-auto py-20">
            <div class="md:px-10">
                <div class="flex justify-between items-center mb-5">
                    <div class="md:text-[24px] text-[18px] font-bold">Press Release</div>
                    <button onclick="window.location.href = '{{ url('blog?category=press-release') }}'" class="button-waba-outline md:text-[16px] text-[14px] text-center !w-auto !pt-[10px] !pb-[9px]">View All</button>
                </div>
                <div class="flex md:grid md:grid-cols-4 gap-5 items-start overflow-x-auto">
                    @php
                        $latestItems = [
                            ['link' => '#', 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => 'The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                            ['link' => '#', 'images' => asset('landing-page/images/blog/image 43.png'), 'title' => 'How to Turn Idle Domains into Steady Revenue Streams', 'date' => 'May 30, 2025'],
                            ['link' => '#', 'images' => asset('landing-page/images/blog/image 42 (3).png'), 'title' => 'Inside Market: Building Asia’s #1 Domain Marketplace for Investors...', 'date' => 'May 30, 2025'],
                            ['link' => '#', 'images' => asset('landing-page/images/blog/image 42 (4).png'), 'title' => 'Inside Market: Building Asia’s #1 Domain Marketplace for Investors...', 'date' => 'May 30, 2025'],
                        ];
                    @endphp

                    @forEach($latestItems as $item)
                        <div class="md:w-auto w-[250px]">
                            <div class="grid gap-3">
                                <div class="flex justify-center md:w-auto w-[250px] md:h-auto h-[150px] max-h-[204px] rounded-xl overflow-auto bg-black">
                                    <img class="max-h-[100%] max-w-[100%]" src="{{ $item['images'] }}" />
                                </div>
                                <a href="{{ $item['link'] }}">
                                    <p class="font-bold mb-1">{{ $item['title'] }}</p>
                                    <p class="text-[14px]">{{ $item['date'] }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        
    </script>
@endsection