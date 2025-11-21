@extends('landing-page.layout')

@section('title', 'Blog')
@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection
@section('content')
    <section class="bg-gradient-to-b from-transparent to-white md:mt-[-20px] mt-[100px]">
        <div class="container px-5 mx-auto pb-20">
            <div class="grid md:grid-cols-12 grid-cols-1 md:grid-flow-col grid-flow-row gap-5 items-start md:px-10">
                <div class="md:col-span-9">
                    <div class="grid gap-2">
                        <div class="flex justify-center md:max-h-[495px] max-h-[204px] rounded-xl overflow-auto bg-black">
                            <img id="imageBlog" class="max-h-[100%] max-w-[100%]" src="" />
                        </div>
                        <a id="linkBlog" href="#">
                            <p id="titleBlog" class="font-bold md:text-[24px] text-[18px]"></p>
                            <p id="dateBlog" class="text-[14px]"></p>
                        </a>
                    </div>
                </div>
                <div class="md:col-span-6">
                    <div id="latestBlogs" class="grid md:grid-flow-row grid-flow-col gap-5"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-[-20px]">
        <div class="container px-5 mx-auto py-20">
            <div class="md:px-10">
                <div class="flex justify-between items-center mb-5">
                    <div class="md:text-[24px] text-[18px] font-bold">Latest News</div>
                    <button onclick="window.location.href = '{{ url('blog?category=news') }}'" class="button-waba-outline md:text-[16px] text-[14px] text-center !w-auto !pt-[10px] !pb-[9px]">View All</button>
                </div>
                <div id="latestNews" class="flex md:grid md:grid-cols-4 gap-5 items-start overflow-x-auto"></div>
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
                <div id="pressRelease" class="flex md:grid md:grid-cols-4 gap-5 items-start overflow-x-auto"></div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        const url = "{{ url('blog/data') }}";
        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                
                return response.json();
            })
            .then(data => {
                setLatestBlogs(data.latestBlogs);
                setBlogsPerCategory(data.latestNews, 'latestNews');
                setBlogsPerCategory(data.pressRelease, 'pressRelease');
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        
        function setLatestBlogs(data){
            let latestBlogsContainer = $('#latestBlogs');

            for (let x in data) {
                let item = data[x];
                const date = new Date(item.created_at);
                const options = { month: 'long', day: 'numeric', year: 'numeric' };
                const formattedDate = new Intl.DateTimeFormat('en-US', options).format(date);
                const urlDetail = "{{url('blog/detail')}}" + "/" + item.slug

                if(x > 0){
                    //except key 0
                    let cardBlog = $('<div class="grid gap-3">');
                    let imageBlod = $('<div class="flex justify-center max-h-[204px] rounded-xl overflow-auto bg-black">')
                        .append($('<img class="max-h-[100%] max-w-[100%]" src="{{asset('')}}'+item.image_url+'" />'));
                    let textBlog = $('<a href="'+urlDetail+'">')
                        .append($('<p class="font-bold mb-1">').text(item.title))
                        .append($('<p class="text-[14px]">').text(formattedDate));
                    
                    cardBlog.append(imageBlod, textBlog);
                    latestBlogsContainer.append(cardBlog);
                }else{
                    //big blogs banner
                    $('#imageBlog').attr("src", "{{asset('')}}"+item.image_url);
                    $('#titleBlog').text(item.title);
                    $('#dateBlog').text(formattedDate);
                    $('#linkBlog').attr("href", urlDetail);
                }
            }
        }

        function setBlogsPerCategory(data, idElement){
            let container = $('#'+idElement);

            for (let item of data) {
                const date = new Date(item.created_at);
                const options = { month: 'long', day: 'numeric', year: 'numeric' };
                const formattedDate = new Intl.DateTimeFormat('en-US', options).format(date);
                const urlDetail = "{{url('blog/detail')}}" + "/" + item.slug

                let wrapper = $('<div class="md:w-auto w-[250px]">')
                let cardBlog = $('<div class="grid gap-3">');
                let imageBlod = $('<div class="flex justify-center md:w-auto w-[250px] md:h-auto h-[150px] max-h-[204px] rounded-xl overflow-auto bg-black">')
                    .append($('<img class="max-h-[100%] max-w-[100%]" src="{{asset('')}}'+item.image_url+'" />'));
                let textBlog = $('<a href="'+urlDetail+'">')
                    .append($('<p class="font-bold mb-1">').text(item.title))
                    .append($('<p class="text-[14px]">').text(formattedDate));
                
                cardBlog.append(imageBlod, textBlog);
                wrapper.append(cardBlog);
                container.append(wrapper);
            }
        }
    </script>
@endsection