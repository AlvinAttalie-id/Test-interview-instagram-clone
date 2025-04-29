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
        $users = User::role('user')->get(); // hanya user role 'user'

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
        ];

        $comments = [
            'Kocak banget ini wkwkwk',
            'Aing ngakak asli 😂',
            'Ini beneran terjadi?',
            'Wkwkwk parah!',
            'Gue save dulu ya',
            'Tag temen lo!',
        ];

        $videoFiles = ['test-2.mp4', 'test-3.mp4', 'test-4.mp4', 'test-5.mp4', 'test-6.mp4'];
        $maxFoto = 51;
        $totalFoto = 0;

        foreach ($users as $user) {
            // 2 video post per user
            for ($i = 0; $i < 2; $i++) {
                $videoFile = fake()->randomElement($videoFiles);

                $this->createPost($user, "media-posts/{$videoFile}", 'video', $captions, $comments);
            }

            // 8-12 foto post per user supaya total mendekati 1000
            $fotoPosts = rand(8, 12);
            for ($j = 0; $j < $fotoPosts; $j++) {
                $fotoNumber = rand(1, $maxFoto);

                $this->createPost($user, "media-posts/{$fotoNumber}.jpg", 'image', $captions, $comments);

                $totalFoto++;
            }
        }

        $this->command->info("Total Foto Posts Generated: {$totalFoto}");
    }

    private function createPost($user, $filePath, $fileType, $captions, $comments)
    {
        $post = MediaPost::create([
            'user_id' => $user->id,
            'caption' => fake()->randomElement($captions),
            'file_path' => $filePath,
            'file_type' => $fileType,
        ]);

        // Likes random 3-8
        $likers = User::inRandomOrder()->limit(rand(3, 8))->get();
        foreach ($likers as $liker) {
            Like::create([
                'media_post_id' => $post->id,
                'user_id' => $liker->id,
            ]);
        }

        // Comments random 2-5
        $commenters = User::inRandomOrder()->limit(rand(2, 5))->get();
        foreach ($commenters as $commenter) {
            Comment::create([
                'media_post_id' => $post->id,
                'user_id' => $commenter->id,
                'comment' => fake()->randomElement($comments),
            ]);
        }
    }
}
