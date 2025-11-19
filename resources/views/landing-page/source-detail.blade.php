@extends('landing-page.layout')

@section('title', 'Source Detail')
@section('css')
    <style>
        input, select {
            width: 100%;
            background-color: white;
            padding: 12px 16px;
            border: 1px solid #DFDFDF;
            border-radius: 8px;
        }

        .sad {
            min-width: 0;
            /* box-sizing: border-box; */
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection
@section('content')
    <section class="container px-5 mx-auto pb-20 md:mt-[-20px] mt-[100px]">
        <div class="md:px-10">
            <div class="flex items-center text-[14px] mb-5 gap-3">
                <span class="text-[var(--waba-primary-color)] whitespace-nowrap">Our Source</span>
                <ion-icon class="" name="chevron-forward-outline"></ion-icon>
                <span class="sad">Sadhguru - Karma - Inner Engineering</span>
            </div>
            <div class="grid md:grid-cols-10 gap-5">
                <div class="md:col-span-4">
                    <img id="imageSource" class="rounded-xl aspect-square" src="{{ asset('landing-page/images/source/image 41.png') }}" />
                </div>
                <div class="md:col-span-6">
                    <div class="text-[24px] font-bold mb-5">Sadhguru - Karma - Inner Engineering</div>
                    <div class="grid gap-3 mb-5">
                        <p>Designed by Sadhguru, Inner Engineering is a transformative program that includes simple Yoga practices, sessions and meditative processes guided by Sadhguru, and the transmission of Shambhavi Mahamudra Kriya, a powerful 21-minute Yogic process. This program helps you build a foundation of health, joy and exuberance, and establish a chemistry of blissfulness.</p>
                        <p>Designed by Sadhguru, Inner Engineering is a transformative program that includes simple Yoga practices, sessions and meditative processes guided by Sadhguru, and the transmission of Shambhavi Mahamudra Kriya, a powerful 21-minute Yogic process. This program helps you build a foundation of health, joy and exuberance, and establish a chemistry of blissfulness.</p>
                    </div>
                    <div class="bg-[var(--waba-third-color)] rounded-xl p-5">
                        <div class="text-[20px] font-bold mb-5">Download PDF</div>
                        <form className="space-y-6">
                            <div class="grid mb-5">
                                <label for="name" className="text-[14px] mb-2">Name</label>
                                <input type="text" id="name" name="name" autocomplete="off" className="" placeholder="John Doe" />
                            </div>

                            <div class="grid md:grid-cols-2 md:gap-5">
                                <div>
                                    <div class="grid mb-5">
                                        <label for="email" className="text-[14px] mb-2">Work Email</label>
                                        <input type="email" id="email" name="email" autocomplete="off" className="" placeholder="JohnDoe@gmail.com" />
                                    </div>
                                </div>
                                <div>
                                    <div class="grid mb-5 custom-select-wrapper">
                                        <label for="region" className="text-[14px] mb-2">Country/Region</label>
                                        <select className="sad">
                                            <option>Indonesia jkdfnisdj sdifnis sidisdjo dfn sdjfni</option>
                                            <option>Singapore</option>
                                            <option>Malaysia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 md:gap-5">
                                <div>
                                    <div class="grid mb-5">
                                        <label for="company" className="text-[14px] mb-2">Company Name</label>
                                        <input type="text" id="company" name="company" autocomplete="off" className="" placeholder="Algo Std" />
                                    </div>
                                </div>
                                <div>
                                    <div class="grid mb-5">
                                        <label for="job" className="text-[14px] mb-2">Job Title</label>
                                        <input type="text" id="job" name="job" autocomplete="off" className="" placeholder="Marketing" />
                                    </div>
                                </div>
                            </div>

                            <button class="button-waba w-full">Download</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>  
@endsection

@section('script')
    <script>
        const urlDetail = "{{ url('blog/data?category=detail&id='.$id) }}";
        fetch(urlDetail)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                
                return response.json();
            })
            .then(data => {
                setDetail(data.item);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        
        const urlSimiliarNews = "{{ url('blog/data?category=similiar-news') }}";
        fetch(urlSimiliarNews)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                
                return response.json();
            })
            .then(data => {
                setSimiliarNews(data.items);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        
        function setDetail(data){
            $('#imageBlog').attr("src", data.image);
            $('#titleBlog').text(data.title);
            $('#imageAuthorBlog').attr("src", data.image_author);
            $('#authorBlog').text(data.author);
            $('#contentBlog').append($(data.content));
        }

        function setSimiliarNews(data){
            const similiarNewsContainer = $('#similiarNewsContainer');

            for (let item of data) {
                let cardBlog = $('<div class="grid gap-3">');
                let imageBlod = $('<img class="w-full rounded-xl" src="'+item.images+'" />');
                let textBlog = $('<a href="'+item.link+'">')
                    .append($('<p class="font-bold mb-1">').text(item.title))
                    .append($('<p class="text-[14px]">').text(item.date));
                
                cardBlog.append(imageBlod, textBlog);
                similiarNewsContainer.append(cardBlog);
            }
        }
    </script>
@endsection