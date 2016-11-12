<a href="<?php echo site_url('agenda/add');?>">Tambah</a><p/>
<?php foreach ($list_user as $user): ?>

        <h4><?php echo $user['username']; ?></h4>
        <div class="main">
                <?php echo $agenda['bagian']; ?>
        </div>
        <p><a href="<?php echo site_url('user/'.$agenda['username']); ?>">Rubah User</a></p>

<?php endforeach; ?>