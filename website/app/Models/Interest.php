<?php

namespace App\Models;

class Interest
{
    public const INTERESTS = [
        'hobby' => [
            'title' => 'My Hobby',
            'image' => 'Travel.jpg',
            'content' => [
                'My main hobby is programming...',
                'In my free time, I enjoy hiking and DJing...',
            ],
        ],
        'books' => [
            'title' => 'Favorite Books',
            'image' => 'soldier.jpg',
            'content' => [
                '"1984" - George Orwell',
                '"The Master and Margarita" - Mikhail Bulgakov',
                '"Three Comrades" - Erich Maria Remarque',
                '"Generation P" - Pelevin V.',
                '"Dnevnik vampira" - Pelevin V.',
            ],
        ],
        'music' => [
            'title' => 'Favorite Music',
            'content' => [
                'Rock: Linkin Park, КиШ, Limp Bizkit',
                'DnB: Prodigy',
                'Dark Techno: Droplex',
                'Heavy Underground: Тяжелая атлетика, Цинк уродов',
            ],
        ],
        'movies' => [
            'title' => 'Favorite Films',
            'content' => [
                'Movie 43 – A bold and controversial comedy.',
                'Груз 200 – A dark and intense Russian drama.',
                'Requiem for a Dream – A powerful film about addiction.',
            ],
        ],
    ];
}
