<h1>文章列表</h1>
<ul>
    @foreach ($posts as $post)
        <li>{{ $post }}</li>
    @endforeach
</ul>