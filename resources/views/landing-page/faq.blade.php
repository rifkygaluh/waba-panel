@extends('landing-page.layout')

@section('title', 'FAQ')
@section('css')
    <style>
        .accordion-waba {
            background-color: #F9FAFB;
            border: 1px solid #F9FAFB;
            border-radius: 16px;
        }
    </style>
@endsection
@section('content')
    <section class="max-w-4xl px-10 mx-auto my-10">
        <p class="text-[40px] font-bold">Frequently Asked Questions</p>
        <p class="text-2xl mb-10">Everything you need to know before getting started with Loyaltygoo.</p>

        <div style="background-color: #E9FCF2; border: 1px solid var(--waba-primary-color); border-radius: 16px;" class="mt-5">
            <button onclick="toggleAccordion(1)" class="w-full flex justify-between items-center px-[20px] py-[10px] cursor-pointer">
                <span class="font-bold">What is Loyaltygoo and how does it work?</span>
                <ion-icon id="icon-1" name="remove-outline" class="text-2xl text-[var(--waba-primary-color)]"></ion-icon>
            </button>
            
            <div id="content-1" style="max-height: 500px;transition-duration: 300ms;" class="accordion-content overflow-hidden transition-all duration-300 ease-in-out">
                <div class="border-t border-[var(--waba-primary-color)] px-[20px] py-[10px]">
                    Loyaltygoo is an automated WhatsApp-based loyalty system that helps businesses reward repeat customers. It automates registration, invoice uploads, point tracking, and reward redemption - all through WhatsApp.
                </div>
            </div>
        </div>

        <div class="accordion-waba mt-5">
            <button onclick="toggleAccordion(2)" class="w-full flex justify-between items-center px-[20px] py-[10px] cursor-pointer">
                <span class="font-bold">Do customers need to install a new app?</span>
                <ion-icon id="icon-2" name="add-outline" class="text-2xl text-[var(--waba-primary-color)]"></ion-icon>
            </button>
            
            <div id="content-2" class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="border-t border-[var(--waba-primary-color)] px-[20px] py-[10px]">
                    No. Customers only need WhatsApp. They can join, upload invoices, and redeem rewards directly through chat - no extra app required.
                </div>
            </div>
        </div>

        <div class="accordion-waba mt-5">
            <button onclick="toggleAccordion(3)" class="w-full flex justify-between items-center px-[20px] py-[10px] cursor-pointer">
                <span class="font-bold">How can Loyaltygoo benefit my business?</span>
                <ion-icon id="icon-3" name="add-outline" class="text-2xl text-[var(--waba-primary-color)]"></ion-icon>
            </button>
            
            <div id="content-3" class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="border-t border-[var(--waba-primary-color)] px-[20px] py-[10px]">
                    Loyaltygoo saves you time and boosts repeat purchases. It automatically tracks customer activities, sends reward reminders, and helps increase engagement without manual follow-ups.
                </div>
            </div>
        </div>

        <div class="accordion-waba mt-5">
            <button onclick="toggleAccordion(4)" class="w-full flex justify-between items-center px-[20px] py-[10px] cursor-pointer">
                <span class="font-bold">Is it easy to set up?</span>
                <ion-icon id="icon-4" name="add-outline" class="text-2xl text-[var(--waba-primary-color)]"></ion-icon>
            </button>
            
            <div id="content-4" class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="border-t border-[var(--waba-primary-color)] px-[20px] py-[10px]">
                    Yes. You can get started in minutes. Just connect your WhatsApp Business number, customize your reward flow, and Loyaltygoo takes care of the rest.
                </div>
            </div>
        </div>

        <div class="accordion-waba mt-5">
            <button onclick="toggleAccordion(5)" class="w-full flex justify-between items-center px-[20px] py-[10px] cursor-pointer">
                <span class="font-bold">Can I customize my loyalty program?</span>
                <ion-icon id="icon-5" name="add-outline" class="text-2xl text-[var(--waba-primary-color)]"></ion-icon>
            </button>
            
            <div id="content-5" class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="border-t border-[var(--waba-primary-color)] px-[20px] py-[10px]">
                    Absolutely. You can define how points are earned, what rewards are offered, and personalize automated messages to match Program Loyalty voice.
                </div>
            </div>
        </div>

        <div class="accordion-waba mt-5">
            <button onclick="toggleAccordion(6)" class="w-full flex justify-between items-center px-[20px] py-[10px] cursor-pointer">
                <span class="font-bold">Is my customer data secure?</span>
                <ion-icon id="icon-6" name="add-outline" class="text-2xl text-[var(--waba-primary-color)]"></ion-icon>
            </button>
            
            <div id="content-6" class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="border-t border-[var(--waba-primary-color)] px-[20px] py-[10px]">
                    Yes. Loyaltygoo uses encrypted communication and secure data handling practices to ensure all customer information stays private and protected.
                </div>
            </div>
        </div>

        <div class="accordion-waba mt-5">
            <button onclick="toggleAccordion(7)" class="w-full flex justify-between items-center px-[20px] py-[10px] cursor-pointer">
                <span class="font-bold">How do I track performance and results?</span>
                <ion-icon id="icon-7" name="add-outline" class="text-2xl text-[var(--waba-primary-color)]"></ion-icon>
            </button>
            
            <div id="content-7" class="accordion-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                <div class="border-t border-[var(--waba-primary-color)] px-[20px] py-[10px]">
                    Your dashboard shows real-time insights - from active members and points redeemed to which campaigns drive the highest repeat orders.
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between rounded-2xl p-[20px] gap-[50px] bg-[#E9FCF2] mt-10">
            <div>
                <p class="font-bold">Curious about something else? Let’s help you out.</p>
                <p class="text-[14px]">Reach out to our customer support team anytime. We’re here to help you move forward with clarity and confidence</p>
            </div>

            <button class="button-waba !w-[150px]">Talk to Us</button>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function toggleAccordion(index) {
            const content = document.getElementById(`content-${index}`);
            const icon = document.getElementById(`icon-${index}`);
            const parent = content.parentElement;
        
            // Toggle the content's max-height for smooth opening and closing
            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0';
                icon.name = 'add-outline';
                parent.style.backgroundColor = '#F9FAFB'
                parent.style.borderColor = '#F9FAFB'
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.name = 'remove-outline';
                parent.style.backgroundColor = '#E9FCF2'
                parent.style.borderColor = 'var(--waba-primary-color)'

                //tutup semua konten kecuali yg ini
                const elementsWithClass = document.querySelectorAll('.accordion-content');
                elementsWithClass.forEach(element => {
                    if(element.id !== `content-${index}`){
                        const parent2 = element.parentElement;
                        const icon2 = parent2.getElementsByTagName('ion-icon');

                        element.style.maxHeight = '0';
                        icon2[0].name = 'add-outline';
                        parent2.style.backgroundColor = '#F9FAFB'
                        parent2.style.borderColor = '#F9FAFB'
                    }
                });
            }
        }
    </script>
@endsection