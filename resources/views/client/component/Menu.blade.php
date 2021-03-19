<nav class="primary-menu">

    <ul class="menu-container">
        <li class="menu-item"><a class="menu-link" href="{{route('client.home')}}">
                <div>Home</div>
            </a></li>

         @foreach (App\Models\ProductsCategoryModel::orderby('name', 'asc')->where('parent_id', 0)->where('is_menu', 1) ->get()  as $parentCat)
        <li class="menu-item">
            <a class="menu-link" href="{{ route('client.category',  $parentCat->slug) }} ">
                <div>{{ $parentCat->name }}</div>
            </a>
            @php
                $childcats=App\Models\ProductsCategoryModel::orderby('name', 'asc') ->where('parent_id', $parentCat->id)  ->get() ;
            @endphp
            @if ($childcats->count()>0)
            <ul class="sub-menu-container">
                @foreach ( $childcats as $childCat)
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('client.category', $childCat->slug) }}">
                        <div>{{ $childCat->name }}</div>
                    </a>
                </li>
               
                  @endforeach
            </ul>
            @endif
        </li>
      @endforeach
        <li class="menu-item"><a class="menu-link" href="#">
                <div>About</div>
            </a></li>
        <li class="menu-item"><a class="menu-link" href="#">
                <div>Contact</div>
            </a></li>
    </ul>

</nav>
