<?php
/**
  * LLR Technologies
 * part of LLR Enterprises - www.llrweb.com/technologies
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 6/11/2019
 * Time: 1:13 PM
 */


namespace extensions\facilities\views\pages;


class FacilitiesHome extends FacilitiesDocument
{
    public function __construct()
    {
        parent::__construct('facilitiescore_facilities-r');
        $this->setVariable('tabTitle', 'Facilities');

        $this->setVariable('content', self::templateFileContents('FacilitiesHome', self::TEMPLATE_PAGE, 'facilities'));
    }
}
