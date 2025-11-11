<?php
require_once 'Class/user.php';
require_once 'Class/game.php';
require_once 'Class/genre.php';
require_once 'Class/library.php';

$user = new User();
$game = new Game();
$genre = new Genre();
$library = new Library();

// Users CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        $user->createUser($_POST['username'], $_POST['password']);
        header("Location: index.php?page=users"); exit;
    }
    if (isset($_POST['update_user'])) {
        $user->updateUser($_POST['id'], $_POST['username'], $_POST['password'] ?? null);
        header("Location: index.php?page=users"); exit;
    }

    // Games CRUD
    if (isset($_POST['add_game'])) {
        $game->createGame($_POST['title'], $_POST['price'], $_POST['genre_id'], $_POST['developer']);
        header("Location: index.php?page=games"); exit;
    }
    if (isset($_POST['update_game'])) {
        $game->updateGame($_POST['id'], $_POST['title'], $_POST['price'], $_POST['genre_id'], $_POST['developer']);
        header("Location: index.php?page=games"); exit;
    }

    // Genres CRUD
    if (isset($_POST['add_genre'])) {
        $genre->createGenre($_POST['genre_name']);
        header("Location: index.php?page=genres"); exit;
    }
    if (isset($_POST['update_genre'])) {
        $genre->updateGenre($_POST['id'], $_POST['genre_name']);
        header("Location: index.php?page=genres"); exit;
    }

    // Library CRUD
    if (isset($_POST['add_library'])) {
        $library->createLibrary($_POST['user_id'], $_POST['game_id'], $_POST['acquired_date'], $_POST['time_played']);
        header("Location: index.php?page=library"); exit;
    }
    if (isset($_POST['update_library'])) {
        $library->updateLibrary($_POST['id'], $_POST['user_id'], $_POST['game_id'], $_POST['acquired_date'], $_POST['time_played']);
        header("Location: index.php?page=library"); exit;
    }
}

// Delete operations via GET
if (isset($_GET['delete'])) {
    switch($_GET['page']) {
        case 'users': $user->deleteUser($_GET['delete']); break;
        case 'games': $game->deleteGame($_GET['delete']); break;
        case 'genres': $genre->deleteGenre($_GET['delete']); break;
        case 'library': $library->deleteLibrary($_GET['delete']); break;
    }
    header("Location: index.php?page=" . $_GET['page']); exit;
}

// Load data for views
$page = $_GET['page'] ?? 'users';
if ($page == 'users') {
    $usersList = $user->getAllUsers();
    if (isset($_GET['edit'])) $editUser = $user->getUserById($_GET['edit']);
}
if ($page == 'games') {
    $gamesList = $game->getAllGames();
    $genresList = $genre->getAllGenres(); // untuk form select genre
    if (isset($_GET['edit'])) $editGame = $game->getGameById($_GET['edit']);
}
if ($page == 'genres') {
    $genresList = $genre->getAllGenres();
    if (isset($_GET['edit'])) $editGenre = $genre->getGenreById($_GET['edit']);
}
if ($page == 'library') {
    $libraryList = $library->getAllLibraries();
    $usersList = $user->getAllUsers();
    $gamesList = $game->getAllGames();
    if (isset($_GET['edit'])) $editLibrary = $library->getLibraryById($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Platform Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Game Platform</h1>
        <nav>
            <a href="?page=users" class="<?= $page=='users'?'active':'' ?>">Users</a>
            <a href="?page=games" class="<?= $page=='games'?'active':'' ?>">Games</a>
            <a href="?page=genres" class="<?= $page=='genres'?'active':'' ?>">Genres</a>
            <a href="?page=library" class="<?= $page=='library'?'active':'' ?>">Library</a>
        </nav>
    </header>

    <main>
        <?php
        switch($page){
            case 'users': include 'View/Users.php'; break;
            case 'games': include 'view/Games.php'; break;
            case 'genres': include 'view/Genres.php'; break;
            case 'library': include 'view/Libraries.php'; break;
            default: include 'view/users.php'; break;
        }
        ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Game Platform</p>
    </footer>
</body>
</html>
