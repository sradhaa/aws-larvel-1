<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
 
use Tests\TestCase;

use app\Models\BlogPost;

use app\Models\Comment;

class PostTest extends TestCase
{
   use RefreshDatabase;
    public function testBlogPostWhenNothingInDb()
    {
        $response = $this->get('/posts');

        $response->assertSeeText("No posts found");
    }

    public function testOneBlogPostIsComingOrNotInPostPageWithNoComments(){
//Arrange part
   
$post = $this->createDummyBlogPost();
//Act Part
        $response = $this->get('/posts');
//Assert part
        $response->assertSeeText("New title");

        $response->assertSeeText("No Comment Found");

        $this->assertDatabaseHas('blog_posts',['title'=>'New title']);
    }

    public function testSee1BlogPostWithComments(){
        //Arrange part

        $post = $this->createDummyBlogPost();
        Comment::factory(4)->create(['blog_post_id' => $post->id]);
        //Comment::factory()->count(4)->create(['blog_post_id' => $post->id]);
       //  factory(Comment::class,4)->create(['blog_post_id' => $post->id]);
        //Act Part
        $response = $this->get('/posts');

        $response->assertSeeText('4 comments');
    }

    public function testStoreValid(){
        $params  =   ['title'=>'a valid title',
                      'content'=>'a valid content'];

         $this->post('/posts',$params)->assertStatus(302)->assertSessionHas('status','Blog Post Created');


    }

    public function testStoreFail(){
        $params = ['title'=>'c',
                   'content' => 'c'];

                   $this->post('/posts' , $params)->assertStatus(302)->assertSessionHas('errors');

                   $message = session('errors')->getMessages();
                 //  dd($message->getMessages());exit;
                 $this->assertEquals($message['title'][0],'The title must be at least 5 characters.');
                 $this->assertEquals($message['content'][0],'The content must be at least 5 characters.');

                 $params1 = ['title'=>'c9999999999999999999999999999999999999999999999999999999999999999999999999999',
                 'content' => 'c'];

                 $this->post('/posts' , $params1)->assertStatus(302)->assertSessionHas('errors');

                 $message = session('errors')->getMessages();
                // dd($message);exit;
                $this->assertEquals($message['title'][0],'The title may not be greater than 20 characters.');
    }

    public function testForBlogPostUpdate(){
  
        $post = $this->createDummyBlogPost();

       // echo '<pre>';print_r($post->getAttributes());exit;
 
        $this->assertDatabaseHas('blog_posts',$post->getAttributes());

        
        $params = array('title'=>'A new named title',
    'content'=>'content has been changes'
    );

        $this->put("/posts/{$post->id}",$params)->assertStatus(302)->assertSessionHas('status');

        $this->assertEquals(session('status') , 'Blog Post Was Updated !');

        $this->assertDatabaseMissing('blog_posts',$post->getAttributes());

        $this->assertDatabaseHas('blog_posts',['title'=>'A new named title']);

        $this->assertDatabaseHas('blog_posts',$params);
       // echo '<pre>';print_r($post->toArray());exit;
    //    $fadat= BlogPost::findOrFail($post->id);
    //      echo '<pre>';print_r($fadat);exit;
    }
    public function testDelete(){

        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts',$post->getAttributes());

        $this->delete("/posts/{$post->id}")->assertStatus(302)->assertSessionHas('status');
        $this->assertEquals(session('status') , 'Blog Post Deleted');

        $this->assertDatabaseMissing('blog_posts',$post->getAttributes());

    }

   private function createDummyBlogPost() :BlogPost{
    $post = new BlogPost();
    $post->title="New title";
    $post->content="content of the blog post";
    $post->save();
    return $post;
   }
}

