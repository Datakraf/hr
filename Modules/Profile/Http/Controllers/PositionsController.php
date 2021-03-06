<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Profile\Entities\Position;
use Datakraf\Traits\AlertMessage;
use Modules\Profile\Http\Requests\CreatePositionRequest;

class PositionsController extends Controller
{
    use AlertMessage;

    protected $position;

    public function __construct(Position $position, Request $request)
    {
        $this->position = $position;
        $this->data = ['name' => $request->name, 'description' => $request->description];
        $this->columnNames = ['name', 'description'];
        $this->actions = [
            'edit' => [
                'url' => 'position.edit',
                'text' => ucwords('edit'),
                'class' => 'text-dark',
                'id' => ''
            ]
        ];
        $this->deleteAction = [
            'delete' => [
                'url' => 'position.destroy',
                'text' => ucwords('delete'),
                'class' => 'text-danger',
                'id' => ''
            ]
        ];

    }
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index()
    {
        $results = $this->position->all();
        return view('profile::forms.personal-details.positions', ['columnNames' => $this->columnNames, 'results' => $results, 'actions' => $this->actions, 'deleteAction' => $this->deleteAction]);
    }

    public function store(CreatePositionRequest $request)
    {
        $this->position->create($this->data);
        toast($this->message('save', 'Position ' . $request->name), 'success', 'top-right');
        return redirect()->route('position.index');
    }

    public function edit($id)
    {
        return view('profile::forms.personal-details.positions', [
            'entity' => $this->position->find($id),
            'columnNames' => $this->columnNames,
            'actions' => $this->actions,
            'results' => $this->position->all(),
            'deleteAction' => $this->deleteAction
        ]);
    }

    public function update(CreatePositionRequest $request, $id)
    {
        $this->position->find($id)->update($this->data);
        toast($this->message('update', 'Position #' . $id), 'success', 'top-right');
        return redirect()->route('position.index');
    }


    public function destroy($id)
    {
        $this->position->find($id)->delete();
        toast($this->message('delete', 'Position #' . $id), 'success', 'top-right');
        return redirect()->route('position.index');
    }
}
