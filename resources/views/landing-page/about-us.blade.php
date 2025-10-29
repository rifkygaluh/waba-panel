@extends('landing-page.layout')

@section('title', 'About Us')
@section('css')
    <style>
        .card-waba3 {
            background-color: white;
            padding: 30px;
            border-radius: 16px;
        }
    </style>
@endsection
@section('content')
    <section class="max-w-4xl md:px-10 px-5 mx-auto my-10">
        <p class="md:text-[40px] text-[20px] font-bold mb-10">We Help Businesses Keep Customers Coming Back</p>

        <div class="space-y-5">
            <p>
                Loyaltygoo lahir dari ide sederhana - membantu bisnis mempertahankan pelanggan dengan cara yang lebih cerdas dan manusiawi.
                Kami percaya bahwa hubungan dengan pelanggan tidak berhenti setelah pembelian pertama, tapi justru dimulai dari sana.
            </p>
            <p>
                Dengan teknologi otomatisasi berbasis WhatsApp, Loyaltygoo memudahkan bisnis untuk mengirim pesan yang relevan, 
                mengingatkan pelanggan tentang poin, dan mendorong pembelian berulang tanpa perlu tenaga ekstra.
            </p>
            <p>
                Kami membantu brand membangun pengalaman pelanggan yang lebih dekat, efisien, dan menyenangkan - sehingga setiap pesan yang terkirim bukan sekadar promosi, tapi juga bentuk perhatian.
                Loyaltygoo adalah jembatan antara bisnis dan pelanggan: cepat, otomatis, dan tetap hangat.
            </p>
        </div>

        <p class="font-bold text-[24px] mt-10 mb-5">Our Values</p>
        <div class="grid md:grid-cols-2 grid-cols-1 grid-flow-row gap-[20px] mb-[120px]">
            <div class="card-waba3">
                <img class="w-[45px] h-[45px] mb-6" src="{{ asset('landing-page/images/Thumbup--Streamline-Beveled-Scribbles.png') }}" />
                <b>Simplicity First</b>
                <p class="mt-2 text-[14px]">Kami percaya teknologi seharusnya mempermudah, bukan memperumit.</p>
            </div>
            <div class="card-waba3">
                <img class="w-[45px] h-[45px] mb-6" src="{{ asset('landing-page/images/Eye--Streamline-Beveled-Scribbles.png') }}" />
                <b>Human Connection</b>
                <p class="mt-2 text-[14px]">Setiap pesan otomatis tetap terasa personal dan penuh empati.</p>
            </div>
            <div class="card-waba3">
                <img class="w-[45px] h-[45px] mb-6" src="{{ asset('landing-page/images/Achievement-Badge--Streamline-Beveled-Scribbles.png') }}" />
                <b>Impact-Driven</b>
                <p class="mt-2 text-[14px]">Fokus kami pada hasil nyata — engagement tinggi & pelanggan kembali membeli.</p>
            </div>
            <div class="card-waba3">
                <img class="w-[45px] h-[45px] mb-6" src="{{ asset('landing-page/images/Checked-Circle--Streamline-Beveled-Scribbles.png') }}" />
                <b>Trust & Transparency</b>
                <p class="mt-2 text-[14px]">Loyalitas tumbuh dari kejujuran, baik pada pelanggan maupun mitra bisnis.</p>
            </div>
        </div>        
    </section>
@endsection
