<?php
require_once __DIR__ . '/../Class/user.php';
$userClass = new User();

// Proses form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_user'])) {
        $userClass->createUser($_POST['username'], $_POST['password'] ?? '');
        header("Location: index.php?page=users");
        exit;
    } elseif (isset($_POST['update_user'])) {
        $userClass->updateUser($_POST['id'], $_POST['username'], $_POST['password'] ?? null);
        header("Location: index.php?page=users");
        exit;
    }
}

// Proses delete
if (isset($_GET['delete'])) {
    $userClass->deleteUser($_GET['delete']);
    header("Location: index.php?page=users");
    exit;
}

// Ambil data untuk edit
$editUser = null;
if (isset($_GET['edit'])) {
    $editUser = $userClass->getUserById($_GET['edit']);
}

// Ambil semua user
$usersList = $userClass->getAllUsers();
?>

<section class="users-section">
    <h2>Users</h2>
    
    <!-- Add/Edit User Form -->
    <div class="form-container">
        <h3><?php echo isset($editUser) ? 'Edit' : 'Add'; ?> User</h3>
        <form method="POST" action="?page=users">
            <?php if(isset($editUser)): ?>
                <input type="hidden" name="id" value="<?php echo $editUser['id']; ?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required value="<?php echo isset($editUser) ? htmlspecialchars($editUser['username']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" <?php echo isset($editUser) ? '' : 'required'; ?> placeholder="<?php echo isset($editUser) ? 'Leave blank to keep current password' : ''; ?>">
            </div>
            <button type="submit" name="<?php echo isset($editUser) ? 'update_user' : 'add_user'; ?>">
                <?php echo isset($editUser) ? 'Update' : 'Add'; ?> User
            </button>
            <?php if(isset($editUser)): ?>
                <a href="?page=users" class="cancel-btn">Cancel</a>
            <?php endif; ?>
        </form>
    </div>
    
    <!-- Users List -->
    <div class="table-container">
        <h3>Users List</h3>
        <?php if(empty($usersList)): ?>
            <p>No users found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usersList as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td class="actions">
                                <a href="?page=users&edit=<?php echo $user['id']; ?>" class="edit-btn">Edit</a>
                                <a href="?page=users&delete=<?php echo $user['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>
