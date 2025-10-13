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
            <div class="grid gap-x-14 gap-y-14 sm:grid-cols-3">
                @forelse ($posts as $post)
                    <x-blog-card :post="$post"/>
                @empty
                    <div class="mx-auto col-span-3">
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
    background: #464973 url(../../../images/inner-banner.png) no-repeat;
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
.grid.gap-x-14.gap-y-14.sm\:grid-cols-3 {
    display: block;
}
.grid.gap-x-14.gap-y-14.sm\:grid-cols-3 a {
    display: block;
    margin-bottom: 35px;
    border-bottom: 1px solid #ccc;
}
.grid.gap-x-14.gap-y-14.sm\:grid-cols-3 a .h-\[250px\].w-full.rounded-xl.bg-zinc-300.overflow-hidden {
    border-radius: 0;
    background: transparent;
    border: 1px solid #eee;
}
@media only screen and (max-width: 768px) {
 body.antialiased h1.mb-6.text-4xl.font-semibold {
    font-size: 28px !important;
}
h3.mb-2.text-2xl.font-semibold {
    font-size: 24px !important;
}

}
/* Blogs EH */
</style>