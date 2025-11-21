@extends('landing-page.layout')

@section('title', 'Blog Detail')
@section('css')
    <style>
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection
@section('content')
    {{-- <section class="container px-5 mx-auto pb-20 md:mt-[-20px] mt-[100px]"> --}}
    <section class="max-w-4xl md:px-10 px-5 mx-auto md:mt-[-20px] mt-[100px]">
        <div>
            <img id="imageBlog" class="w-full max-h-[300px] rounded-4xl" src="" />
            <div id="titleBlog" class="font-bold text-[24px] mt-5 mb-3"></div>
            <div class="flex justify-between items-center text-[14px] mb-8">
                <div class="flex items-center gap-3">
                    <img id="imageAuthorBlog" class="rounded-full w-[24px] h-[24px]" src="" />
                    <div>By <span id="authorBlog">-</span></div>
                    <div>30 mins ago</div>
                    <div><span id="readTime">0</span> min read</div>
                </div>
                <div class="flex items-center gap-3">
                    <ion-icon name="chatbox-outline"></ion-icon>
                    <ion-icon name="share-social-outline"></ion-icon>
                    <ion-icon name="bookmark-outline"></ion-icon>
                </div>
            </div>
            <div id="contentBlog" class="grid gap-3"></div>

            <div class="font-bold text-[20px] mt-8 mb-5">Similiar News</div>
            <div id="similiarNewsContainer" class="grid md:grid-cols-3 grid-cols-1 md:grid-flow-col grid-flow-row gap-5 items-start mb-[100px]"></div>
        </div>
    </section>  
@endsection

@section('script')
    <script>
        const urlDetail = "{{ url('blog/data?slug='.$slug) }}";
        fetch(urlDetail)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                
                return response.json();
            })
            .then(data => {
                setDetail(data.blog);
                setSimiliarNews(data.blogs);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        
        function setDetail(data){
            $('#imageBlog').attr("src", "{{asset('')}}"+data.image_url);
            $('#titleBlog').text(data.title);
            // $('#imageAuthorBlog').attr("src", data.author_id);
            $('#imageAuthorBlog').attr("src", "{{asset('landing-page/images/blog/Ellipse 11.png')}}");
            $('#authorBlog').text(data.author_id);
            $('#readTime').text(data.read_time);
            $('#contentBlog').append($(data.content));
        }

        function setSimiliarNews(data){
            const similiarNewsContainer = $('#similiarNewsContainer');

            for (let item of data) {
                const date = new Date(item.created_at);
                const options = { month: 'long', day: 'numeric', year: 'numeric' };
                const formattedDate = new Intl.DateTimeFormat('en-US', options).format(date);
                const urlDetail = "{{url('blog/detail')}}" + "/" + item.slug

                let cardBlog = $('<div class="grid gap-3">');
                // let imageBlod = $('<img class="w-full rounded-xl" src="{{asset('')}}'+item.image_url+'" />');
                let imageBlod = $('<div class="flex justify-center md:w-auto w-[250px] h-[150px] max-h-[204px] rounded-xl overflow-auto bg-black">')
                    .append($('<img class="max-h-[100%] max-w-[100%]" src="{{asset('')}}'+item.image_url+'" />'));
                let textBlog = $('<a href="'+urlDetail+'">')
                    .append($('<p class="font-bold mb-1">').text(item.title))
                    .append($('<p class="text-[14px]">').text(formattedDate));
                
                cardBlog.append(imageBlod, textBlog);
                similiarNewsContainer.append(cardBlog);
            }
        }
    </script>
@endsection