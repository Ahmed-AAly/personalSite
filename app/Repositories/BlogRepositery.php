<?php

namespace App\Repositories;

use App\Models\Blog;

/**
 * this class contains all Blog DB querys
 */
class BlogRepositery
{
    /**
     * @var Blog $blog
     */
    protected $blog;

    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Get complete list of all published blog articles.
     * @param Type|void
     * @return object
     */
    public function getAllBlogPosts(bool $status = null): object
    {
        return $this->blog->select('id', 'title', 'blog_content', 'blog_img', 'published_status', 'created_at')
        ->when($status, function ($query, $status) {
            return $query->where('published_status', 1);
        })
        ->paginate(10);
    }

    /**
     * Get selected post from storage.
     * @param Type|int $id
     * @return object
     */
    public function getBlogPostFromDB(int $id, bool $status = null): object
    {
        return $this->blog->select('id', 'title', 'blog_content', 'blog_img', 'published_status')
        ->where('id', $id)
        ->when($status, function ($query, $status) {
            return $query->where('published_status', 1);
        })
        ->get();
    }

    /**
     * search for article
     * @param Type|string $keywords
     * @return object
     */
    public function searchBlogPost(string $keywords, bool $status = null): object
    {
        return $this->blog->select('id', 'title', 'blog_content', 'blog_img', 'published_status')
        ->where('title', 'like', '%' . $keywords . '%')
        ->when($status, function ($query, $status) {
            return $query->where('published_status', 1);
        })
        ->get();
    }

    /**
     * Store article to DB.
     * @param Type|string $imgPath
     * @param Type|string $title
     * @param Type|string $blogContent
     * @param Type|bool $publishStatus
     * @return object
     */
    public function storeBlogPostToDB(string $imgPath, string $title, string $blogContent, bool $publishStatus): bool
    {
        try {
            $storeblog = $this->blog;
            $storeblog->title = $title;
            $storeblog->blog_img  = $imgPath;
            $storeblog->blog_content  = $blogContent;
            $storeblog->published_status  = $publishStatus;
            $storeblog->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    /**
     * Update article on DB.
     * @param Type|int $int
     * @param Type|string $imgPath
     * @param Type|string $title
     * @param Type|string $blogContent
     * @param Type|bool $publishStatus
     * @return object
     */
    public function updateBlogPostOnDB(
        int $id,
        string $imgPath,
        string $title,
        string $blogContent,
        bool $publishStatus
    ): bool {
        try {
            $this->blog->where('id', $id)
            ->update(['title' => $title, 'blog_img' => $imgPath,
            'blog_content' => $blogContent
            , 'published_status' => $publishStatus]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * removes article from DB
     * @param int $blogPostID
     */
    public function removeBLogPostQuery(int $blogPostID): bool
    {

        try {
            $this->blog->find($blogPostID)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
