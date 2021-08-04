<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author ahmedabdelaziz
 */
interface curdInterface {
    function get_all();
    function update($id);
    function delete($id);
    function get_by_id($id);
}
