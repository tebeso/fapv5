<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class FapNavigationController extends Controller
{
    /**
     * @var array|string[][]
     */
    protected array $pageItems1 = [
        [
            'button' => 'Audio',
            'title'  => 'AUDIO',
            'menuId' => 'audio',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Lights',
            'title'  => 'LIGHTS',
            'menuId' => 'lights',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Doors/<br />Slides',
            'title'  => 'DOORS/SLIDES',
            'menuId' => 'doors-slides',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Temp.',
            'title'  => 'TEMPERATURE',
            'menuId' => 'temperature',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Water/<br >Waste',
            'title'  => 'WATER/WASTE',
            'menuId' => 'water-waste',
            'type'   => 'nav-item-disabled',
        ],
        [
            'button' => 'Smoke<br />Detect.',
            'title'  => 'SMOKE DETECTION',
            'menuId' => 'smoke-detection',
            'type'   => 'nav-item',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'button' => 'System<br />Info',
            'title'  => 'SYSTEM INFO',
            'menuId' => 'system-info',
            'type'   => 'nav-item',
        ],
    ];

    /**
     * @var array|string[][]
     */
    protected array $pageItems2 = [
        [
            'button' => 'Setup<br /> Audio',
            'title'  => 'SETUP AUDIO',
            'menuId' => 'setup/audio',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Setup<br /> Lights',
            'title'  => 'SETUP LIGHTS',
            'menuId' => 'setup/lights',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Setup<br /> Doors',
            'title'  => 'SETUP DOORS',
            'menuId' => 'setup/doors-slides',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Setup<br /> Temp.',
            'title'  => 'SETUP TEMPERATURE',
            'menuId' => 'setup/temperature',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Setup<br /> Smoke',
            'title'  => 'SETUP SMOKE DETECTION',
            'menuId' => 'setup/smoke-detect',
            'type'   => 'nav-item',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'button' => 'Aircraft<br /> Layout',
            'title'  => 'SETUP AIRCRAFT LAYOUT',
            'menuId' => 'setup/aircraft-layout',
            'type'   => 'nav-item',
        ],
    ];

    /**
     * @var array|string[][]
     */
    protected array $pageItems3 = [
        [
            'button' => 'FAP<br /> Control',
            'title'  => 'FAP CONTROL',
            'menuId' => 'admin/fap-control',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Bridge<br /> Setup',
            'title'  => 'BRIDGE SETUP',
            'menuId' => 'admin/bridge-setup',
            'type'   => 'nav-item',
        ],
        [
            'button' => 'Sreen<br /> Saver',
            'title'  => 'SCREENSAVER',
            'menuId' => 'admin/screensaver',
            'type'   => 'nav-item',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'type' => 'nav-item-blank',
        ],
    ];


    /**
     * Gets all navigation buttons from the current page.
     * Also checks if previous and next pages have elements to show to correct arrow state.
     *
     * @param int $pageId
     *
     * @return JsonResponse
     */
    public function getNavigationItems(int $pageId): JsonResponse
    {
        $pageItems = 'pageItems' . $pageId;

        $previousPageId = $pageId - 1;
        $nextPageId     = $pageId + 1;

        if (isset($this->$pageItems) === true) {
            $return = [
                'prev'  => $this->hasItems($previousPageId),
                'items' => $this->$pageItems,
                'next'  => $this->hasItems($nextPageId),
            ];
        } else {
            $return = false;
        }

        return response()->json($return);
    }


    /**
     * Checks if a page has items and returns true or false.
     *
     * @param int $pageId
     *
     * @return bool
     */
    protected function hasItems(int $pageId): bool
    {
        $pageItems = 'pageItems' . $pageId;

        return isset($this->$pageItems) === true && empty($this->$pageItems === false);
    }
}