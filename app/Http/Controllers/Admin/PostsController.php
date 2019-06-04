<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $posts = Post::where('post_title', 'LIKE', "%$keyword%")
                ->orWhere('post_tease', 'LIKE', "%$keyword%")
                ->orWhere('post_image', 'LIKE', "%$keyword%")
                ->orWhere('post_content', 'LIKE', "%$keyword%")
                ->orWhere('post_author', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $posts = Post::latest()->paginate($perPage);
        }

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cates = Category::pluck('cate_name', 'id');
        return view('admin.posts.create', compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'post_title' => 'required',
			'post_tease' => 'required',
			'post_content' => 'required'
		]);
        $requestData = $request->except('post_image', 'post_author');
        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image');
            $filename = 'post' . '-' . time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('Uploads/Post');
            $request->file('post_image')->move($location, $filename);

            $requestData['post_image'] = $filename;
        }
        else{
            $requestData['post_image'] = null;
        }
        if(Auth::user())
        {
            $requestData['post_author'] = Auth::user()->id;
        }
        else{
            $requestData['post_author'] = null;
        }
        
        Post::create($requestData);

        return redirect('admin/posts')->with('flash_message', 'Post added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $cates = Category::pluck('cate_name', 'id');

        return view('admin.posts.edit', compact('post', 'cates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'post_title' => 'required',
			'post_tease' => 'required',
			'post_content' => 'required'
		]);
        $requestData = $request->all();
        
        $post = Post::findOrFail($id);
        $post->update($requestData);

        return redirect('admin/posts')->with('flash_message', 'Post updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Post::destroy($id);

        return redirect('admin/posts')->with('flash_message', 'Post deleted!');
    }
}
