<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ request()->is('admin/home*') ? 'active' : ''}}">
        
        <p>Esasy Sahypa</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('categories.index')}}" class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
        
        <p>Kategoriyalar</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('news.index')}}" class="nav-link {{ request()->is('admin/news*') ? 'active' : '' }}">
        
        <p>Habarlar</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('products.index')}}" class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
        
        <p>Harytlar</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('galleries.index')}}"
       class="nav-link {{ request()->is('admin/galleries*') ? 'active' : '' }}">
        
        <p>Gallereya</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('feedbacks.index')}}" class="nav-link {{ request()->is('admin/contacts*') ? 'active' : '' }}">
        
        <p>Feedback</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('sliders.index')}}" class="nav-link {{ request()->is('admin/sliders*') ? 'active' : '' }}">
        
        <p>Esasy sahypa Sliders</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('abouts.index')}}" class="nav-link {{ request()->is('admin/abouts*') ? 'active' : '' }}">
        
        <p>Biz Hakda text</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('privacies.index')}}" class="nav-link {{ request()->is('admin/privacies*') ? 'active' : '' }}">
        
        <p>Privacy Policy text</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{route('files.index')}}" class="nav-link {{ request()->is('admin/files*') ? 'active' : '' }}">
        
        <p>File Manager</p>
    </a>
</li>


