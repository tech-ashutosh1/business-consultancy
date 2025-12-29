<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display blog posts for admin
     */
    public function index()
    {
        $posts = BlogPost::with('author')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.blog.index', compact('posts'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $categories = ['General', 'Industry News', 'Company Updates', 'Tips & Guides', 'Case Studies'];
        return view('admin.blog.create', compact('categories'));
    }

    /**
     * Store new blog post
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable|max:500',
            'content' => 'required',
            'category' => 'required|max:100',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author_id'] = auth()->id();
        $validated['is_featured'] = $request->has('is_featured');
        
        if ($validated['status'] === 'published' && empty($request->published_at)) {
            $validated['published_at'] = now();
        }

        BlogPost::create($validated);

        return redirect()->route('blog.index')
            ->with('success', 'Blog post created successfully!');
    }

    /**
     * Show edit form
     */
    public function edit(BlogPost $blog)
    {
        $categories = ['General', 'Industry News', 'Company Updates', 'Tips & Guides', 'Case Studies'];
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    /**
     * Update blog post
     */
    public function update(Request $request, BlogPost $blog)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable|max:500',
            'content' => 'required',
            'category' => 'required|max:100',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_featured'] = $request->has('is_featured');
        
        if ($validated['status'] === 'published' && empty($blog->published_at)) {
            $validated['published_at'] = now();
        }

        $blog->update($validated);

        return redirect()->route('blog.index')
            ->with('success', 'Blog post updated successfully!');
    }

    /**
     * Delete blog post
     */
    public function destroy(BlogPost $blog)
    {
        $blog->delete();

        return redirect()->route('blog.index')
            ->with('success', 'Blog post deleted successfully!');
    }

    /**
     * Public blog listing
     */
    public function publicIndex()
    {
        $featuredPosts = BlogPost::published()
            ->featured()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $posts = BlogPost::published()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = BlogPost::published()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('blog.index', compact('posts', 'featuredPosts', 'categories'));
    }

    /**
     * Show single blog post
     */
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->published()
            ->firstOrFail();

        $relatedPosts = BlogPost::published()
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}