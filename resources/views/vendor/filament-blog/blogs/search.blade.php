<x-blog-layout>
    <section class="pb-16">
        <div class="mb-10 flex gap-x-2 text-sm font-semibold blogDetailBanner">
            <a href="{{ route('filamentblog.post.index') }}" class="opacity-60">Home</a>
            <span class="opacity-30">/</span>
            <a href="{{ route('filamentblog.post.all') }}" class="opacity-60">Blog</a>
            <span class="opacity-30">/</span>
            <span class="max-w-2xl truncate font-medium">Search Results</span>
        </div>
        <div class="container mx-auto">
            <div class="mx-auto mb-20 space-y-10">
                <div class="mb-10">
                    <h1 class="text-4xl font-semibold mb-4">Search Results for: "{{ $query }}"</h1>
                    <p class="text-gray-600">Found {{ $posts->total() }} result(s)</p>
                </div>

                <div class="grid gap-x-20 sm:grid-cols-[minmax(min-content,10%)_1fr_minmax(min-content,10%)]">
                    <div class="space-y-10">
                        @forelse($posts as $post)
                            <div class="mb-8 pb-8 border-b border-gray-200 last:border-0">
                                <div class="flex gap-6">
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('filamentblog.post.show', ['post' => $post->slug]) }}">
                                            <img class="h-48 w-64 object-cover rounded-lg" 
                                                 src="{{ $post->cover_photo_path && str_starts_with($post->cover_photo_path, 'http') ? $post->cover_photo_path : asset('storage/' . $post->cover_photo_path) }}" 
                                                 alt="{{ $post->photo_alt_text }}">
                                        </a>
                                    </div>
                                    <div class="flex-1">
                                        <div class="mb-2">
                                            @foreach ($post->categories as $category)
                                            <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}">
                                                <span class="bg-primary-200 text-primary-800 mr-2 inline-flex rounded-full px-2 py-1 text-xs font-semibold">
                                                    {{ $category->name }}
                                                </span>
                                            </a>
                                            @endforeach
                                        </div>
                                        <h2 class="text-2xl font-semibold mb-3">
                                            <a href="{{ route('filamentblog.post.show', ['post' => $post->slug]) }}" 
                                               class="hover:text-primary-600 transition-colors">
                                                {{ $post->title }}
                                            </a>
                                        </h2>
                                        @if($post->sub_title)
                                            <p class="text-gray-600 mb-3">{{ $post->sub_title }}</p>
                                        @endif
                                        <div class="flex items-center gap-4 text-sm text-gray-500">
                                            <div class="flex items-center gap-2">
                                                <img class="h-8 w-8 rounded-full object-cover" 
                                                     src="{{ $post->user->avatar }}" 
                                                     alt="{{ $post->user->name() }}">
                                                <span>{{ $post->user->name() }}</span>
                                            </div>
                                            <span>•</span>
                                            <span>{{ $post->formattedPublishedDate() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-20">
                                <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="mt-4 text-2xl font-semibold text-gray-600">No results found</h3>
                                <p class="mt-2 text-gray-500">Try adjusting your search terms or browse all posts.</p>
                                <a href="{{ route('filamentblog.post.all') }}" 
                                   class="mt-6 inline-block rounded-lg bg-primary-600 px-8 py-3 text-white font-semibold hover:bg-primary-700 transition-colors">
                                    View All Posts
                                </a>
                            </div>
                        @endforelse

                        @if($posts->hasPages())
                            <div class="mt-10">
                                {{ $posts->appends(['q' => $query])->links() }}
                            </div>
                        @endif
                    </div>

                    <div class="relativeBlogs">
                        <div class="sidesearch">
                            <div class="mb-6 flex items-center gap-x-8">
                                <h2 class="whitespace-nowrap text-xl font-semibold">
                                    Search
                                </h2>
                                <div class="flex w-full items-center">
                                    <span class="h-0.5 w-full rounded-full bg-slate-200"></span>
                                </div>
                            </div>
                            <form action="{{ route('blog.search') }}" id="searchForm" method="GET">
                                <input type="search" name="q" value="{{ $query }}" placeholder="Search blogs..." required>
                            </form>
                        </div>
                        
                        <div class="sideCat">
                            <div class="mb-6 flex items-center gap-x-8">
                                <h2 class="whitespace-nowrap text-xl font-semibold">
                                    Categories
                                </h2>
                                <div class="flex w-full items-center">
                                    <span class="h-0.5 w-full rounded-full bg-slate-200"></span>
                                </div>
                            </div>
                            <ul class="catList">
                                @php
                                    $categories = app(\App\Http\Controllers\BlogController::class)->getAllCategories();
                                @endphp
                                @forelse($categories as $category)
                                    <li>
                                        <a href="{{ route('filamentblog.category.post', ['category' => $category->slug]) }}">
                                            {{ $category->name }} 
                                            @if($category->posts_count > 0)
                                                <span class="text-gray-500">({{ $category->posts_count }})</span>
                                            @endif
                                        </a>
                                    </li>
                    @empty
                                    <li class="text-gray-500">No categories found</li>
                                @endforelse
                            </ul>
                        </div>

                        <div class="blogTags">
                            <div class="mb-6 flex items-center gap-x-8">
                                <h2 class="whitespace-nowrap text-xl font-semibold">
                                    Tags
                                </h2>
                                <div class="flex w-full items-center">
                                    <span class="h-0.5 w-full rounded-full bg-slate-200"></span>
                                </div>
                            </div>
                            <ul class="blogTagsList">
                                @php
                                    $tags = app(\App\Http\Controllers\BlogController::class)->getAllTags();
                                @endphp
                                @forelse($tags as $tag)
                                    <li>
                                        <a href="{{ route('filamentblog.tag.post', ['tag' => $tag->slug]) }}">
                                            {{ $tag->name }}
                                            @if($tag->posts_count > 0)
                                                <span class="text-xs text-gray-500">({{ $tag->posts_count }})</span>
                                            @endif
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-gray-500">No tags found</li>
                @endforelse
                            </ul>
                        </div>
                    </div>
            </div>
            </div>
        </div>
    </section>
</x-blog-layout>
<style>
/* Blog Search Page */
.sm\:grid-cols-\[minmax\(min-content\2c 10\%\)_1fr_minmax\(min-content\2c 10\%\)\] {
    display: flex;
}
.min-h-screen div#navbarSupportedContent {
    visibility: visible;
}
.space-y-10 {
    flex-basis: 70%;
}
.relativeBlogs {
    flex-basis: 30%;
}
body.antialiased main {
    margin-top: 150px;
    padding-top: 18px;
}
body.antialiased header.mainHead {
    background: #21233c;
    padding: 10px 0;
}
.blogDetailBanner {
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #464973 url(../../../images/inner-banner.png) no-repeat;
    background-size: cover;
    background-position: center bottom;
    margin-bottom: 60px;
}
.blogDetailBanner * {
    color: #fff;
}
body.antialiased .container {
    max-width: 1320px;
    padding: 0 10px;
}
.sidesearch {
    margin-bottom: 35px;
}
form#searchForm {
    border: 1px solid #ededed;
}
form#searchForm input[type="search"] {
    width: 100%;
    padding: 15px;
}
.sideCat {
    margin-bottom: 30px;
}
.sideCat li {
    padding-bottom: 5px;
}
.blogTags {
    margin-top: 40px;
}
ul.blogTagsList {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}
ul.blogTagsList a {
    border: 1px solid #ccc;
    font-size: 13px;
    padding: 5px 10px;
    display: block;
}
@media only screen and (max-width: 768px) {
    .sm\:grid-cols-\[minmax\(min-content\2c 10\%\)_1fr_minmax\(min-content\2c 10\%\)\] {
        flex-direction: column;
    }
    .space-y-10, .relativeBlogs {
        flex-basis: 100%;
    }
}
</style>
