<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function home(){
        return view('landing-page/home');
    }

    public function about(){
        return view('landing-page/about-us');
    }

    public function faq(){
        return view('landing-page/faq');
    }

    public function terms(){
        return view('landing-page/terms-n-conditions');
    }

    public function privacy(){
        return view('landing-page/privacy-policy');
    }

    public function blog(Request $request){
        if($request->get('category')){
            $category = ['latest-news', 'press-release'];

            if(in_array($request->category, $category)){
                $titles = ['latest-news' => 'Latest News', 'press-release' => 'Press Release'];
                // $arrParams = [
                //     'page' => $request->get('page') ? $request->page : 1,
                //     'category' => $request->category
                // ];

                $data = [
                    'title' => $titles[$request->category],
                    'page' => $request->get('page') ? $request->page : 1,
                    'category' => $request->category,
                    // 'params' => '?'.http_build_query($arrParams)
                ];

                if($request->get('page')){
                    // dd((int)$request->page);
                    if((int)$request->page < 1) {
                        return redirect(url('blog?category='.$data['category']));
                    }
                }

                return view('landing-page/blog-category', $data);
            }
        }

        return view('landing-page/blog');
    }

    public function blogData(Request $request){
        if($request->get('category')){
            $categories = ['latest-news', 'press-release'];

            if(in_array($request->category, $categories)){
                $dataBlog = [
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '1The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/IMG_20150328_074937.jpg'), 'title' => '2The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '3The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '4The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/bg_compose_background.png'), 'title' => '5The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '6The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/Ellipse 11.png'), 'title' => '7The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '8The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '9The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '10The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '11The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '12The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '13The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '14The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '15The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '16The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '17The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '18The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '19The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '20The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '21The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '22The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                ];

                $category = $request->category;
                $currentPage = $request->page;
                $totalItems = count($dataBlog);
                $totalPage = (integer)($totalItems / $request->count) + ($totalItems % $request->count ? 1 : 0);
                $start = ($request->count * $currentPage) - $request->count;
                // $end = $request->count * $currentPage;
                $items = array_slice($dataBlog, $start, $request->count);

                return response()->json(compact('totalItems', 'totalPage', 'start', 'items', 'currentPage', 'category'));
            }

            if($request->category == 'similiar-news'){
                $dataBlog = [
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '1The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '2The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                    ['link' => url('blog/detail/1'), 'images' => asset('landing-page/images/blog/image 41.png'), 'title' => '3The Rise of Digital Real Estate: Why Domain Investing Is the New Gold... ', 'date' => 'May 30, 2025'],
                ];

                return response()->json(['items' => $dataBlog]);
            }

            if($request->category == 'detail'){
                $blog = [
                    'image' => asset('landing-page/images/blog/image 41.png'),
                    'title' => 'Smart, Scalable, Secure: What Sets Modern Domain Platforms Apart in 2025',
                    'content' => '
                        <p>
                            In an era where digital presence defines brand credibility, domain investing has evolved from a niche hobby into a strategic business. But as the industry grows, so do user expectations. Today’s domain platforms must go beyond basic buying and selling—they need to be smart, scalable, and secure.<br>
                            So, what really sets a modern domain marketplace apart in 2025?
                        </p>
                        <p>WASHINGTON — Secretary of State Antony J. Blinken on Friday canceled a weekend trip to Beijing after a Chinese spy balloon was sighted above the Rocky Mountain state of Montana, igniting a frenzy of media coverage and political commentary over a machine that the Pentagon said posed no threat to the United States.</p>
                        <p>Mr. Blinken called the Chinese surveillance an “irresponsible act” and a “clear violation of U.S. sovereignty and international law.”</p>
                        <p>China’s “decision to take this action on the eve of my planned visit is detrimental to the substantive discussions that we were prepared to have,” he said at a news conference on Friday afternoon.</p>
                        <p>
                            Mr. Blinken canceled the trip after civilians in Montana this week began spotting the balloon, which the Pentagon said was an “intelligence-gathering” airship. Military officials had been monitoring the balloon for days, and Mr. Blinken and a deputy secretly confronted Chinese diplomats in Washington on Wednesday. But it became a diplomatic crisis only as media attention mounted on Thursday night and Republican politicians called for President Biden and Mr. Blinken to act.<br>
                            The balloon’s presence and Mr. Blinken’s announcement added to the rising tensions between the two superpowers. The situation also underscored the sensitive politics in the United States as both Democratic and Republican leaders vie to be seen as sufficiently hawkish on China.
                        </p>
                        <p>Mr. Blinken had planned to leave Friday night for the trip, the first visit by a U.S. secretary of state to China since 2018. He had been expected to meet with President Xi Jinping and discuss a wide range of issues. But Mr. Blinken said he called Wang Yi, China’s top foreign policy official, on Friday and said he was postponing his trip because of the balloon.</p>',
                    'author' => 'Bruce Marlow',
                    'image_author' => asset('landing-page/images/blog/Ellipse 11.png'),
                ];

                return response()->json(['item' => $blog]);
            }
        }

        abort(404);
    }

    public function blogDetail($id){
        $data['id'] = $id;

        return view('landing-page/blog-detail', $data);
    }

    public function source(Request $request){
        $data['page'] = $request->get('page') ? $request->page : 1;

        return view('landing-page/source', $data);
    }

    public function sourceData(Request $request){
        $dataSource = [
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41.png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (1).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (2).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (3).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (4).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (5).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (6).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (7).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41.png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (1).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (2).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (3).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (4).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (5).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (6).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (7).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41.png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (1).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (2).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (3).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (4).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (5).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (6).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (7).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41.png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (1).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (2).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (3).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (4).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (5).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (6).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
            ['link' => url('source/detail/1'), 'image' => asset('landing-page/images/source/image 41 (7).png'), 'title' => 'Sadhguru - Karma - Inner Engineering'],
        ];

        $currentPage = $request->page;
        $totalItems = count($dataSource);
        $totalPage = (integer)($totalItems / $request->count) + ($totalItems % $request->count ? 1 : 0);
        $start = ($request->count * $currentPage) - $request->count;
        // $end = $request->count * $currentPage;
        $items = array_slice($dataSource, $start, $request->count);

        return response()->json(compact('totalItems', 'totalPage', 'start', 'items', 'currentPage'));
    }

    public function sourceDetail($id){
        $data['id'] = $id;

        return view('landing-page/source-detail', $data);
    }
}
