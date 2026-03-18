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
        $locale = app()->getLocale();
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept-Language' => $locale])
            ->get("{$this->apiBaseUrl}/about_us", ['lang' => $locale]);
        $aboutUs = $response->successful() ? (object)$response->json('data', []) : null;
        
        return view('site.about.about_us', compact('aboutUs'));
    }

    public function allNews()
    {
        $page = request('page', 1);
        $perPage = env('perPage', 10);
        $locale = app()->getLocale();
        
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept-Language' => $locale])
            ->get("{$this->apiBaseUrl}/news", [
            'page' => $page,
            'per_page' => $perPage,
            'lang' => $locale,
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
        $locale = app()->getLocale();
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept-Language' => $locale])
            ->get("{$this->apiBaseUrl}/news/{$newsId}", ['lang' => $locale]);
        $news = $response->successful() ? (object)$response->json('data', []) : null;

        // Get related news in same locale
        $topNewsResponse = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept-Language' => $locale])
            ->get("{$this->apiBaseUrl}/news", ['lang' => $locale]);
        $allNews = $topNewsResponse->successful() ? collect($topNewsResponse->json('data', [])) : collect([]);
        $top_news = $allNews->where('id', '!=', $newsId)->random(min(6, $allNews->count()));

        return view('site.newsdetail', compact('news', 'top_news'));
    }

    public function categoryProducts(Request $request)
    {
        $category_id = $request->get('category_id');
        $page = request('page', 1);
        $perPage = env('perPage', 10);
        $locale = app()->getLocale();

        // Fetch categories from API for sidebar (with locale)
        $categoriesResponse = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept-Language' => $locale])
            ->get("{$this->apiBaseUrl}/categories", ['lang' => $locale]);
        $categories = $categoriesResponse->successful() ? collect($categoriesResponse->json('data', [])) : collect([]);

        // Fetch products from API (with locale)
        $params = ['page' => $page, 'per_page' => $perPage, 'lang' => $locale];
        if ($category_id) {
            $params['category_id'] = $category_id;
        }

        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept-Language' => $locale])
            ->get("{$this->apiBaseUrl}/products", $params);
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
        $locale = app()->getLocale();
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Accept-Language' => $locale])
            ->get("{$this->apiBaseUrl}/privacy", ['lang' => $locale]);
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

