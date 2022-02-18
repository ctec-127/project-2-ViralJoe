<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="display-records.php">Student Records Manager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item <?= echoActiveClassIfRequestMatches("display-records") ?>">
          <a class="nav-link active" aria-current="page" href="display-records.php">Home</a>
        </li>
        <li class="nav-item <?= echoActiveClassIfRequestMatches("create-record") ?>">
          <a class="nav-link" href="create-record.php">Create Record</a>
        </li>
        <li class="nav-item <?= echoActiveClassIfRequestMatches("advanced-search") ?>">
          <a class="nav-link" href="advanced-search.php">Advanced Search</a>
        </li>
      </ul>
      <form class="d-flex" action="search-records.php" method="post">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
    </div>

  </div>
</nav>