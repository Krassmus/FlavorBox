<?php

class FBCourseInfo extends SimpleORMap
{
    protected static function configure($config = array())
    {
        $config['db_table'] = 'flavorbox_courseinfo';
        parent::configure($config);
    }
}