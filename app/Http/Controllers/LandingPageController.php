<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Ebook;
use App\Models\EbookDownload;

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
            $category = ['news', 'press-release'];

            if(in_array($request->category, $category)){
                $titles = ['news' => 'Latest News', 'press-release' => 'Press Release'];

                $data = [
                    'title' => $titles[$request->category],
                    'page' => $request->get('page') ? $request->page : 1,
                    'category' => $request->category,
                ];

                if($request->get('page')){
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
        if($request->get('slug')){
            $blog = Blog::where('slug', $request->slug)->first();
            $blogs = Blog::whereIn('id', json_decode($blog->related_ids))->get();

            return response()->json(compact('blog', 'blogs'));
        }


        if($request->get('category')){
            $categories = ['news', 'press-release'];

            if(in_array($request->category, $categories)){
                $category = $request->category;
                $currentPage = $request->page;
                $totalItems = Blog::where('category', $request->category)->count();
                $totalPage = (integer)($totalItems / $request->count) + ($totalItems % $request->count ? 1 : 0);
                $start = ($request->count * $currentPage) - $request->count;
                $items = Blog::where('category', $request->category)->offset($start)->limit($request->count)->get()->toArray();

                return response()->json(compact('totalItems', 'totalPage', 'start', 'items', 'currentPage', 'category'));
            }
        }

        $latestBlogs = Blog::limit(3)->orderBy('id', 'desc')->get();
        $latestNews = Blog::where('category', 'news')->limit(4)->orderBy('id', 'desc')->get();
        $pressRelease = Blog::where('category', 'press-release')->limit(4)->orderBy('id', 'desc')->get();

        return response()->json(compact('latestBlogs', 'latestNews', 'pressRelease'));
    }

    public function blogDetail($slug){
        $data['slug'] = $slug;

        return view('landing-page/blog-detail', $data);
    }

    public function source(Request $request){
        $data['page'] = $request->get('page') ? $request->page : 1;

        return view('landing-page/source', $data);
    }

    public function sourceData(Request $request){
        if($request->get('slug')){
            $ebook = Ebook::where('slug', $request->slug)->first();

            return response()->json($ebook);
        }

        $currentPage = $request->page;
        $totalItems = Ebook::count();
        $totalPage = (integer)($totalItems / $request->count) + ($totalItems % $request->count ? 1 : 0);
        $start = ($request->count * $currentPage) - $request->count;
        $items = Ebook::offset($start)->limit($request->count)->get()->toArray();

        return response()->json(compact('totalItems', 'totalPage', 'start', 'items', 'currentPage'));
    }

    public function sourceDetail($slug){
        $data['slug'] = $slug;
        
        return view('landing-page/source-detail', $data);
    }

    public function downloadEbook(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|in:indonesia,other',
            'company' => 'required|string|max:255',
            'job' => 'required|string',
            'slug' => 'required|string'
        ]);

        $ebook = Ebook::where('slug', $request->slug)->first();

        if(!$ebook){
            return response()->json([
                'message' => 'Data Not Found',
                'errors' => ['Data Not Found'],
            ], 404);
        }

        $ebookDownload = new EbookDownload;
        $ebookDownload->ebook_id = $ebook->id;
        $ebookDownload->name = $request->name;
        $ebookDownload->email = $request->email;
        $ebookDownload->country = $request->country;
        $ebookDownload->company_name = $request->company;
        $ebookDownload->job_title = $request->job;
        $ebookDownload->downloaded_at = date('Y-m-d H:i:s');
        $ebookDownload->save();

        // DB::table('e    ')->insert($blogs);

        return response()->json(['link_download' => asset($ebook->file_url)]);
    }
}
