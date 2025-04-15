<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\MediaPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class MediaPostSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $captions = [
            'Tung tung tung sahur!',
            'Anomali detected 🚨',
            'Makan sahur yuk!',
            'Jangan lupa minum air putih',
            'Ngabuburit vibes 😎',
            'Ramadhan kali ini beda!',
            'Meme of the day!',
            'Yang penting kompak 😁',
            'Lelah tapi senang!',
            'Puasa hari ke sekian...',
            'Ayo semangat sahur!',
            'Habis sahur langsung kerja!',
            'Siapa siap sahur?',
            'Makanan favorit sahur!',
            'Ngebaperin orang sahur nih!',
            'Gue selalu tidur pas sahur',
            'Tunggu sahur, terus tidur lagi',
            'Jangan lupa kasih yang manis!',
            'Sahur penuh berkah!',
            'Cuma bisa liat makanan enak',
            'Niat sahur biar kuat puasa',
            'Tunggu waktu buka puasa',
            'Semangat puasa meski lapar',
            'Buka puasa yuk!',
            'Jangan lemes sahur dong!'
        ];

        $comments = [
            'Kocak banget ini wkwkwk',
            'Aing ngakak asli 😂',
            'Ini beneran terjadi?',
            'Haram banget ini sih haha',
            'Wkwkwk parah!',
            'Gue save dulu ya',
            'Tag temen lo!',
            'Ini mah udah level dewa',
            'Astagfirullah ngakak',
            'Tolong ini lucu beneran!'
        ];

        for ($i = 1; $i <= 51; $i++) {
            $user = $users->random();

            $post = MediaPost::create([
                'user_id' => $user->id,
                'caption' => fake()->randomElement($captions),
                'file_path' => "media-posts/{$i}.jpg",
                'file_type' => 'image',
            ]);

            // Like acak dari 3-10 user
            $likedUsers = $users->random(rand(3, 10));
            foreach ($likedUsers as $liker) {
                Like::create([
                    'media_post_id' => $post->id,
                    'user_id' => $liker->id,
                ]);
            }

            // Comment acak dari 3-8 user
            $commentUsers = $users->random(rand(3, 8));
            foreach ($commentUsers as $commenter) {
                Comment::create([
                    'media_post_id' => $post->id,
                    'user_id' => $commenter->id,
                    'comment' => fake()->randomElement($comments),
                ]);
            }
        }
    }
}
