@extends('landing-page.layout')

@section('title', 'Source')
@section('css')
    <style>
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection
@section('content')
    <section class="container px-5 mx-auto pb-20 md:mt-[-20px] mt-[100px]">
        <div class="md:px-10">
            <div class="font-bold text-[24px] mb-5">Our Source</div>
            <div id="sourceContainer" class="grid md:grid-cols-4 grid-cols-1 gap-5"></div>
            <div class="flex items-center justify-between pt-10">
                <div class="flex flex-1 justify-between sm:hidden">
                    <a id="mobilePrevious" href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                    <a id="mobileNext" href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                </div>
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing
                            <span id="startItems" class="font-medium">1</span>
                            to
                            <span id="endItems" class="font-medium">10</span>
                            of
                            <span id="totalItems" class="font-medium">97</span>
                            results
                        </p>
                    </div>
                    <div>
                        <nav id="paginationContainer" aria-label="Pagination" class="isolate inline-flex -space-x-px gap-2 shadow-xs">
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        let width = window.innerWidth;
        const dataPerPage = width <= 426 ? 8 : 20;
        const url = "{{ url('source/data') }}"+"?page={{$page}}&count="+dataPerPage;

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                
                return response.json();
            })
            .then(data => {
                if(data.currentPage > data.totalPage){
                    window.location.href = "{{url('source')}}"+"?page="+data.totalPage;
                }

                console.log(data); // Process the retrieved data
                setSource(data.items);
                setPagination(data);
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        
        function setSource(data){
            const sourceContainer = $('#sourceContainer');

            for (let item of data) {
                let cardSource = $('<div class="grid gap-3 bg-white p-4 rounded-xl">');
                let imageSource = $('<div class="flex justify-center h-[295px] rounded-xl overflow-auto bg-white">')
                    .append($('<img class="max-h-[100%] max-w-[100%]" src="{{asset('')}}'+item.cover_url+'" />'));
                let textSource = $('<p class="font-bold mb-1">').text(item.title);
                let btnSource = $('<button onclick="redirectToPage(`'+item.slug+'`)" class="button-waba-outline !pt-[10px] !pb-[9px] !w-full text-center">')
                    .text('Download E-Book');
                
                cardSource.append(imageSource, textSource, btnSource);
                sourceContainer.append(cardSource);
            }
        }

        function setPagination(data) {
            const category = data.category;
            const totalPage = Number(data.totalPage);
            const currentPage = Number(data.currentPage);
            const paginationContainer = $('#paginationContainer');

            $('#startItems').text(Number(data.start) + 1);
            $('#endItems').text((Number(data.start) + dataPerPage) > Number(data.totalItems) ? Number(data.totalItems) : (Number(data.start) + dataPerPage));
            $('#totalItems').text(Number(data.totalItems));

            if (totalPage > 1) {
                const urlPrevious = "{{ url('source') }}"+"?page="+(currentPage > 1 ? currentPage - 1 : "#");
                const previous = $('<a href="'+urlPrevious+'" class="relative inline-flex items-center rounded-md px-2 py-2 inset-ring inset-ring-[var(--waba-primary-color)] hover:bg-[var(--waba-primary-color)] focus:z-20 focus:outline-offset-0">')
                    .append($('<span class="sr-only">Previous</span>'))
                    .append($('<ion-icon class="" name="chevron-back-outline"></ion-icon>'));
                const urlNext = "{{ url('source') }}"+"?page="+(currentPage == totalPage ? "#" : currentPage + 1);
                const next = $('<a href="'+urlNext+'" class="relative inline-flex items-center rounded-md px-2 py-2 inset-ring inset-ring-[var(--waba-primary-color)] hover:bg-[var(--waba-primary-color)] focus:z-20 focus:outline-offset-0">')
                    .append($('<span class="sr-only">Next</span>'))
                    .append($('<ion-icon class="" name="chevron-forward-outline"></ion-icon>'));
                const separator = '<span class="relative inline-flex items-center rounded-md px-4 py-2 text-sm font-semibold text-gray-700 inset-ring inset-ring-gray-300 focus:outline-offset-0">';
                const pagesNumber = '<a href="#" class="relative inline-flex items-center rounded-md px-4 py-2 text-sm font-semibold inset-ring inset-ring-[var(--waba-primary-color)] hover:bg-[var(--waba-primary-color)] focus:z-20 focus:outline-offset-0">';

                if(currentPage > 1){
                    $('#mobilePrevious').attr('href', urlPrevious);
                }else{
                    $('#mobilePrevious').removeAttr('href');
                    previous.removeAttr('href');
                }
                
                if(currentPage == totalPage){
                    $('#mobileNext').removeAttr('href');
                    next.removeAttr('href');
                }else{
                    $('#mobileNext').attr('href', urlNext);
                }

                paginationContainer.append(previous);

                if (totalPage <= 5) {
                    // Tampilkan semua nomer halaman
                    for (let i = 1; i <= totalPage; i++) {
                        paginationContainer.append($(pagesNumber).text(i).attr("href", "{{url('source')}}"+"?page="+i).addClass(i == currentPage ? 'bg-[var(--waba-primary-color)]' : ''));
                    }
                } else {
                    if (currentPage <= 3) {
                        for (let i = 1; i <= (currentPage <= 2 ? 3 : 4); i++) {
                            paginationContainer.append($(pagesNumber).text(i).attr("href", "{{url('source')}}"+"?page="+i).addClass(i == currentPage ? 'bg-[var(--waba-primary-color)]' : ''));
                        }

                        paginationContainer.append($(separator).text('...'));
                        paginationContainer.append($(pagesNumber).text(totalPage).attr("href", "{{url('source')}}"+"?page="+totalPage).addClass(i == currentPage ? 'bg-[var(--waba-primary-color)]' : ''));
                    } else if (currentPage >= totalPage - 2) {
                        paginationContainer.append($(pagesNumber).text(1).attr("href", "{{url('source')}}"+"?page="+1).addClass(i == currentPage ? 'bg-[var(--waba-primary-color)]' : ''));
                        paginationContainer.append($(separator).text('...'));

                        for (let i = (currentPage == totalPage - 2) ? (totalPage - 3) : (totalPage - 2); i <= totalPage; i++) {
                            paginationContainer.append($(pagesNumber).text(i).attr("href", "{{url('source')}}"+"?page="+i).addClass(i == currentPage ? 'bg-[var(--waba-primary-color)]' : ''));
                        }
                    } else {
                        pages.push(1)
                        paginationContainer.append($(separator).text('...'));

                        for (let i = currentPage - 1; i <= currentPage + 1; i++) {
                            paginationContainer.append($(pagesNumber).text(i).attr("href", "{{url('source')}}"+"?page="+i).addClass(i == currentPage ? 'bg-[var(--waba-primary-color)]' : ''));
                        }

                        paginationContainer.append($(separator).text('...'));
                        paginationContainer.append($(pagesNumber).text(totalPage).attr("href", "{{url('source')}}"+"?page="+totalPage).addClass(i == currentPage ? 'bg-[var(--waba-primary-color)]' : ''));
                    }
                }

                paginationContainer.append(next);
            }
        }

        function redirectToPage(urlEbook){
            window.location.href = "{{url('source/detail')}}"+"/"+urlEbook;
        }
    </script>
@endsection