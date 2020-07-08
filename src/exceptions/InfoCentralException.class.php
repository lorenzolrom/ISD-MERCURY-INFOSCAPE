<?php
/**
 * LLR Information Systems Development
 * part of LLR Services Group - www.llrweb.com/isd
 *
 * Mercury Application Platform
 * InfoScape
 *
 * User: lromero
 * Date: 4/07/2019
 * Time: 3:44 PM
 */


namespace exceptions;


class InfoCentralException extends MercuryException
{
    const IC_RESPONDED_500 = 1300;

    const MESSAGES = array(
        self::IC_RESPONDED_500 => 'The InfoCentral server did not provide a valid response'
    );
}
