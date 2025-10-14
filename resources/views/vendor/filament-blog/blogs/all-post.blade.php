<x-blog-layout>
    <section class="py-10">
        <header class="container mx-auto px-6">
            <h3 class="inherits-color text-balance leading-tighter relative z-10 text-3xl font-semibold tracking-tight">
                Latest News / Blogs
            </h3>
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
                            <div class="col-span-2 mx-auto">
                                <div class="flex items-center justify-center">
                                    <p class="text-2xl font-semibold text-gray-300">No posts found</p>
                                </div>
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
    </section>

</x-blog-layout>
<style>
/* Blogs SH */
.min-h-screen div#navbarSupportedContent {
    visibility: visible;
}
body.antialiased main {
    margin-top: 150px;
    padding-top: 18px;
}
section.py-10 {
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f68743 url(../../../../images/inner-banner.png) no-repeat;
    background-size: cover;
    background-position: center bottom;
    margin-bottom: 60px;
}
h3.inherits-color.text-balance.leading-tighter.relative.z-10.text-3xl.font-semibold.tracking-tight {
    text-align: center;
    color: #fff;
    font-size: 35px !important;
}
body.antialiased header.mainHead {
    background: #21233c;
    padding: 10px 0;
}
body.antialiased h1.mb-6.text-4xl.font-semibold {
    font-size: 38px !important;
    line-height: 1.2;
}
.mb-5.flex.items-center.justify-between.gap-x-3.py-5 {
    padding: 0 !important;
    margin-bottom: 20px !important;
}
a.bg-primary-600.hover\:bg-primary-700.rounded-lg.px-8.py-4.font-semibold.text-white.transition-all.duration-300 {
    padding: 14px 60px !important;
    border-radius: 5px;
    font-weight: 400;
    display: inline-block;
}
textarea#author-comment {
    border: 1px solid #e5e6ea !important;
}
h2.whitespace-nowrap.text-xl.font-semibold {
    font-size: 32px !important;
}
h2.group-hover\/blog-item\:text-primary-700.mb-3.line-clamp-2.text-xl.font-semibold.hover\:text-blue-600 {
    font-size: 18px !important;
    font-weight: 500 !important;
    line-height: 1.2;
}
.group\/blog-item.flex.flex-col.gap-y-5 .flex.items-center.gap-4 {
    display: none;
}
a.flex.items-center.justify-center.md\:gap-x-5.rounded-full {
    padding: 16px 40px !important;
    border-radius: 4px;
    text-transform: capitalize;
    background: #f58642;
    color: #fff;
    font-size: 16px;
    font-weight: 500;
}
.relative.mb-6.flex.items-center.gap-x-8 {
    margin-bottom: 40px;
}
body.antialiased .container {
    max-width: 1320px;
    padding: 0 10px;
}
.footerWidget.web-list h5 {
    font-size: 1.25rem;
    font-weight: 500;
    padding-bottom: 10px;
}
/* Main grid layout */
.grid.gap-x-20 {
    display: flex;
    gap: 20px;
}

/* Left content area */
.grid.gap-x-20 > div:first-child {
    flex-basis: 70%;
}

/* Right sidebar */
.relativeBlogs {
    flex-basis: 30%;
}

/* Blog cards grid */
.grid.grid-cols-2.gap-x-14.gap-y-14 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
}

.grid.grid-cols-2.gap-x-14.gap-y-14 a {
    display: block;
    margin-bottom: 35px;
    border-bottom: 1px solid #ccc;
}

.grid.grid-cols-2.gap-x-14.gap-y-14 a .h-\[250px\].w-full.rounded-xl.bg-zinc-300.overflow-hidden {
    border-radius: 0;
    background: transparent;
    border: 1px solid #eee;
}

/* Sidebar styles */
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
 body.antialiased h1.mb-6.text-4xl.font-semibold {
    font-size: 28px !important;
}
h3.mb-2.text-2xl.font-semibold {
    font-size: 24px !important;
}

/* Mobile responsive layout */
.grid.gap-x-20 {
    flex-direction: column;
}

.grid.gap-x-20 > div:first-child,
.relativeBlogs {
    flex-basis: 100%;
}

.grid.grid-cols-2.gap-x-14.gap-y-14 {
    grid-template-columns: 1fr;
}

}
/* Blogs EH */
</style>