<?php

use Illuminate\Database\Seeder;

class FilmsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
   public function run()
     {
         // DB::table('films')->insert([
         //     'title' => '',
         //     'year' => '',
         //     'certificate' => '',
         //     'subtitle' => '',
         //     'slug' => '',
         //     'thumb' => '',
         //     'description' => '',
         //     'short_description' => '',
         //     'runtime' => '',
         //     'buy_url' => '',
         //     'director' => '',
         //     'starring' => '',
         //     'country' => '',
         //     'language' => '',
         //     'f_rating' => '',
         //     'association' => '',
         //     'format' => '',
         //     'tickets' => '',
         //     'alt_language_title' => '',
         //     'free' => '',
         //     'audio_description' => true
         // ]);
        if(!App\Models\Film::find(1)) {
         DB::table('films')->insert([
             'title' => 'Apostasy',
             'year' => '2018',
             'certificate' => 'PG',
             'subtitle' => '',
             'slug' => 'apostasy',
             'thumb' => '/images/seeded/apostasy.jpg',
             'description' => 'As devout Jehovah\'s Witnesses, sisters Alex and Luisa and their mother, Ivanna, are united in The Truth. Alex looks up to her confident older sister, while striving to follow in Ivanna\'s footsteps as a \'good Witness\'. But when Luisa starts to question the advice of the Elders, she makes a life-altering transgression that threatens to expel her from the congregation. A remarkable and authentic insight into the complex nature of faith, family, duty and love, Apostasy is one of the year’s stand-out British indies.',
             'short_description' => 'A remarkable and authentic insight into the complex nature of faith, family, duty and love',
             'runtime' => '',
             'director' => 'Dan Kokotajlo',
             'starring' => 'Siobhan Finneran, Robert Emms, Sacha Parkinson',
             'country' => 'UK',
             'language' => 'English',
             'f_rating' => '1',
             'association' => '',
             'format' => '',
             'tickets' => '',
             'alt_language_title' => '',
             'free' => false,
             'audio_description' => true
         ]);
       }

       if(!App\Models\Film::find(2)) {
        DB::table('films')->insert([
            'title' => 'Jumanji',
            'year' => '1995',
            'certificate' => 'PG',
            'subtitle' => '',
            'slug' => 'jumanji',
            'thumb' => '/images/seeded/jumanji.jpg',
            'description' => 'A magical board game unleashes a world of adventure on siblings Peter (Bradley Pierce) and Judy Shepherd (Kirsten Dunst).  ﻿﻿While exploring an old mansion, the youngsters find a curious, jungle-themed game called Jumanji in the attic. When they start playing, they free Alan Parrish (Robin Williams), who\'s been stuck in the game\'s inner world for decades. If they win Jumanji, the kids can free Alan for good -- but that means braving giant bugs, ill-mannered monkeys and even stampeding rhinos!',
            'short_description' => 'A magical board game unleashes a world of adventure',
            'runtime' => '100',
            'director' => 'Joe Johnston',
            'starring' => 'Robin Williams, Kirsten Dunst',
            'country' => 'USA',
            'language' => 'English',
            'f_rating' => '0',
            'association' => '',
            'format' => '',
            'tickets' => 'Our special Hyde & Seek matinees every Saturday at 12noon are just £1.50 for kids (aged 14 and under) and £5 for adults.',
            'alt_language_title' => '',
            'free' => false,
            'audio_description' => true
        ]);
      }


        if(!App\Models\Film::find(3)) {
         DB::table('films')->insert([
             'title' => 'Tracking Edith',
             'year' => '2016',
             'certificate' => 'PG',
             'subtitle' => '',
             'slug' => 'tracking-edith',
             'thumb' => '/images/seeded/trackingedith.jpg',
             'description' => 'Being a secret agent doesn’t seem to have come naturally to photographer Edith Tudor-Hart. When she wasn’t working as a Soviet agent, she was taking photos of workers and street children in Vienna and London, documenting their conditions and social deprivation. Directed by Edith’s great nephew Peter Stephan, the filmmaker tries to unravel the truth about his aunt’s life in Austria, the UK and Russia, and uncover the hidden secrets behind his remarkable family.',
             'short_description' => 'Being a secret agent doesn’t seem to have come naturally to photographer Edith Tudor-Hart.',
             'runtime' => '91',
             'director' => 'Peter Stephan Jungk',
             'starring' => 'Edith Tudor-Hart, Misha Donat, Duncan Forbes',
             'country' => 'Austria/Germany/Russia/UK',
             'language' => 'English',
             'f_rating' => '0',
             'association' => '',
             'format' => '',
             'tickets' => '',
             'alt_language_title' => '',
             'free' => false,
             'audio_description' => false
         ]);
       }
         if(!App\Models\Film::find(4)) {
          DB::table('films')->insert([
              'title' => 'Hearts Beat Loud',
              'year' => '2018',
              'certificate' => '12A',
              'subtitle' => '',
              'slug' => 'hearts-beat-loud',
              'thumb' => '/images/seeded/heartsbeatloud.jpg',
              'description' => 'In the hip Brooklyn neighbourhood of Red Hook, single dad and record store owner Frank is preparing to send his hard-working daughter Sam off to college, while being forced to close his vintage shop. Hoping to stay connected through their shared musical passions, Frank urges Sam to turn their weekly "jam sesh" into a father-daughter live act. After their first song becomes an Internet breakout, the two embark on a journey of love, growing up and musical discovery.',
              'short_description' => 'Single dad and record store owner Frank is preparing to send his hard-working daughter Sam off to college',
              'runtime' => '97',
              'director' => 'Brett Haley',
              'starring' => 'Nick Offerman, Kiersey Clemons, Ted Danson',
              'country' => 'USA',
              'language' => 'English',
              'f_rating' => '0',
              'association' => '',
              'format' => '',
              'tickets' => '',
              'alt_language_title' => '',
              'free' => false,
              'audio_description' => true
          ]);
        }
        if(!App\Models\Film::find(5)) {
         DB::table('films')->insert([
             'title' => 'The Apparition',
             'year' => '2018',
             'certificate' => '12A',
             'subtitle' => '',
             'slug' => 'apparition',
             'thumb' => '/images/seeded/apparition.jpg',
             'description' => 'Jacques is a journalist at a leading newspaper in France. His reputation as an impartial and talented investigator attracts the attention of the Vatican who recruits him for a special task; to investigate the veracity of a divine apparition in a small French village. Upon his arrival, he meets the young Anna, who claims to have personally witnessed the apparition of the Virgin Mary. Intriguing and suspenseful, intimate yet epic, The Apparition keeps the viewer on their toes until the very end.',
             'short_description' => 'The Apparition keeps the viewer on their toes until the very end.',
             'runtime' => '144',
             'director' => 'Xavier Giannoli',
             'starring' => 'Vincent Lindon, Galatéa Bellugi, Patrick d’Assumçao',
             'country' => 'France',
             'language' => 'French & Italian, with English subtitles',
             'f_rating' => '0',
             'association' => '',
             'format' => '',
             'tickets' => '',
             'alt_language_title' => 'L’apparition',
             'free' => false,
             'audio_description' => false
         ]);
       }
         if(!App\Models\Film::find(6)) {
          DB::table('films')->insert([
              'title' => 'The Hitch-Hiker',
              'year' => '1953',
              'certificate' => '12A',
              'subtitle' => 'Mother of Us All: Ida Lupino at 100',
              'slug' => 'the-hitch-hiker',
              'thumb' => '/images/seeded/hitchhiker.jpg',
              'description' => 'Inspired by the true-life crimes of Billy Cook, The Hitch-Hiker is a taut and suspenseful noir thriller from 1953, directed and independently produced by Ida Lupino. A weekend fishing trip turns into the holiday from hell when two friends make the fateful mistake of giving a ride to a psychotic drifter.',
              'short_description' => 'Inspired by the true-life crimes of Billy Cook',
              'runtime' => '71',
              'director' => 'Ida Lupino',
              'starring' => 'Edmond O’Brien, Frank Lovejoy, William Talman',
              'country' => 'USA',
              'language' => 'French & Italian, with English subtitles',
              'f_rating' => '0',
              'association' => 'She’s A Rebel',
              'format' => '35mm film',
              'tickets' => '',
              'alt_language_title' => '',
              'free' => false,
              'audio_description' => false
          ]);
        }
          if(!App\Models\Film::find(7)) {
           DB::table('films')->insert([
               'title' => 'BlacKkKlansman',
               'year' => '2018',
               'certificate' => '15',
               'subtitle' => 'With panel discussion',
               'slug' => 'blackkklansman',
               'thumb' => '/images/seeded/blackkklansman.jpg',
               'description' => 'It’s the early 1970s, a time of great social upheaval as the struggle for civil rights rages on. Ron Stallworth becomes the first African-American detective on the Colorado Springs Police Department, but his arrival is greeted with skepticism and open hostility by the department’s rank and file. Undaunted, Stallworth resolves to make a name for himself and a difference in his community. He bravely sets out on a dangerous mission: infiltrate and expose the Ku Klux Klan.',
               'short_description' => 'A portrait of great social upheaval as the struggle for civil rights rages on',
               'runtime' => '135',
               'director' => 'Spike Lee',
               'starring' => 'John David Washington, Adam Driver, Laura Harrier, Topher Grace',
               'country' => 'USA',
               'language' => '',
               'f_rating' => '0',
               'association' => 'Leeds Black Film Club, The Racial Justice Network',
               'format' => '',
               'tickets' => '',
               'alt_language_title' => '',
               'free' => false,
               'audio_description' => false
           ]);
         }
           if(!App\Models\Film::find(8)) {
            DB::table('films')->insert([
                'title' => 'Pet Sematary',
                'year' => '1989',
                'certificate' => '18',
                'subtitle' => '',
                'slug' => 'pet-sematary',
                'thumb' => '/images/seeded/pet-sematary.jpg',
                'description' => 'When the Creed family move to Maine, they think they are moving to an idyllic new home. Yet just behind their house is a pet cemetery built on top of an old Indian burial ground. Whilst the young family recover from a tragedy, a supernatural threat complicates their healing. Stephen King, who adapted his novel for the screen, initially thought it was too bleak to be published. So join us for this late-night screening as we spiral into darkness, revisiting one of Stephen King’s creepiest creations.',
                'short_description' => 'Join us for this late-night screening as we spiral into darkness',
                'runtime' => '103',
                'director' => 'Mary Lambert',
                'starring' => 'Dale Midkiff, Denise Crosby, Fred Gwynne',
                'country' => 'USA',
                'language' => '',
                'f_rating' => '0',
                'association' => '',
                'format' => '',
                'tickets' => '',
                'alt_language_title' => '',
                'free' => false,
                'audio_description' => false
            ]);
          }
     }
}
