<div  class="admin-left-menu">
    <ul>
        <ul class="images-menu-items">
            <li class="admin-menu-item"><a href="/admin/files/">Files</a></li>
            <li class="admin-menu-item"><a href="/admin/files/upload-page/">Upload file(s)</a></li>
        </ul>
        <ul class="news-menu-items">
            <li class="admin-menu-item"><a href="/admin/news/">News</a></li>
            <li class="admin-menu-item"><a href="/admin/news/create/">Create new</a></li>
        </ul>
        <ul class="faqs-menu-items">
            <li class="admin-menu-item"><a href="/admin/faqs/">Faqs</a></li>
            <li class="admin-menu-item"><a href="/admin/faqs/create/">Create faq</a></li>
        </ul>
        <ul class="posts-menu-items">
            <li class="admin-menu-item"><a href="/admin/posts/">Posts</a></li>
            <li class="admin-menu-item"><a href="/admin/posts/create/">Create post</a></li>
        </ul>
        <ul class="auth-menu-items">
            <li class="admin-menu-item"><a href="/auth/register">register</a></li>
            @if (Auth::guest())
                <li class="admin-menu-item"><a href="/auth/login">Login</a></li>
            @else
                <li class="dropdown admin-menu-item">
                    <a href="#" class="dropdown-toggle admin-menu-item" data-toggle="dropdown" role="button" aria-expanded="false"><% Auth::user()->name %> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class="admin-menu-item"><a href="/auth/logout">Logout</a></li>
                    </ul>
                </li>
            @endif
            <li class="admin-menu-item"><a href="/">Home</a></li>
        </ul>
    </ul>
</div>