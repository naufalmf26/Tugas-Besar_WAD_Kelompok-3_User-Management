<?php

namespace Modules\Homepage\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GroceryCrud\Core\GroceryCrud;
use Modules\Homepage\Entities\Slide;
use Modules\Homepage\Entities\Video;

class HomepageController extends Controller
{
    private function _getDatabaseConnection() {
        $databaseConnection = config('database.default');
        $databaseConfig = config('database.connections.' . $databaseConnection);


        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'database' => $databaseConfig['database'],
                'username' => $databaseConfig['username'],
                'password' => $databaseConfig['password'],
                'charset' => 'utf8'
            ]
        ];
    }

    private function _getGroceryCrudEnterprise() {
        $database = $this->_getDatabaseConnection();
        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);

        return $crud;
    }

    private function _show_output($output, $title = '') {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
                  ->header('Content-Type', 'application/json')
                  ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;

        return view('grocery', [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files,
            'title' => $title
        ]);
    }

    public function slider()
    {
        $title = "Slide Show";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('slides');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Slide Show', 'Slide Shows');
        $crud->columns(['name', 'description', 'updated_at']);
        $crud->requiredFields(['name', 'description', 'file']);
        $crud->fields(['name', 'description', 'file']);
        $crud->setTexteditor(['description']);
        $crud->setFieldUpload('file', 'storage', '../storage');
        $crud->callbackAfterInsert(function ($s) {
            $category = Slide::find($s->insertId);
            $category->created_at = now();
            $category->save();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $category = Slide::find($s->primaryKeyValue);
            $category->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function video()
    {
        $title = "Video";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('videos');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Video', 'Videos');
        $crud->columns(['name', 'youtube', 'updated_at']);
        $crud->requiredFields(['name', 'youtube']);
        $crud->fields(['name', 'youtube']);
        $crud->callbackAfterInsert(function ($s) {
            $category = Video::find($s->insertId);
            $category->created_at = now();
            $category->save();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $category = Video::find($s->primaryKeyValue);
            $category->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
