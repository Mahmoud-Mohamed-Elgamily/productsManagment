


<li class="{{ Request::is('criterias*') ? 'active' : '' }}">
    <a href="{{ route('criterias.index') }}"><i class="fa fa-edit"></i><span>Criterias</span></a>
</li>




<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{{ route('products.index') }}"><i class="fa fa-edit"></i><span>Products</span></a>
</li>

