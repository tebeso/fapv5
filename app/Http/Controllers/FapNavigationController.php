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
            'name'   => 'Audio',
            'menuId' => 'audio',
            'type'   => 'nav-item',
        ],
        [
            'name'   => 'Lights',
            'menuId' => 'lights',
            'type'   => 'nav-item',
        ],
        [
            'name'   => 'Doors/<br />Slides',
            'menuId' => 'doors-slides',
            'type'   => 'nav-item',
        ],
        [
            'name'   => 'Temp.',
            'menuId' => 'temp',
            'type'   => 'nav-item',
        ],
        [
            'name'   => 'Water/<br >Waste',
            'menuId' => 'water-waste',
            'type'   => 'nav-item',
        ],
        [
            'name'   => 'Smoke<br />Detect.',
            'menuId' => 'smoke-detect',
            'type'   => 'nav-item',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'type' => 'nav-item-blank',
        ],
        [
            'name'   => 'System<br />Info',
            'menuId' => 'system-info',
            'type'   => 'nav-item',
        ],
    ];

    /**
     * @var array|string[][]
     */
    protected array $pageItems2 = [
        [
            'name'   => 'Setup<br /> Audio',
            'menuId' => 'setup-audio',
            'type'   => 'nav-item',
        ],
        [
            'name'   => 'Setup<br /> Lights',
            'menuId' => 'setup-lights',
            'type'   => 'nav-item',
        ],
        [
            'name'   => 'Setup<br /> Doors',
            'menuId' => 'setup-doors-slides',
            'type'   => 'nav-item',
        ],
        [
            'name'   => 'Setup<br /> Temp.',
            'menuId' => 'setup-temp',
            'type'   => 'nav-item',
        ],
        [
            'name'   => 'Setup<br /> Smoke',
            'menuId' => 'setup-smoke-detect',
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
    ];

    /**
     * @var array
     */
    protected array $pageItems3;


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

        $previousPageItems = $pageId - 1;
        $nextPageItems     = $pageId + 1;

        if (isset($this->$pageItems) === true) {
            $return = [
                'prev'  => $this->hasItems($previousPageItems),
                'items' => $this->$pageItems,
                'next'  => $this->hasItems($nextPageItems),
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