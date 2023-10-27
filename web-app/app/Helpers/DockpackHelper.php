<?php
use App\Models\Dockpack;

function getDockpacks() {
    $userId = auth()->id();
    $dockpacks = Dockpack::where('owner', $userId)->get();
    return $dockpacks->map(function($dockpack) {
        $dockpack['name'] =  $dockpack['name'];
        $dockpack['route'] = route('pack', ['id' => $dockpack['id'], 'date_range' => '30_days']);
        $dockpack['active'] = request()->is('pack/'.$dockpack['id']) ? true : false;
        $dockpack['active_class'] = $dockpack['active'] ? 'active' : '';
        return $dockpack;
    })->toArray();
}
