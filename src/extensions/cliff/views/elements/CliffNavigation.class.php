<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/02/2020
 * Time: 9:43 AM
 */


namespace extensions\cliff\views\elements;


use views\elements\Navigation;

class CliffNavigation extends Navigation
{
    public const BASE_URI = 'cliff/';

    public const LINKS = array(
        'home' => array(
            'title' => 'CLIFF',
            'permission' => 'cliff-r',
            'icon' => 'home',
            'link' => ''
        ),
        'records' => array(
            'title' => 'Records',
            'permission' => 'cliff-r',
            'icon' => 'assignment',
            'pages' => array(
                array(
                    'title' => 'Systems',
                    'link' => 'systems',
                    'icon' => 'work',
                    'permission' => 'cliff-r',
                ),
                array(
                    'title' => 'Keys',
                    'link' => 'keys',
                    'icon' => 'vpn_key',
                    'permission' => 'cliff-r',
                ),
                array(
                    'title' => 'Cores',
                    'link' => 'cores',
                    'icon' => 'security',
                    'permission' => 'cliff-r',
                ),
                array(
                    'title' => 'A2 Cheatsheet',
                    'link' => 'cheatsheet',
                    'icon' => 'assignment',
                    'permission' => 'cliff-r',
                ),
            )
        ),
        'processing' => array(
            'title' => 'Processing',
            'permission' => 'cliff-r',
            'icon' => 'sync',
            'pages' => array(
                array(
                    'title' => 'Compare Cores',
                    'link' => 'comparecores',
                    'icon' => 'book',
                    'permission' => 'cliff-r',
                ),
                array(
                    'title' => 'Build Core',
                    'link' => 'buildcore',
                    'icon' => 'build',
                    'permission' => 'cliff-r',
                ),
                array(
                    'title' => 'Seq. Keys',
                    'link' => 'seqkeys',
                    'icon' => 'vpn_key',
                    'permission' => 'cliff-w',
                ),
            )
        ),
        'xref' => array(
            'title' => 'X-Reference',
            'permission' => 'cliff-r',
            'icon' => 'search',
            'pages' => array(
                array(
                    'title' => 'X-Ref Locations',
                    'link' => 'xreflocations',
                    'icon' => 'room',
                    'permission' => 'cliff-r'
                ),
                array(
                    'title' => 'X-Ref People',
                    'link' => 'xrefpeople',
                    'icon' => 'account_circle',
                    'permission' => 'cliff-r'
                )
            )
        )
    );

    /**
     * TicketNavigation constructor.
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\ViewException
     */
    public function __construct()
    {
        parent::__construct(self::BASE_URI, self::LINKS);
    }
}
