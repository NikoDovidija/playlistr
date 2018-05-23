<?php

use Illuminate\Database\Seeder;
use App\Models\Playlist;
use App\Models\Comment;
use App\Models\Song;
use App\Models\Artwork;
use App\User;
class DatabaseSeeder extends Seeder
{
    


    public function run()
    {
        $playlists = [
            [
                1, 
                1,
                "My Playlist 1", 
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation.", 
                1,
                12,
                6,
            ],
            [
                2, 
                2,
                "My Playlist 2", 
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt.", 
                1,
                12,
                6,
            ],
            [
                3, 
                3,
                "My Playlist 3", 
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet, 
                consectetur adipiscing elit, sed do eiusmod tempor incididunt.", 
                1,
                12,
                6,
            ],
            [
                4, 
                4,
                "My Playlist 4", 
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt. Lorem ipsum dolor sit amet, 
                consectetur adipiscing elit, sed do eiusmod tempor incididunt.", 
                1,
                12,
                6,
            ],
        ];
    
        $songs = [
            [
                1,
                1,
                "public/storage/Intervals - Fable.mp3",
                "Fable",
                "Intervals",
                "The Shape of Colour",
                258,
                0,
            ],
            [
                2,
                2,
                "public/storage/Intervals - Fable.mp3",
                "Fable",
                "Intervals",
                "The Shape of Colour",
                258,
                0,
            ],
            [
                3,
                3,
                "public/storage/Intervals - Fable.mp3",
                "Fable",
                "Intervals",
                "The Shape of Colour",
                258,
                0,
            ],
            [
                4,
                4,
                "public/storage/Intervals - Fable.mp3",
                "Fable",
                "Intervals",
                "The Shape of Colour",
                258,
                0,
            ],
        ];
    
        $comments = [
            [
                1,
                1,
                "Jack",
                "Hey, this playlist is totally rad!! Love it!",
                "playlist",
            ],
            [
                2,
                1,
                "Julian",
                "Needs more djent.",
                "playlist",
            ],
            [
                3,
                2,
                "Bartholomeo",
                "Needs more cowbell.",
                "comment",
            ],
            [
                4,
                2,
                "Christian",
                "Needs more time signatures",
                "comment",
            ],
            [
                5,
                2,
                "Heidi",
                "Hey, this kind of playlists are awesome for work. Could you make it more complete please?",
                "playlist",
            ],
            [
                6,
                5,
                "Julian",
                "Yeah, I was just testing this. Will add some more songs soon.",
                "comment",
            ],
        ];
        // $artworks = [
        //     [
        //         1,
        //         1,
        //         "http://www.lgam.info/local--files/wayne-eddy-s-photos-6/Artvo-Shark.jpg",

        //     ],
        //     [
        //         2,
        //         2,
        //         "https://images.fandango.com/ImageRenderer/0/0/redesign/static/img/default_poster.png/0/images/fandangoblog/Garofalo-It-Final-crop-Silk.jpg",
        //     ],
        //     [
        //         3,
        //         3,
        //         "http://s3.weddbook.com/t4/2/6/1/2616913/flowerfishswan-watercolor-paintingoriginal-watercolor-artunique-artoriginal-watercolor-ooakartworkaquarelleflowerart-collectibes.jpg",
        //     ],
        //     [
        //         4,
        //         4,
        //         "http://s3.weddbook.com/t4/2/6/1/2616913/flowerfishswan-watercolor-paintingoriginal-watercolor-artunique-artoriginal-watercolor-ooakartworkaquarelleflowerart-collectibes.jpg",
        //     ],
        //     [
        //         5,
        //         4,
        //         "http://s3.weddbook.com/t4/2/6/1/2616913/flowerfishswan-watercolor-paintingoriginal-watercolor-artunique-artoriginal-watercolor-ooakartworkaquarelleflowerart-collectibes.jpg",
        //     ],
        //     [
        //         6,
        //         4,
        //         "http://s3.weddbook.com/t4/2/6/1/2616913/flowerfishswan-watercolor-paintingoriginal-watercolor-artunique-artoriginal-watercolor-ooakartworkaquarelleflowerart-collectibes.jpg",
        //     ],
        //     [
        //         7,
        //         4,
        //         "http://s3.weddbook.com/t4/2/6/1/2616913/flowerfishswan-watercolor-paintingoriginal-watercolor-artunique-artoriginal-watercolor-ooakartworkaquarelleflowerart-collectibes.jpg",
        //     ],
        // ];

        $users = [
            [
                1,
                "User1",
                "Email1",
                "Pass1",
            ],
            [
                2,
                "User2",
                "Email2",
                "Pass2",
            ],
            [
                3,
                "User3",
                "Email3",
                "Pass3",
            ],
            [
                4,
                "User4",
                "Email4",
                "Pass4",
            ],
            [
                5,
                "User5",
                "Email5",
                "Pass5",
            ],
            [
                6,
                "User6",
                "Email6",
                "Pass6",
            ],
            [
                7,
                "User7",
                "Email7",
                "Pass7",
            ],
        ];

        foreach ($users as $user) {
            $u = new User;
            $u->user_id =$user[0];
            $u->name =$user[1];
            $u->email =$user[2];
            $u->password =$user[3];
            $u->save();
        }
    
        foreach ($playlists as $playlist) {
            $p = new Playlist;
            $p->playlist_id = $playlist[0];
            $p->user_id = $playlist[1];
            $p->name = $playlist[2];
            $p->description = $playlist[3];
            $p->times_played = $playlist[5];
            $p->recommended = $playlist[6];
            $p->save();
        }

        // foreach ($artworks as $artwork) {
        //     $a = new Artwork;
        //     $a->artwork_id = $artwork[0];
        //     $a->playlist_id = $artwork[1];
        //     $a->url = $artwork[2];
        //     $a->save();
        // }

        foreach ($songs as $song) {
            $s = new Song;
            $s->song_id = $song[0];
            $s->playlist_id = $song[1];
            $s->song_url = $song[2];
            $s->name = $song[3];
            $s->artist = $song[4];
            $s->album = $song[5];
            $s->duration = $song[6];
            $s->playcount = $song[7];
            $s->save();
        }

        foreach ($comments as $comment) {
            $c = new Comment;
            $c->comment_id = $comment[0];
            $c->response_to = $comment[1];
            $c->author = $comment[2];
            $c->text = $comment[3];
            $c->parent_type = $comment[4];
            $c->save();
        }

       


    }
}
