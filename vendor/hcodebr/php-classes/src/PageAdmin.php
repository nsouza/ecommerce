<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hcode;

/**
 * Description of PageAdmin
 *
 * @author nsouza
 */
class PageAdmin extends Page {
    public function __construct($opts = array(), $tpl_dir = "/views/admin/") {
        parent::__construct($opts, $tpl_dir);
    }
}
