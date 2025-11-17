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
            <img id="imageBlog" class="w-full max-h-[300px] rounded-4xl" src="{{ asset('landing-page/images/blog/Rectangle 60.png') }}" />
            <div id="titleBlog" class="font-bold text-[24px] mt-5 mb-3"></div>
            <div class="flex justify-between items-center text-[14px] mb-8">
                <div class="flex items-center gap-3">
                    <img id="imageAuthorBlog" class="rounded-full w-[24px] h-[24px]" src="" />
                    <div>By <span id="authorBlog">-</span></div>
                    <div>30 mins ago</div>
                    <div>2 min read</div>
                </div>
                <div class="flex items-center gap-3">
                    <ion-icon name="chatbox-outline"></ion-icon>
                    <ion-icon name="share-social-outline"></ion-icon>
                    <ion-icon name="bookmark-outline"></ion-icon>
                </div>
            </div>
            <div id="contentBlog" class="grid gap-3"></div>

            <div class="font-bold text-[20px] mt-8 mb-5">Similiar News</div>
            <div id="similiarNewsContainer" class="grid md:grid-cols-3 grid-cols-1 md:grid-flow-col grid-flow-row gap-5 items-center mb-[100px]"></div>
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