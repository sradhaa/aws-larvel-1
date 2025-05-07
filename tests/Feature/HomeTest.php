<?php

namespace Tests\Feature;
 
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageIsWorkingCorrectly()
    {
        $response = $this->get('/');

       // $response->assertStatus(200);
       $response->assertSeeText("Hello, welcome to laravel");
    }
    public function testConatctPageIsWorkingCorrectly()
    {
        $response = $this->get('/contact');
        $response->assertSeeText('Contact Page');
    }
}
