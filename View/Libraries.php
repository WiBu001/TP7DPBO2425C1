<section class="library-section">
    <h2>Library</h2>

    <!-- Add / Edit Library Form -->
    <div class="form-container">
        <h3><?php echo isset($_GET['edit']) ? 'Edit' : 'Add'; ?> Library</h3>
        <form method="POST" action="index.php?page=library">
            <?php if (isset($_GET['edit'])): ?>
                <input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="user_id">User:</label>
                <select id="user_id" name="user_id" required>
                    <option value="">-- Select User --</option>
                    <?php foreach ($usersList as $user): ?>
                        <option value="<?php echo $user['id']; ?>"
                            <?php echo (isset($editLibrary) && $editLibrary['user_id'] == $user['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($user['username']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="game_id">Game:</label>
                <select id="game_id" name="game_id" required>
                    <option value="">-- Select Game --</option>
                    <?php foreach ($gamesList as $game): ?>
                        <option value="<?php echo $game['id']; ?>"
                            <?php echo (isset($editLibrary) && $editLibrary['game_id'] == $game['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($game['title']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="acquired_date">Acquired Date:</label>
                <input type="date" id="acquired_date" name="acquired_date" required
                       value="<?php echo isset($editLibrary) ? htmlspecialchars($editLibrary['acquired_date']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="time_played">Time Played (hours):</label>
                <input type="number" id="time_played" name="time_played" min="0" step="1" required
                       value="<?php echo isset($editLibrary) ? htmlspecialchars($editLibrary['time_played']) : ''; ?>">
            </div>

            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update_library' : 'add_library'; ?>">
                <?php echo isset($_GET['edit']) ? 'Update' : 'Add'; ?> Library
            </button>

            <?php if (isset($_GET['edit'])): ?>
                <a href="?page=library" class="cancel-btn">Cancel</a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Library List -->
    <div class="table-container">
        <h3>Library List</h3>
        <?php if (empty($libraryList)): ?>
            <p>No library data found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Game</th>
                        <th>Acquired Date</th>
                        <th>Time Played (hours)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($libraryList as $lib): ?>
                        <tr>
                            <td><?php echo $lib['id']; ?></td>
                            <td><?php echo htmlspecialchars($lib['username']); ?></td>
                            <td><?php echo htmlspecialchars($lib['title']); ?></td>
                            <td><?php echo htmlspecialchars($lib['acquired_date']); ?></td>
                            <td><?php echo htmlspecialchars($lib['time_played']); ?></td>
                            <td class="actions">
                                <a href="?page=library&edit=<?php echo $lib['id']; ?>" class="edit-btn">Edit</a>
                                <a href="?page=library&delete=<?php echo $lib['id']; ?>" class="delete-btn"
                                   onclick="return confirm('Are you sure you want to delete this library record?');">
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