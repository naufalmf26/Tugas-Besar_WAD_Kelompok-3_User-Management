<?php

namespace Modules\Article\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use GroceryCrud\Core\GroceryCrud;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Article\Entities\ArticleCategory;
use Illuminate\Support\Str;
use Modules\Article\Entities\Article;

class ArticleController extends Controller
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

    public function category()
    {
        $title = "Article Category";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('article_categories');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Category', 'Categories');
        $crud->columns(['name', 'slug', 'description', 'updated_at']);
        $crud->requiredFields(['name', 'description', 'image']);
        $crud->fields(['name', 'description', 'image']);
        $crud->setTexteditor(['description']);
        $crud->uniqueFields(['slug']);
        $crud->setFieldUpload('image', 'storage', '../storage');
        $crud->callbackAfterInsert(function ($s) {
            $category = ArticleCategory::find($s->insertId);
            $category->slug = Str::slug($category->name);
            $category->created_at = now();
            $category->save();
            $category->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $category = ArticleCategory::find($s->primaryKeyValue);
            $category->slug = Str::slug($category->name);
            $category->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function index()
    {
        $title = "Articles";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('articles');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Article', 'Articles');
        $crud->columns(['name', 'slug', 'short_description', 'article_category_id', 'updated_at']);
        $crud->requiredFields(['name', 'short_description', 'long_description', 'image', 'article_category_id', 'status_id']);
        $crud->fields(['name', 'short_description', 'long_description', 'image', 'article_category_id', 'status_id']);
        $crud->setTexteditor(['long_description', 'short_description']);
        $crud->uniqueFields(['slug']);
        $crud->setFieldUpload('image', 'storage', 'storage');
        $crud->setRelation('status_id', 'statuses', 'name');
        $crud->setRelation('article_category_id', 'article_categories', 'name');
        $crud->displayAs([
            'article_category_id' => 'Article Category',
            'status_id' => 'Status'
        ]);
        $crud->callbackAfterInsert(function ($s) {
            $article = Article::find($s->insertId);
            $article->slug = Str::slug($article->name);
            $article->user_id = Auth::id();
            $article->created_at = now();
            $article->save();
            $article->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $article = Article::find($s->primaryKeyValue);
            $article->slug = Str::slug($article->name);
            $article->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
