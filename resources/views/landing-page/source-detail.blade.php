@extends('landing-page.layout')

@section('title', 'Source Detail')
@section('css')
    <style>
        input {
            width: 100%;
            background-color: white;
            padding: 12px 16px;
            border: 1px solid #DFDFDF;
            border-radius: 8px;
        }

        select {
            width: 100%;
            background-color: white;
            padding: 12px 16px;
            border-radius: 8px;
            border-right: 16px solid transparent;
        }

        .select-wrapper {
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
                <a href="{{url('source')}}" class="text-[var(--waba-primary-color)] whitespace-nowrap">Our Source</a>
                <ion-icon class="" name="chevron-forward-outline"></ion-icon>
                <span class="title-ebook sad">Sadhguru - Karma - Inner Engineering</span>
            </div>
            <div class="grid md:grid-cols-10 gap-5">
                <div class="md:col-span-4">
                    <img id="image" class="rounded-xl aspect-square" src="" />
                </div>
                <div class="md:col-span-6">
                    <div class="title-ebook text-[24px] font-bold mb-5"></div>
                    <div id="description" class="grid gap-3 mb-5"></div>
                    <div class="bg-[var(--waba-third-color)] rounded-xl p-5">
                        <div class="text-[20px] font-bold mb-5">Download PDF</div>
                        <form className="" id="formDownload" action="{{url('ebook/download')}}">
                            @csrf

                            <div class="grid mb-5">
                                <label for="name" className="text-[14px] mb-2">Name</label>
                                <input type="text" id="name" name="name" autocomplete="off" className="" placeholder="John Doe" required />
                            </div>

                            <div class="grid md:grid-cols-2 md:gap-5">
                                <div>
                                    <div class="grid mb-5">
                                        <label for="email" className="text-[14px] mb-2">Work Email</label>
                                        <input type="email" id="email" name="email" autocomplete="off" className="" placeholder="JohnDoe@gmail.com" required />
                                    </div>
                                </div>
                                <div>
                                    <div class="grid mb-5 custom-select-wrapper">
                                        <label for="region" className="text-[14px] mb-2">Country/Region</label>
                                        <div class="select-wrapper">
                                            <select id="country" name="country" className="" required>
                                                <option value="indonesia">Indonesia</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 md:gap-5 mb-3">
                                <div>
                                    <div class="grid mb-5">
                                        <label for="company" className="text-[14px] mb-2">Company Name</label>
                                        <input type="text" id="company" name="company" autocomplete="off" className="" placeholder="Algo Std" required />
                                    </div>
                                </div>
                                <div>
                                    <div class="grid mb-5">
                                        <label for="job" className="text-[14px] mb-2">Job Title</label>
                                        <input type="text" id="job" name="job" autocomplete="off" className="" placeholder="Marketing" required />
                                    </div>
                                </div>
                            </div>

                            <button id="btnSubmit" type="submit" class="button-waba w-full flex items-center justify-center">
                                <svg id="loadingIcon" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Download
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const urlDetail = "{{ url('source/data?slug='.$slug) }}";
        fetch(urlDetail)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                
                return response.json();
            })
            .then(data => {
                $('#image').attr("src", "{{ asset('') }}"+data.cover_url);
                $('.title-ebook').text(data.title);
                $('#description').append($(data.description));
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        
        $("#formDownload").on("submit", function(e) {
            e.preventDefault();

            $('#btnSubmit').prop('disabled', true);
            $('#loadingIcon').show();

            let formData = new FormData(this);
            formData.append('slug', '{{$slug}}');

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log("Success:", response);

                    $('#formDownload')[0].reset();
                    $('#btnSubmit').prop('disabled', false);
                    $('#loadingIcon').hide();
                    downloadFile(response.link_download, 'ebook_downloaded_file')

                    Swal.fire({
                        title: "Thank you for downloading",
                        icon: "info",
                        html: `If the file is not automatically downloaded, click <a class="font-bold underline" href="$(response.link_download)" download>here</a> to download`,
                    });
                },
                error: function(xhr, status, error) {
                    $('#btnSubmit').prop('disabled', false);
                    $('#loadingIcon').hide();

                    Swal.fire({
                        title: error,
                        text: xhr.responseJSON.message,
                        icon: "error"
                    });

                    console.error("Error:", error);
                    console.error("xhr:", xhr);
                    console.error("status:", status);
                }
            });
        });

        function downloadFile(url, filename) {
            var link = document.createElement('a');
            link.href = url;
            link.download = filename || 'downloaded_file'; // Provide a default filename
            document.body.appendChild(link); // Append to body (can be hidden)
            link.click(); // Programmatically click the link to trigger download
            document.body.removeChild(link); // Remove the temporary link
        }
    </script>
@endsection