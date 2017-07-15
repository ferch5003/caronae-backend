<?php
namespace Caronae\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HubController extends CrudController
{
    public function setup() {
        $this->crud->setModel('Caronae\Models\Hub');
        $this->crud->setRoute('admin/hubs');
        $this->crud->setEntityNameStrings('hub', 'hubs');
        $this->crud->setDefaultPageLength(100);

        $this->crud->setColumns([
            [ 'name' => 'name', 'label' => 'Nome' ],
            [ 'name' => 'center', 'label' => 'Centro' ],
            [ 'name' => 'campus', 'label' => 'Campus' ],
        ]);

        $this->crud->addFields([
            [ 'name' => 'name', 'label' => 'Nome' ],
            [ 'name' => 'center', 'label' => 'Centro' ],
            [ 'name' => 'campus', 'label' => 'Campus' ],
        ]);
    }

    public function store()
    {
        $this->clearCache();
        return parent::storeCrud();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'center' => 'required|string',
            'campus' => 'required|string',
        ]);

        $this->clearCache();
        return parent::updateCrud();
    }

    private function clearCache()
    {
        Log::info('Clearing campi cache.');
        Cache::forget('campi');
    }
}