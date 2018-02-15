<?php
/**
 * Created by PhpStorm.
 * User: moe
 * Date: 06/11/16
 * Time: 3:13 PM
 */

function flash ($title = null, $message = null ){
    $flash = app('App\Http\Flash');

    if(func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $message);
}

function store_path(App\Store $store)
{
    return $store->store_name.'/'.str_replace(' ','-', $store->store_address);
}
function getCount($source, $input) {
    /*\App\Store::select('id')
        ->*/
    return \App\Store::select('id')->where($source, $input)->count();

}
function linking_to($body, $path, $type){
    $csrf = csrf_field();
    if (is_object($path)) {
        $action = '/' . $path->getTable();
        if (in_array($type, ['PUT', 'PATCH', 'DELETE'])) {
            $action .= '/' . $path-getKey();
        }
    } else {
        $action = $path;
    }
    return <<<EOT
        <form method="POST" action="{$action}">
            <input type="hidden" name="_method" value="{$type}">
            $csrf
            <button type="submit">{$body}</button>
        </form>
EOT;
}