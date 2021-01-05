<?php

namespace Modules\Member\Http\Controllers;

use App\Site;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GroceryCrud\Core\GroceryCrud;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class MemberController extends Controller
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

    public function index()
    {
        $title = "Members";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->unsetAdd()->unsetDelete()->unsetDeleteMultiple();
        $crud->setTable('users');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Member', 'Members');
        $crud->columns(['name', 'last_name', 'email', 'site_id', 'updated_at']);
        $crud->editFields(['name', 'last_name', 'email']);
        $crud->requiredFields(['name', 'last_name', 'email']);
        $crud->setRelation('site_id', 'sites', 'name');
        $crud->where([
            'role_id' => 2
        ]);
        $crud->displayAs([
            'site_id' => 'Website'
        ]);
        $crud->callbackAfterInsert(function ($s) {
            $category = User::find($s->insertId);
            $category->created_at = now();
            $category->save();

            // Sinao
            Http::post(config('app.sinao').'masuk', [
                'email' => $category->email,
                'password' => $category->password,
                'name' => $category->name,
                'last_name' => $category->last_name,
                'init' => 'smart'
            ]);

            // Tebar
            Http::post(config('app.tebar').'masuk', [
                'email' => $category->email,
                'password' => $category->password,
                'name' => $category->name,
                'last_name' => $category->last_name,
                'init' => "smart"
            ]);

            // Jogja
            Http::post(config('app.jogja').'masuk', [
                'email' => $category->email,
                'password' => $category->password,
                'name' => $category->name,
                'last_name' => $category->last_name,
                'init' => "smart"
            ]);

            // EZPay
            Http::post(config('app.ezpay').'masuk', [
                'email' => $category->email,
                'password' => $category->password,
                'name' => $category->name,
                'last_name' => $category->last_name,
                'init' => "smart"
            ]);

            // Cilik
            Http::post(config('app.cilik').'masuk', [
                'email' => $category->email,
                'password' => $category->password,
                'name' => $category->name,
                'last_name' => $category->last_name,
                'init' => "smart"
            ]);

            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $category = User::find($s->primaryKeyValue);
            $category->save();
            $category->refresh();
            $category = User::find($s->primaryKeyValue);

            // ezpay
            Http::post(config('app.ezpay').'update', [
                'name' => $category->name,
                'last_name' => $category->last_name,
                'email' => $category->email
            ]);

            // sinao
            Http::post(config('app.sinao').'update', [
                'name' => $category->name,
                'last_name' => $category->last_name,
                'email' => $category->email
            ]);

            // tebar
            Http::post(config('app.tebar').'update', [
                'name' => $category->name,
                'last_name' => $category->last_name,
                'email' => $category->email
            ]);

            // jogja
            Http::post(config('app.jogja').'update', [
                'name' => $category->name,
                'last_name' => $category->last_name,
                'email' => $category->email
            ]);

            // cilik
            Http::post(config('app.cilik').'update', [
                'name' => $category->name,
                'last_name' => $category->last_name,
                'email' => $category->email
            ]);
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function admin()
    {
        $title = "Admins";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('users');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Admin', 'Admins');
        $crud->columns(['name', 'last_name', 'email', 'updated_at']);
        $crud->addFields(['name', 'last_name', 'email', 'password']);
        $crud->editFields(['name', 'last_name', 'email']);
        $crud->uniqueFields(['email']);
        $crud->requiredFields(['name', 'last_name', 'email']);
        $crud->where([
            'role_id' => 1
        ]);
        $crud->callbackAfterInsert(function ($s) {
            $category = User::find($s->insertId);
            $category->created_at = now();
            $category->password = Hash::make($category->password);
            $category->role_id = 1;
            $category->save();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $category = User::find($s->primaryKeyValue);
            $category->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function site()
    {
        $title = "Sites";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('sites');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Site', 'Sites');
        $crud->columns(['name', 'description', 'updated_at']);
        $crud->fields(['name', 'description']);
        $crud->callbackAfterInsert(function ($s) {
            $category = Site::find($s->insertId);
            $category->created_at = now();
            $category->save();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $category = Site::find($s->primaryKeyValue);
            $category->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
