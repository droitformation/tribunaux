<li id="search">
    <a href="javascript:;"><i class="fa fa-search opacity-control"></i></a>
    <form action="{{ url('admin/search') }}" method="POST">
        <input type="text" class="search-query" name="search" placeholder="Recherche...">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</li>