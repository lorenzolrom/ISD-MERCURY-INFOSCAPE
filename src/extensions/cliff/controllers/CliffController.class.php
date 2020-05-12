<?php
/**
 * LLR Technologies & Associated Services
 * Information Systems Development
 *
 * Mercury MAP Navigator
 *
 * User: lromero
 * Date: 4/02/2020
 * Time: 9:36 AM
 */


namespace extensions\cliff\controllers;


use controllers\Controller;
use extensions\cliff\views\pages\BuildCorePage;
use extensions\cliff\views\pages\Cheatsheet;
use extensions\cliff\views\pages\CliffHome;
use extensions\cliff\views\pages\CompareCoresPage;
use extensions\cliff\views\pages\CoreCreatePage;
use extensions\cliff\views\pages\CoreEditPage;
use extensions\cliff\views\pages\CoreSearchPage;
use extensions\cliff\views\pages\KeyCreatePage;
use extensions\cliff\views\pages\KeyEditPage;
use extensions\cliff\views\pages\KeySearchPage;
use extensions\cliff\views\pages\SequenceKeysPage;
use extensions\cliff\views\pages\SystemCreatePage;
use extensions\cliff\views\pages\SystemEditPage;
use extensions\cliff\views\pages\SystemSearchPage;
use views\View;

class CliffController extends Controller
{

    /**
     * @return View
     * @throws \exceptions\InfoCentralException
     * @throws \exceptions\SecurityException
     * @throws \exceptions\ViewException
     * @throws \exceptions\EntryNotFoundException
     */
    public function getPage(): ?View
    {
        $p1 = $this->request->next();
        $p2 = $this->request->next();

        if($p1 === NULL)
            return new CliffHome();
        else if($p1 === 'cheatsheet' AND $p2 === NULL)
            return new Cheatsheet();
        else if($p1 === 'systems' AND $p2 === NULL)
            return new SystemSearchPage();
        else if($p1 === 'systems' AND $p2 === 'new')
            return new SystemCreatePage();
        else if($p1 === 'systems' AND $p2 !== NULL)
            return new SystemEditPage((int)$p2);
        else if($p1 === 'keys' AND $p2 === NULL)
            return new KeySearchPage();
        else if($p1 === 'keys' AND $p2 === 'new')
            return new KeyCreatePage();
        else if($p1 === 'keys' AND $p2 !== NULL)
            return new KeyEditPage((int)$p2);
        else if($p1 === 'cores' AND $p2 === NULL)
            return new CoreSearchPage();
        else if($p1 === 'cores' AND $p2 === 'new')
            return new CoreCreatePage();
        else if($p1 === 'cores' AND $p2 !== NULL)
            return new CoreEditPage((int)$p2);
        else if($p1 === 'buildcore' AND $p2 === NULL)
            return new BuildCorePage();
        else if($p1 === 'comparecores' AND $p2 === NULL)
            return new CompareCoresPage();
        else if($p1 === 'seqkeys' AND $p2 === NULL)
            return new SequenceKeysPage();

        return NULL;
    }
}