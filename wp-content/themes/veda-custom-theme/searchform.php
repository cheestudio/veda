<form role="search" method="get" class="form-search" action="<?php echo home_url('/'); ?>">
  <input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-query" placeholder="Search ...">
  <button type="submit">Search</button>
</form>
