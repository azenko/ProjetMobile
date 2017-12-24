<li class="{{ Request::is('sandwitches*') ? 'active' : '' }}">
    <a href="{!! route('sandwitches.index') !!}"><i class="fa fa-edit"></i><span>Sandwitches</span></a>
</li>

<li class="{{ Request::is('boissons*') ? 'active' : '' }}">
    <a href="{!! route('boissons.index') !!}"><i class="fa fa-edit"></i><span>Boissons</span></a>
</li>

<li class="{{ Request::is('desserts*') ? 'active' : '' }}">
    <a href="{!! route('desserts.index') !!}"><i class="fa fa-edit"></i><span>Desserts</span></a>
</li>

