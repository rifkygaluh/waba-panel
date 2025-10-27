@extends('landing-page.layout')

@section('title', 'Home')
@section('css')
    <style>
        /* linear-gradient(to right, #E1F8E8, #1FC36C8F); */
        .background1 {
            background-image: url('{{ asset("landing-page/images/01. Line accent BG.png") }}'),
                linear-gradient(to right, var(--waba-secondary-color), #1FC36C8F);
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        .background2 {
            background-image: url('{{ asset("landing-page/images/02. Line Accent BG 2.png") }}'),
                linear-gradient(to right, var(--waba-secondary-color), #1FC36C8F);
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        .card-waba1 {
            background-color: white;
            padding: 30px 20px;
            border-radius: 16px;
        }

        .card-waba2 {
            /* background-color: var(--waba-secondary-color); */
            border: 0.3px solid #CCCCCC;
            border-radius: 20px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-waba3 {
            background-color: white;
            padding: 30px;
            border-radius: 16px;
        }
    </style>
@endsection
@section('content')
    <img class="absolute w-full top-[-80px] z-[-1]" src="{{ asset('landing-page/images/subtract.png') }}" />
    
    <section class="container px-5 mx-auto">
        <div class="grid md:grid-cols-12 grid-cols-1 md:grid-flow-col grid-flow-row gap-10 items-center md:px-10">
            <div class="md:col-span-7 md:order-1 order-2">
                <div class="max-w-[680px]">
                    <div class="flex flex-wrap leading-normal">
                        {{-- kenapa pakai div, dikarenakan saat pakai span ada kemungkinan image tidak terrender saat sudah dipinggir ukuran --}}
                        <div class="md:text-[60px] text-[32px] font-bold">Turn WhatsApp&nbsp;</div>
                        <div class="relative md:text-[60px] text-[32px] font-bold">
                            Chats&nbsp; <img class="absolute right-[0px] md:top-[-5px] top-[-13px] md:w-[40px] w-[30px] md:h-[40px] h-[30px]" src="{{ asset('landing-page/images/wa.png') }}" />
                        </div>
                        <div class="md:text-[60px] text-[32px] font-bold">into&nbsp;</div>
                        <div class="relative md:text-[60px] text-[32px] font-bold text-[#1FC36C] font-[Times] italic">
                            Loyal&nbsp; <img class="absolute md:w-[57px] w-[30px] md:h-[37px] h-[20px] top-[-2px] md:left-[25px] left-[13px]" src="{{ asset('landing-page/images/Vector.png') }}" />
                        </div>
                        <div class="md:text-[60px] text-[32px] font-bold text-[#1FC36C] font-[Times] italic">Customers.</div>
                    </div>
                    <p class="mt-5 md:text-[18px]">Build loyalty effortlessly inside WhatsApp. Just seamless connection with your customers.</p>
                    <div class="flex md:flex-row flex-col items-center gap-5 mt-10">
                        <a class="button-waba !md:w-[200px] !w-full text-center" href="https://wa.me/083199294607?text=Hallo">Get a Free Now</a>
                        <a class="button-waba-outline !md:w-[200px] !w-full text-center" href="https://wa.me/081222999879">Start Now</a>
                    </div>
                </div>
            </div>
            <div class="md:col-span-5 md:order-2 order-1 md:px-0 px-10">
                <div class="relative w-full max-w-[430px] max-h-[569px] mx-auto">
                    {{-- aspect-2/3 object-fill  --}}
                    <img class="w-full max-w-[360px] max-h-[548px] mx-auto" src="{{ asset('landing-page/images/02 1.png') }}" />
                    <img class="absolute left-[30%] translate-x-[-50%] top-[25%] w-[75%] max-w-[320px] max-h-[360px]" src="{{ asset('landing-page/images/01._Welcome_Program_2-removebg-preview.png') }}" />
                    <img class="absolute right-[30%] translate-x-[50%] bottom-[-12%] translate-y-[-50%] w-[75%] max-w-[265px] max-h-[55px]" src="{{ asset('landing-page/images/02. About Program.png') }}" />
                </div>
            </div>
        </div>
    </section>

    <section id="problem-n-solution" class="container px-5 mx-auto md:mt-20 mt-10">
        <p class="md:text-[40px] text-[32px] md:text-center font-bold">The Problem and Our Solution</p>
        <p class="mt-2 md:text-[18px] md:text-center">Loyalty shouldn’t be hard. We make it automatic, personal, and built for real results.</p>

        <div class="grid md:grid-cols-2 grid-cols-1 md:grid-flow-col grid-flow-row md:gap-20 gap-10 items-center md:px-10 md:mt-20 mt-10">
            <img class="mx-auto" src="{{ asset('landing-page/images/visual.png') }}" />

            <div class="">
                <span class="badge-waba">Problem</span>
                <p class="text-[24px] font-bold mt-3">
                    Traditional Loyalty Programs Just Don't Work Anymore.
                </p>
                <div class="mt-3 space-y-1.5">
                    <div class="flex items-center">
                        <ion-icon class="text-2xl text-red-500 mr-1" name="close-outline"></ion-icon>
                        <p class="md:text-[18px]">Customers <span class="font-bold text-red-500">lose loyalty cards</span> and forget Program Loyalty.</p>
                    </div>
                    <div class="flex items-center">
                        <ion-icon class="text-2xl text-red-500 mr-1" name="close-outline"></ion-icon>
                        <p class="md:text-[18px]">Extra <span class="font-bold text-red-500">apps get deleted</span> and take up space.</p>
                    </div>
                    <div class="flex items-center">
                        <ion-icon class="text-2xl text-red-500 mr-1" name="close-outline"></ion-icon>
                        <p class="md:text-[18px]">Promotional <span class="font-bold text-red-500">emails go unread</span> in busy inboxes.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 grid-cols-1 md:grid-flow-col grid-flow-row md:gap-20 gap-10 items-center md:px-10 md:mt-20 mt-10">
            <div class="md:order-1 order-2">
                <span class="badge-waba">Solution</span>
                <p class="text-[24px] font-bold mt-3">
                    A Loyalty Program They'll Actually Use
                </p>
                <p class="md:text-[18px] mt-3 space-y-1.5">
                    With our system, your customers can join, collect points, and redeem rewards.
                    <span class="font-bold text-[#1FC36C]">All within their WhatsApp chat</span>. It’s automatic, personal, and incredibly simple.
                </p>
            </div>
            
            <img class="md:order-2 order-1 mx-auto" src="{{ asset('landing-page/images/Group 90 (1).png') }}" />
        </div>

        <div class="md:px-10 mt-20">
            <div class="relative rounded-2xl background1 md:p-[50px] p-[20px]">
                <div class="grid md:grid-cols-2 grid-cols-1 md:grid-flow-col grid-flow-row items-center justify-items-stretch md:gap-10 gap-3">
                    <div class="max-w-[545px]">
                        <p class="md:text-[40px] text-[32px] font-bold">As Easy as Sending a Text. Just 3 Simple Steps!</p>
                    </div>

                    <div class="max-w-[500px] md:justify-self-end">
                        <p class="mt-2 text-[18px] md:text-right">
                            We’ve simplified loyalty so your customers can join and engage instantly.
                        </p>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 grid-cols-1 md:grid-flow-col grid-flow-row mt-15 gap-[20px]">
                    <div class="card-waba1">
                        <p class="text-[20px] text-[var(--waba-primary-color)] font-bold">1. Join inSeconds</p>
                        <p class="mt-2 ml-5 text-[14px]">
                            Customers scan a QR or link to start instantly, no app needed.
                        </p>
                    </div>
                    <div class="card-waba1">
                        <p class="text-[20px] text-[var(--waba-primary-color)] font-bold">2. Earn Points Automatically</p>
                        <p class="mt-2 ml-5 text-[14px]">
                            Points are added after every purchase with instant WhatsApp confirmation.
                        </p>
                    </div>
                    <div class="card-waba1">
                        <p class="text-[20px] text-[var(--waba-primary-color)] font-bold">3. Redeem Rewards Instantly</p>
                        <p class="mt-2 ml-5 text-[14px]">
                            Customers browse and claim rewards right inside the chat fast and easy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="container px-5 mx-auto md:mt-20 mt-10">
        <p class="md:text-[40px] text-[32px] md:text-center font-bold">What Loyaltygoo Can Do for You</p>
        <p class="mt-2 text-[18px] md:text-center">Empower your business with automated loyalty, points, and repeat sales.</p>

        <div class="md:px-10 md:mt-20 mt-10">
            <div class="grid md:grid-cols-3 grid-cols-1 md:grid-flow-col grid-flow-row gap-[20px]">
                <div class="grid gap-[20px]">
                    <div style="background: url('{{ asset('landing-page/images/1.png') }}');background-position: center center;background-size: 100% 100%;" class="card-waba2">
                        <div class="p-[30px]">
                            <b class="text-[20px]">Automated Engagement</b>
                            <p class="mt-2">Set once, and let Loyaltygoo handle points, greetings, and reminders automatically.</p>
                        </div>
                        <img class="w-full" src="{{ asset('landing-page/images/01._automated_engagement-removebg-preview.png') }}" />
                    </div>

                    <div style="background: url('{{ asset('landing-page/images/4.png') }}');background-position: center center;background-size: 100% 100%;" class="card-waba2">
                        <div class="p-[30px]">
                            <b class="text-[20px]">Smart Promotions</b>
                            <p class="mt-2">Send targeted offers based on customer behavior and purchase history.</p>
                        </div>
                        <img class="w-full px-5 pb-5" src="{{ asset('landing-page/images/02. About Program (1).png') }}" />
                    </div>
                </div>

                <div class="grid gap-[20px]">
                    <div style="background: url('{{ asset('landing-page/images/2.png') }}');background-position: center center;background-size: 100% 100%;" class="card-waba2">
                        <div class="p-[30px]">
                            <b class="text-[20px]">Digital Membership Card</b>
                            <p class="mt-2">A loyalty card that lives in your customer’s phone, never forgotten.</p>
                        </div>
                        <img class="w-full p-5" src="{{ asset('landing-page/images/02._Membership_Card-removebg-preview.png') }}" />
                    </div>

                    <div style="background: url('{{ asset('landing-page/images/5.png') }}');background-position: center center;background-size: 100% 100%;" class="card-waba2">
                        <div class="p-[30px]">
                            <b class="text-[20px]">Insightful Dashboard</b>
                            <p class="mt-2">Track performance easily and see what drives real loyalty.</p>
                        </div>
                        <img class="w-full px-5 pb-5" src="{{ asset('landing-page/images/01 1.png') }}" />
                    </div>
                </div>

                <div class="grid gap-[20px]">
                    <div style="background: url('{{ asset('landing-page/images/3.png') }}');background-position: center center;background-size: 100% 100%;" class="card-waba2">
                        <div class="p-[30px]">
                            <b class="text-[20px]">Interactive Reward Catalog</b>
                            <p class="mt-2">Let customers easily browse and choose the rewards they really want.</p>
                        </div>
                        <img class="w-full p-[30px]" src="{{ asset('landing-page/images/message_welcome.png') }}" />
                    </div>

                    <div style="background: url('{{ asset('landing-page/images/6.png') }}');background-position: center center;background-size: 100% 100%;" class="card-waba2">
                        <div class="p-[30px]">
                            <b class="text-[20px]">Seamless Intregation</b>
                            <p class="mt-2">Connect with your POS or online store — no hassle required.</p>
                        </div>
                        <img class="w-full" src="{{ asset('landing-page/images/Group 85.png') }}" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="container px-5 mx-auto mt-20">
        <p class="md:text-[40px] text-[32px] md:text-center font-bold">It’s More Than Points. It’s About Growth</p>
        <p class="mt-2 md:text-[18px] md:text-center">Build loyalty that drives real results.</p>

        <div class="md:px-10 mt-20">
            <div class="grid md:grid-cols-4 grid-cols-1 md:grid-flow-col grid-flow-row gap-[20px]">
                <div class="card-waba3">
                    <img class="w-[40px] h-[40px] mb-6" src="{{ asset('landing-page/images/Smiley-Grinding--Streamline-Beveled-Scribbles.png') }}" />
                    <b class="text-[16px]">Keep Them Coming Back</b>
                    <p class="mt-2 text-[14px]">Make returning effortless with rewards that just work.</p>
                </div>

                <div class="card-waba3">
                    <img class="w-[40px] h-[40px] mb-6" src="{{ asset('landing-page/images/Heart--Streamline-Beveled-Scribbles.png') }}" />
                    <b class="text-[16px]">Boost Every Bill</b>
                    <p class="mt-2 text-[14px]">Encourage customers to spend more for rewards they love.</p>
                </div>

                <div class="card-waba3">
                    <img class="w-[40px] h-[40px] mb-6" src="{{ asset('landing-page/images/Shared--Streamline-Beveled-Scribbles.png') }}" />
                    <b class="text-[16px]">Build Real Connections</b>
                    <p class="mt-2 text-[14px]">Send personal offers that make customers feel seen and valued.</p>
                </div>

                <div class="card-waba3">
                    <img class="w-[40px] h-[40px] mb-6" src="{{ asset('landing-page/images/Dollar-Bill--Streamline-Beveled-Scribbles.png') }}" />
                    <b class="text-[16px]">Save Time & Costs</b>
                    <p class="mt-2 text-[14px]">Ditch punch cards and let automation handle the rest.</p>
                </div>
            </div>
        </div>

        <div id="pricing" class="md:px-10 mt-20">
            <div class="flex md:flex-row flex-col md:items-center justify-between">
                <div>
                    <p class="md:text-[40px] text-[32px] font-bold">Simple plans for <br />every business</p>
                </div>

                <div class="md:text-right">
                    <p>Start small, scale when ready. Monthly & annual billing.</p>
                    <p>14-day free trial no credit card required.</p>
                    
                    {{-- after:h-6 after:w-6 --}}
                    <div class="flex justify-end mt-2">
                        <img class="w-[186px]" src="{{ asset('landing-page/images/TAB (1).png') }}" />
                        {{-- <label class="relative flex items-center mb-5 cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer">
                            <div class="w-[186px] h-[41px] bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white 
                                after:content-['Monthly'] after:absolute after:top-0.5 after:left-[4px] after:bg-[#0CC144] after:border-gray-300 after:border after:rounded-full after:py-1 after:px-3 after:transition-all 
                                peer-checked:bg-indigo-600 hover:peer-checked:bg-indigo-700">Annual</div>
                        </label> --}}
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-3 grid-cols-1 md:grid-flow-col grid-flow-row gap-[20px] mt-10">
                <div class="bg-white border rounded-2xl p-[30px]">
                    <div class="flex items-start justify-between">
                        <img class="w-[56px] h-[56px]" src="{{ asset('landing-page/images/Icon.png') }}" />
                    </div>

                    <p class="text-[24px] font-bold mt-5">Starter</p>
                    <p>Perfect for new users who want to explore Loyaltygoo and start building customer loyalty</p>

                    <div class="flex items-center mt-5">
                        <p class="text-[40px] font-bold mr-2">IDR 0</p>
                        <p>/ month</p>
                    </div>

                    <hr class="mt-5">
                    
                    <div class="mt-5 space-y-1.5">
                        <p class="flex items-center">
                            <ion-icon class="text-2xl text-green-500 mr-1" name="checkmark-outline"></ion-icon>
                            Up to 100 customers
                        </p>
                        <p class="flex items-center">
                            <ion-icon class="text-2xl text-green-500 mr-1" name="checkmark-outline"></ion-icon>
                            Basic automations
                        </p>
                        <p class="flex items-center">
                            <ion-icon class="text-2xl text-green-500 mr-1" name="checkmark-outline"></ion-icon>
                            Email support
                        </p>
                    </div>

                    <button class="button-waba-outline !w-full mt-10">
                        Start Now
                    </button>
                </div>

                <div style="background: url('{{ asset('landing-page/images/Pricing Card.png') }}');background-repeat: no-repeat;background-size: cover;" class="border rounded-2xl p-[30px]">
                    <div class="flex items-start justify-between">
                        <img class="w-[56px] h-[56px]" src="{{ asset('landing-page/images/Iconb.png') }}" />
                        <div class="rounded-[8px] bg-[#F9FAFB] border-white px-[10px] py-[5px] text-[14px] text-[var(--waba-primary-color)] font-bold">Best Value</div>
                    </div>

                    <p class="text-[24px] font-bold mt-5">Pro</p>
                    <p>Ideal for growing brands that want to automate rewards, segment customers, and boost repeat sales.</p>

                    <div class="flex items-center mt-5">
                        <p class="text-[40px] font-bold mr-2">IDR 299</p>
                        <p>/ month</p>
                    </div>

                    <hr class="mt-5">
                    
                    <div class="mt-5 space-y-1.5">
                        <p class="flex items-center">
                            <ion-icon class="text-2xl text-green-500 mr-1" name="checkmark-outline"></ion-icon>
                            Unlimited customers
                        </p>
                        <p class="flex items-center">
                            <ion-icon class="text-2xl text-green-500 mr-1" name="checkmark-outline"></ion-icon>
                            Advanced automations
                        </p>
                        <p class="flex items-center">
                            <ion-icon class="text-2xl text-green-500 mr-1" name="checkmark-outline"></ion-icon>
                            Segmentation & A/B tests
                        </p>
                    </div>

                    <button class="button-waba !w-full mt-10">Get Pro</button>
                </div>

                <div class="bg-white border rounded-2xl p-[30px]">
                    <div class="flex items-start justify-between">
                        <img class="w-[56px] h-[56px]" src="{{ asset('landing-page/images/Iconc.png') }}" />
                    </div>

                    <p class="text-[24px] font-bold mt-5">Business</p>
                    <p>Designed for established companies with multiple locations or complex customer data.</p>

                    <div class="flex items-center mt-5">
                        <p class="text-[24px] text-[#1FC36C] font-bold mr-2">Contact us</p>
                    </div>

                    <hr class="mt-5">
                    
                    <div class="mt-5 space-y-1.5">
                        <p class="flex items-center">
                            <ion-icon class="text-2xl text-green-500 mr-1" name="checkmark-outline"></ion-icon>
                            Multi-location
                        </p>
                        <p class="flex items-center">
                            <ion-icon class="text-2xl text-green-500 mr-1" name="checkmark-outline"></ion-icon>
                            Dedicated onboarding
                        </p>
                        <p class="flex items-center">
                            <ion-icon class="text-2xl text-green-500 mr-1" name="checkmark-outline"></ion-icon>
                            SLA & custom integrations
                        </p>
                    </div>

                    <button class="button-waba-outline !w-full mt-10">
                        Contact Sales
                    </button>
                </div>
            </div>
        </div>

        <div id="benefits" class="md:px-10 md:mt-[240px] mt-10 md:mb-[120px] mb-10">
            <div class="p-[30px] background2 rounded-2xl">
                <div class="grid md:grid-cols-12 grid-cols-1 md:grid-flow-col grid-flow-row md:gap-0 gap-5">
                    <div class="md:order-1 order-2 md:col-span-8 col-span-1">
                        <p class="font-bold text-2xl mb-2"> Ready to Turn Everyday Customers into Lifelong Fans? </p>
                        <p> Book a free demo and see how WhatsApp loyalty grows your business. No credit card required, no commitment at all </p>
                        <button class="bg-white text-[#1FC36C] font-bold rounded-2xl px-3 py-2 mt-5 cursor-pointer md:w-auto w-full"> Contact Us Now </button>
                    </div>

                    <div class="md:order-2 order-1 md:col-span-4 col-span-1 relative md:mx-0 mx-auto">
                        <img class="md:absolute md:top-2/3 md:left-1/2 md:-translate-x-1/2 md:-translate-y-2/3 w-[210px] h-auto" src="{{ asset('landing-page/images/On Mockup GIF.gif') }}" />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
