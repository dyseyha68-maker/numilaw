<?php

use Illuminate\Support\Facades\Route;

Route::get('/debug-articles', function() {
    $allArticles = \App\Models\Article::with(['author', 'category'])->get();
    $publishedArticles = \App\Models\Article::published()->get();
    
    echo "<h2>All Articles ({$allArticles->count()})</h2>";
    echo "<table border='1' style='border-collapse: collapse; margin: 20px 0;'>";
    echo "<tr><th>ID</th><th>Title</th><th>Status</th><th>Published At</th><th>Now()</th><th>Published Query?</th></tr>";
    
    foreach($allArticles as $article) {
        $isPublished = $article->status === 'published' && 
                      $article->published_at !== null && 
                      $article->published_at <= now();
        
        echo "<tr>";
        echo "<td>{$article->id}</td>";
        echo "<td>{$article->title_en}</td>";
        echo "<td>{$article->status}</td>";
        echo "<td>" . ($article->published_at ? $article->published_at->toDateTimeString() : 'null') . "</td>";
        echo "<td>" . now()->toDateTimeString() . "</td>";
        echo "<td>" . ($isPublished ? '✓' : '✗') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2>Published via Scope ({$publishedArticles->count()})</h2>";
    foreach($publishedArticles as $article) {
        echo "<p>ID: {$article->id}, Title: {$article->title_en}, Published: {$article->published_at}</p>";
    }
});