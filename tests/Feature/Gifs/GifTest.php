<?php

namespace Tests\Feature\Gifs;

use Tests\TestCase;

class GifTest extends TestCase
{

    public function test_user_can_view_trending_gifs()
    {
        $response = $this->get('/api/gifs');

        $response->assertSuccessful();

        // asserting received json structure
        $structure = ['data' => 
                               ['*' => 
                                      ['type',
                                       'url', 
                                       'images' => 
                                                   ['downsized']
                                      ]
                               ]
                    ];

        $response->assertJsonStructure($structure);

    }

    public function test_user_can_search_gifs()
    {
        $response = $this->get('/api/gifs/search?search=baby&offset=0');

        $response->assertSuccessful();

        // asserting received json structure
        $structure = [
            'count',
            'data' => 
                     ['*' => 
                            ['type',
                            'url', 
                            'images' => 
                                        ['downsized']
                            ]
                     ]
                    ];

        $response->assertJsonStructure($structure);

    }
}
