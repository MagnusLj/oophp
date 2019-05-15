<form method="post" action="search-title">
    <fieldset>
    <legend>Search</legend>
    <!-- <input type="hidden" name="route" value="search-title"> -->
    <p>
        <label>Title (use % as wildcard):
            <input type="text" name="searchTitle" value="<?= $searchTitle ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    <!-- <p><a href="?">Show all</a></p> -->
    </fieldset>
</form>
