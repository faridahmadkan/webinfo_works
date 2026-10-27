<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_books_page_can_be_opened(): void
    {
        $response = $this->get('/books');
        $response->assertOk();
        $response->assertSee('Book Registration System');
    }

    public function test_a_book_can_be_registered(): void
    {
        $response = $this->post('/books', ['title' => 'Laravel Basics', 'author' => 'Sara Ahmad', 'pages' => 120]);
        $response->assertRedirect('/books');
        $this->assertDatabaseHas('books', ['title' => 'Laravel Basics', 'author' => 'Sara Ahmad', 'pages' => 120]);
    }
}
