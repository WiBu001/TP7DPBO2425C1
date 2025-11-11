<section class="genres-section">
    <h2>Genres</h2>
    
    <!-- Add / Edit Genre Form -->
    <div class="form-container">
        <h3><?php echo isset($_GET['edit']) ? 'Edit' : 'Add'; ?> Genre</h3>
        <form method="POST" action="index.php?page=genres">
            <?php if (isset($_GET['edit'])): ?>
                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="genre_name">Genre Name:</label>
                <input type="text" id="genre_name" name="genre_name" required 
                       value="<?php echo isset($editGenre) ? htmlspecialchars($editGenre['genre_name']) : ''; ?>">
            </div>

            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update_genre' : 'add_genre'; ?>">
                <?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> Genre
            </button>

            <?php if (isset($_GET['edit'])): ?>
                <a href="?page=genres" class="cancel-btn">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Genres List -->
    <div class="table-container">
        <h3>Genres List</h3>
        <?php if (empty($genresList)): ?>
            <p>No genres found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Genre Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($genresList as $genre): ?>
                        <tr>
                            <td><?php echo $genre['id']; ?></td>
                            <td><?php echo htmlspecialchars($genre['genre_name']); ?></td>
                            <td class="actions">
                                <a href="?page=genres&edit=<?php echo $genre['id']; ?>" class="edit-btn">Edit</a>
                                <a href="?page=genres&delete=<?php echo $genre['id']; ?>" 
                                   class="delete-btn" 
                                   onclick="return confirm('Are you sure you want to delete this genre?');">
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
