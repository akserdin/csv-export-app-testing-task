<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomePageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_home_page_works()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Completed testing task');
    }
}
