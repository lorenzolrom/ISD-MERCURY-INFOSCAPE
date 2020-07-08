<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 10/30/2019
 * Time: 3:09 PM
 */


namespace extensions\tickets;


class ExtConfig
{
    public const MENU = array(
        'servicenter' => array(
            'title' => 'Tickets',
            'permission' => 'tickets',
            'icon' => 'emedia/tickets/eicon.svg',
            'link' => 'tickets'
        ),
    );

    public const ROUTES = array(
        'tickets' => 'extensions\tickets\controllers\TicketController',
    );
}
