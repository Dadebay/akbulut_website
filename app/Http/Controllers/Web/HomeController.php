<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = env('API_BASE_URL', 'https://akbulut.com.tm/api');
    }

    public function index()
    {
        // Fetch categories from API
        $categoriesResponse = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/categories");
        $categories = $categoriesResponse->successful() ? collect($categoriesResponse->json('data', [])) : collect([]);

        // Fetch latest news from API
        $newsResponse = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/latest_news");
        $newsData = $newsResponse->successful() ? $newsResponse->json('data', []) : [];
        
        // Fetch sliders from API
        $slidersResponse = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/home_sliders_web");
        $sliders = $slidersResponse->successful() ? collect($slidersResponse->json('data', [])) : collect([]);
        
        // Convert to paginated collection
        $perPage = env('perPage', 10);
        $news = new LengthAwarePaginator(
            collect($newsData)->take($perPage),
            count($newsData),
            $perPage,
            1
        );

        return view('site.welcome', compact('categories', 'news', 'sliders'));
    }

    public function aboutUs()
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/about_us");
        $aboutUs = $response->successful() ? (object)$response->json('data', []) : null;
        
        return view('site.about.about_us', compact('aboutUs'));
    }

    public function allNews()
    {
        $page = request('page', 1);
        $perPage = env('perPage', 10);
        
        $response = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/news", [
            'page' => $page,
            'per_page' => $perPage
        ]);
        
        $newsData = $response->successful() ? $response->json('data', []) : [];
        
        $news = new LengthAwarePaginator(
            collect($newsData),
            count($newsData),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('site.news', compact('news'));
    }

    public function showNews($newsId)
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/news/{$newsId}");
        $news = $response->successful() ? (object)$response->json('data', []) : null;

        // Get random news
        $topNewsResponse = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/news");
        $allNews = $topNewsResponse->successful() ? collect($topNewsResponse->json('data', [])) : collect([]);
        $top_news = $allNews->where('id', '!=', $newsId)->random(min(6, $allNews->count()));

        return view('site.newsdetail', compact('news', 'top_news'));
    }

    public function categoryProducts(Request $request)
    {
        $category_id = $request->get('category_id');
        $page = request('page', 1);
        $perPage = env('perPage', 10);

        // Fetch categories from API for sidebar
        $categoriesResponse = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/categories");
        $categories = $categoriesResponse->successful() ? collect($categoriesResponse->json('data', [])) : collect([]);

        // Fetch products from API
        $params = ['page' => $page, 'per_page' => $perPage];
        if ($category_id) {
            $params['category_id'] = $category_id;
        }

        $response = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/products", $params);
        $productsData = $response->successful() ? $response->json('data', []) : [];

        $products = new LengthAwarePaginator(
            collect($productsData),
            count($productsData),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('site.products.categoryproducts', compact('products', 'category_id', 'categories'));
    }

    public function Privacy()
    {
        $response = Http::withOptions(['verify' => false])->get("{$this->apiBaseUrl}/privacy");
        $aboutUs = $response->successful() ? (object)$response->json('data', []) : null;
        
        return view('site.privacy', compact('aboutUs'));
    }

    public function anniversary()
    {
        return view('site.anniversary');
    }

    public function turkmenGips()
    {
        return view('site.turkmen_gips');
    }
}

