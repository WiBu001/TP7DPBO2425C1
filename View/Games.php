<section class="games-section">
    <h2>Games</h2>

    <!-- Add / Edit Game Form -->
    <div class="form-container">
        <h3><?php echo isset($_GET['edit']) ? 'Edit' : 'Add'; ?> Game</h3>
        <form method="POST" action="index.php?page=games">
            <?php if (isset($_GET['edit'])): ?>
                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required
                       value="<?php echo isset($editGame) ? htmlspecialchars($editGame['title']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="price">Price ($):</label>
                <input type="number" id="price" name="price" step="0.01" required
                       value="<?php echo isset($editGame) ? htmlspecialchars($editGame['price']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="genre_id">Genre:</label>
                <select id="genre_id" name="genre_id" required>
                    <option value="">-- Select Genre --</option>
                    <?php foreach ($genresList as $genre): ?>
                        <option value="<?php echo $genre['id']; ?>"
                            <?php echo (isset($editGame) && $editGame['genre_id'] == $genre['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($genre['genre_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="developer">Developer:</label>
                <input type="text" id="developer" name="developer" required
                       value="<?php echo isset($editGame) ? htmlspecialchars($editGame['developer']) : ''; ?>">
            </div>

            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update_game' : 'add_game'; ?>">
                <?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> Game
            </button>
            <?php if (isset($_GET['edit'])): ?>
                <a href="?page=games" class="cancel-btn">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Games List -->
    <div class="table-container">
        <h3>Games List</h3>
        <?php if (empty($gamesList)): ?>
            <p>No games found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Price ($)</th>
                        <th>Genre</th>
                        <th>Developer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gamesList as $game): ?>
                        <tr>
                            <td><?php echo $game['id']; ?></td>
                            <td><?php echo htmlspecialchars($game['title']); ?></td>
                            <td><?php echo htmlspecialchars($game['price']); ?></td>
                            <td><?php echo htmlspecialchars($game['genre_name']); ?></td>
                            <td><?php echo htmlspecialchars($game['developer']); ?></td>
                            <td class="actions">
                                <a href="?page=games&edit=<?php echo $game['id']; ?>" class="edit-btn">Edit</a>
                                <a href="?page=games&delete=<?php echo $game['id']; ?>" class="delete-btn"
                                   onclick="return confirm('Are you sure you want to delete this game?');">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>
