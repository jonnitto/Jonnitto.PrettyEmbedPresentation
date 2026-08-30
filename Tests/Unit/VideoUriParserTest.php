<?php

declare(strict_types=1);

namespace Carbon\VideoPlatformEditor\Tests\Unit;

use Jonnitto\PrettyEmbedPresentation\Service\ParseIDService;
use PHPUnit\Framework\TestCase;

class VideoUriParserTest extends TestCase
{
    public static function examples(): iterable
    {
        yield 'L' . __LINE__ => [
            'input' => '',
            'parsed' => null
        ];

        yield 'L' . __LINE__ => [
            'input' => '   ',
            'parsed' => null
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://mysite.de',
            'parsed' => null
        ];

        // TODO not a youtube video
        // yield 'L'  . __LINE__ => [
        //     'input' => 'http://www.youtube.com/user/Scobleizer#p/u/1/1p3vcRhsYGo',
        //     'parsed' => ['youtubeVideoId' => 'todo', 'youtubeType' =>'video']
        // ];

        yield 'L' . __LINE__ => [
            'input' => 'https://vimeo.com/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://vimeo.com/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://www.vimeo.com/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://www.vimeo.com/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://vimeo.com/channels/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://vimeo.com/channels/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://vimeo.com/groups/name/videos/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://vimeo.com/groups/name/videos/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://vimeo.com/album/2222222/video/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://vimeo.com/album/2222222/video/11111111',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://vimeo.com/11111111?param=test',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://vimeo.com/11111111?param=test',
            'parsed' => ['vimeoId' => '11111111']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://vimeo.com/jonnitto/carbonplausible',
            'parsed' => ['vimeoId' => 'jonnitto/carbonplausible']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://youtu.be/IdOfTheVideo',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://www.youtube.com/embed/IdOfTheVideo',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'youtu.be/IdOfTheVideo',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'youtube.com/watch?v=IdOfTheVideo',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://youtu.be/IdOfTheVideo&t=2m',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://www.youtube.com/embed/IdOfTheVideo&t=2m5s',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://www.youtube.com/watch?v=IdOfTheVideo',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://www.youtube.com/watch?v=IdOfTheVideo&feature=g-vrec&t=30s',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://www.youtube.com/watch?v=IdOfTheVideo&feature=player_embedded',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        // TODO Bug, fails with "IdOfTheVideo?fs=1"
        // yield 'L' . __LINE__ => [
        //     'input' => 'http://www.youtube.com/v/IdOfTheVideo?fs=1&hl=en_US',
        //     'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' =>'video']
        // ];

        yield 'L' . __LINE__ => [
            'input' => 'http://www.youtube.com/ytscreeningroom?v=IdOfTheVideo',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://www.youtube.com/watch?NR=1&feature=endscreen&v=IdOfTheVideo',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' => 'video']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://www.youtube.com/watch?v=2a_ytyt9sf8&list=PLmmYSbUCWJ4x1GO839azG_BBw8rkh-zOj&index=2',
            'parsed' => ['youtubeVideoId' => 'PLmmYSbUCWJ4x1GO839azG_BBw8rkh-zOj', 'youtubeType' => 'playlist']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'http://www.youtube.com/watch?v=IdOfTheVideo&feature=c4-overview-vl&list=PlaylistID',
            'parsed' => ['youtubeVideoId' => 'PlaylistID', 'youtubeType' => 'playlist']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://www.youtube.com/watch?v=IdOfTheVideo&list=PlaylistID',
            'parsed' => ['youtubeVideoId' => 'PlaylistID', 'youtubeType' => 'playlist']
        ];


        yield 'L' . __LINE__ => [
            'input' => 'youtube.com/shorts/IdOfTheVideo',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' =>  'short']
        ];

        yield 'L' . __LINE__ => [
            'input' => 'https://www.youtube.com/shorts/IdOfTheVideo',
            'parsed' => ['youtubeVideoId' => 'IdOfTheVideo', 'youtubeType' =>  'short']
        ];

        // Support for plain ids?
        // TODO
        // yield 'L' . __LINE__ => [
        //     'input' => 'shorts/IdOfTheVideo',
        //     'parsed' => ['youtubeVideoId' =>'IdOfTheVideo', 'youtubeType' => 'short']
        // ];
        // yield 'L' . __LINE__ => [
        //     'input' => 'warC3CxMtOE',
        //     'parsed' => ['youtubeVideoId' =>'warC3CxMtOE', 'youtubeType' => 'video']
        // ];
        // yield 'L' . __LINE__ => [
        //     'input' => '6383273',
        //     'parsed' => ['vimeoId' => videoId: '6383273']
        // ];
    }

    /**
     * @test
     * @dataProvider examples
     */
    public function parseExamples(string $input, array|null $parsed): void
    {
        $parser = new ParseIDService();
        /** Illegal dependency in test but the method type() should be part of this package */
        $typeParser = new \Jonnitto\PrettyEmbedHelper\Service\YoutubeService();

        $type = $parser->platform($input);
        $result = null;
        if ($type === 'youtube') {
            $youtubeType = $typeParser->type($input);
            $result = [
                'youtubeVideoId' => $parser->youtube($input, $youtubeType),
                'youtubeType' => $youtubeType,
            ];
            // other parser should reject input
            // self::assertNull($parser->vimeo($input));
        } elseif ($type === 'vimeo') {
            $result = [
                'vimeoId' => $parser->vimeo($input),
            ];
            // other parser should reject input
            // self::assertNull($parser->youtube($input));
        }

        self::assertEquals($parsed, $result);
    }
}
