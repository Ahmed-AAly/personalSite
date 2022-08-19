<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\Admin\BlogController;
use App\Models\User;
use App\Repositories\BlogRepositery;
use App\Services\BlogService;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    // use WithoutMiddleware;

    /**
     * Test if we can visit admin Blog route.
     * @param Type|void
     * @return void
     */
    public function testIfWeCanGetBlogAdminIndexRoute(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get(route('blog'));

        $response->assertStatus(200);
    }

    /**
     * Test if we can post new blog post.
     * @param Type|void
     * @return void
     */
    public function testIfWeCanPostNewBlogPost(): void
    {
        $blog = \App\Models\Blog::factory()->create();
        $this->assertIsString($blog->title);
        $this->assertIsString($blog->blog_content);
    }

    /**
     * Test if we can get a list of all blog posts.
     * @param Type|void
     * @return void
     */
    public function testIfWeCanGetListOfAllBlogPosts(): void
    {
        $blog = \App\Models\Blog::factory()->create();
        $blogRepo = $this->app->make(BlogRepositery::class);
        $blogList = $blogRepo->getAllBlogPosts();
        $this->assertGreaterThanOrEqual(1, $blogList->count());
    }

    /**
     * Test if we can visit create blog route.
     * @param Type|void
     * @return void
     */
    public function testIfWeCanGetBlogCreationRoute(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->get(route('createBlog'));

        $response->assertStatus(200);
    }

    /**
     * test if we are able to store blog post to DB
     *
     * @param Type|void
     * @return void
     */
    public function testIfSendStoreRequestToBlogService(): void
    {
        $this->withoutMiddleware();
        $user = User::factory()->create();
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $request = $this->post(route('storeBlog'), [
            'post_image' => $file,
            'blog_title' => 'blogTitle',
            'blog_content' => 'saasskadjaksjd ask;ldj;alskjd;laksjd;, a;lskjd;alskjd alskjd;aslkjd;alsjdjdhflajdsfhl',
            'immediately_publish' => 'on'
        ]);
        $request->assertSessionHas("successstatus");
        $request->assertStatus(302);
    }

    /**
     * test if we are able to store blog post to DB
     *
     * @param Type|void
     * @return void
     */
    public function testIfStoreBlogPostToDatabase(): void
    {
        $blogRepo = $this->app->make(BlogRepositery::class);
        $storeBlogPost = $blogRepo->storeBlogPostToDB('/sasasa/asassa', 'blog Ttile', 'assaasasasasas assasaasas', 1);
        $this->assertTrue($storeBlogPost);
    }
}
