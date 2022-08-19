<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\BlogRepositery;
use Exception;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BlogService
{
    /**
     * @var BlogRepositery $blogRepositery
     */
    protected $blogRepositery;

    public function __construct(BlogRepositery $blogRepositery)
    {
        $this->blogRepositery = $blogRepositery;
    }

    /**
     * directs the user to blog admin main home page.
     * adminstration backend.
     * @param Type|void
     * @return Type|object Illuminate\Http\Response
     */
    public function indexPage(): object
    {
        $blogList = $this->blogRepositery->getAllBlogPosts();

        return view('admin.blog.blog', compact('blogList'));
    }

    /**
     * directs the user to blog main home page
     * site visitors frondend.
     * @param Type|void
     * @return Type|object Illuminate\Http\Response
     */
    public function frontEndIndexPage(): object
    {
        $blogList = $this->blogRepositery->getAllBlogPosts(true);
        return view('blog.blog', compact('blogList'));
    }

    /**
     * load article content.
     * @param Type|int $id
     * @return Type|object Illuminate\Http\Response
     */
    public function readPostContent(int $id): object
    {
        $blogPost = $this->blogRepositery->getBlogPostFromDB($id, true);
        if ($blogPost->isEmpty()) {
            return $this->frontEndIndexPage();
        } else {
            return view('blog.read', [$id], compact('blogPost'));
        }
    }

    /**
     * handles the user search request for a article.
     * @param Type|object $request
     * @return Type|object Illuminate\Http\Response
     */
    public function searchPost(object $request): object
    {
        $messages = [
            'post_title.required' => __('backendLang.searchTitleRequired'),
            'post_title.max' => __('backendLang.searchMaxChar'),
            'post_title.min' => __('backendLang.searchMinChar'),
        ];

        $validator = Validator::make($request->all(), [
            'post_title' => 'required|string|max:50|min:3',
        ], $messages);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        $searchResults = $this->blogRepositery->searchBlogPost($request->post_title, true);

        if ($searchResults->isEmpty()) {
            return back()->with('noArticleFound', __('backendLang.noArticleFound'));
        } else {
            return view('blog.search', compact('searchResults'));
        }
    }

    /**
     * adminstration backend.
     * directs the user to article publishing form.
     * @param Type|void
     * @return Type|object Illuminate\Http\Response
     */
    public function createBlog(): object
    {
        return view('admin.blog.create');
    }

    /**
     * adminstration backend.
     * handles publishing new article.
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function storeBlog(object $request): object
    {
        $validator = Validator::make($request->all(), [
            'post_image' => 'required|image|mimes:jpg,bmp,png,gif',
            'blog_title' => 'required|string|max:255',
            'blog_content' => 'required|string|max:50000',
            'immediately_publish' => 'nullable|in:on',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $imgPath = $request->file('post_image')->store('blogAssetS', 'customStorageFolder');

            if ($request->immediately_publish === 'on') {
                $request->immediately_publish = true;
            } else {
                $request->immediately_publish = false;
            }

            $storeNewPost = $this->blogRepositery->storeBlogPostToDB(
                $imgPath,
                $request->blog_title,
                $request->blog_content,
                $request->immediately_publish
            );

            if ($storeNewPost) {
                return redirect()->route('blog')->with('successstatus', __('backendLang.articlePublished'));
            }
            if (!$storeNewPost) {
                return back()->with('failedstatus', __('backendLang.failedToPublished'));
            }
        }
    }

    /**
     * adminstration backend.
     * directs user to article edit form.
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function editBlog(object $request): object
    {
        $validator = Validator::make($request->all(), [
            'post_ID' => 'required|numeric|exists:blog,id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $getPostCotent = $this->blogRepositery->getBlogPostFromDB(intval($request->post_ID));

            return view('admin.blog.edit', compact('getPostCotent'));
        }
    }

    /**
     * adminstration backend.
     * handles article update request.
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function updateBlog(object $request): object
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|numeric|exists:blog,id',
            'post_image' => 'nullable|image|mimes:jpg,bmp,png,gif',
            'blog_title' => 'required|string|max:255',
            'blog_content' => 'required|string|max:50000',
            'immediately_publish' => 'nullable|in:on',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            // If user did not upload new image, this block is triggered.
            if (is_null($request->file('post_image'))) {
                $path = $this->blogRepositery->getBlogPostFromDB(intval($request->post_id));
                $imgPath = $path['0']['blog_img'];
            }
            // If user uploaded new image, this block is triggered.
            if (!is_null($request->file('post_image'))) {
                $path = $this->blogRepositery->getBlogPostFromDB(intval($request->post_id));
                Storage::disk('customStorageFolder')->delete($path['0']['blog_img']);
                $imgPath = $request->file('post_image')->store('blogAssetS', 'customStorageFolder');
            }
            // Handles user request to update the post publish status.
            if ($request->immediately_publish === 'on') {
                $request->immediately_publish = true;
            } else {
                $request->immediately_publish = false;
            }
            // And finaly we update the post.
            $updatePost = $this->blogRepositery->updateBlogPostOnDB(
                intval($request->post_id),
                $imgPath,
                $request->blog_title,
                $request->blog_content,
                $request->immediately_publish
            );

            if ($updatePost) {
                return redirect()->route('blog')->with('successstatus', __('backendLang.articleUpdated'));
            }
            if (!$updatePost) {
                return back()->with('failedstatus', __('backendLang.failedToUpdate'));
            }
        }
    }

    /**
     * adminstration backend.
     * handles removing article request.
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function deleteBlog(object $request): object
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|numeric|exists:blog,id',
            'delete_confirmation' => 'required|string|in:DELETE',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $imgPath = $this->blogRepositery->getBlogPostFromDB(intval($request->post_id));
            Storage::disk('customStorageFolder')->delete($imgPath['0']['blog_img']);
            $deletePOst = $this->blogRepositery->removeBLogPostQuery(intval($request->post_id));

            if ($deletePOst) {
                return back()->with('successstatus', __('backendLang.articleDeleted'));
            }
            if (!$deletePOst) {
                return back()->with('failedstatus', __('backendLang.failedToDelete'));
            }
        }
    }
}
