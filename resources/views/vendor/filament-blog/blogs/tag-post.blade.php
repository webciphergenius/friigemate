<x-blog-layout>
    <section>
        <header class="container mx-auto mb-4 max-w-[800px] px-6 pb-4 mt-10 text-center tagPageHeader">
            <p class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                Tag: {{ $tag->name }}
            </p>
        </header>
    </section>
    <section class="pb-16 pt-8">
        <div class="container mx-auto">
            <div class="grid gap-x-20 sm:grid-cols-[1fr_minmax(min-content,30%)]">
                <div>
                    <div class="grid grid-cols-2 gap-x-14 gap-y-14">
                        @forelse ($posts as $post)
                            <x-blog-card :post="$post"/>
                        @empty
                            <div class="col-span-2 flex justify-center w-full">
                                <h2 class="text-2xl font-semibold text-gray-300">No posts found</h2>
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-20">
                        {{ $posts->links() }}
                    </div>
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
                            <input type="search" name="q" placeholder="Search blogs..." required>
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
                            @forelse($tags as $t)
                                <li>
                                    <a href="{{ route('filamentblog.tag.post', ['tag' => $t->slug]) }}"
                                       class="{{ $t->id === $tag->id ? 'font-bold bg-primary-600 text-white' : '' }}">
                                        {{ $t->name }}
                                        @if($t->posts_count > 0)
                                            <span class="text-xs {{ $t->id === $tag->id ? 'text-white' : 'text-gray-500' }}">({{ $t->posts_count }})</span>
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
    </section>

</x-blog-layout>
<style>
/* Tag Page */
.tagPageHeader {
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #464973 url(../../../images/inner-banner.png) no-repeat;
    background-size: cover;
    background-position: center bottom;
    margin-bottom: 60px;
}
.tagPageHeader p {
    color: #fff;
}
body.antialiased main {
    margin-top: 150px;
    padding-top: 18px;
}
body.antialiased header.mainHead {
    background: #21233c;
    padding: 10px 0;
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
    .grid.gap-x-20 {
        grid-template-columns: 1fr;
    }
}
</style>