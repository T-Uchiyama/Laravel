<?php

use App\Article;
use App\Comment;
use Illuminate\Database\Seeder;

class ArticleCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bodyDummy =  'この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。';
        $commentDummy = 'コメントダミーです。ダミーコメントだよ。';
        
        for ($index = 0; $index < 9; $index++) { 
            $article = new Article();
            $article->title = $index.'番目の投稿';
            $article->body = $bodyDummy;
            $article->category_id = 1;
            $article->save();
            
            $maxComments = mt_rand(3, 15);
            for ($number = 0; $number < $maxComments; $number++) { 
                $comment = new Comment();
			    $comment->commenter = '名無しさん';
			    $comment->comment = $commentDummy;
                
                $article->comments()->save($comment);
            }
        }
    }
}
