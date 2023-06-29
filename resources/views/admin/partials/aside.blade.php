<aside class="">

    @auth
        <nav>
            <ul>
                <li><a href="{{ route('admin.home')}}"><i class="fa-solid fa-table-columns"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.projects.index')}}"><i class="fa-solid fa-folder-open"></i> Progetti</a></li>
                <li><a href="{{ route('admin.categories.index')}}"><i class="fa-solid fa-folder-open"></i> Tipologie</a></li>
                <li><a href="{{ route('admin.projects.create')}}"><i class="fa-solid fa-folder-plus"></i> Nuovo progetto</a></li>
            </ul>
    @endauth

    </nav>
</aside>
